<?php

session_start();

require_once 'functions.php';

if (isset($_SESSION['user'])) {
    header("Location: /403.php");
    exit();
}

$users = getUsers($db);
$categories = getCategories($db);
$required = ['email', 'password', 'name', 'message'];
$dict = ['email' => 'Email', 'password' => 'Пароль', 'name' => 'Имя', 'message' => 'Контактные данные'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $form = $_POST;

    foreach ($form as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$dict[$key]] = 'Это поле надо заполнить';
            }
        }
    }

    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Введите правильный формат email";
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories, 'errors' => $errors, 'form' => $form]);
    } else {
        if ($form['email'] == searchUserByEmail($form['email'], $users)['email']) {
            $errors['Email'] = 'Уже существует пользователь с таким email';
            $page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories, 'errors' => $errors, 'form' => $form]);
        } else {
            $db_connection = connectToDatabase($db);
            $name_user =  mysqli_real_escape_string($db_connection, $form['name']);
            $email_user =  mysqli_real_escape_string($db_connection, $form['email']);
            $password_user = password_hash($form['password'], PASSWORD_DEFAULT);
            $contacts_user =  mysqli_real_escape_string($db_connection, $form['message']);
            $date_create = date('Y-m-d H:i:s');
            $sql_add_user = "INSERT INTO Users (`name`, `email`, `password`, `contact`, `date_registration`) VALUES (?, ?, ?, ?, ?)";

            $add_new_user = mysqli_prepare($db_connection, $sql_add_user);
            mysqli_stmt_bind_param($add_new_user, 'sssss', $name_user, $email_user, $password_user, $contacts_user, $date_create);

            mysqli_stmt_execute($add_new_user);
            header("Location:index.php");
        }
    }
} else {
    $page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories]);
}

$layout_content = renderTemplate('templates/layout.php', ['title' => 'Регистрация', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

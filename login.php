<?php

session_start();

require_once 'functions.php';

$users = getUsers($db);
$categories = getCategories($db);
$required = ['email', 'password'];
$dict = ['email' => 'Email', 'password' => 'Пароль'];

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

    if (!count($errors) && $user = searchUserByEmail($form['email'], $users)) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['Password'] = 'Неверный пароль';
        }
    } else {
        $errors['Email'] = 'Такой пользователь не найден';
    }
    if (count($errors)) {
        $page_content = renderTemplate('templates/login.php', ['errors' => $errors, 'categories' => $categories, 'form' => $form]);
    } else {
        header("Location: /index.php");
        exit();
    }
} else {
    if (isset($_SESSION['user'])) {
        $page_content = renderTemplate('templates/main.php', ['arrayOfProduct' => $arrayOfProduct, 'categories' => $categories]);
    } else {
        $page_content = renderTemplate('templates/login.php', ['categories' => $categories]);
    }
}

$layout_content = renderTemplate('templates/layout.php', ['title' => 'Страница авторизации', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

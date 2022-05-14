<?php

session_start();

require_once 'functions.php';

$categories = getCategories($db);

if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lot = $_POST;
        $required = ['name', 'category', 'detail', 'cost_start', 'cost_step', 'date_finished'];
        $dict = ['name' => 'Наименование', 'category' => 'Категория', 'detail' => 'Описание', 'cost_start' => 'Начальная цена', 'cost_step' => 'Шаг ставки', 'date_finished' => 'Дата окончания торгов'];
        $errors = [];

        foreach ($_POST as $key => $value) {
            if (in_array($key, $required)) {
                if (!$value) {
                    $errors[$dict[$key]] = 'Это поле надо заполнить';
                }
            }
        }

        if ($_POST['category'] === 'Выберите категорию') {
            $errors[$dict['category']] = 'Это поле надо заполнить';
        }

        if (($_FILES['url']['error'] == 0)) {
            $tmp_name = $_FILES['url']['tmp_name'];
            $path = uniqid() . $_FILES['url']['name'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);
            $png = "image/png";
            $jpeg = "image/jpeg";
            if ($file_type !== $jpeg && $file_type !== $png) {
                $errors['Изображение'] = 'Загрузите картинку в формате JPG или PNG';
            } else {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $path = 'img/' . $path;
                $lot['url'] = $path;
            }
        } else if (($_FILES['url']['error'] == 1) || ($_FILES['url']['error']) == 2) {
            $errors['Изображение'] = 'Превышен допустимый размер файла';
        } else {
            $errors['Изображение'] = 'Вы не загрузили изображение';
        }

        if (count($errors)) {
            $page_content = renderTemplate('templates/add-lot.php', ['arrayOfProduct' => $arrayOfProduct, 'lot' => $lot, 'errors' => $errors, 'categories' => $categories]);
        } else {
            $db_connection = connectToDatabase($db);
            $name_lot =  mysqli_real_escape_string($db_connection, $lot['name']); //Просто так экскейп стринг, м без него
            $category_id =  getOneCategory($db, $lot['category'])[0]['id'];
            //можно тупо добавить id в values и убрать функцию, но уже лень
            $detail_lot = mysqli_real_escape_string($db_connection, $lot['detail']);
            $cost_start = $lot['cost_start'];
            $cost_step = $lot['cost_step'];
            $image_url =  $lot['url'];
            $date_finished = $lot['date_finished'];
            $user_id = json_decode($_SESSION['user']['id']);

            $sql_add_lot = "INSERT INTO lots (`user_id`, `category_id`, `name`, `detail`, `cost_start`, `cost_step`, `url`, `date_create`, `date_finished`) VALUES (?, ?, ?, ?, ?,?, ?, now(), ?)";

            $add_new_lot = mysqli_prepare($db_connection, $sql_add_lot);
            mysqli_stmt_bind_param($add_new_lot, 'iissddss', $user_id, $category_id, $name_lot, $detail_lot, $cost_start, $cost_step, $image_url, $date_finished);
            mysqli_stmt_execute($add_new_lot);

            $time_limited = getExpirationTime($lot['date_finished']);
            $page_content = renderTemplate('templates/lot.php', ['arrayOfProduct' => $arrayOfProduct, 'lot' => $lot, 'categories' => $categories, 'time_limited' => $time_limited]);
        }
    } else {
        $page_content = renderTemplate('templates/add-lot.php', ['arrayOfProduct' => $arrayOfProduct, 'lot' => $lot, 'categories' => $categories]);
    }

    $layout_content = renderTemplate('templates/layout.php', ['title' => 'Добавить лот', 'content' => $page_content, 'categories' => $categories]);

    print($layout_content);
} else {
    header("Location: /403.php");
    exit();
}

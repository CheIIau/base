<?php

require_once 'initsql.php';

// if (!$link) {
//     $error = mysqli_connect_error();
//     $page_content = renderTemplate('templates/error.php', ['error' => $error]);
//     header("Location: /error.php");
// } else {
//     $sql = 'SELECT `id`, `name` FROM categories';
//     $result = mysqli_query($link, $sql);

//     if ($result) {
//         $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     } else {
//         $error = mysqli_error($link);
//         $page_content = renderTemplate('templates/error.php', ['error' => $error]);
//         header("Location: /error.php");
//     }
// }



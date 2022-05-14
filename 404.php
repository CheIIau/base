<?php

require_once 'functions.php';
$categories = getCategories($db);
$page_content = renderTemplate('templates/404.php');
$layout_content = renderTemplate('templates/layout.php', ['title' => 'Ошибка 404', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

<?php

require_once 'functions.php';
$categories = getCategories($db);
$page_content = renderTemplate('templates/403.php');
$layout_content = renderTemplate('templates/layout.php', ['title' => 'Ошибка 403', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

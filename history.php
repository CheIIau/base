<?php

require_once 'functions.php';

$categories = getCategories($db);
$lots = getLots($db);
$visitedLotsName = "visitedlots";

if (isset($_COOKIE[$visitedLotsName])) {
    $jsonArr = $_COOKIE[$visitedLotsName];
    $visitedArr = json_decode($jsonArr);
};

$page_content = renderTemplate('templates/history.php', ['lots' => $lots, 'visitedArr' => $visitedArr]);
$layout_content = renderTemplate('templates/layout.php', ['title' => 'История просмотров', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

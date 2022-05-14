<?php

require_once 'functions.php';
$categories = getCategories($db);
$search = $_GET['search'];


if (isset($search) && $search != '') {
    $lots = [];
    $db_connection = connectToDatabase($db);
    // queryResult($db_connection, 'CREATE FULLTEXT INDEX lots_srch ON lots (`name`, detail)');
    $sql = "SELECT categories.name AS category, lots.id AS `id`, detail, lots.name AS `name`, cost_start, `url`, date_finished FROM lots
    INNER JOIN categories ON lots.category_id=categories.id WHERE MATCH(lots.name, lots.detail) AGAINST(?)";
    $sql_prepared = mysqli_prepare($db_connection, $sql);
    mysqli_stmt_bind_param($sql_prepared, 's', $search);
    mysqli_stmt_execute($sql_prepared);
    $result = mysqli_stmt_get_result($sql_prepared);
    $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $page_content = renderTemplate('templates/search.php', ['lots' => $lots, 'search' => $search]);
} else {
    header("Location:index.php");
}

$layout_content = renderTemplate('templates/layout.php', ['title' => 'Результаты поиска', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

<?php

require_once 'functions.php';
// require_once 'getwinner.php';

$categories = getCategories($db);
$lots = getLots($db);

$db_connection = connectToDatabase($db);
$cur_page = intval($_GET['page']) ?? 1;
$page_items = 6;
$items_count =  intval(queryResult($db_connection, 'SELECT COUNT(*) AS cnt FROM lots')[0]['cnt']);
$pages_count = intval(ceil($items_count / $page_items));
$offset = ($cur_page - 1) * $page_items;
$pages = range(1, $pages_count);
if (isset($_GET['page'])) {
    $sql = "SELECT categories.name AS category, lots.id AS `id`, detail, lots.name AS `name`, cost_start, cost_step, `url`, date_finished FROM lots
    INNER JOIN categories ON lots.category_id=categories.id
    ORDER BY lots.id DESC LIMIT ? OFFSET ?";

    $sql_prepared = mysqli_prepare($db_connection, $sql);
    mysqli_stmt_bind_param($sql_prepared, 'ii', $page_items, $offset);
    mysqli_stmt_execute($sql_prepared);
    $result = mysqli_stmt_get_result($sql_prepared);
    $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


$page_content = renderTemplate(
    'templates/main.php',
    [
        'lots' => $lots,
        'categories' => $categories,
        'pages_count' => $pages_count,
        'pages' => $pages,
        'cur_page' => $cur_page
    ]
);
$layout_content = renderTemplate(
    'templates/layout.php',
    [
        'title' => 'Главная',
        'content' => $page_content,
        'categories' => $categories
    ]
);

print($layout_content);

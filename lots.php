<?php

require_once 'functions.php';

$category = $_GET['category'];

$categories = getCategories($db);
$db_connection = connectToDatabase($db);
$cur_page = intval($_GET['page']) ?? 1;
$page_items = 6;
$items_count =  intval(queryResult($db_connection, 'SELECT COUNT(*) AS cnt FROM lots')[0]['cnt']);
$pages_count = intval(ceil($items_count / $page_items));
$offset = ($cur_page - 1) * $page_items;
$pages = range(1, $pages_count);
$search = '2014';
$int_category = intval($category);

if (isset($category) && $category != '') {
  $lots = [];
  $sql = "SELECT categories.name AS category, categories.id, lots.id AS `id`, detail, lots.name AS `name`, cost_start, `url`, date_finished FROM lots
  INNER JOIN categories ON lots.category_id=categories.id WHERE categories.id = ?";
  $sql_prepared = mysqli_prepare($db_connection, $sql);
  mysqli_stmt_bind_param($sql_prepared, 'i', $int_category);
  mysqli_stmt_execute($sql_prepared);
  $result = mysqli_stmt_get_result($sql_prepared);
  $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql_category = "SELECT categories.name AS category FROM categories WHERE categories.id = ?";
  $sql_prepared2 = mysqli_prepare($db_connection, $sql_category);
  mysqli_stmt_bind_param($sql_prepared2, 'i', $int_category);
  mysqli_stmt_execute($sql_prepared2);
  $result2 = mysqli_stmt_get_result($sql_prepared2);
  $category_name = mysqli_fetch_all($result2, MYSQLI_ASSOC);
} else {
  header("Location:index.php");
}

$page_content = renderTemplate(
  'templates/lots.php',
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
    'title' => $category_name[0]["category"],
    'content' => $page_content,
    'categories' => $categories
  ]
);

print($layout_content);

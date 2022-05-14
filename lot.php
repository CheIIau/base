<?php

require_once 'functions.php';
require_once 'classes/database.php';

session_start();

$categories = getCategories($db);
// $lots = getLots($db);
$lot = null;
$lot_id = intval($_GET['id']);

// if (isset($_GET['id'])) {
//     $id = intval($_GET['id']);
//     foreach ($lots as $key => $item) {
//         if ($item['id'] == $id) {
//             $lot = $item;
//             break;
//         }
//     }
// }

$lot = getOneLot($db, $lot_id)[0];
$time_limited = getExpirationTime($lot['date_finished']);

if (!$lot) {
    http_response_code(404);
}
//cookie history
$visitedLotsName = "visitedlots";
$visitedArr = [];
$expire = strtotime("+1 days");
$path = "/";
$visitedArrEncoded = "";

if (isset($_COOKIE[$visitedLotsName])) {
    $jsonArr = $_COOKIE[$visitedLotsName];
    $visitedArr = json_decode($jsonArr);
    if (!in_array($lot_id, $visitedArr)) {
        $visitedArr[] = $lot_id;
    } else {
        $indexInArr = array_search($lot_id, $visitedArr);
        unset($visitedArr[$indexInArr]);
        $visitedArr = array_values($visitedArr);
        $visitedArr[] = $lot_id;
    }
} else {
    $visitedArr[] = $lot_id;
}
$visitedArrEncoded = json_encode($visitedArr);
setcookie($visitedLotsName, $visitedArrEncoded, $expire, $path);
//get rates
$db_connection = connectToDatabase($db);
$sql_get_rates = "SELECT users.name AS `name`, `lot_id`, `cost`, `date_create` FROM rates LEFT JOIN users ON rates.user_id=users.id WHERE `lot_id`='$lot_id' ORDER BY `date_create` DESC LIMIT 10";
$rates = queryResult($db_connection, $sql_get_rates);
//get prices
$cost_step = $lot['cost_step'];
$price = $lot['cost_start'];
$sql_max_bet = "SELECT cost FROM rates WHERE `lot_id`='$lot_id' ORDER BY cost DESC LIMIT 1";
$max_bet = queryResult($db_connection, $sql_max_bet)[0]['cost'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user'])) {
        $errors = [];
        $rate = intval($_POST['cost']);

        if (gettype($rate) != 'integer' || gettype($lot_id) != 'integer') {
            $errors['Ставка'] = 'Введите целочисленную сумму';
        }
        if ($max_bet > $rate) {
            $errors['Маленькая сумма'] = 'Ваша ставка ниже максимальной предложенной';
        }
        if ($rate < $price + $cost_step) {
            $errors['Маленькая сумма'] = 'Ваша ставка должна быть больше, чем цена + шаг';
        }

        if (empty($errors)) {
            $user_id = intval(json_decode($_SESSION['user']['id']));
            $sql = "INSERT INTO rates (`user_id`, lot_id, cost, date_create) VALUES (?, ?, ?, now())";
            $add_new_rate = mysqli_prepare($db_connection, $sql);
            mysqli_stmt_bind_param($add_new_rate, 'iii', $user_id, $lot_id, $rate);
            mysqli_stmt_execute($add_new_rate);
            header("Refresh:0");
        } else {
            $page_content = renderTemplate('templates/lot.php', ['lot' => $lot, 'time_limited' => $time_limited, 'errors' => $errors, 'rates' => $rates, 'max_bet' => $max_bet, 'cost_step' => $cost_step]);
        }
    } else {
        header("Location: /403.php");
        exit();
    }
} else {
    $page_content = renderTemplate('templates/lot.php', ['lot' => $lot, 'time_limited' => $time_limited, 'rates' => $rates, 'max_bet' => $max_bet, 'cost_step' => $cost_step]);
}

$layout_content = renderTemplate('templates/layout.php', ['title' => $lot['name'], 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

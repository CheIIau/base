<?php

require_once 'config/db.php';

function renderTemplate($path, array $data = [])
{
    if (!file_exists($path)) {
        return '';
    } else {
        ob_start();
        extract($data);
        include_once $path;
        $output = ob_get_clean();
        return $output;
    }
}

function formatPrice($price)
{
    if (!is_numeric($price)) {
        return '';
    } else {
        $formatedPrice = ceil($price);
        $formatedPrice = ($formatedPrice > 1000) ? $formatedPrice = number_format($formatedPrice) : $formatedPrice;
        return $formatedPrice;
    }
}

function getExpirationTime($expTime)
{
    $ts = time();
    $ts_finishedTime = strtotime($expTime);
    $milSecsToFinishedTime = $ts_finishedTime - $ts;
    if ($milSecsToFinishedTime < 0) {
        $time_limit[] = 0;
        $time_limit[] = 0;
        $time_limit[] = 0;
        $time_limit[] = 0;
        $time_limit[] = 0;
    } else {
        $seconds = $milSecsToFinishedTime % 60;
        $minutes = floor(($milSecsToFinishedTime % 3600) / 60);
        $hours = floor(($milSecsToFinishedTime % 86400) / 3600);
        $days = floor(($milSecsToFinishedTime / 86400));
        $time_limit[] = $days;
        $time_limit[] = $hours;
        $time_limit[] = $minutes;
        $time_limit[] = $seconds;
        $time_limit[] = $milSecsToFinishedTime;
    }
    return $time_limit;
}

function searchUserByEmail($email, $users)
{
    $result = null;
    foreach ($users as $key => $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}

function queryResult($db_connection, $query)
{

    $queryRes = mysqli_query($db_connection, $query);

    if (!$queryRes) {
        $error = mysqli_error($db_connection);
        print("Error in MySQL: " . $error);
    }

    $result = mysqli_fetch_all($queryRes, MYSQLI_ASSOC);

    return $result;
}

function getCategories($db)
{
    return queryResult(connectToDatabase($db), "SELECT `id`, `name`, `symbol_code` FROM categories ORDER BY id ASC");
}

function connectToDatabase($db)
{
    $db_connection = mysqli_connect($db['host'], $db['user'], $db['password'], $db['db_name']);
    mysqli_set_charset($db_connection, 'utf8');

    if ($db_connection == false) {
        print("Error connection to data base: " . mysqli_connect_error());
    }

    return $db_connection;
}

function getUsers($db)
{
    return queryResult(connectToDatabase($db), "SELECT `id`, `email`, `name`, `password` FROM users ORDER BY id ASC");
}

function getLots($db)
{
    $sql_lots = "SELECT categories.name AS category, lots.id AS `id`, detail, lots.name AS `name`, cost_start, cost_step, `url`, date_finished FROM lots
    INNER JOIN categories ON lots.category_id=categories.id
    ORDER BY lots.id DESC LIMIT 6";
    return queryResult(connectToDatabase($db), $sql_lots);
}

function getOneLot($db, $id)
{
    $sql_lots = "SELECT categories.name AS category, lots.id AS `id`, detail, lots.name AS `name`, cost_start, cost_step, `url`, date_finished FROM lots
    INNER JOIN categories ON lots.category_id=categories.id
    LEFT JOIN rates ON rates.lot_id=lots.id 
	 WHERE lots.id = '$id' ORDER BY lots.id";

    return queryResult(connectToDatabase($db), $sql_lots);
}

function getOneCategory($db, $category)
{
    return queryResult(connectToDatabase($db), "SELECT `id`, `name`, `symbol_code` FROM categories WHERE `name` = '$category'");
}

function sendEmailToUser($text_message, $mail_winner, $name_winner)
{
    $keksSmtpHost = 'phpdemo.ru';
    $keksSmtpPort = 25;
    $my_name_in_keks = 'keks@phpdemo.ru';
    $my_email_in_keks = 'keks@phpdemo.ru';
    $my_password_in_keks = 'htmlacademy';


    $transport = (new Swift_SmtpTransport($keksSmtpHost, $keksSmtpPort))
        ->setUsername($my_name_in_keks)
        ->setPassword($my_password_in_keks);

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message())
        ->setFrom(["keks@phpdemo.ru" => "YetiCave"])
        ->setTo([$mail_winner => $name_winner])
        ->setBody($text_message, 'text/html', 'utf-8');

    $result = $mailer->send($message);
}

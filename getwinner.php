<?php

require_once 'vendor/autoload.php';
require_once 'functions.php';

$db_connection = connectToDatabase($db);
$arrOfWInnerLots = queryResult($db_connection, 'SELECT * FROM lots WHERE (CURRENT_TIMESTAMP >= `date_finished` AND winner_id IS NULL)');

if (isset($arrOfWInnerLots)) {
    foreach ($arrOfWInnerLots as $key => $lot) {
        $winnerLotId = $lot['id'];
        $lotName = $lot['name'];
        // $queryWinnerId = ;
        $winnerId = queryResult($db_connection, "SELECT user_id from rates WHERE `lot_id` = '$winnerLotId' ORDER BY cost DESC LIMIT 1")[0]['user_id'];

        $sql_update_winnerid = "UPDATE lots SET winner_id='$winnerId' WHERE id='$winnerLotId'";
        mysqli_query($db_connection, $sql_update_winnerid);

        $userInfo = queryResult($db_connection, "SELECT `name`, `email`, contact from users WHERE id ='$winnerId'")[0];

        $text_message = renderTemplate(
            'templates/email.php',
            [
                "user_name" => $userInfo["name"],
                "lot_name" => $lotName,
                "lot_id" => $winnerLotId
            ]
        );
        sendEmailToUser($text_message, $userInfo["email"], $userInfo["name"]);
    }
}

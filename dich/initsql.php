<?php

require_once 'config/db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['db_name']);
mysqli_set_charset($link, 'utf8');

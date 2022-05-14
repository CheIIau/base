<?php

session_start();

require_once 'functions.php';

unset($_SESSION['user']);

header("Location: /index.php");
exit();

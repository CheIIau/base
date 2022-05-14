<?php

require_once 'data.php';
require_once 'functions.php';
require_once 'getsqlthings.php';

$layout_content = renderTemplate('templates/layout.php', ['title' => 'Произошла ошибка', 'content' => $page_content, 'categories' => $categories]);

print($layout_content);

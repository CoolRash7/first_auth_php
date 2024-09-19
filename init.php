<?php


require 'vendor/autoload.php';

//test
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'test');

//production
define('DB_HOST', 'localhost');
define('DB_USER', 'host1870186');
define('DB_PASS', 'vgkGH7eNxK');
define('DB_NAME', 'host1870186_test');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysql->connect_errno) exit('Ошибка подключение к БД');
$mysql->set_charset('utf8mb4');
//часовой пояс по Якутску
$mysql->query("SET time_zone = '+09:00'");


?>
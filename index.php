<?php

ini_set('display_errors', 1); //указывать ошибку с новой строки если она есть
error_reporting(E_ALL);

use app\core\Router;
require "autoload.php";
$router = new Router();
$router->run();
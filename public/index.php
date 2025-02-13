<?php

require_once realpath($_SERVER['DOCUMENT_ROOT'] . '/../') . '/vendor/autoload.php';
use App\Core\Router;
session_start();

$Router = new Router();
$Router->dispatch();

?>
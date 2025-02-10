<?php

require_once realpath($_SERVER['DOCUMENT_ROOT'] . '/../') . '/vendor/autoload.php';
use App\Core\Router;
$Router = new Router();
$Router->dispatch();
?>
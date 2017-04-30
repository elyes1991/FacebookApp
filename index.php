<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

use Controllers\MainController;

$uri = $_SERVER['REQUEST_URI'];

$mainController = new MainController();

if ('/index.php' == $uri) {

    $mainController->loginAction();
} elseif ('/index.php/show' == $uri) {

    $mainController->showProfileAction();
} else {

    $mainController->renderErrorPage();
}
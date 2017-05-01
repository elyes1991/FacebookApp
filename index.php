<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

use Controllers\MainController;
use Login\FacebookConnection;
use Db\Database;
use Models\UserRepository;

$uri = $_SERVER['REQUEST_URI'];

$facebookConnection = new FacebookConnection();
$database = new Database();
$userRepository = new UserRepository($database);
$mainController = new MainController($facebookConnection, $userRepository);


if ('/index.php' == $uri) {

    $mainController->loginAction();
    
} elseif ('/index.php/show' == $uri || isset($_GET['code'])) {

    $mainController->showProfileAction();
    if (isset($_GET['code'])) {
        header('Location: ./show');
    }
    
} else {
    
    $mainController->renderErrorPage();
}
die();
<?php

namespace Controllers;

/**
 * Class MainController.
 */
class MainController {

    /**
     * Constructor.
     */
    public function __construct() {
        
    }

    /**
     * Show login page.
     */
    public function loginAction() {
        //TODO get the login url
        $params = array();
        $params[] = array("key" => "loginUrl", "value" => $loginUrl);
        $this->renderView('/../templates/Login.php', $params);
    }

    /**
     * Show profile page.
     */
    public function showProfileAction() {
        // TODO get the user data
        $params = array();
        $params[] = array("key" => "name", "value" => $user->getName());
        $params[] = array("key" => "imageUrl", "value" => $user->getImageUrl());
        $this->renderView('/../templates/UserInfos.php', $params);
    }

    /**
     * Show Error page.
     */
    public function renderErrorPage() {
        header('Status: 404 Not Found');
        $this->renderView('/../templates/404.php');
    }

    /**
     * Include the template.
     * @param string $pathToFile
     * @param array $params
     */
    private function renderView($pathToFile, $params = array()) {
        foreach ($params as $param) {
            ${$param['key']} = $param['value'];
        }
        require __DIR__ . $pathToFile;
    }

}

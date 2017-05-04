<?php

namespace Controllers;

use Login\FacebookConnection;
use Models\UserRepository;
use Config\Config;

/**
 * Class MainController.
 */
class MainController {

    /**
     * Constructor.
     * @param FacebookConnection $facebookConnection Instance of FacebookConnection class.
     * @param UserRepository $userRepository Instance of UserRepository class.
     */
    public function __construct(FacebookConnection $facebookConnection, UserRepository $userRepository) {
        $this->facebookConnection = $facebookConnection;
        $this->userRepository = $userRepository;
    }

    /**
     * Show login page.
     */
    public function loginAction() {
        $loginUrl = $this->facebookConnection->getLoginUrl();
        $params = array();
        $params[] = array("key" => "loginUrl", "value" => $loginUrl);
        $this->renderView('/../templates/Login.php', $params);
    }

    /**
     * Show profile page.
     */
    public function showProfileAction() {
        if (isset($_SESSION['userId'])) {
            $user = $this->userRepository->getUserById($_SESSION['userId']);
            if ($user->isMyTokenExpired()) {
                $profile = $this->facebookConnection->getProfile();
                $user = $this->userRepository->update($profile->getData());
            }
        } else {
            $profile = $this->facebookConnection->getProfile();
            $user = $this->userRepository->getUserByFacebookId($profile->getFacebookId());
            if ($user->getId() != null) {
                if ($user->isMyTokenExpired()) {
                    $user = $this->userRepository->update($profile->getData());
                }
            } else {
                $user = $this->userRepository->insert($profile->getData());
            }
            $_SESSION['userId'] = (int) $user->getId();
        }
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

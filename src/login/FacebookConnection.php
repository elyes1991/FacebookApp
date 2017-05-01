<?php

namespace Login;

use Facebook\Facebook;
use Config\Config;

class FacebookConnection {

    /**
     * Instance of Facebook super-class.
     * @var Object
     */
    private $fb;

    /**
     * Create an instance of FacebookConnection class.
     */
    public function __construct() {
        $this->fb = new Facebook([
            'app_id' => Config::FB_APP_ID,
            'app_secret' => Config::FB_APP_SECRET,
            'default_graph_version' => Config::FB_DEFAULT_GRAPH_VERSION,
        ]);
    }

    /**
     * Get login Url.
     * @return string
     */
    public function getLoginUrl() {
        $helper = $this->fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl(Config::CALLBACK_URL, ['email']);
        return $loginUrl;
    }

}

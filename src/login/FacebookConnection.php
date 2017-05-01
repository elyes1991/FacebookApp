<?php

namespace Login;

use Facebook\Facebook;
use Config\Config;

/**
 * FacebookConnection class collect facebook profile data from facebook apis.
 */
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

    /**
     * Get Facebook longLivedAccessToken.
     * @return AccessToken
     */
    private function getLongLivedAccessToken() {
        $helper = $this->fb->getRedirectLoginHelper();
        $accessToken = $helper->getAccessToken();
        $oAuth2Client = $this->fb->getOAuth2Client();
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        $this->fb->setDefaultAccessToken($longLivedAccessToken);
        return $longLivedAccessToken;
    }

    /**
     * Get User.
     * @return Models\User
     */
    public function getProfile() {

        $longLivedAccessToken = $this->getLongLivedAccessToken();
        $accessToken = (string) $longLivedAccessToken;
        $expirationDate = $longLivedAccessToken->getExpiresAt();
        if ($expirationDate != null) {
            $tokenExpirationDate = $expirationDate->format('Y-m-d H:i:s');
        }
        $tokenExpirationDate = $longLivedAccessToken->getExpiresAt();

        $this->fb->setDefaultAccessToken($accessToken);
        $profile_request = $this->fb->get('/me?fields=name,picture');
        $profile = $profile_request->getGraphNode()->asArray();
        $user = new User();
        $user->setData(array(
            'name' => $profile['name'],
            'imageUrl' => $profile['picture']['url'],
            'facebookId' => $profile['id'],
            'facebookToken' => $accessToken,
            'tokenExpirationDate' => $tokenExpirationDate,
        ));
        return $user;
    }

}

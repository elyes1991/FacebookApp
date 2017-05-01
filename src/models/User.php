<?php

namespace Models;

/**
 * User Class.
 */
class User {

    /**
     *
     * @var int  
     */
    private $id;

    /**
     * @var string 
     */
    private $name;

    /**
     * @var string 
     */
    private $imageUrl;

    /**
     * @var string 
     */
    private $facebookId;

    /**
     * @var string 
     */
    private $facebookToken;

    /**
     * @var dateTime 
     */
    private $tokenExpirationDate;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->isActive = true;
    }

    /**
     * Get the user id.
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the user name.
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get imageUrl.
     * @return string.
     */
    public function getImageUrl() {
        return $this->imageUrl;
    }

    /**
     * Get Facebook id.
     * @return string
     */
    public function getFacebookId() {
        return $this->facebookId;
    }

    /**
     * Get Facebook token.
     * @return string
     */
    public function getFacebookToken() {
        return $this->facebookToken;
    }

    /**
     * Get the token expiration date.
     * @return DateTime
     */
    public function getExpiresAt() {
        return $this->tokenExpirationDate;
    }

    /**
     * Check if user facebook token is expired.
     * @return string
     */
    public function isMyTokenExpired() {
        if ($this->getExpiresAt() instanceof \DateTime) {
            return $this->getExpiresAt()->getTimestamp() < time();
        }
        return null;
    }

    /**
     * Set User Data.
     * @param array $data
     */
    public function setData($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->imageUrl = (isset($data['imageUrl'])) ? $data['imageUrl'] : null;
        $this->facebookId = (isset($data['facebookId'])) ? $data['facebookId'] : null;
        $this->facebookToken = (isset($data['facebookToken'])) ? $data['facebookToken'] : null;
        $this->tokenExpirationDate = (isset($data['tokenExpirationDate'])) ? $data['tokenExpirationDate'] : null;
    }

    /**
     * Get User Data.
     * @return array
     */
    public function getData() {
        return get_object_vars($this);
    }

}

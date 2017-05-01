<?php

namespace Models;

use Models\User;
use Db\Database;

/**
 * User Repository Class Get\Persist User data in the database.
 */
class UserRepository {

    /**
     * Constructor.
     * @param Database $database
     */
    public function __construct(Database $database) {
        $this->database = $database;
    }

    /**
     * Get User by facebookId.
     * @param string $facebookId
     * @return User
     */
    public function getUserByFacebookId($facebookId) {
        $query = "select * from User where facebookId=" . $facebookId;
        $result = $this->database->select($query);
        $user = new User();
        $user->setData($result);
        return $user;
    }

    /**
     * Get User by id.
     * @param int $id
     * @return User
     */
    public function getUserById($id) {
        $query = "select * from User where id=" . $id;
        $result = $this->database->select($query);
        $user = new User();
        $user->setData($result);
        return $user;
    }

    /**
     * Insert User data.
     * @param array $data
     * @return Boolean
     */
    public function insert($data) {
        unset($data['id']);
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map(function($x) {
                    return "'" . $x . "'";
                }, $data));
        $query = "INSERT INTO User ($fields) VALUES ($values)";
        $result = $this->database->execute($query);
        return $result;
    }

    /**
     * Update User data.
     * @param array $data
     * @return Boolean
     */
    public function update($data) {
        $query = "UPDATE User SET ";
        $fields = "";
        foreach ($data as $key => $value) {
            if ($key != "id") {
                $fields .= $key . "='" . $value . "' ";
            }
        }
        $query.= $fields . "WHERE id=" . $data['id'];
        return $this->database->execute($query);
    }

}

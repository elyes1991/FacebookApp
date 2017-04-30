<?php

namespace Db;

use Config\Config;

/**
 * Class Database.
 */
class Database {

    /**
     * @var string
     */
    private $server = Config::DB_HOST;

    /**
     * @var string
     */
    private $username = Config::DB_USER;

    /**
     * @var string
     */
    private $password = Config::DB_PASS;

    /**
     * @var string
     */
    private $database_name = Config::DB_NAME;

    /**
     * Open connection to the database.
     * @return string connection link identifier.
     */
    private function start() {
        $conn = mysqli_connect($this->server, $this->username, $this->password, $this->database_name);
        return $conn;
    }

    /**
     * Close connection to the database.
     */
    private function end($conn) {
        $conn->close();
    }

    /**
     * Execute Query.
     * @return boolean connection link identifier.
     */
    public function execute($query) {
        $conn = $this->start();
        $result = $conn->query($query);
        $this->end($conn);
        return $result;
    }

    /**
     * Execute Select query and return result.
     * @param string $query select query.
     * @return type select query result.
     */
    public function select($query) {
        $conn = $this->start();
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $this->end($conn);
        return $row;
    }

}

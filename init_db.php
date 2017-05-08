<?php

namespace ComposerScript;

use Db\Database;
use Config\Config;

class init_db
{

    /**
     * Create the database.
     */
    public static function createDatabase()
    {
        $database = new Database();
        $sql = "CREATE DATABASE " . Config::DB_NAME;
        $database->execute($sql);
    }

    /**
     * Create the User table.
     */
    public static function createUserTable()
    {
        $database = new Database();
        $sql = "CREATE TABLE User (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                name VARCHAR(30) ,
                imageUrl VARCHAR(2083),
                facebookId VARCHAR(50),
                facebookToken VARCHAR(2083),
                tokenExpirationDate DATETIME,
                created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                isActive boolean not null default 1
                ) ENGINE=InnoDB;
                ALTER TABLE `User` ADD INDEX `facebook_id` (`facebookId`);
                ALTER TABLE `User` ADD INDEX `user_id` (`id`);";
        $database->execute($sql);
    }
}

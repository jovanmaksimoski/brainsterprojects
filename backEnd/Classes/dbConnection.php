<?php

namespace backEnd\Classes;

class DbConnection
{
    const DB_HOSTNAME = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'brainster_library';
    protected \PDO $_db_connect;


    public function __construct()
    {
        $dsn = "mysql:host=" . self::DB_HOSTNAME . ";dbname=" . self::DB_NAME;


        try {
            $this->_db_connect = new \PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
            $this->_db_connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getDbConnection()
    {
        return $this->_db_connect;
    }
}


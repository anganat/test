<?php

class DbConnect
{
    protected $db;

    public function __construct()
    {
        $this->_dbConnect();
    }

    /**
     * Database Connection
     */
    private function _dbConnect()
    {
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $data = sprintf('mysql:host=%s;dbname=%s', 'localhost', 'test');
        $this->db = new PDO($data, 'root', 'root', $options);
    }

}
?>

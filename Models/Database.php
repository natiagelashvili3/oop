<?php

namespace Models;

use PDO;
use Exception;

class Database
{

    protected $host = "localhost";
    protected $dbName = "school-oop";
    protected $username = "admin";
    protected $password = "admin123";
    public $pdo;

    public $tableName;

    public function __construct()
    {
        $this->connect();
    }

    protected function connect()
    {
        try {
            $this->pdo = new PDO( "mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password );
        } catch ( Exception $e ) {
            print_r( $e->getMessage() );
        }
    }

    public function get( )
    {
        $data = [];

        $query = "SELECT * FROM " . $this->tableName;

        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        while ( $row = $sql->fetch() ) {
            $data[] = $row;
        }

        return $data;

    }

    public function getById( $id )
    {
        $data = [];

        $query = "SELECT * FROM " . $this->tableName . " WHERE id = ".$id;

        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        $data = $sql->fetch();

        return $data;

    }
}
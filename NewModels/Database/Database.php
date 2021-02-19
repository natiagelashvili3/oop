<?php

namespace NewModels\Database;

use PDO;
use Exception;

class Database
{

    protected $host = "localhost";
    protected $dbName = "school-post";
    protected $username = "admin";
    protected $password = "admin123";
    public $pdo;

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

    public function get( $tableName )
    {
        $data = [];

        $query = "SELECT * FROM " . $tableName;

        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        while ( $row = $sql->fetch() ) {
            $data[] = $row;
        }

        return $data;

    }
}
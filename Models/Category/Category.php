<?php

use Models\Database;

class Category extends Database {

    function __construct()
    {
        $this->tableName = 'categories';
        parent::__construct();
    }
    

    public function add($data) {
        $insert_query = "INSERT INTO categories (`name`) VALUES (?) ";
        
        try {
            $result = $this->pdo->prepare( $insert_query )->execute([
                $data['name']
            ]);
        } catch(Exception $e) {
            $e->getMessage();
        }

    }

}
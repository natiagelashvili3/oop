<?php

use Models\Database;

class User extends Database {

    function __construct()
    {
        $this->tableName = 'users';
        parent::__construct();
    }
    
}
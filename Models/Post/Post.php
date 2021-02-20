<?php

use Models\Database;

class Post extends Database {

    function __construct()
    {
        $this->tableName = 'posts';
        parent::__construct();
    }

    public function add($data) {
        $insert_query = "INSERT INTO ".$this->tableName." (`title`, `text`, `cat_id`) VALUES (?, ?, ?) ";
        
        try {
            $result = $this->pdo->prepare( $insert_query );
            $result->execute([
                $data['title'],
                $data['text'],
                $data['cat_id']
            ]);
        } catch(Exception $e) {
            $e->getMessage();
        }

    }

    public function update($data) {
        $update_query = "UPDATE posts SET `title` = :title, `text` = :text, `cat_id` = :cat_id WHERE id = :id";
        
        try {
            $result = $this->pdo->prepare( $update_query );
            $result->execute([
                'title' => $data['title'],
                'text' => $data['text'],
                'cat_id' => $data['cat_id'],
                'id' => $data['post_id']
            ]);
        } catch(Exception $e) {
            $e->getMessage();
        }

    }


    public function getPostsWithCategories()
    {
        $data = [];

        $query = "SELECT p.*, c.name as cat_name
                    FROM ".$this->tableName." p 
              INNER JOIN categories c ON c.id = p.cat_id";

        $sql = $this->pdo->prepare( $query );
        $sql->execute();

        while ( $row = $sql->fetch() ) {
            $data[] = $row;
        }

        return $data;
    }

}

?>
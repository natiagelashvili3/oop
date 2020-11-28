<?php

include("components/database.php");

$status = false;

if(isset($_POST) && isset($_POST['action'])) {

    $bookname = isset($_POST["book-name"]) ? $_POST["book-name"] : null;
    $author = isset($_POST["author_id"]) ? $_POST["author_id"] : 0;
    $releasedate = isset($_POST["release-date"]) ? $_POST["release-date"] : null;

    if($_POST['action'] == 'add-book') {

        $sourceName = '';

        // Adding Books
        if ($bookname && $author && $releasedate) {
            // Insert Query
            $insert_query = "INSERT INTO books (`book_name`, `author_id`, `release_date`) 
                             VALUES (?, ?, ?)";
            $myDatabase->prepare($insert_query)
            ->execute([$bookname, $author, $releasedate]);

            $id = $myDatabase->lastInsertId(); 

            // UPLOAD FILE ON SERVER
            if (isset($_FILES) && !empty($_FILES)) {

                if (!file_exists('uploads/')) {
                    mkdir('uploads/');
                }

                $tmp_name = $_FILES['source']['tmp_name'];
                $name = $_FILES['source']['name'];
                $extension = pathinfo($name)['extension'];
                $filename = pathinfo($name)['filename'];

                $sourceName = $filename . '-' . $id . '.' . $extension;
                $destination = 'uploads/' . $sourceName;

                move_uploaded_file($tmp_name, $destination); 

                $update_query = "UPDATE books SET source = :source WHERE id = :id";
                $stm = $myDatabase->prepare($update_query);
                $stm->execute([
                    'source' => $sourceName,
                    'id' => $id
                ]);

            }

            header("Location: /" );
        }

    } else if($_POST['action'] == 'edit-book') {
        // Edit Books
        if (isset($_POST['id']) && $bookname && $author && $releasedate) {
            $id = $_POST['id'];
            $sourceName = '';

            //UPLOAD FILE ON SERVER
            if (isset($_FILES) && !empty($_FILES)) {

                if (!file_exists('uploads/')) {
                    mkdir('uploads/');
                }

                $tmp_name = $_FILES['source']['tmp_name'];
                $name = $_FILES['source']['name'];
                $extension = pathinfo($name)['extension'];
                $filename = pathinfo($name)['filename'];

                $sourceName = $filename . '-' . $id . '.' . $extension;
                $destination = 'uploads/' . $sourceName;

                move_uploaded_file($tmp_name, $destination); 

            }
            
            // Update Query
            $update_query = "UPDATE books 
                                SET book_name = :book_name, author = :author, release_date = :release_date, source = :source
                              WHERE id = :id";
            $stm = $myDatabase->prepare($update_query);
            $stm->execute([
                'id' => $id,
                'book_name' => $bookname,
                'author' => $author,
                'release_date' => $releasedate,
                'source' => $sourceName
            ]);

            header("Location: edit.php?id=".$_POST['id'] );
                            
        }
    } else if(isset($_POST['action']) && $_POST['action'] == 'delete-book') {
        if ($_POST['id']) {
            $query = "DELETE FROM books WHERE id = :id";
            $stm = $myDatabase->prepare($query);
            $stm->execute([
                'id' => $_POST['id']
            ]);       
            
            $status = true;
            echo $status;
        }
    } else if(isset($_POST['action']) && $_POST['action'] == 'add-author') {
        $insert_query = "INSERT INTO authors (`name`) VALUES (?)";

        $myDatabase->prepare($insert_query)->execute([$_POST['name']]);

        header("Location: authors.php" );
    }
}
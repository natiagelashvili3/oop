<?php
    include "config.php";
    include "Models/Post/Post.php";

    $post = new Post();
    $posts = $post->getPostsWithCategories();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <nav>
            <a href="index.php">Posts</a>
            <a href="#">News</a>
            <a href="#">About</a>
        </nav>
    </header> 
    
    <div class="container">
        <a class="btn" href="add-post.php">Add Post</a>
        <a class="btn" href="add-category.php">Add Category</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Text</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php

            foreach ($posts as $key => $value) {
                ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['title'] ?></td>
                    <td><?= $value['text'] ?></td>
                    <td><?= $value['cat_name'] ?></td>
                    <td>
                        <a href="edit-post.php?id=<?= $value['id'] ?>">
                            Edit
                        </a>
                    </td>
                </tr>
                <?php
            }

            ?>
        </table>
    </div>

</body>
</html>
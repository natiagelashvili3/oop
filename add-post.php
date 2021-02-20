<?php
    include "config.php";
    include "Models/Post/Post.php";
    include "Models/Category/Category.php";

    $post = new Post();
    $category = new Category();
    $categories = $category->get();

    if (isset($_POST) && !empty($_POST)) {
        $post->add($_POST);
    }
    
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
        <form action="" id="form" method="post">
            <a class="btn" href="add-category.php">Add Category</a>
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title">
            </div>
            <div class="form-group">
                <label for="">Text</label>
                <textarea name="text" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select name="cat_id" id="">

                    <?php foreach ($categories as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            <div class="form-group">
                <button>Submit</button>
            </div>
        </form>
    </div>

</body>
</html>
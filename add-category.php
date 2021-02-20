<?php
    include "config.php";
    include "Models/Category/Category.php";

    $category = new Category();

    if (isset($_POST) && !empty($_POST)) {
        $category->add($_POST);
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
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name">
            </div>
            <div class="form-group">
                <button>Submit</button>
            </div>
        </form>
    </div>

</body>
</html>
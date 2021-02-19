<?php
    include "config.php";
    include "Models/User/User.php";

    $user = new User();
    $users = $user->get();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
    </tr>
    <?php

        foreach ($users as $key => $value) {
            ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['username'] ?></td>
                </tr>
            <?php
        }
    
    ?>
    </table>

</body>
</html>
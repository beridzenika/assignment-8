<?php

include('helper/DB_connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'insert') {
    $title = isset($_POST['title']) ? $_POST['title'] : '' ;

    if($title) {
        $insert_query = "INSERT INTO categories (title) VALUES ('$title')";
        
        if(mysqli_query($connection, $insert_query)) {
            echo "Record Created";
        } else {
            echo "Error";
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include('components/header.php') ?>
    
    <?php include('components/aslide.php') ?>

    <main>
        <div class="container-header">
            <h2>სიახლეები</h2>
            <a href="" class="btn">Add category</a>
        </div>
        <div class="content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                <input type="hidden" name="acton" value="insert">
                    <button class="btn submit">Add</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
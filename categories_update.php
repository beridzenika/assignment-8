<?php

    include('helper/DB_connection.php');

    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

    if($id) {
        $select_query = "SELECT * FROM categories WHERE id = " .$id;
        $result = mysqli_query($connection, $select_query);
        $categories = mysqli_fetch_assoc($result);
        if(!$categories) {
            die('categories not found');
        }
        } else {
            echo "invalid id";
        }

    if(isset($_POST['action']) && $_POST['action'] == 'update') {
        
        $title = isset($_POST['title']) ? $_POST['title'] : '' ;
        $text = isset($_POST['text']) ? $_POST['text'] : '' ;
        $categories_id = isset($_POST['categories_id']) ? $_POST['categories_id'] : '' ;

        if($title && $text && $categories_id) {
            $update_query = "UPDATE categories SET title = '$title', text = '$text', categories_id = '$categories_id' WHERE id = " . $id;

            if(mysqli_query($connection, $update_query)) {
                header('Location: index.php');
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
            <h2>categories</h2>
            <a href="categories.php" class="btn">Update</a>
        </div>
        <div class="content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" name="title" value="<?= $categories['title'] ?>" >
                </div> 
                <div class="form-group">
                    <input type="hidden" name="acton" value="update">
                    <button class="btn submit">Update</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
<?php

    include('helper/DB_connection.php');

    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

    if($id) {
        $select_query = "SELECT * FROM news WHERE id = " .$id;
        $result = mysqli_query($connection, $select_query);
        $news = mysqli_fetch_assoc($result);
        if(!$news) {
            die('news not found');
        }
        } else {
            echo "invalid id";
        }

    $select_categories = "SELECT * FROM categories";
    $result = mysqli_query($connection, $select_categories);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['action']) && $_POST['action'] == 'update') {
        
        $title = isset($_POST['title']) ? $_POST['title'] : '' ;
        $text = isset($_POST['text']) ? $_POST['text'] : '' ;
        $categories_id = isset($_POST['categories_id']) ? $_POST['categories_id'] : '' ;

        if($title && $text && $categories_id) {
            $update_query = "UPDATE news SET title = '$title', text = '$text', categories_id = '$categories_id' WHERE id = " . $id;

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
            <h2>News</h2>
            <a href="news.php" class="btn">Update</a>
        </div>
        <div class="content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" name="title" value="<?= $news['title'] ?>">
                </div>
                <div class="form-group">
                    <label for="">text</label>
                    <textarea name="text" id="" cols="30" rows="10"  value="<?= $news['text'] ?>"></textarea>
                </div>
                <div class="form-group">
                    <label for="">categories</label>
                    <select name="categories_id" id="">
                        <?php foreach($categories as $value) { ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $news['categories_id'] ? 'selected' : '' ?>><?= $value['title'] ?></option>
                        <?php } ?>
                    </select>
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
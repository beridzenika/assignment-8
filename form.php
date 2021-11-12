<?php

include('helper/DB_connection.php');

$select_categories = "SELECT * FROM categories";
$result = mysqli_query($connection, $select_categories);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(isset($_POST['action']) && $_POST['action'] == 'insert') {
    $title = isset($_POST['title']) ? $_POST['title'] : '' ;
    $text = isset($_POST['text']) ? $_POST['text'] : '' ;
    $categories_id = isset($_POST['categories_id']) ? $_POST['categories_id'] : '' ;

    if($title && $text && $categories_id) {
        $insert_query = "INSERT INTO new (title, text, categories_id) VALUES ('$title', '$text', '$categories_id')";
        
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
            <a href="" class="btn">Add New</a>
        </div>
        <div class="content">
            <form action="" method="post">
                <input type="hidden" name="action" value="insert">
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                    <label for="">text</label>
                    <textarea name="text" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="">categories</label>
                    <select name="">
                        <?php foreach($categories as $value){ ?>
                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn submit">Add</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
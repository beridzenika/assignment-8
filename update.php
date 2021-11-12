<?php

    include('helper/DB_connection.php');

    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

    if($id) {
        $select_query = "SELECT * FROM students WHERE id = " .$id;
        $result = mysqli_query($connection, $select_query);
        $student = mysqli_fetch_assoc($result);
        if(!$student) {
            die('student not found');
        }
        } else {
            echo "invalid id";
        }

    if(isset($_POST['action']) && $_POST['action'] == 'update') {
        
        $name = isset($_POST['name']) ? $_POST['name'] : '' ;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '' ;
        $age = isset($_POST['age']) ? $_POST['age'] : '' ;
        $status = isset($_POST['status']) ? $_POST['status'] : '' ;

        if($name && $lastname && $age) {
            $update_query = "UPDATE students SET name = '$name', lastname = '$lastname', age = '$age' status = '$status' WHERE id = " . $id;

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
            <h2>Students</h2>
            <a href="" class="btn">Update</a>
        </div>
        <div class="content">
            <form action="" method="post">
                <input type="hidden" name="action" value="update">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="<?=  $student['name']?>">
                </div>
                <div class="form-group">
                    <label for="">Lastname</label>
                    <input type="text" name="lastname" value="<?= $student['lastname']?>">
                </div>
                <div class="form-group">
                    <label for="">Age</label>
                    <input type="text" name="age" value="<?= $student['age']?>">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status">
                        <option value="1" <?= $student['status'] == 1 ? 'selected' : '' ?> >Active</option>
                        <option value="0" <?= $student['status'] == 0 ? 'selected' : '' ?> >Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn submit">Update</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
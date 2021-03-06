<?php
    include('helper/DB_connection.php');

    $select_query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $select_query);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $_POST['id'];
        
        $delete_query = "DELETE FROM categories WHERE id = " .$id;

            

        if(mysqli_query($connection, $delete_query)) {
            echo "Record Deleted";
        } else {
            echo "Error";
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
            <h2>კატეგორიები</h2>
            <a href="categories_form.php" class="btn">Add New</a>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($categories as $value) { ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['title'] ?></td>
                    <td class="actions">
                        <a class="edit" href="categories_update.php?id=<?= $value['id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                            <a class="delete" href="">Delete</a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
              </table>
        </div>
    </main>

</body>
</html>
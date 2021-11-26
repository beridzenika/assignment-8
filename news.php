<?php
    include('helper/DB_connection.php');
  
    $limit = 3;

    $offset = '';
    if(isset($_GET['page']) && $_GET['page'] && $_GET['page'] > 1) {
        $offset = ' OFFSET ' . ($_GET['page'] - 1) * $limit;
    }


    $sql = "SELECT COUNT(*) as cnt FROM news";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_fetch_assoc($result);

    $pageNumber = ceil($count['cnt'] / $limit);


    
    $orderBy = 'ORDER BY news.id DESC';

    if(isset($_GET['sort']) && $_GET['sort']) {
        $sort = explode('-', $_GET['sort']);
    if($sort[0] == 'id') {
        $orderBy = 'ORDER BY news.id';
    } elseif($sort[0] == 'title') {
        $orderBy = 'ORDER BY news.title';
    }
    $orderBy .= ' ' . $sort[1];

    }


    if(isset($_GET['search']) && $_GET['search']) {
        $search_value = $_GET['search'];
        $titleLike = 'WHERE title LIKE %' . $search_value . '%';
    }
    $titleLike = ' ';


    $select_query = "SELECT news.id as news_id, news.title as news_title, news.text, news.categories_id, categories.id as cat_id, categories.title as categories_title
                       FROM news 
                       " . $titleLike . '
                  LEFT JOIN categories ON news.categories_id = categories.id ' . $orderBy . ' LIMIT ' . $limit .' '. $offset;
    $result = mysqli_query($connection, $select_query);
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if(isset($_POST['action']) && $_POST['action'] == 'delete') {

        $id = $_POST['id'];        
        $delete_query = "DELETE FROM news WHERE id = " .$id;

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

        <form action="">
            <select name="sort" id="">
                <option value="id-desc">ID DESC</option>
                <option value="id-asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'id-asc' ? 'selected' : '' ?>>ID ASC</option>
                <option value="title-desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title-desc' ? 'selected' : '' ?>>Title DESC</option>
                <option value="title-asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title-asc' ? 'selected' : '' ?>>Title ASC</option>
            </select>
            <button class="btn">Sort</button>
        </form>

        <form action="">
            <input type="text" name="search">
            <button class="btn">Search</button>
        </form>

        <div class="container-header">
            <h2>სიახლეები</h2>
            <a href="form.php" class="btn">Add New</a>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>categories</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($news as $value) { ?>
                <tr>
                    <td><?= $value['news_id'] ?></td>
                    <td><?= $value['news_title'] ?></td>
                    <td><?= $value['categories_title'] ?></td>
                    <td class="actions">
                        <a class="edit" href="update.php?id=<?= $value['news_id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['news_id'] ?>">
                            <a class="delete" href="">Delete</a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
              </table>
        </div>

        <div class="paging">
            <?php for($i = 1; $i <= $pageNumber; $i++): ?>

                <a href="?page=<?= $i ?>" class="btn"><?= $i ?></a>

            <?php endfor; ?>
        </div>

    </main>

</body>
</html>
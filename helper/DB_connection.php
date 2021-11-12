
<?php
    
    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'assignment-8';

    $connection = mysqli_connect($serverName, $userName, $password, $dbName);

    if(!$connection) {
        echo "connection faild";
        die();
    } 
    
?>
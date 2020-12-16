<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
	$dbname = "gamepc";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=".$dbname, $username, $password);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: ".$e->getMessage();
        die();
    }
?>
<!-- GRANT ALL PRIVILEGES ON `webshop_test`.* TO 'phpDB'@'localhost' -->

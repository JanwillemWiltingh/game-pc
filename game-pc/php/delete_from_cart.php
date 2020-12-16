<?php
    Include "../../private/connection.php";
    session_start();

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM shopping_cart
                WHERE cart_ID = :ID LIMIT 1";
        $sth = $conn->prepare($sql);
        $sth->bindParam(":ID", $_GET['id']);
        $sth->execute();

        $_SESSION["alert"] = array("type" => "success", "message" => "Item has been removed from cart");
        header("location: ../index.php?page=shopping_cart");
		die;
    }
?>

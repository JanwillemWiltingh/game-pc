<?php
    Include "../../private/connection.php";
    session_start();

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM users
                WHERE user_ID = :ID LIMIT 1";
        $sth = $conn->prepare($sql);
        $sth->bindParam(":ID", $_GET['id']);
        $sth->execute();
        $_SESSION["alert"] = array("type" => "success", "message" => "User has been removed");
        header("location: ../index.php?page=admin_users");
		die;
    }
?>

<?php
    Include "../../private/connection.php";
    session_start();

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM hardware
                WHERE hardware_ID = :ID LIMIT 1";
        $sth = $conn->prepare($sql);
        $sth->bindParam(":ID", $_GET['id']);
        $sth->execute();
        $_SESSION["alert"] = array("type" => "success", "message" => "Hardware has been removed");
        header("location: ../index.php?page=admin_hardware");
		die;
    }
?>

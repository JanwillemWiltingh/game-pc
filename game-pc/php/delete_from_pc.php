<?php
    Include "../../private/connection.php";
    session_start();

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM users_products
                WHERE user_FK = :user_ID
				AND product_FK = :product_ID";
        $sth = $conn->prepare($sql);
        $sth->bindParam(":user_ID", $_SESSION["user_ID"]);
		$sth->bindParam(":product_ID", $_GET['id']);
        $sth->execute();

		echo "<pre>", print_r($_SESSION["user_ID"]),"</pre><hr>";
		echo "<pre>", print_r($_GET['id']),"</pre><hr>";

        $_SESSION["alert"] = array("type" => "success", "message" => "Hardware has been removed from PC");
        header("location: ../index.php?page=my_pc");
		die;
    }
?>

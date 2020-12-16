<?php
	include "../../private/connection.php";
	session_start();

	$sql = "SELECT products.product_ID, hardware.hardware_ID
			FROM ((users_products
			INNER JOIN products ON users_products.product_FK = products.product_ID)
			INNER JOIN hardware ON products.hardware_FK = hardware.hardware_ID)
			WHERE users_products.user_FK = :user_ID
			AND hardware.hardware_ID = :hardware_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->bindParam(":hardware_ID", $_POST["hardware_ID"]);
	$sth->execute();
	$parts = $sth->fetch(PDO::FETCH_ASSOC);

	echo "<pre>", print_r($_SESSION),"</pre><hr>";
	echo "<pre>", print_r($_POST),"</pre><hr>";
	echo "<pre>", print_r($parts),"</pre><hr>";

	if($parts != NULL)
	{
		#	Check if the hardware already is choosen
		if($parts["product_ID"] != $_POST["product_ID"])
		{
			$sql = "UPDATE users_products
					SET product_FK = :product_ID_1
					WHERE user_FK = :user_ID
					AND product_FK = :product_ID_2";
			$sth = $conn->prepare($sql);
			$sth->bindParam(":product_ID_1", $_POST["product_ID"]);
			$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
			$sth->bindParam(":product_ID_2", $parts["product_ID"]);
			$sth->execute();

			$_SESSION["alert"] = array("type" => "success", "message" => "Your choice has been updated");
			header("location: ../index.php?page=my_pc");
			die;
		}
	}
	else
	{
		#	Insert choosen product
		$sql = "INSERT INTO users_products (user_FK, product_FK)
				VALUES (:user_ID, :product_ID)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
		$sth->bindParam(":product_ID", $_POST["product_ID"]);
		$sth->execute();

		$_SESSION["alert"] = array("type" => "success", "message" => "Your choice has been added");
		header("location: ../index.php?page=my_pc");
		die;
	}

	header("location: ../index.php?page=my_pc");
	die;
?>

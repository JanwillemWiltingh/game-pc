<?php
	include "../../private/connection.php";
	session_start();

	$date = date("Y-m-d");
	$amount = 1;

	$sql = "SELECT products.product_ID, hardware.hardware_name, products.image, brands.brand, products.name, products.in_stock, products.price
			FROM (((users_products
			INNER JOIN products ON users_products.product_FK = products.product_ID)
			INNER JOIN hardware ON products.hardware_FK = hardware.hardware_ID)
			INNER JOIN brands ON products.brand_FK = brands.brand_ID)
			WHERE users_products.user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();
	$user_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	echo "<pre>", print_r($user_hardware),"</pre><hr>";

	if($user_hardware == NULL)
	{
		$_SESSION["alert"] = array("type" => "success", "message" => "Your PC isn't complete yet");
		header("location: ../index.php?page=my_pc");
		die;
	}

	foreach($user_hardware as $item)
	{
		$sql = "INSERT INTO orders (user_FK, product_FK, amount, price_bought, date_ordered)
				VALUES (:user_ID, :product_ID, :amount, :price, :date_ordered)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
		$sth->bindParam(":product_ID", $item["product_ID"]);
		$sth->bindParam(":amount", $amount);
		$sth->bindParam(":price", $item["price"]);
		$sth->bindParam(":date_ordered", $date);
		$sth->execute();
	}

	$sql = "DELETE FROM users_products
			WHERE user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "You've successfully assembled and paid :D");
	header("location: ../index.php?page=orders");
	die;
?>

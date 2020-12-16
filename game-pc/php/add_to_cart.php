<?php
	include "../../private/connection.php";
	session_start();

	$product_ID = $_POST["product_ID"];
	$user_ID = $_SESSION["user_ID"];
	$amount = $_POST["amount"];

	if($amount == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Product has been given an amount");
		header("location: ../index.php?page=products");
		die;
	}

	$sql = "SELECT *
			FROM shopping_cart
			WHERE product_FK = :product_ID
			AND user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":product_ID", $product_ID);
	$sth->bindParam(":user_ID", $user_ID);
	$sth->execute();
	$cart = $sth->fetch(PDO::FETCH_ASSOC);

	if($cart == NULL)
	{
		$sql = "INSERT INTO shopping_cart (product_FK, user_FK, amount)
				VALUES (:product_ID, :user_ID, :amount)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":product_ID", $product_ID);
		$sth->bindParam(":user_ID", $user_ID);
		$sth->bindParam(":amount", $amount);
		$sth->execute();
	}
	else
	{
		$amount = $amount + $cart["amount"];
		$sql = "UPDATE shopping_cart
				SET amount = :amount
				WHERE cart_ID = :cart_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":amount", $amount);
		$sth->bindParam(":cart_ID", $cart["cart_ID"]);
		$sth->execute();
	}

	$_SESSION["alert"] = array("type" => "success", "message" => "Product has been added to your cart");
	header("location: ../index.php?page=shopping_cart");
	die;
?>

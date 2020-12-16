<?php
	include "../../private/connection.php";
	session_start();

	$date = date("Y-m-d");

	$sql = "SELECT shopping_cart.amount, products.price, products.product_ID, products.in_stock
			FROM (shopping_cart
			INNER JOIN products ON shopping_cart.product_FK = products.product_ID)
			WHERE shopping_cart.user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();
	$shopping_cart = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($shopping_cart == NULL)
	{
		$_SESSION["alert"] = array("type" => "success", "message" => "Your shopping cart is empty");
		header("location: ../index.php?page=shopping_cart");
		die;
	}

	foreach($shopping_cart as $item)
	{
		$sql = "SELECT *
				FROM orders
				WHERE user_FK = :user_ID
				AND product_FK = :product_ID
				AND date_ordered = :date_ordered";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
		$sth->bindParam(":product_ID", $item["product_ID"]);
		$sth->bindParam(":date_ordered", $date);
		$sth->execute();
		$order = $sth->fetch(PDO::FETCH_ASSOC);

		if($order == NULL)
		{
			$sql = "INSERT INTO orders (user_FK, product_FK, amount, price_bought, date_ordered)
					VALUES (:user_ID, :product_ID, :amount, :price, :date_ordered)";
			$sth = $conn->prepare($sql);
			$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
			$sth->bindParam(":product_ID", $item["product_ID"]);
			$sth->bindParam(":amount", $item["amount"]);
			$sth->bindParam(":price", $item["price"]);
			$sth->bindParam(":date_ordered", $date);
			$sth->execute();
		}
		else
		{
			$new_amount = $order["amount"] + $item["amount"];

			$sql = "UPDATE orders
					SET amount = :amount
					WHERE order_ID = :order_ID";
			$sth = $conn->prepare($sql);
			$sth->bindParam(":amount", $new_amount);
			$sth->bindParam(":order_ID", $order["order_ID"]);
			$sth->execute();
		}

		$new_amount = $item["in_stock"] - $item["amount"];

		$sql = "UPDATE products
				SET in_stock = :stock
				WHERE product_ID = :product_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":stock", $new_amount);
		$sth->bindParam(":product_ID", $item["product_ID"]);
		$sth->execute();
	}

	$sql = "DELETE FROM shopping_cart
			WHERE user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "You've successfully paid :D");
	header("location: ../index.php?page=orders");
	die;
?>

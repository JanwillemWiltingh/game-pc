<?php
	include "../../private/connection.php";
	session_start();

	$product_ID = $_POST["product_ID"];

	$hardware = $_POST["hardware"];
	$original_hardware = $_POST["original_hardware"];
	$brand = $_POST["brand"];
	$original_brand = $_POST["original_brand"];

	$name = $_POST["name"];
	$original_name = $_POST["original_name"];
	$in_stock = $_POST["in_stock"];
	$original_in_stock = $_POST["original_in_stock"];
	$price = $_POST["price"];
	$original_price = $_POST["original_price"];

	if($name == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Name field has been left empty");
		header("location: ../index.php?page=edit_product&id=".$product_ID);
		die;
	}

	if($price == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Price field has been left empty");
		header("location: ../index.php?page=edit_product&id=".$product_ID);
		die;
	}

	if($in_stock == NULL)
	{
		$in_stock = 0;
	}

	#	Check if name is unique
	$sql = "SELECT name
			FROM products
			WHERE product_ID != :product_ID
			AND name = :name";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $user_ID);
	$sth->bindParam(":email", $email);
	$sth->execute();
	$duplicants = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($duplicants != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Name is already in use");
		header("location: ../index.php?page=edit_product&id=".$product_ID);
		die;
	}

	if($original_hardware == $hardware AND $original_brand == $brand AND $original_name == $name AND $original_in_stock == $in_stock AND $original_price == $price)
	{
		$_SESSION["alert"] = array("type" => "primary", "message" => "Nothing has been changed");
		header("location: ../index.php?page=admin_products");
		die;
	}
	else
	{
		#   Update Brand
		$sql = "UPDATE products
				SET hardware_FK = :hardware_FK, brand_FK = :brand_FK, name = :name, in_stock = :in_stock, price = :price
				WHERE product_ID = :product_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":product_ID", $product_ID);
		$sth->bindParam(":hardware_FK", $hardware);
		$sth->bindParam(":brand_FK", $brand);
		$sth->bindParam(":name", $name);
		$sth->bindParam(":in_stock", $in_stock);
		$sth->bindParam(":price", $price);
		$sth->execute();

		$_SESSION["alert"] = array("type" => "success", "message" => "Product has been changed");
		header("location: ../index.php?page=admin_products");
		die;
	}
?>

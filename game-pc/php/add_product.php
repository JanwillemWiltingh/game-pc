<?php
	include "../../private/connection.php";
	session_start();

	$hardware = $_POST["hardware"];
	$brand = $_POST["brand"];
	$name = $_POST["name"];
	$in_stock = $_POST["in_stock"];
	$price = $_POST["price"];

	#	Check if name has been filled in
	if($name == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No Name has been given");
		header("location: ../index.php?page=add_product");
		die;
	}

	#	Check if name is unique
	$sql = "SELECT *
			FROM products
			WHERE name = :name";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":name", $name);
	$sth->execute();
	$product = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($product["name"] != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "This name is already used");
		header("location: ../index.php?page=add_product");
		die;
	}

	#	If stock if empty make it 0
	if($in_stock == NULL)
	{
		$in_stock = 0;
	}
	else if($in_stock < 0)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No negative numbers allowed");
		header("location: ../index.php?page=add_product");
		die;
	}

	#	if price is empty give a alert
	if($price == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No Price has been given");
		header("location: ../index.php?page=add_product");
		die;
	}

	#   Check if an image has been added
	$data = file_get_contents($_FILES["file"]['tmp_name']);
	if($data == NULL or $data == "")
	{
		#	This should add a default image
	}
	else
	{
		#	When an image has been added check if it has the right extension
		$path = $_FILES['file']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$allowed = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");

		if(!in_array($ext, $allowed))
		{
			$_SESSION["alert"] = array("type" => "danger", "message" => "Only jpg, jpeg, and png files are allowed.");
			header("location: ../index.php?page=admin_page");
			die;
		}
	}

	$data= file_get_contents($_FILES['file']['tmp_name']);
    $sql = "INSERT INTO products (hardware_FK, image, brand_FK, name, in_stock, price)
	        VALUES (:hardware, :image, :brand, :name, :stock, :price)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(":hardware", $hardware);
    $sth->bindParam(":image", $data);
	$sth->bindParam(":brand", $brand);
	$sth->bindParam(":name", $name);
	$sth->bindParam(":stock", $in_stock);
	$sth->bindParam(":price", $price);
    $sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "Product has been added");
	header("location: ../index.php?page=admin_products");
	die;
?>

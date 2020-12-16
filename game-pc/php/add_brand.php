<?php
	include "../../private/connection.php";
	session_start();

	$brand = $_POST["brand"];

	#	Check if name has been filled in
	if($brand == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No brand has been given");
		header("location: ../index.php?page=add_brand");
		die;
	}

	#	Check if name is unique
	$sql = "SELECT brand
			FROM brands
			WHERE brand = :brand";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":brand", $brand);
	$sth->execute();
	$hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($hardware != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "This brand already exists");
		header("location: ../index.php?page=add_brand");
		die;
	}

	$sql = "INSERT INTO brands (brand)
	        VALUES (:brand)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(":brand", $brand);
    $sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "Brand has been added");
	header("location: ../index.php?page=admin_brands");
	die;
?>

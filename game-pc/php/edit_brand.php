<?php
	include "../../private/connection.php";
	session_start();

	$brand = $_POST["brand"];
	$brand_ID = $_POST["brand_ID"];
	$original = $_POST["original_name"];

	if($brand == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Field has been left empty");
		header("location: ../index.php?page=edit_brand&id=".$brand_ID);
		die;
	}

	#	Check if name is unique
	$sql = "SELECT brand
			FROM brands
			WHERE brand_ID != :brand_ID
			AND brand = :brand";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":brand_ID", $brand_ID);
	$sth->bindParam(":brand", $brand);
	$sth->execute();
	$duplicants = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($duplicants != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Brand already excists");
		header("location: ../index.php?page=edit_brand&id=".$brand_ID);
		die;
	}

	if($original == $brand)
	{
		$_SESSION["alert"] = array("type" => "primary", "message" => "Nothing has been changed");
		header("location: ../index.php?page=admin_brands");
		die;
	}
	else
	{
		#   Update Brand
		$sql = "UPDATE brands
				SET brand = :brand
				WHERE brand_ID = :brand_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":brand", $brand);
		$sth->bindParam(":brand_ID", $brand_ID);
		$sth->execute();
		
		$_SESSION["alert"] = array("type" => "success", "message" => "The name has been changed");
		header("location: ../index.php?page=admin_brands");
		die;
	}
?>

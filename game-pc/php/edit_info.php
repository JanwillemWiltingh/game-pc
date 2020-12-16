<?php
	include "../../private/connection.php";
	session_start();

	$user_ID = $_SESSION["user_ID"];

	$sql = "UPDATE users
			SET email = :email, first_name = :first_name, last_name = :last_name, payment_method_FK = :payment, city = :city, state_province = :state_province, billing_address_1 = :address_1, billing_address_2 = :address_2, zip_postal = :postal, country_FK = :country, phone_number = :phone
			WHERE user_ID = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":hardware_name", $hardware_name);
	$sth->bindParam(":hardware_ID", $hardware_ID);
	$sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "The name has been changed");
	header("location: ../index.php?page=admin_hardware");
	die;
?>

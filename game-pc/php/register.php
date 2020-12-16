<?php
	include "../../private/connection.php";
	session_start();

	if(!isset($_POST["email"]))
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No email has been given");
		header("location: ../index.php?page=register");
		die;
	}

	if(!isset($_POST["password"]))
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No password has been given");
		header("location: ../index.php?page=register");
		die;
	}

	if(!isset($_POST["repeat_password"]))
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Password has not been repeated");
		header("location: ../index.php?page=register");
		die;
	}

	if($_POST["password"] != $_POST["repeat_password"])
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Password and repeat password aren't identical");
		header("location: ../index.php?page=register");
		die;
	}

	$sql = "SELECT *
			FROM users
			WHERE email = :email";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":email", $_POST["email"]);
	$sth->execute();
	$user = $sth->fetch(PDO::FETCH_ASSOC);

	if($user != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "This email is already in use");
		header("location: ../index.php?page=register");
		die;
	}

	$sql = "SELECT *
			FROM roles
			WHERE role = 'customer'";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":email", $_POST["email"]);
	$sth->execute();
	$role_ID = $sth->fetch(PDO::FETCH_ASSOC);

	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (email, password, role_FK)
			VALUES (:email, :password, :role)";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":email", $_POST["email"]);
	$sth->bindParam(":password", $password);
	$sth->bindParam(":role", $role_ID["role_ID"]);
	$sth->execute();


	$_SESSION["alert"] = array("type" => "success", "message" => "Regestration was successful");
	header("location: ../index.php?page=login");
	die;
?>

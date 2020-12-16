<?php
	include "../../private/connection.php";
	session_start();

	$email = $_POST["email"];
	$role_ID = $_POST["role"];

	#	Check if name has been filled in
	if($email == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No Email has been given");
		header("location: ../index.php?page=add_user");
		die;
	}

	#	Check if name is unique
	$sql = "SELECT email
			FROM users
			WHERE email = :email";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":email", $email);
	$sth->execute();
	$emails = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($emails != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "This email is already in use");
		header("location: ../index.php?page=add_user");
		die;
	}

	$password = "password123";
    $sql = "INSERT INTO users (email, password, role_FK)
	        VALUES (:email, :password, :role)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(":email", $email);
	$sth->bindParam(":password", $password);
    $sth->bindParam(":role", $role_ID);
    $sth->execute();

	$_SESSION["alert"] = array("type" => "success", "message" => "User has been added");
	header("location: ../index.php?page=admin_users");
	die;
?>

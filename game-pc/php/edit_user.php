<?php
	include "../../private/connection.php";
	session_start();

	

	if($email == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Email field has been left empty");
		header("location: ../index.php?page=edit_user&id=".$user_ID);
		die;
	}

	#	Check if name is unique
	$sql = "SELECT email
			FROM users
			WHERE user_ID != :user_ID
			AND email = :email";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $user_ID);
	$sth->bindParam(":email", $email);
	$sth->execute();
	$duplicants = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($duplicants != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Email is already in use");
		header("location: ../index.php?page=edit_user&id=".$user_ID);
		die;
	}

	if($original_email == $email AND $original_role == $role)
	{
		$_SESSION["alert"] = array("type" => "primary", "message" => "Nothing has been changed");
		header("location: ../index.php?page=admin_users");
		die;
	}
	else
	{
		#   Update Brand
		$sql = "UPDATE users
				SET email = :email, role_FK = :role
				WHERE user_ID = :user_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":email", $email);
		$sth->bindParam(":role", $role);
		$sth->bindParam(":user_ID", $user_ID);
		$sth->execute();

		$_SESSION["alert"] = array("type" => "success", "message" => "User has been changed");
		header("location: ../index.php?page=admin_users");
		die;
	}
?>

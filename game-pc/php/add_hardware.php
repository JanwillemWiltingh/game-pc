<?php
	include "../../private/connection.php";
	session_start();

	$hardware = $_POST["hardware"];

	#	Check if name has been filled in
	if($hardware == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "No hardware has been given");
		header("location: ../index.php?page=add_hardware");
		die;
	}

	#	Check if name is unique
	$sql = "SELECT *
			FROM hardware
			WHERE hardware_name = :hardware";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":hardware", $hardware);
	$sth->execute();
	$all_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($all_hardware != NULL)
	{
		// $_SESSION["alert"] = array("type" => "danger", "message" => "This name is already in use");
		// header("location: ../index.php?page=add_hardware");
		// die;
	}
	else
	{
		$sql = "INSERT INTO hardware (hardware_name)
				VALUES (:hardware)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":hardware", $hardware);
		$sth->execute();

		$_SESSION["alert"] = array("type" => "success", "message" => "Hardware has been added");
		header("location: ../index.php?page=admin_hardware");
		die;
	}
?>

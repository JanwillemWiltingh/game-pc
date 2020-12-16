<?php
	include "../../private/connection.php";
	session_start();

	$hardware_name = $_POST["hardware_name"];
	$hardware_ID = $_POST["hardware_ID"];
	$original = $_POST["original_name"];

	if($hardware_name == NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Field has been left empty");
		header("location: ../index.php?page=edit_hardware&id=".$hardware_ID);
		die;
	}

	#	Check if name is unique
	$sql = "SELECT hardware_name
			FROM hardware
			WHERE hardware_ID != :hardware_ID
			AND hardware_name = :hardware_name";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":hardware_ID", $hardware_ID);
	$sth->bindParam(":hardware_name", $hardware_name);
	$sth->execute();
	$duplicants = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($duplicants != NULL)
	{
		$_SESSION["alert"] = array("type" => "danger", "message" => "Hardware already excists");
		header("location: ../index.php?page=edit_hardware&id=".$hardware_ID);
		die;
	}

	if($original == $hardware_name)
	{
		$_SESSION["alert"] = array("type" => "primary", "message" => "Nothing has been changed");
		header("location: ../index.php?page=admin_hardware");
		die;
	}
	else
	{
		#   Update Brand
		$sql = "UPDATE hardware
				SET hardware_name = :hardware_name
				WHERE hardware_ID = :hardware_ID";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":hardware_name", $hardware_name);
		$sth->bindParam(":hardware_ID", $hardware_ID);
		$sth->execute();

		$_SESSION["alert"] = array("type" => "success", "message" => "The name has been changed");
		header("location: ../index.php?page=admin_hardware");
		die;
	}
?>

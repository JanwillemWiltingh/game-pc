<?php
    include "../../private/connection.php";
    session_start();

	$email = $_POST["email"];
	$password = $_POST["password"];

    #   Wachtwoord uit Database halen aan de hand van Email
    $sql = "SELECT users.user_ID, users.email, users.password, roles.role
			FROM users
			INNER JOIN roles
			ON users.role_FK = roles.role_ID
			WHERE users.email = :username";
    $sth = $conn->prepare($sql);
    $sth->bindParam(":username", $email);
    $sth->execute();
    $rsUser = $sth->fetch(PDO::FETCH_ASSOC);

    #   Wachtwoord verifiëren, Toegang geven en role meegeven aan SESSION
    $verify = password_verify($password, $rsUser["password"]);
    if($verify == TRUE)
    {
		if($rsUser["role"] == "admin")
		{
			$_SESSION["user_ID"] = $rsUser["user_ID"];
			$_SESSION["role"] = $rsUser["role"];

			$_SESSION["alert"] = array("type" => "success", "message" => "You've been logged in");
			header("location: ../index.php?page=admin_products");
			die;
		}
		else if($rsUser["role"] = "customer")
		{
			$_SESSION["user_ID"] = $rsUser["user_ID"];
			$_SESSION["role"] = $rsUser["role"];

			$_SESSION["alert"] = array("type" => "success", "message" => "You've been logged in");
			header("location: ../index.php?page=my_pc");
			die;
		}
		else
		{
			#   Wanneer iemand opeens geen role heeft krijgt die dit
			$_SESSION["alert"] = array("type" => "danger", "message" => "Foute email en Wachtwoord combinatie");
			header("location: ../index.php?page=login");
			die;
		}
    }
    else
    {
        #   Wanneer het wachtwoord verkeerd is worden gebruikers terug gestuurd naar de login pagina waar ze opnieuw kunnen proberen
		$_SESSION["alert"] = array("type" => "danger", "message" => "Foute email en Wachtwoord combinatie");
        header("location: ../index.php?page=login");
		die;
    }
?>

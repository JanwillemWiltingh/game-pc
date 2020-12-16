<?php
	session_start();
	include "../private/connection.php";
	include "includes/functions.inc.php";

	require_once "includes/header.inc.php";
	require_once "includes/navbar.inc.php";
	include "includes/status_messages.inc.php";

	$key = array_search($page, array_column($nav_items, 'slug'));

	if($key === NULL)
	{
		include "includes/error404.inc.php";
	}
	else if(empty($key))
	{
		include "includes/error404.inc.php";
	}
	else
	{
		if(isset($_SESSION["role"]))
		{
			if($nav_items[$key][$_SESSION["role"]] == TRUE)
			{
				include "includes/".$page.".inc.php";
			}
			else
			{
				include "includes/errorRole.inc.php";
			}
		}
		else
		{
			if($nav_items[$key]["guest"] == TRUE)
			{
				include "includes/".$page.".inc.php";
			}
			else
			{
				include "includes/errorRole.inc.php";
			}
		}
	}
?>

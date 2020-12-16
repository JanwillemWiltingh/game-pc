<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Page Title -->
		<title>
			404 Error Occurred
		</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
		<link rel="manifest" href="./images/favicon/site.webmanifest">

		<!-- My own CSS and Javascript -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="jsfile.js" href="jsfile.js"></script>
	</head>
	<body>
		<div class="page-wrap d-flex flex-row align-items-center">
		    <div class="container">
		        <div class="row justify-content-center">
		            <div class="col-md-12 text-center">
		                <span class="display-1 d-block">404</span>
		                <div class="mb-4 lead">The page you are looking for was not found.</div>
						<?php
							if(!isset($_SESSION["role"]))
							{
								#	Product Page
								echo '<a href="index.php?page=products" class="btn btn-link">Back to Shopping</a>';
							}
							else if($_SESSION["role"] == "admin")
							{
								# Admin Page
								echo '<a href="index.php?page=admin_products" class="btn btn-link">Back to Admin Pages</a>';
							}
							else if($_SESSION["role"] == "customer")
							{
								#	Product Page
								echo '<a href="index.php?page=products" class="btn btn-link">Back to Shopping</a>';
							}
						?>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
</html>

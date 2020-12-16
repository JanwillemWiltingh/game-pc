<?php
	$sql = "SELECT *
			FROM roles";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$roles = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<?php
		if(!isset($_SESSION["role"]))
		{
			echo '<a class="navbar-brand" href="index.php?page=table_competitions">';
		}
		else
		{
			if($_SESSION["role"] == "admin")
			{
				echo '<a class="navbar-brand" href="index.php?page=admin_page">';
			}
			else
			{
				echo '<a class="navbar-brand" href="index.php?page=table_competitions">';
			}
		}
	?>
  		Game-PC
	</a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php
				if(isset($_SESSION["role"]))
				{
					if($_SESSION["role"] == "admin")
					{
			?>
		  	<li class="nav-item">
		    	<a class="nav-link" href="index.php?page=admin_products">Products</a>
		  	</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=admin_brands">Brands</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=admin_users">Users</a>
			</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="index.php?page=admin_hardware">Hardware</a>
		  	</li>
			<?php
					}
					else
					{
						?>
							<li class="nav-item">
								<a class="nav-link" href="index.php?page=my_pc">My PC</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="index.php?page=products">Products</a>
							</li>
						<?php
					}
				}
				else
				{
			?>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=my_pc">My PC</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=products">Products</a>
			</li>
			<?php
				}
			?>
		</ul>
		<ul class="navbar-nav my-2 my-lg-0">
			<li class="nav-item">
				<?php
					if(!isset($_SESSION["user_ID"]))
					{
						?>
								<a class="nav-link" href="index.php?page=register">Register</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="index.php?page=login">Login</a>
						<?php
					}
					else
					{
						$sql = "SELECT *
								FROM shopping_cart
								WHERE user_FK = :user_FK";
						$sth = $conn->prepare($sql);
						$sth->bindParam(":user_FK", $_SESSION["user_ID"]);
						$sth->execute();
						$cart = $sth->fetchAll(PDO::FETCH_ASSOC);
						if($_SESSION["role"] == "customer")
						{
				?>
						<li class="nav-item">
        					<a class="nav-link" href="index.php?page=shopping_cart">
								<i class="fa fa-shopping-cart fa-2x"></i>
            						<span class="badge badge-danger badge badge-notify">
									<?= sizeof($cart) ?>
									</span>
          						</i>
        					</a>
  						</li>
						<li class="nav-item"><a class="nav-link" href="index.php?page=orders">Orders</a></li>
				<?php
						}
				?>

						<li class="nav-item"><a class="nav-link" href="php/logout.php">Logout</a></li>
				<?php
					}
				?>
			</ul>
		</ul>
	</div>
</nav>

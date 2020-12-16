<div class="page-wrap d-flex flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 text-center">
				<span class="display-1 d-block">Access Denied</span>
				<?php
					$key = array_search($page, array_column($nav_items, 'slug'));

					if(!isset($_SESSION["role"]))
					{
						if($nav_items[$key]["customer"] == TRUE)
						{
							echo '<div class="mb-4 lead">You need to be logged in as a Customer to be allowed on this page</div>';
							echo '<a href="index.php?page=login" class="btn btn-link">Login As Customer</a>';
						}
						else if($nav_items[$key]["admin"] == TRUE)
						{
							echo '<div class="mb-4 lead">You need to be logged in as a Admin to be allowed on this page</div>';
							echo '<a href="index.php?page=login" class="btn btn-link">Login As Admin</a>';
						}
						else
						{
							echo '<div class="mb-4 lead">You are not allowed on this page</div>';
						}
					}
					else
					{
						if($_SESSION["role"] == "customer")
						{
							if($nav_items[$key]["admin"] == TRUE)
							{
								echo '<div class="mb-4 lead">You need to be logged in as a Admin to be allowed on this page</div>';
								echo '<a href="index.php?page=login" class="btn btn-link">Login As Admin</a>';
							}
							else
							{
								echo '<div class="mb-4 lead">You are not allowed on this page</div>';
							}
						}
						else
						{
							if($nav_items[$key]["customer"] == TRUE)
							{
								echo '<div class="mb-4 lead">You need to be logged in as a Customer to be allowed on this page</div>';
								echo '<a href="index.php?page=login" class="btn btn-link">Login As Customer</a>';
							}
							else
							{
								echo '<div class="mb-4 lead">You are not allowed on this page</div>';
							}
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php
	$sql = "SELECT products.product_ID, hardware.hardware_name, hardware.hardware_ID, products.image, brands.brand, products.name, products.in_stock, products.price
			FROM ((products
			INNER JOIN hardware ON products.hardware_FK = hardware.hardware_ID)
			INNER JOIN brands ON products.brand_FK = brands.brand_ID)
			WHERE hardware_ID = :hardware_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":hardware_ID", $_GET["id"]);
	$sth->execute();
	$products = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
	<div class="row">
		<?php
			foreach($products as $product)
			{
		?>
        <div class="col-sm-3 mt-2">
        	<article class="col-item">
				<form action="../game-pc/php/add_to_pc.php" method="POST">
					<input name="product_ID" type="hidden" value="<?php echo $product["product_ID"] ?>">
					<input name="hardware_ID" type="hidden" value="<?php echo $product["hardware_ID"] ?>">
					<?php
						if(isset($_SESSION["role"]))
						{
							if($_SESSION["role"] == "customer")
							{
					?>
	        		<div class="options">
	        			<button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Add to cart"
						<?php
							if($product["in_stock"] == 0)
							{
								echo "disabled";
							}
						?>>
	        				<span class="fa fa-plus"></span>
	        			</button>
	        		</div>
					<?php
							}
						}
					?>
	        		<div class="photo">
	        			<a href="#">
							<?php
								if($product["image"] == NULL)
								{
									echo '<td><img width="75px" src="default_image/default.png"/></td>';
								}
								else
								{
									echo '<td><img width="75px" src="data:image/png;base64,'.base64_encode( $product["image"]).'"/></td>';
								}
							?>
						</a>
	        		</div>
	        		<div class="info">
	        			<div class="row">
	        				<div class="price-details col-md-12">
	        					<h1><?php echo $product["brand"]." - ".$product["name"] ?></h1>
	        					<span class="price-new">€<?php echo $product["price"] ?></span>
	        				</div>
	        			</div>
	        		</div>
				</form>
        	</article>
        </div>
		<?php
			}
		?>
	</div>
</div>

<?php
	$sql = "SELECT DISTINCT date_ordered
			FROM orders
			WHERE user_FK = :user_ID
			ORDER BY date_ordered DESC";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();
	$dates = $sth->fetchAll(PDO::FETCH_ASSOC);

 	foreach($dates as $date)
	{
		$sql = "SELECT orders.order_ID, orders.amount, orders.date_ordered, users.user_ID, products.product_ID, products.name, products.image, products.price, brands.brand
				FROM (((orders
				INNER JOIN users ON orders.user_FK = users.user_ID)
				INNER JOIN products ON orders.product_FK = products.product_ID)
				INNER JOIN brands ON products.brand_FK = brands.brand_ID)
				WHERE orders.user_FK = :user_ID
				AND date_ordered = :date_ordered";
		$sth = $conn->prepare($sql);
		$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
		$sth->bindParam(":date_ordered", $date["date_ordered"]);
		$sth->execute();
		$orders = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="accordion-<?= $date["date_ordered"] ?>">
  	<div class="card">
    	<div class="card-header" id="heading-<?= $date["date_ordered"] ?>">
      		<h5 class="mb-0">
        		<button class="btn btn-link" data-toggle="collapse" data-target="#<?= $date["date_ordered"] ?>" aria-expanded="false" aria-controls="collapse-<?= $date["date_ordered"] ?>">
          			Orders: <?= $date["date_ordered"] ?>
        		</button>
      		</h5>
    	</div>

		<div id="<?= $date["date_ordered"] ?>" class="collapse" aria-labelledby="heading-<?= $date["date_ordered"] ?>" data-parent="#accordion-<?= $date["date_ordered"] ?>">
      		<div class="card-body">
				<table class="table table-hover">
				    <thead>
				        <tr>
				            <th>Product</th>
				            <th>Quantity</th>
				            <th class="text-center">Price</th>
				            <th class="text-center">Total</th>
				        </tr>
				    </thead>
				    <tbody>
						<?php
							if($orders == NULL)
							{
								echo '<td class="col-sm-8 col-md-6">This cart is empty</td>';
							}
							else
							{
								foreach($orders as $order)
								{
						?>
				        <tr>
				            <td class="col-sm-8 col-md-6">
				            	<div class="media">
									<?php
										if($order["image"] == NULL)
										{
											echo '<img width="75px" class="media-object rounded" src="default_image/default.png"/>';
										}
										else
										{
											echo '<img width="75px" class="media-object rounded" src="data:image/png;base64,'.base64_encode( $order["image"]).'"/>';
										}
									?>
				                	<div class="media-body">
				                    	<h4 class="media-heading"><?php echo $order["name"] ?></h4>
				                    	<h5 class="media-heading"> by <?php echo $order["brand"] ?></h5>
				                	</div>
				            	</div>
							</td>
							<td class="col-sm-1 col-md-1 text-center"><strong><?php echo $order["amount"]."x" ?></strong></td>
				            <td class="col-sm-1 col-md-1 text-center"><strong>€<?php echo $order["price"] ?></strong></td>
				            <td class="col-sm-1 col-md-1 text-center"><strong>€<?php echo $order["amount"] * $order["price"] ?></strong></td>
				        </tr>
						<?php
								}
							}
						?>
				        <tr>
				            <td>   </td>
				            <td>   </td>
							<td><h3>Total</h3></td>
							<td class="col-md-1 text-center">
								<h3>
									<strong>
										<?php
											$total_price = 0;
											foreach($orders as $order)
											{
												$total_price = $total_price + ($order["price"] * $order["amount"]);
											}
											echo "€".$total_price;
										?>
									</strong>
								</h3>
							</td>
				        </tr>
				        <tr>
				            <td>   </td>
				            <td>   </td>
				            <td>   </td>
							<td>   </td>
				        </tr>
				    </tbody>
				</table>
			</div>
	    </div>
	</div>
	<?php } ?>
</div>

<?php
	$sql = "SELECT shopping_cart.cart_ID, shopping_cart.amount, products.name, products.image, products.price, brands.brand
			FROM ((shopping_cart
			INNER JOIN products ON shopping_cart.product_FK = products.product_ID)
			INNER JOIN brands ON products.brand_FK = brands.brand_ID)
			WHERE shopping_cart.user_FK = :user_ID";
	$sth = $conn->prepare($sql);
    $sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();
	$products = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<div>
    <div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
					<?php
						if($products == NULL)
						{
							echo '<td class="col-sm-8 col-md-6">This cart is empty</td>';
						}
						else
						{
							foreach($products as $product)
							{
					?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        	<div class="media">
								<?php
									if($product["image"] == NULL)
									{
										echo '<img width="75px" class="media-object rounded" src="default_image/default.png"/>';
									}
									else
									{
										echo '<img width="75px" class="media-object rounded" src="data:image/png;base64,'.base64_encode( $product["image"]).'"/>';
									}
								?>
                            	<div class="media-body">
                                	<h4 class="media-heading"><?php echo $product["name"] ?></h4>
                                	<h5 class="media-heading"> by <?php echo $product["brand"] ?></h5>
                            	</div>
                        	</div>
						</td>
						<td class="col-sm-1 col-md-1 text-center"><strong><?php echo $product["amount"]."x" ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>€<?php echo $product["price"] ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>€<?php echo $product["amount"] * $product["price"] ?></strong></td>
	                    <td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_from_cart.php?id=<?= $product["cart_ID"]?>" onclick="return confirm('Are You Sure you want to remove this item from your shopping cart?');"><i class="fa fa-times"></i></a></td>
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
										foreach($products as $product)
										{
											$total_price = $total_price + ($product["price"] * $product["amount"]);
										}
										echo "€".$total_price;
									?>
								</strong>
							</h3>
						</td>
                        <td>   </td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
							<a class="btn btn-outline-dark" href="index.php?page=products" role="button">Continue Shopping</a>
						</td>
                        <td>
							<?php
								if($products == NULL)
								{
									echo '<a class="btn btn-outline-success disabled">Checkout</a>';
								}
								else
								{
									echo '<a class="btn btn-outline-success" href="./php/check_out.php">Checkout</a>';
								}
							?>
						</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
	$sql = "SELECT products.product_ID, hardware.hardware_name, products.image, brands.brand, products.name, products.in_stock, products.price
			FROM ((products
			INNER JOIN hardware ON products.hardware_FK = hardware.hardware_ID)
			INNER JOIN brands ON products.brand_FK = brands.brand_ID)";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$all_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Image</th>
			<th scope="col">Hardware</th>
			<th scope="col">Brand</th>
			<th scope="col">Name</th>
			<th scope="col">In Stock</th>
			<th scope="col">Price</th>
			<th scope="col"></th>
			<th scope="col"><a class="border-0 btn-transition btn btn-outline-light" href="index.php?page=add_product"><i class="fa fa-plus"></i></a></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x = 0;
			foreach($all_hardware as $hardware)
			{
				$x++;
		?>
		<tr>
			<th style="width: 5%" scope="row"><?php echo $x ?></th>
			<?php
				if($hardware["image"] == NULL)
				{
					echo '<td><img width="75px" src="default_image/default.png"/></td>';
				}
				else
				{
					echo '<td><img width="75px" src="data:image/png;base64,'.base64_encode( $hardware["image"]).'"/></td>';
				}
			?>
			<td><?php echo $hardware["hardware_name"] ?></td>
			<td><?php echo $hardware["brand"] ?></td>
			<td><?php echo $hardware["name"] ?></td>
			<td><?php echo $hardware["in_stock"] ?></td>
			<td>€<?php echo $hardware["price"] ?></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-dark" href="index.php?page=edit_product&id=<?= $hardware["product_ID"] ?>"><i class="fa fa-cog"></i></a></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_product.php?id=<?= $hardware["product_ID"]?>" onclick="return confirm('Weet u zeker dat u deze hardware wilt verwijderen?');"><i class="fa fa-times"></i></a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

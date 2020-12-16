<?php
	$sql = "SELECT *
			FROM hardware";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$all_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	// echo "<pre>", print_r($hardware),"</pre>";
?>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
			<th scope="col">Hardware Type</th>
			<th scope="col">Image</th>
			<th scope="col">Brand</th>
			<th scope="col">Name</th>
			<th scope="col">In Stock</th>
			<th scope="col">Price</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach($all_hardware as $hardware)
		{
			$sql = "SELECT products.product_ID, hardware.hardware_name, products.image, brands.brand, products.name, products.in_stock, products.price
					FROM (((users_products
					INNER JOIN products ON users_products.product_FK = products.product_ID)
					INNER JOIN hardware ON products.hardware_FK = hardware.hardware_ID)
					INNER JOIN brands ON products.brand_FK = brands.brand_ID)
					WHERE users_products.user_FK = :user_ID
					AND hardware.hardware_ID = :hardware_ID";
			$sth = $conn->prepare($sql);
			$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
			$sth->bindParam(":hardware_ID", $hardware["hardware_ID"]);
			$sth->execute();
			$user_hardware = $sth->fetch(PDO::FETCH_ASSOC);

			// echo "<pre>", print_r($user_hardware),"</pre>";
			// echo "<pre>", print_r($hardware),"</pre>";
	?>
		<tr>
			<td style="width: 5%;"><a class="border-0 btn-transition btn btn-outline-dark" href="index.php?page=parts&id=<?= $hardware["hardware_ID"] ?>"><i class="fa fa-arrow-circle-right fa-2x"></i></a></td>
			<td style="width: 10%;"><?= $hardware["hardware_name"] ?></td>
			<?php
				if($user_hardware == NULL)
				{
					echo '<td colspan="6">No, '.$hardware["hardware_name"].' has been selected</td>';
				}
				else
				{
					if($user_hardware["image"] == NULL)
					{
						echo '<td><img width="75px" src="default_image/default.png"/></td>';
					}
					else
					{
						echo '<td><img width="75px" src="data:image/png;base64,<?=base64_encode( $product["image"])?>"/></td>';
					}
			?>
			<td><?= $user_hardware["brand"] ?></td>
			<td><?= $user_hardware["name"] ?></td>
			<td><?= $user_hardware["in_stock"] ?></td>
			<td>€ <?= $user_hardware["price"] ?></td>
			<td><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_from_pc.php?id=<?= $user_hardware["product_ID"]?>"><i class="fa fa-times"></i></a></td>
			<?php
				}
			?>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
<?php
	$sql = "SELECT *
			FROM users_products
			WHERE user_FK = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_SESSION["user_ID"]);
	$sth->execute();
	$selected_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	$sql = "SELECT *
			FROM hardware";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$all_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);

	if($all_hardware > $selected_hardware)
	{
		echo '<a class="btn btn-outline-success disabled">Checkout</a>';
	}
	else
	{
		echo '<a class="btn btn-outline-success" href="./php/assemble.php">Checkout</a>';
	}
?>

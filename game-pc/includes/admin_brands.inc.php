<?php
	$sql = "SELECT *
			FROM brands";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$brands = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Brand</th>
			<th scope="col"></th>
			<th scope="col"><a class="border-0 btn-transition btn btn-outline-light" href="index.php?page=add_brand"><i class="fa fa-plus"></i></a></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x = 0;
			foreach($brands as $brand)
			{
				$x++;
		?>
		<tr>
			<td style="width: 5%" scope="row"><?php echo $x ?></td>
			<td><?php echo $brand["brand"] ?></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-dark" href="index.php?page=edit_brand&id=<?= $brand["brand_ID"] ?>"><i class="fa fa-cog"></i></a></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_brand.php?id=<?= $brand["brand_ID"]?>" onclick="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?');"><i class="fa fa-times"></i></a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

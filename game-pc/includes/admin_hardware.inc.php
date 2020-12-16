<?php
	$sql = "SELECT *
			FROM hardware";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$all_hardware = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Hardware</th>
			<th scope="col"></th>
			<th scope="col"><a class="border-0 btn-transition btn btn-outline-light" href="index.php?page=add_hardware"><i class="fa fa-plus"></i></a></th>
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
			<td style="width: 5%" scope="row"><?php echo $x ?></td>
			<td><?php echo $hardware["hardware_name"] ?></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-dark" href="index.php?page=edit_hardware&id=<?= $hardware["hardware_ID"] ?>"><i class="fa fa-cog"></i></a></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_hardware.php?id=<?= $hardware["hardware_ID"]?>" onclick="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?');"><i class="fa fa-times"></i></a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php
	$sql = "SELECT users.user_ID, users.email, users.password, roles.role
			FROM users
			INNER JOIN roles
			ON users.role_FK = roles.role_ID";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$users = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Email</th>
			<th scope="col">Role</th>
			<th scope="col"></th>
			<th scope="col"><a class="border-0 btn-transition btn btn-outline-light" href="index.php?page=add_user"><i class="fa fa-plus"></i></a></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x = 0;
			foreach($users as $user)
			{
				$x++;
		?>
		<tr>
			<td style="width: 5%" scope="row"><?php echo $x ?></td>
			<td><?php echo $user["email"] ?></td>
			<td><?php echo $user["role"] ?></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-dark" href="index.php?page=edit_user&id=<?= $user["user_ID"] ?>"><i class="fa fa-cog"></i></a></td>
			<td style="width: 5%"><a class="border-0 btn-transition btn btn-outline-danger" href="./php/delete_user.php?id=<?= $user["user_ID"]?>" onclick="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?');"><i class="fa fa-times"></i></a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

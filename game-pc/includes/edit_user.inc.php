<?php
	$sql = "SELECT *
			FROM users
			WHERE user_ID = :user_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":user_ID", $_GET["id"]);
	$sth->execute();
	$user = $sth->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Edit User</h5>
            <form method="POST" action="../game-pc/php/edit_user.php">

				<!-- Email Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail" class="col-form-label">Email</label>
						<input name="email" type="text" class="form-control" id="inputEmail" placeholder="example@mail.com" value="<?php echo $user["email"] ?>">
						<input name="original_email" type="hidden" value="<?php echo $user["email"] ?>">
						<input name="user_ID" type="hidden" value="<?php echo $_GET["id"] ?>">
					</div>
				</div>

				<!-- Select Input for Hardware -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="Hardware">Role</label>
						<select name="role" id="amountOfTeams" class="form-control">
						<?php
							$sql = "SELECT *
									FROM roles";
							$sth = $conn->prepare($sql);
							$sth->bindParam(":role_FK", $user["role_FK"]);
							$sth->execute();
							$roles = $sth->fetchAll();

							foreach($roles as $role)
							{
								if($user["role_FK"] == $role["role_ID"])
								{
									echo '<option value="'.$role["role_ID"].'"selected>'.$role["role"].'</option>';
								}
								else
								{
									echo '<option value="'.$role["role_ID"].'">'.$role["role"].'</option>';
								}
							}

						?>
                        </select>
						<input name="original_role" type="hidden" value="<?php echo $user["role_FK"] ?>">
                    </div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

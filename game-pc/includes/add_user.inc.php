<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Add User</h5>
            <form method="POST" action="../game-pc/php/add_user.php">

				<!-- Email Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail" class="col-form-label">Email</label>
						<input name="email" type="text" class="form-control" id="inputEmail" placeholder="example@mail.com">
					</div>
				</div>

				<!-- Select Input for Hardware -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="Hardware">Role</label>
						<select name="role" id="amountOfTeams" class="form-control">
						<?php
							$sql = "SELECT * FROM roles";
							$sth = $conn->prepare($sql);
							$sth->execute();
							$roles = $sth->fetchAll();

							foreach($roles as $role)
							{
								echo '<option value="'.$role["role_ID"].'">'.$role["role"].'</option>';
							}

						?>
                        </select>
                    </div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

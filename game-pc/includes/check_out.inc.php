<?php
	$sql = "SELECT *
			FROM users
			WHERE user_ID = :user_ID";
	$sth = $conn->prepare($sql);
	   $sth->bindParam(":user_ID", $user_ID);
	$sth->execute();
	$user_info = $sth->fetchAll(PDO::FETCH_ASSOC);

	$sql = "SELECT *
			FROM payment_methods";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$payment_methods = $sth->fetchAll(PDO::FETCH_ASSOC);

	$sql = "SELECT *
			FROM countries
			ORDER BY printable_name";
	$sth = $conn->prepare($sql);
	$sth->execute();
	$countries = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Check Out</h5>
            <form method="POST" action="../game-pc/php/check_out.php">

				<!-- Select Input for Hardware -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="payment_method">Payment Method</label>
						<select name="payment_method" id="payment_method" class="form-control">
							<?php
								foreach($payment_methods as $payment_method)
								{
									echo '<option value="NULL">'.$payment_method["method"].'</option>';
								}
							?>
                        </select>
                    </div>
				</div>

				<!-- Email Input -->
				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="first_name" class="col-form-label">First Name</label>
						<input name="first_name" type="text" class="form-control" id="first_name">
					</div>

					<div class="form-group col-md-3">
						<label for="last_name" class="col-form-label">Last Name</label>
						<input name="last_name" type="text" class="form-control" id="last_name">
					</div>

					<div class="form-group col-md-6">
						<label for="city" class="col-form-label">City</label>
						<input name="city" type="text" class="form-control" id="city">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="billing_address">Billing address</label>
						<input name="billing_address" type="text" class="form-control" id="billing_address">
					</div>

					<div class="form-group col-md-6">
                        <label for="state">State/Province</label>
						<select name="state" id="state" class="form-control">
							<option value="NULL"selected>State/Province</option>
                        </select>
                    </div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="billing_address_line_2" class="col-form-label">Billing address, line 2</label>
						<input name="billing_address_line_2" type="text" class="form-control" id="billing_address_line_2">
					</div>

					<div class="form-group col-md-6">
						<label for="zip_postal" class="col-form-label">Zip or postal code</label>
						<input name="zip_postal" type="text" class="form-control" id="zip_postal">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="country">Country</label>
						<select name="country" id="country"  class="selectpicker form-control" data-live-search="true">
							<?php
								#   Teams worden weergegeven
								foreach($countries as $country)
								{
									echo '<option value="'.$country["country_ID"].'">'.$country["printable_name"].'</option>';
								}
							?>
						</select>
					</div>

					<div class="form-group col-md-6">
						<label for="phone_number" class="col-form-label">Phone Number</label>
						<input name="phone_number" type="text" class="form-control" id="phone_number">
					</div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">Continue</button>

            </form>
        </div>
    </div>
</div>

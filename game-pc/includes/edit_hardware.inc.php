<?php
	$sql = "SELECT hardware_name
			FROM hardware
			WHERE hardware_ID = :hardware_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":hardware_ID", $_GET["id"]);
	$sth->execute();
	$hardware = $sth->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Edit Hardware</h5>
            <form method="POST" action="../game-pc/php/edit_hardware.php">

				<!-- Hardware Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputHardware" class="col-form-label">Brand</label>
						<input name="hardware_name" type="text" class="form-control" id="inputHardware" placeholder="Hardware" value="<?php echo $hardware["hardware_name"] ?>">
						<input name="original_name" type="hidden" value="<?php echo $hardware["hardware_name"] ?>">
						<input name="hardware_ID" type="hidden" value="<?php echo $_GET["id"] ?>">
					</div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

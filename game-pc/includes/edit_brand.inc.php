<?php
	$sql = "SELECT brand
			FROM brands
			WHERE brand_ID = :brand_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":brand_ID", $_GET["id"]);
	$sth->execute();
	$brand = $sth->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Edit Brand</h5>
            <form method="POST" action="../game-pc/php/edit_brand.php">

				<!-- Brand Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputBrand" class="col-form-label">Brand</label>
						<input name="brand" type="text" class="form-control" id="inputBrand" placeholder="Brand" value="<?php echo $brand["brand"] ?>">
						<input name="original_name" type="hidden" value="<?php echo $brand["brand"] ?>">
						<input name="brand_ID" type="hidden" value="<?php echo $_GET["id"] ?>">
					</div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

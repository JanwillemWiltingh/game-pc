<?php
	$sql = "SELECT *
			FROM products
			WHERE product_ID = :product_ID";
	$sth = $conn->prepare($sql);
	$sth->bindParam(":product_ID", $_GET["id"]);
	$sth->execute();
	$product = $sth->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Edit Product</h5>
            <form method="POST" enctype="multipart/form-data" action="../game-pc/php/edit_product.php">
				<input name="product_ID" type="hidden" value="<?php echo $product["product_ID"] ?>">

				<!-- File Browser -->
				<div class="input-group md-12">
					<div class="custom-file">
						<input type="file" name="file" class="custom-file-input" id="customFile" accept="image/*" />
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>
				<small id="passwordHelpBlock" class="form-text text-muted md-12 mb-3">
					upload alstublieft een afbeelding van ongever 400 x 400
				</small>
				<script>
					$('#customFile').on('change',function(){
						//get the file name
						var fileName = $(this).val();
						//replace the "Choose a file" label
						$(this).next('.custom-file-label').html(fileName);
					})

					// Material Select Initialization
					$(document).ready(function() {
					$('.mdb-select').materialSelect();
					});
				</script>

				<!-- Select Input for Hardware -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Hardware">Hardware</label>
						<select name="hardware" id="amountOfTeams" class="form-control">
						<?php
							$sql = "SELECT * FROM hardware";
							$sth = $conn->prepare($sql);
							$sth->execute();
							$all_hardware = $sth->fetchAll();

							foreach($all_hardware as $hardware)
							{
								if($product["hardware_FK"] == $hardware["hardware_ID"])
								{
									echo '<option value="'.$hardware["hardware_ID"].'" selected>'.$hardware["hardware_name"].'</option>';
								}
								else
								{
									echo '<option value="'.$hardware["hardware_ID"].'">'.$hardware["hardware_name"].'</option>';
								}
							}

						?>
                        </select>
						<input name="original_hardware" type="hidden" value="<?php echo $product["hardware_FK"] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brands">Brand</label>
						<select name="brand" id="brands" class="form-control">
						<?php
							$sql = "SELECT * FROM brands";
							$sth = $conn->prepare($sql);
							$sth->execute();
							$brands = $sth->fetchAll();

							foreach($brands as $brand)
							{
								if($product["brand_FK"] == $brand["brand_ID"])
								{
									echo '<option value="'.$brand["brand_ID"].'" selected>'.$brand["brand"].'</option>';
								}
								else
								{
									echo '<option value="'.$brand["brand_ID"].'">'.$brand["brand"].'</option>';
								}
							}
						?>
                        </select>
						<input name="original_brand" type="hidden" value="<?php echo $product["brand_FK"] ?>">
                    </div>
				</div>

				<!-- Name Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputName" class="col-form-label">Name</label>
						<input name="name" type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo $product["name"] ?>">
						<input name="original_name" type="hidden" value="<?php echo $product["name"] ?>">
					</div>
				</div>

					<!-- In Stock Input -->
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputInStock" class="col-form-label">In Stock</label>
						<input name="in_stock" type="number" class="form-control" min="0" step="any" id="inputInStock" placeholder="In Stock" value="<?php echo $product["in_stock"] ?>">
						<input name="original_in_stock" type="hidden" value="<?php echo $product["in_stock"] ?>">
					</div>

					<!-- Price Input -->
					<div class="form-group col-md-6">
						<label for="inputPrice" class="col-form-label">Price</label>
						<input name="price" type="text" class="form-control" min="0" step="any" id="inputPrice" placeholder="Price(€)" value="<?php echo $product["price"] ?>">
						<input name="original_price" type="hidden" value="<?php echo $product["price"] ?>">
					</div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="my-5">
            <h5 class="text-center">Add Product</h5>
            <form method="POST" enctype="multipart/form-data" action="../game-pc/php/add_product.php">

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
						<select name="hardware" id="amountOfTeams" class="form-control" required>
						<?php
							$sql = "SELECT * FROM hardware";
							$sth = $conn->prepare($sql);
							$sth->execute();
							$all_hardware = $sth->fetchAll();

							foreach($all_hardware as $hardware)
							{
								echo '<option value="'.$hardware["hardware_ID"].'">'.$hardware["hardware_name"].'</option>';
							}

						?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brands">Brand</label>
						<select name="brand" id="brands" class="form-control" required>
						<?php
							$sql = "SELECT * FROM brands";
							$sth = $conn->prepare($sql);
							$sth->execute();
							$brands = $sth->fetchAll();

							foreach($brands as $brand)
							{
								echo '<option value="'.$brand["brand_ID"].'">'.$brand["brand"].'</option>';
							}
						?>
                        </select>
                    </div>
				</div>

				<!-- Name Input -->
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputName" class="col-form-label">Name</label>
						<input name="name" type="text" class="form-control" id="inputName" placeholder="Name" required>
					</div>
				</div>

					<!-- In Stock Input -->
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputInStock" class="col-form-label">In Stock</label>
						<input name="in_stock" type="number" class="form-control" min="0" step="any" id="inputInStock" placeholder="In Stock">
					</div>

					<!-- Price Input -->
					<div class="form-group col-md-6">
						<label for="inputPrice" class="col-form-label">Price</label>
						<input name="price" type="text" class="form-control" min="0" step="any" id="inputPrice" placeholder="Price(€)" required>
					</div>
				</div>

                <!-- Create button to confirm choices -->
                <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ADD</button>

            </form>
        </div>
    </div>
</div>

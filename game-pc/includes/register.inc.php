<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <form action="../game-pc/php/register.php" method="POST">

						<!-- Email Input Field -->
						<div class="form-label-group">
							<input type="email" id="email" name="email" class="form-control" required>
							<label for="email">Email</label>
						</div>

						<!-- Password Input Field -->
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control" required>
                            <label for="inputPassword">Wachtwoord</label>
                        </div>

						<!-- Repeat Password Input Field -->
                        <div class="form-label-group">
                            <input type="password" id="repeat_password" name="repeat_password" class="form-control" required>
                            <label for="repeat_password">Repeat Password</label>
                        </div>

						<!-- Submit Button -->
                        <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Register</button>

						<hr>

						<!-- Register Suggestion text and link -->
    					<small class="text-muted">
        					Already have an account? <a class="ml-2" href="index.php?page=register">Login</a>
    					</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Log In</h5>
                    <form class="form-signin" action="../game-pc/php/login.php" method="POST">

						<!-- Username Input Field -->
                        <div class="form-label-group">
                            <input type="text" name="email" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                            <label for="inputUsername">Email</label>
                        </div>

						<!-- Password Input Field -->
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                            <label for="inputPassword">Wachtwoord</label>
                        </div>

						<!-- Submit Button -->
                        <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Log in</button>

						<hr>

						<!-- Register Suggestion text and link -->
    					<small class="text-muted">
        					Do not have an account yet? <a class="ml-2" href="index.php?page=register">Sign Up</a>
    					</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

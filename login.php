<?php

include 'main/header.php';

session_start();

if (isset($_SESSION['SuccessMessage'])) {
    echo "<script>
    Swal.fire({
        allowEnterKey: false,
        allowOutsideClick: false,
        icon: 'success',
        title: 'Good Job :)',
        text: '".$_SESSION['SuccessMessage']."'
    }).then(function() {
        window.location.href='updateProfile.php';
    });
    </script>";
    unset($_SESSION['SuccessMessage']);
} else if (isset($_SESSION['ErrorMessage'])) {
    echo "<script>
    Swal.fire({
        allowEnterKey: false,
        allowOutsideClick: false,
        icon: 'error',
        title: 'Sorry :(',
        text: '".$_SESSION['ErrorMessage']."'
    }).then(function() {
        window.location.href='index.php';
    });
    </script>";
    unset($_SESSION['ErrorMessage']);
}

?>

    <main>
        <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

						<div class="d-flex justify-content-center py-4">
						<a href="index.html" class="logo d-flex align-items-center w-auto">
							<!-- <img src="assets/img/logo.png" alt=""> -->
							<span class="d-none d-lg-block" style='text-align:center'>Data Transaksi dan Penyediaan Stok Beras</span>
						</a>
						</div>

						<div class="card mb-3">

							<div class="card-body">
								<div class="pt-4 pb-2">
								<h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
								<p class="text-center small">Enter your username & password to login</p>
								</div>

								<form class="row g-3" method='POST' action='proses.php'>
									<div class="col-12">
										<label for="yourUsername" class="form-label">Username</label>
										<div class="input-group has-validation">
										<input type="text" name="username" class="form-control" required>
										<div class="invalid-feedback">Please enter your username.</div>
										</div>
									</div>

									<div class="col-12">
										<label for="yourPassword" class="form-label">Password</label>
										<input type="password" name="password" class="form-control" required>
										<div class="invalid-feedback">Please enter your password!</div>
									</div>

									<div class="col-12">
										<button class="btn btn-primary w-100" type="submit" name="login">Login</button>
									</div>
								</form>

							</div>
						</div>

					</div>
				</div>
			</div>
        </section>

      	</div>
    </main>
    <!-- End #main -->

<?php

include 'main/footer.php';

?>

   
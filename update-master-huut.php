<?php

include 'main/header.php';

session_start();

if ($_SESSION['username'] == "" && $_SESSION['role'] == "") {
	include 'login.php';
	exit;
}

include('header.php');

include('navbar.php');

include('sidebar.php');

require_once 'koneksi.php';

$IdHuut = $_GET['id'];

$q = "SELECT * FROM db_huut WHERE id = '$IdHuut'";
$sql = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($sql);
$Berat = $row["berat"];
$Harga = $row["harga"];
$Stok = $row["stok"];
$Status = $row["status"];

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Master Huut</h1>
		<nav>
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="list-huut.php">Master Huut</a></li>
			<li class="breadcrumb-item active">Update Master Huut</li>
			</ol>
		</nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="list-huut.php"><i class="bi bi-arrow-left-circle-fill"></i></a> Update Master Huut</h5>

                    <form method="POST" action="proses.php">

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Berat (Kg)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="berat" value="<?= $Berat; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Harga (Rp)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="harga" value="<?= $Harga; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="stok" value="<?= $Stok; ?>" required>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="id_huut" value="<?= $IdHuut; ?>" required>

                        <div class="row-mb-3">
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-success" name="update_master_huut">Submit</button>
                            </div>
                        </div>

                    </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php

include('footer.php');
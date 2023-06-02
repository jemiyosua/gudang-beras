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

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Master Beras</h1>
		<nav>
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="list-beras.php">Master Beras</a></li>
			<li class="breadcrumb-item active">Tambah Master Beras</li>
			</ol>
		</nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="list-beras.php"><i class="bi bi-arrow-left-circle-fill"></i></a> Input Master Beras</h5>

                    <form method="POST" action="proses.php">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Beras</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="jenis">
                                <option>Pilih Jenis Beras</option>

                                <?php
                                
                                $q = "SELECT * FROM db_beras_jenis";
                                $sql = mysqli_query($conn, $q);
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $JenisBeras = $row["jenis"];

                                    ?>
                                    
                                    <option value="<?= $JenisBeras; ?>"><?= $JenisBeras; ?></option>

                                    <?php
                                }
                                
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori Beras</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="kategori">
                                    <option>Pilih Kategori Beras</option>
                                    <option value="Wangi">Wangi</option>
                                    <option value="Non Wangi">Non Wangi</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Karung Beras</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="karung" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Berat Beras</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="berat" value="25" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Harga (/Kg)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="harga" required>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-success" name="input_master_beras">Submit</button>
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
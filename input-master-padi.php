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

if (isset($_SESSION['ErrorMessage'])) {
    echo "<script>
    Swal.fire({
        allowEnterKey: false,
        allowOutsideClick: false,
        icon: 'error',
        title: 'Sorry :(',
        text: '".$_SESSION['ErrorMessage']."'
    }).then(function() {
        window.location.href='input-master-padi.php';
    });
    </script>";
    unset($_SESSION['ErrorMessage']);
}

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Master Padi</h1>
		<nav>
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="list-padi.php">Master Padi</a></li>
			<li class="breadcrumb-item active">Tambah Master Padi</li>
			</ol>
		</nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="list-padi.php"><i class="bi bi-arrow-left-circle-fill"></i></a> Input Master Padi</h5>

                    <form method="POST" action="proses.php">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Padi</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="jenis">
                                <option>Pilih Jenis Padi</option>

                                <?php  
                                
                                $q = "SELECT * FROM db_beras_jenis";
                                $sql = mysqli_query($conn, $q);
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $JenisPadi = $row["jenis"];

                                    ?>
                                    
                                    <option value="<?= $JenisPadi; ?>"><?= $JenisPadi; ?></option>

                                    <?php
                                }
                                
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Karung Padi</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="karung" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Berat Padi (Kg)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="berat" required>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-success" name="input_master_padi">Submit</button>
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
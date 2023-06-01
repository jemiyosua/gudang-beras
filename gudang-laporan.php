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

$_SESSION['page'] = "list-huut";

if (isset($_SESSION['SuccessMessage'])) {
    echo "<script>
    Swal.fire({
        allowEnterKey: false,
        allowOutsideClick: false,
        icon: 'success',
        title: 'Good Job :)',
        text: '".$_SESSION['SuccessMessage']."'
    }).then(function() {
        window.location.href='list-huut.php';
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
        window.location.href='list-huut.php';
    });
    </script>";
    unset($_SESSION['ErrorMessage']);
}

if (isset($_GET['search'])) {
    $Search = $_GET['search'];
}

$q = "SELECT COUNT(1) AS CNT FROM db_huut";
$sql = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($sql);
$jumlah = $row['CNT'];

$row = mysqli_fetch_assoc($sql);
$jumlahHistory = $row['CNT'];

// query get count beras
$qHuut = "SELECT SUM(karung) AS cnt_beras FROM db_beras WHERE status = 1";
$sql = mysqli_query($conn, $qHuut);
$row = mysqli_fetch_assoc($sql);
$CountBeras = $row['cnt_beras'];

// query get count padi
$qHuut = "SELECT SUM(karung) AS cnt_padi FROM db_padi WHERE status = 1";
$sql = mysqli_query($conn, $qHuut);
$row = mysqli_fetch_assoc($sql);
$CountPadi = $row['cnt_padi'];

// query get count huut
$qHuut = "SELECT SUM(karung) AS cnt_huut FROM db_huut WHERE status = 1";
$sql = mysqli_query($conn, $qHuut);
$row = mysqli_fetch_assoc($sql);
$CountHuut = $row['cnt_huut'];

?>

<main id="main" class="main">

	<div class="pagetitle">
        <h1>Gudang Laporan</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Gudang Laporan</li>
            </ol>
        </nav>
	</div>

    <section class="section dashboard">
		<div class="row">
			
			<div class="col-lg-12">
				<div class="row">

					<div class="col-xxl-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">BERAS <span>| Total Karung</span></h5>
								<div class="d-flex align-items-center mb-3">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<img src="assets/img/rice.png" style="width: 40px;">
									</div>
									<div class="ps-3">
										<h6><?= $CountBeras ?> Karung</h6>
									</div>
								</div>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="export-pdf.php?id=beras" type="button" class="btn btn-primary"><i class="bi bi-file-earmark-pdf-fill"></i> Download Report</a>
                                </div>
							</div>
						</div>
					</div>

                    <div class="col-xxl-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">PADI <span>| Total Karung</span></h5>
								<div class="d-flex align-items-center mb-3">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <img src="assets/img/padi.png" style="width: 40px;">
									</div>
									<div class="ps-3">
										<h6><?= $CountPadi ?> Karung</h6>
									</div>
								</div>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="export-pdf.php?id=padi" type="button" class="btn btn-primary"><i class="bi bi-file-earmark-pdf-fill"></i> Download Report</a>
                                </div>
							</div>
						</div>
					</div>

                    <div class="col-xxl-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">HUUT <span>| Total Karung</span></h5>
								<div class="d-flex align-items-center mb-3">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <img src="assets/img/brown-rice.png" style="width: 40px;">
									</div>
									<div class="ps-3">
										<h6><?= $CountHuut ?> Karung</h6>
									</div>
								</div>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="export-pdf.php?id=huut" type="button" class="btn btn-primary"><i class="bi bi-file-earmark-pdf-fill"></i> Download Report</a>
                                </div>
							</div>
						</div>
					</div>

				</div>
            </div>

		</div>
	</section>

</main>

<script language="JavaScript" type="text/javascript">
    function checkDelete() {
        return confirm('Are you sure?');
    }
</script>

<?php

include('footer.php');
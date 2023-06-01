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

if (isset($_POST["review"])) {
    $IdTransaksi = $_POST["id_transaksi"];
    $KategoriPembelian = $_POST["kategori_pembelian"];
    $JenisPembelian = $_POST["jenis_pembelian"];
    $q = "SELECT harga FROM db_beras_harga_kilogram WHERE jenis = '$JenisPembelian'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);
    $Harga = $_POST['harga'];
    $HargaHidden = $_POST['harga_hidden'];
    $JumlahPembelian = $_POST["jumlah_pembelian"];
    $Total = $_POST["total"];
    $TotalHidden = $_POST["total_hidden"];
    $Pembeli = $_POST["nama_pembeli"];
    $TotalBayar = $_POST["total_bayar"];
}

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Review Transaksi</h1>
		<nav>
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="list-transaksi.php">Transaksi</a></li>
			<li class="breadcrumb-item"><a href="input-transaksi.php">Tambah Transaksi</a></li>
			<li class="breadcrumb-item active">Review Transaksi</li>
			</ol>
		</nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review Transaksi</h5>

                        <ul class="list-group">
                            <li class="list-group-item active" aria-current="true">
                                <text style="font-weight:bold"><?= $Pembeli ?></text>
                            </li>
                            <li class="list-group-item">ID Transaksi : <text style="font-weight:bold"><?= $IdTransaksi ?></text></li>
                            <li class="list-group-item">Kategori Pembelian : <text style="font-weight:bold"><?= $KategoriPembelian ?></text></li>
                            <li class="list-group-item">Jenis Pembelian (Kg) :<text style="font-weight:bold"><?= $JenisPembelian ?></text></li>
                            <li class="list-group-item">Harga /Kg : <text style="font-weight:bold">Rp <?= $Harga ?></text></li>
                            <li class="list-group-item">Jumlah Pembelian : <text style="font-weight:bold"><?= $JumlahPembelian ?></text></li>
                            <li class="list-group-item">Total Pembayaran : <text style="font-weight:bold">Rp <?= $Total ?></text></li>
                        </ul>

                    </div>
                </div>
                
                <div class="row-mb-3">
                    <div class="d-flex flex-row-reverse">
                        <a href="proses.php?function=input_transaksi&id_transaksi=<?=$IdTransaksi?>&kategori=<?=$KategoriPembelian?>&jenis=<?=$JenisPembelian?>&harga=<?=$HargaHidden?>&jumlah=<?=$JumlahPembelian?>&total=<?=$TotalHidden?>&pembeli=<?=$Pembeli?>" type="submit" class="btn btn-success" name="input_transaksi">Next</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php

include('footer.php');
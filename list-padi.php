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
        window.location.href='list-padi.php';
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
        window.location.href='list-padi.php';
    });
    </script>";
    unset($_SESSION['ErrorMessage']);
}

if (isset($_GET['search'])) {
    $Search = $_GET['search'];
}

$q = "SELECT COUNT(1) AS CNT FROM db_padi";
$sql = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($sql);
$jumlah = $row['CNT'];

if (isset($_GET['search_history'])) {
    $cari = $_GET['search_history'];

    if ($cari == "") {
        $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI'";
        $sql = mysqli_query($conn, $q);
    } else {
        $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI' AND jenis LIKE '%" . $cari . "%'";
        $sql = mysqli_query($conn, $q);
    }
} else {
    $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI'";
    $sql = mysqli_query($conn, $q);
}

$row = mysqli_fetch_assoc($sql);
$jumlahHistory = $row['CNT'];

// query get count padi
$qPadi = "SELECT SUM(karung) AS cnt_padi FROM db_padi WHERE status = 1";
$sql = mysqli_query($conn, $qPadi);
$row = mysqli_fetch_assoc($sql);
$CountPadi = $row['cnt_padi'];

?>

<main id="main" class="main">

	<div class="pagetitle">
        <h1>Master Padi</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Master Padi</li>
            </ol>
        </nav>
	</div>

    <section class="section dashboard">
		<div class="row">
			
			<div class="col-lg-12">
				<div class="row">

					<div class="col-xxl-3 col-md-6">
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
                                <?php
                                
                                if ($_SESSION['role'] == "admin") {
                                    ?>
                                    <hr>
                                    <div class="d-grid gap-2">
                                        <a href="input-master-padi.php" type="button" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Stok Padi</a>
                                    </div>
                                    <?php
                                }
                                
                                ?>
							</div>
						</div>
					</div>

                    <div class="col-xxl-9 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">List Master Padi</h5>
                                </div>

                                <hr>

                                <table class="table mt-3">
                                    <thead>
                                        <tr style="background-color:#F9E79F">
                                            <th scope="col">NO</th>
                                            <th scope="col">JENIS PADI</th>
                                            <th scope="col">JUMLAH KARUNG</th>
                                            <th scope="col">BERAT (Kg)</th>
                                            <?php
                                            
                                            if ($_SESSION['role'] == "admin") {
                                                ?>
                                                 <th scope="col">ACTION</th>
                                                <?php
                                            }
                                            
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                        $limit = 5; // Jumlah data per halamannya

                                        // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                                        $limit_start = ($page - 1) * $limit;

                                        $No = $limit_start + 1;

                                        if (isset($_GET['search'])) {
                                            $Search = $_GET['search'];

                                            if ($Search == "") {
                                                $q = "SELECT * FROM db_padi ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                            } else {
                                                $q = "SELECT * FROM db_padi WHERE jenis LIKE '%" . $Search . "%' ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                            }
                                        } else {
                                            $q = "SELECT * FROM db_padi ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                        }

                                        $sql = mysqli_query($conn, $q);
                                        if ($jumlah > 0) {
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                $Id = $row["id"];
                                                $JenisPadi = $row["jenis"];
                                                $KarungPadi = $row["karung"];
                                                $KeteranganHabis = "";
                                                $ColorText = "black";
                                                if ($KarungPadi == 0) {
                                                    $KeteranganHabis = '<span class="badge rounded-pill text-bg-warning">Kosong</span>';
                                                    $ColorText = "red";
                                                }
                                                $BeratPadi = $row["berat"];
            
                                                ?>
                                                
                                                <tr>
                                                    <th scope="row"><?= $No; ?></th>
                                                    <td style="font-weight:bold"><?= $JenisPadi . " " . $KeteranganHabis ?></td>
                                                    <td style="color:<?= $ColorText ?>"><?= $KarungPadi ?></td>
                                                    <td style="font-weight:bold"><?= $BeratPadi ?></td>
                                                    <?php
                                                    
                                                    if ($_SESSION['role'] == "admin") {
                                                        ?>
                                                        <td colspan=2>
                                                            <a href="update-master-padi.php?id=<?= $Id ?>"><span class="badge rounded-pill text-bg-info">Edit Data</span></a>
                                                            <a href="proses.php?function=delete-master-padi&id=<?= $Id ?>" onclick="return checkDelete()"><span class="badge rounded-pill text-bg-danger">Delete Data</span></a>
                                                        </td>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </tr>
            
                                                <?php
                                                
                                                $No++;
            
                                            }
                                        } else {
                                            ?>
                                            
                                            <tr>
                                                <td colspan=7>
                                                    <div class="alert alert-danger" role="alert" style="text-align:center;font-weight:bold">
                                                        Data Tidak Ditemukan
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        

                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <nav aria-label="Page navigation example" style="padding-top: 10px;padding-left: 15px">
                                <ul class="pagination">
                                    <!-- LINK FIRST AND PREV -->
                                    <?php
                                    
                                    if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV
                                        echo "<li class='page-item disbled'><a class='page-link' href='#'>First</a></li>";
                                        echo "<li class='page-item disbled'><a class='page-link' href='#'>&laquo;</a></li>";
                                    } else { // Jika page bukan page ke 1
                                        $link_prev = ($page > 1) ? $page - 1 : 1;
                                        echo "<li class='page-item'><a class='page-link' href='list-padi.php?page=1'>First</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='list-padi.php?page=$link_prev'>&laquo;</a></li>";
                                    }
                                

                                    if (isset($_GET['search'])) {
                                        $cari = $_GET['search'];

                                        if ($cari == "") {
                                            $q = "SELECT COUNT(1) AS CNT FROM db_padi";
                                            $sql = mysqli_query($conn, $q);
                                        } else {
                                            $q = "SELECT COUNT(1) AS CNT FROM db_padi WHERE jenis LIKE '%" . $cari . "%'";
                                            $sql = mysqli_query($conn, $q);
                                        }
                                    } else {
                                        $q = "SELECT COUNT(1) AS CNT FROM db_padi";
                                        $sql = mysqli_query($conn, $q);
                                    }
                                    // Buat query untuk menghitung semua jumlah data
                                    // $q = "SELECT COUNT(*) AS CNT FROM TAGIHAN WHERE ID_USER = '$ID_USER' AND FLAG_HAPUS = 0 ";
                                    $sql = mysqli_query($conn, $q);
                                    $row = mysqli_fetch_assoc($sql);
                                    $jumlah = $row['CNT'];

                                    $jumlah_page = ceil($jumlah / $limit); // Hitung jumlah halamannya
                                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                                    $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
                                    $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                                    for ($i = $start_number; $i <= $end_number; $i++) {

                                        $link_active = ($page == $i) ? ' class="page-item active"' : '';

                                        echo "<li$link_active><a class='page-link' href='list-padi.php?page=$i'>$i</a></li>";
                                        
                                    }

                                    // LINK NEXT AND LAST

                                    // Jika page sama dengan jumlah page, maka disable link NEXT nya
                                    // Artinya page tersebut adalah page terakhir 
                                    if ($page == $jumlah_page) { // Jika page terakhir
                                        echo "<li class='page-item disbled'><a class='page-link' href='#'>&raquo;</a></li>";
                                        echo "<li class='page-item disbled'><a class='page-link' href='#'>Last</a></li>";
                                    } else { // Jika Bukan page terakhir
                                        $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

                                        echo "<li class='page-item'><a class='page-link' href='list-padi.php?page=$link_next'>&raquo;</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='list-padi.php?page=$jumlah_page'>Last</a></li>";
                                    }

                                    ?>
                                </ul>
                            </nav>     

                        </div>
                    </div>

				</div>
            </div>

		</div>
	</section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">History Master Padi</h5>
                            <div class="mt-4">
                                <div class="d-flex flex-row-reverse">
                                    <div class="input-group">
                                        <form>
                                            <input type="text" class="form-control" value="<?= $Search ?>" placeholder="Search ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="search_history">
                                            <!-- <div class="input-group mb-3">
                                                <input type="text" class="form-control" value="<?= $Search ?>" placeholder="Search ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="search_history">
                                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Clear Search</button>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <table class="table mt-3">
                            <thead>
                                <tr style="background-color:#F9E79F;font-weight:bold">
                                    <th scope="col">NO</th>
                                    <th scope="col">JENIS PADI</th>
                                    <th scope="col">JUMLAH KARUNG</th>
                                    <th scope="col">BERAT (Kg)</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">JAM</th>
                                    <th scope="col">LOG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $page = (isset($_GET['page_history'])) ? $_GET['page_history'] : 1;

                                $limit = 5; // Jumlah data per halamannya

                                // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                                $limit_start = ($page - 1) * $limit;

                                $No = $limit_start + 1;

                                if (isset($_GET['search_history'])) {
                                    $Search = $_GET['search_history'];

                                    if ($Search == "") {
                                        $q = "SELECT * FROM db_log_history WHERE kategori = 'PADI' ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                    } else {
                                        $q = "SELECT * FROM db_log_history WHERE kategori = 'PADI' AND jenis LIKE '%" . $Search . "%' ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                    }
                                } else {
                                    $q = "SELECT * FROM db_log_history WHERE kategori = 'PADI' ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                }
                                
                                $sql = mysqli_query($conn, $q); 
                                if ($jumlahHistory > 0) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $Id = $row["id"];
                                        $JenisPadi = $row["jenis"];
                                        $KarungPadi = $row["karung"];
                                        $BeratPadi = $row["berat"];
                                        $TanggalInput = $row["tgl_input"];
                                        $TanggalInputExplode = explode(" ", $TanggalInput);
                                        $Tanggal = $TanggalInputExplode[0];
                                        $Jam = $TanggalInputExplode[1];
                                        $TanggalExplode = explode("-", $Tanggal);
                                        $TanggalFix = $TanggalExplode[2];
                                        $BulanFix = $TanggalExplode[1];
                                        $TahunFix = $TanggalExplode[0];
                                        if ($BulanFix == "01") {
                                            $Month = "Januari";
                                        } else if ($BulanFix == "02") {
                                            $Month = "Februari";
                                        } else if ($BulanFix == "03") {
                                            $Month = "Maret";
                                        } else if ($BulanFix == "04") {
                                            $Month = "April";
                                        } else if ($BulanFix == "05") {
                                            $Month = "Mei";
                                        } else if ($BulanFix == "06") {
                                            $Month = "Juni";
                                        } else if ($BulanFix == "07") {
                                            $Month = "Juli";
                                        } else if ($BulanFix == "08") {
                                            $Month = "Agustus";
                                        } else if ($BulanFix == "09") {
                                            $Month = "September";
                                        } else if ($BulanFix == "10") {
                                            $Month = "Oktober";
                                        } else if ($BulanFix == "11") {
                                            $Month = "November";
                                        } else {
                                            $Month = "Desember";
                                        }
                                        $Date = $TanggalFix . " " . $Month . " " . $TahunFix;
                                        $Log = $row['log'];
                                        $vLog = "";
                                        if ($Log == "INSERT") {
                                            $vLog = '<span class="badge rounded-pill text-bg-success">TAMBAH STOK</span>';
                                        } else if ($Log == "UPDATE") {
                                            $vLog = '<span class="badge rounded-pill text-bg-warning">UPDATE STOK</span>';
                                        } else if ($Log == "DELETE") {
                                            $vLog = '<span class="badge rounded-pill text-bg-danger">HAPUS STOK</span>';
                                        } else {
                                            $vLog = '-';
                                        }
                                        // $State = "";
                                        // if ($No == 1) {
                                        //     $State = '<span class="badge rounded-pill text-bg-danger">New</span>';
                                        // }
    
                                        ?>
                                        
                                        <tr>
                                            <th scope="row"><?= $No; ?></th>
                                            <td style="font-weight:bold"><?= $JenisPadi ?></td>
                                            <td style="color:<?= $ColorText ?>"><?= $KarungPadi ?></td>
                                            <td style="font-weight:bold"><?= $BeratPadi ?></td>
                                            <td><?= $Date ?></td>
                                            <td><?= $Jam ?></td>
                                            <td><?= $vLog ?></td>
                                        </tr>
    
                                        <?php
                                        
                                        $No++;
    
                                    }
                                } else {
                                    ?>
                                    
                                    <tr>
                                        <td colspan=7>
                                            <div class="alert alert-danger" role="alert" style="text-align:center;font-weight:bold">
                                                History Tidak Ditemukan
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                

                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <h7 class="card-title">Total Data : <?= $jumlahHistory ?></h7>
                    </div>

                    <nav aria-label="Page navigation example" style="padding-top: 10px;padding-left: 15px">
                        <ul class="pagination">
                            <!-- LINK FIRST AND PREV -->
                            <?php
                            
                            if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>First</a></li>";
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>&laquo;</a></li>";
                            } else { // Jika page bukan page ke 1
                                $link_prev = ($page > 1) ? $page - 1 : 1;
                                echo "<li class='page-item'><a class='page-link' href='list-padi.php?page_history=1'>First</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='list-padi.php?page_history=$link_prev'>&laquo;</a></li>";
                            }
                           

                            if (isset($_GET['search_history'])) {
                                $cari = $_GET['search_history'];

                                if ($cari == "") {
                                    $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI'";
                                    $sql = mysqli_query($conn, $q);
                                } else {
                                    $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI' AND jenis LIKE '%" . $cari . "%'";
                                    $sql = mysqli_query($conn, $q);
                                }
                            } else {
                                $q = "SELECT COUNT(1) AS CNT FROM db_log_history WHERE kategori = 'PADI'";
                                $sql = mysqli_query($conn, $q);
                            }
                            // Buat query untuk menghitung semua jumlah data
                            // $q = "SELECT COUNT(*) AS CNT FROM TAGIHAN WHERE ID_USER = '$ID_USER' AND FLAG_HAPUS = 0 ";
                            $sql = mysqli_query($conn, $q);
                            $row = mysqli_fetch_assoc($sql);
                            $jumlah = $row['CNT'];

                            $jumlah_page = ceil($jumlah / $limit); // Hitung jumlah halamannya
                            $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
                            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                            for ($i = $start_number; $i <= $end_number; $i++) {

                                $link_active = ($page == $i) ? ' class="page-item active"' : '';

                                if (isset($_GET['search_history'])) {
                                    $cari = $_GET['search_history'];
                                    if ($cari != "") {
                                        echo "<li$link_active><a class='page-link' href='list-padi.php?page_history=$i&search_history=$cari'>$i</a></li>";
                                    } else {
                                        echo "<li$link_active><a class='page-link' href='list-padi.php?page_history=$i'>$i</a></li>";
                                    }
                                } else {
                                    echo "<li$link_active><a class='page-link' href='list-padi.php?page_history=$i'>$i</a></li>";
                                }
                                
                            }

                            // LINK NEXT AND LAST

                            // Jika page sama dengan jumlah page, maka disable link NEXT nya
                            // Artinya page tersebut adalah page terakhir 
                            if ($page == $jumlah_page) { // Jika page terakhir
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>&raquo;</a></li>";
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>Last</a></li>";
                            } else { // Jika Bukan page terakhir
                                $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

                                echo "<li class='page-item'><a class='page-link' href='list-padi.php?page_history=$link_next'>&raquo;</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='list-padi.php?page_history=$jumlah_page'>Last</a></li>";
                            }

                            ?>
                        </ul>
                    </nav>                    

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
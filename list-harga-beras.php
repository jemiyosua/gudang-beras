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
        window.location.href='list-beras.php';
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
        window.location.href='list-beras.php';
    });
    </script>";
    unset($_SESSION['ErrorMessage']);
}

if (isset($_GET['search'])) {
    $Search = $_GET['search'];
}

$q = "SELECT COUNT(1) AS CNT FROM db_beras_harga_kilogram";
$sql = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($sql);
$jumlah = $row['CNT'];

?>

<main id="main" class="main">

	<div class="pagetitle">
        <h1>Harga Beras</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">List Harga Beras</li>
            </ol>
        </nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">List Harga Beras</h5>
                            <div class="mt-4">
                                <div class="d-flex flex-row-reverse">
                                    <div class="input-group">
                                        <form>
                                            <input type="text" class="form-control" value="<?= $Search ?>" placeholder="Search ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                                        </form>
                                    </div>
                                    <div class="input-group">
                                        <div>
                                            <a href="404.php" type="button" class="btn btn-primary">Tambah Data</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Beras</th>
                                    <th scope="col">Harga Beras / Kg</th>
                                    <th scope="col">Tanggal Input</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                $limit = 10; // Jumlah data per halamannya

                                // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                                $limit_start = ($page - 1) * $limit;

                                $No = $limit_start + 1;

                                if (isset($_GET['search'])) {
                                    $Search = $_GET['search'];

                                    if ($Search == "") {
                                        $q = "SELECT * FROM db_beras_harga_kilogram ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                    } else {
                                        $q = "SELECT * FROM db_beras_harga_kilogram WHERE jenis LIKE '%" . $Search . "%' ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                    }
                                } else {
                                    $q = "SELECT * FROM db_beras_harga_kilogram ORDER BY tgl_input DESC LIMIT $limit_start, $limit";
                                }
                                
                                $sql = mysqli_query($conn, $q);
                                if ($jumlah > 0) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $Id = $row["id"];
                                        $JenisBeras = $row["jenis"];
                                        $HargaBeras = $row["harga"];
                                        $TanggalInput = $row["tgl_input"];
    
                                        ?>
                                        
                                        <tr>
                                            <th scope="row"><?= $No; ?></th>
                                            <td><?= $JenisBeras ?></td>
                                            <td>Rp <?= number_format($HargaBeras) ?></td>
                                            <td><?= $TanggalInput ?></td>
                                            <td colspan=2>
                                                <a href="update-master-beras.php?id=<?= $Id ?>"><span class="badge rounded-pill text-bg-warning">Edit Data</span></a>
                                                <a href="proses.php?function=delete-master-beras&id=<?= $Id ?>" onclick="return checkDelete()"><span class="badge rounded-pill text-bg-danger">Delete Data</span></a>
                                            </td>
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
                                echo "<li class='page-item'><a class='page-link' href='list-beras.php?page=1'>First</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='list-beras.php?page=$link_prev'>&laquo;</a></li>";
                            }

                            if (isset($_GET['cari'])) {
                                $cari = $_GET['cari'];

                                if ($cari == "") {
                                    $q = "SELECT COUNT(1) AS CNT FROM db_beras_harga_kilogram";
                                    $sql = mysqli_query($conn, $q);
                                } else {
                                    $q = "SELECT COUNT(1) AS CNT FROM db_beras_harga_kilogram WHERE jenis LIKE '%" . $cari . "%'";
                                    $sql = mysqli_query($conn, $q);
                                }
                            } else {
                                $q = "SELECT COUNT(1) AS CNT FROM db_beras_harga_kilogram";
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

                                echo "<li$link_active><a class='page-link' href='list-beras.php?page=$i'>$i</a></li>";
                            }

                            // LINK NEXT AND LAST

                            // Jika page sama dengan jumlah page, maka disable link NEXT nya
                            // Artinya page tersebut adalah page terakhir 
                            if ($page == $jumlah_page) { // Jika page terakhir
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>&raquo;</a></li>";
                                echo "<li class='page-item disbled'><a class='page-link' href='#'>Last</a></li>";
                            } else { // Jika Bukan page terakhir
                                $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

                                echo "<li class='page-item'><a class='page-link' href='list-beras.php?page=$link_next'>&raquo;</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='list-beras.php?page=$jumlah_page'>Last</a></li>";
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
<?php

require_once 'koneksi.php';

session_start();

if (isset($_GET["function"])) {
    $Function = $_GET["function"];
}

if (isset($_POST['login'])) {

    $UserName = $_POST['username']; // get value username
    $Password = md5($_POST['password']); // get value password

    $q = "SELECT COUNT(*) AS cnt_login, role FROM db_login WHERE username = '$UserName' AND password = '$Password'"; // query get data dari tabel db_login berdasarkan username dan password yang sudah kita input
    $sql = mysqli_query($conn, $q); // menjalankan query select
    $row = mysqli_fetch_assoc($sql); // mendapatkan data balikan dari query

    $CountLogin = $row['cnt_login']; // menampung data cnt_login dari query di dalam variabel
    $Role = $row['role'];

    if ($CountLogin > 0) { // sukses
        $_SESSION['role'] = $Role; // set session role
        header('location:list-beras.php'); // mengarahkan ke page list-beras.php
        exit;
    } else { // gagal
        $_SESSION['ErrorMessage'] = "Your Username or Password Are Wrong. Please Try Again."; // set session error message
        header('location:index.php'); // mengarahkan ke page index.php
        exit;
    }

} else if (isset($_POST["input_master_beras"])) {

    $JenisBeras = $_POST['jenis']; // get value jenis beras
    $KategoriBeras = $_POST['kategori']; // get value kategori
    $KarungBeras = $_POST['karung']; // get value karung beras
    $BeratBeras = $_POST['berat']; // get value berat beras
    $HargaBeras = $_POST['harga']; // get value harga

    $q = "SELECT COUNT(*) AS cnt, karung FROM db_beras WHERE jenis = '$JenisBeras'"; // query get total data dan total karung beras dari tabel db_beras berdasarkan jenis beras
    $sql = mysqli_query($conn, $q); // menjalankan query select
    $row = mysqli_fetch_assoc($sql); // mendapatkan data balikan dari query
    $CountBeras = $row['cnt']; // menampung data cnt dari query di dalam variabel
    $JumlahKarung = $row['karung']; // menampung data jumlah karung beras dari query di dalam variabel

    $TotalSekarang = $JumlahKarung + $KarungBeras; // hitung total dari penjumlahan jumlah karung beras inputan dan karung beras saat ini

    if ($CountBeras > 0) { // kondisi jika jumlah data lebih dari 0
        $qUpdate = "UPDATE db_beras SET karung = '$TotalSekarang' WHERE jenis = '$JenisBeras'"; // query update ke tabel db_beras set karung beras berdasarkan jenis beras
        $sqlUpdate = mysqli_query($conn, $qUpdate); // menjalankan query update

        if ($sqlUpdate) {
            $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('BERAS', '$JenisBeras', '$KarungBeras', '$BeratBeras', 'INSERT', NOW())";
            $sqlLog = mysqli_query($conn, $qLog);
            if ($sqlLog) {
                $_SESSION['SuccessMessage'] = "Data Berhasil Ditembahkan";
                header('location:list-beras.php');
                exit;
            } else {
                $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
                header('location:list-beras.php');
                exit;
            }
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
            header('location:list-beras.php');
            exit;
        }

    } else {
       
        $qInsert = "INSERT INTO db_beras (jenis, kategori, karung, berat, status, harga, tgl_input) VALUES ('$JenisBeras', '$KategoriBeras', '$KarungBeras', '$BeratBeras', '1', '$HargaBeras', NOW())";
        $sqlInsert = mysqli_query($conn, $qInsert);

        if ($sqlInsert) {
            $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('BERAS', '$JenisBeras', '$KarungBeras', '$BeratBeras', 'INSERT', NOW())";
            $sqlLog = mysqli_query($conn, $qLog);
            if ($sqlLog) {
                $_SESSION['SuccessMessage'] = "Data Berhasil Ditembahkan";
                header('location:list-beras.php');
                exit;
            } else {
                $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
                header('location:list-beras.php');
                exit;
            }
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
            header('location:list-beras.php');
            exit;
        }
    }

} else if (isset($_POST["update_master_beras"])) {

    $IdBeras = $_POST['id_beras'];
    $JenisBeras = $_POST['jenis'];
    $KarungBeras = $_POST['karung'];
    $Berat = $_POST['berat'];
    $Harga = $_POST['harga'];

    $q = "UPDATE db_beras SET jenis = '$JenisBeras', karung = '$KarungBeras', berat = '$Berat', harga = '$Harga' WHERE id = '$IdBeras'";
    $sql = mysqli_query($conn, $q);

    if ($sql) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('BERAS', '$JenisBeras', '$KarungBeras', '$Berat', 'UPDATE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);

        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Diupdate";
            header('location:list-beras.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
            header('location:list-beras.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
        header('location:list-beras.php');
        exit;
    }

} else if ($Function == "delete-master-beras") {

    $Id = $_GET["id"];

    $q = "SELECT * FROM db_beras WHERE id = '$Id'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);

    $JenisBeras = $row['jenis'];
    $KarungBeras = $row['karung'];
    $Berat = $row['berat'];    

    $qDelete = "DELETE FROM db_beras WHERE id = '$Id'";
    $sqlDelete = mysqli_query($conn, $qDelete);

    if ($sqlDelete) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('BERAS', '$JenisBeras', '$KarungBeras', '$Berat', 'DELETE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);
        
        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Dihapus";
            header('location:list-beras.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
            header('location:list-beras.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
        header('location:list-beras.php');
        exit;
    }
    
} else if (isset($_POST["input_master_padi"])) {

    $JenisPadi = $_POST['jenis']; 
    $KarungPadi = $_POST['karung'];
    $BeratPadi = $_POST['berat'];

    $q = "SELECT COUNT(*) AS CNT FROM db_padi WHERE jenis = '$JenisPadi' AND berat = '$BeratPadi'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);
    $CountPadi = $row['CNT'];

    if ($CountPadi > 0) {
        $_SESSION['ErrorMessage'] = "Data Sudah Ada";
        header('location:input-master-padi.php');
        exit;
    } else {
        $q = "INSERT INTO db_padi (jenis, karung, berat, status, tgl_input) VALUES ('$JenisPadi', '$KarungPadi', '$BeratPadi', 1, NOW())";
        $sql = mysqli_query($conn, $q);
    
        if ($sql) {
            $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('PADI', '$JenisPadi', '$KarungPadi', '$BeratPadi', 'INSERT', NOW())";
            $sqlLog = mysqli_query($conn, $qLog);
    
            if ($sqlLog) {
                $_SESSION['SuccessMessage'] = "Data Berhasil Ditembahkan";
                header('location:list-padi.php');
                exit;
            } else {
                $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
                header('location:list-padi.php');
                exit;
            }
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
            header('location:list-padi.php');
            exit;
        }
    
    }

} else if (isset($_POST["update_master_padi"])) {

    $IdPadi = $_POST['id_padi'];
    $Jenis = $_POST['jenis'];
    $Karung = $_POST['karung'];
    $Berat = $_POST['berat'];

    $q = "UPDATE db_padi SET jenis = '$Jenis', karung = '$Karung', berat = '$Berat' WHERE id = '$IdPadi'";
    $sql = mysqli_query($conn, $q);

    if ($sql) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('PADI', '$Jenis', '$Karung', '$Berat', 'UPDATE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);

        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Diupdate";
            header('location:list-padi.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
            header('location:list-padi.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
        header('location:list-padi.php');
        exit;
    }

} else if ($Function == "delete-master-padi") {

    $Id = $_GET["id"];

    $q = "SELECT * FROM db_padi WHERE id = '$Id'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);

    $Jenis = $row['jenis'];
    $Karung = $row['karung'];
    $Berat = $row['berat'];    

    $qDelete = "DELETE FROM db_padi WHERE id = '$Id'";
    $sqlDelete = mysqli_query($conn, $qDelete);

    if ($sqlDelete) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('PADI', '$Jenis', '$Karung', '$Berat', 'DELETE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);
        
        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Dihapus";
            header('location:list-padi.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
            header('location:list-padi.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
        header('location:list-padi.php');
        exit;
    }
   
} else if (isset($_POST["input_master_huut"])) {
    
    $Berat = $_POST['berat'];
    $Harga = $_POST['harga'];
    $Karung = $_POST['karung'];

    $q = "SELECT COUNT(*) AS cnt FROM db_huut WHERE berat = '$Berat'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);
    $CountHuut = $row['cnt'];

    if ($CountHuut > 0) {
        $_SESSION['ErrorMessage'] = "Data sudah ada";
        header('location:input-master-huut.php');
        exit;
    } else {
        $q = "INSERT INTO db_huut (berat, harga, karung, status, tgl_input) VALUES ('$Berat', '$Harga', '$Karung', 1, NOW())";
        $sql = mysqli_query($conn, $q);
    
        if ($sql) {
            $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('HUUT', '-', '$Karung', '$Berat', 'INSERT', NOW())";
            $sqlLog = mysqli_query($conn, $qLog);
    
            if ($sqlLog) {
                $_SESSION['SuccessMessage'] = "Data Berhasil Ditembahkan";
                header('location:list-huut.php');
                exit;
            } else {
                $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
                header('location:list-huut.php');
                exit;
            }
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Ditambahkan";
            header('location:list-huut.php');
            exit;
        }
    }

} else if (isset($_POST["update_master_huut"])) {

    $IdHuut = $_POST['id_huut'];
    $Berat = $_POST['berat'];
    $Harga = $_POST['harga'];
    $Karung = $_POST['karung'];

    $q = "UPDATE db_huut SET berat = '$Berat', harga = '$Harga', karung = '$Karung' WHERE id = '$IdHuut'";
    $sql = mysqli_query($conn, $q);

    if ($sql) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('HUUT', '-', '$Karung', '$Berat', 'UPDATE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);

        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Diupdate";
            header('location:list-huut.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
            header('location:list-huut.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Diupdate";
        header('location:list-huut.php');
        exit;
    }

} else if ($Function == "delete-master-huut") {

    $Id = $_GET["id"];

    $q = "SELECT * FROM db_huut WHERE id = '$Id'";
    $sql = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($sql);

    $Berat = $row['berat'];
    $Harga = $row['harga'];    
    $Karung = $row['karung'];    

    $qDelete = "DELETE FROM db_huut WHERE id = '$Id'";
    $sqlDelete = mysqli_query($conn, $qDelete);

    if ($sqlDelete) {
        $qLog = "INSERT INTO db_log_history (kategori, jenis, karung, berat, log, tgl_input) VALUES ('HUUT', '-', '$Karung', '$Berat', 'DELETE', NOW())";
        $sqlLog = mysqli_query($conn, $qLog);
        
        if ($sqlLog) {
            $_SESSION['SuccessMessage'] = "Data Berhasil Dihapus";
            header('location:list-huut.php');
            exit;
        } else {
            $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
            header('location:list-huut.php');
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Data Gagal Dihapus";
        header('location:list-huut.php');
        exit;
    }
   
} else if ($Function == "input_transaksi") {
    
    $IdTransaksi = $_GET["id_transaksi"];
    $Kategori = $_GET["kategori"];
    $Jenis = $_GET["jenis"];
    $Harga = $_GET["harga"];
    $Jumlah = $_GET["jumlah"];
    $Total = $_GET["total"];
    $Pembeli = $_GET["pembeli"];

    $q = "INSERT INTO db_transaksi (id_transaksi, jenis, kategori, harga, jumlah_beli, total, pembeli, total_bayar, tgl_input) VALUES ('$IdTransaksi', '$Jenis', '$Kategori', '$Harga', '$Jumlah', '$Total', '$Pembeli', '0', NOW())";
    // echo $q;exit;
    $sql = mysqli_query($conn, $q);
    
    if ($sql) {
        $_SESSION['SuccessMessage'] = "Transaksi Berhasil Dibuat";
        header('location:list-transaksi.php');
        exit;
    } else {
        $_SESSION['ErrorMessage'] = "Transaksi Gagal Dibuat";
        header('location:list-transaksi.php');
        exit;
    }
}

?>
<?php

// Include autoloader 
require_once('dompdf/autoload.inc.php');
require_once('koneksi.php');
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

if ($id == "beras") {
	$judul = '<h3>REPORT DATA PENGADAAN & STOK DATA BERAS</h2>';
	$sub_judul = '<h5>List Master Beras</h5>';
	$sub_judul2 = '<h5>History Master Beras</h5>';
	$db = 'db_beras';
	$kategori_history = 'BERAS';
} else if ($id == "padi") {
	$judul = '<h3>REPORT DATA PENGADAAN & STOK DATA PADI</h2>';
	$sub_judul = '<h5>List Master Padi</h5>';
	$sub_judul2 = '<h5>History Master Padi</h5>';
	$db = 'db_padi';
	$kategori_history = 'PADI';
} else if ($id == "huut") {
	$judul = '<h3>REPORT DATA PENGADAAN & STOK DATA HUUT</h2>';
	$sub_judul = '<h5>List Master Huut</h5>';
	$sub_judul2 = '<h5>History Master Huut</h5>';
	$db = 'db_huut';
	$kategori_history = 'HUUT';
}

$html = '
<html>

	<center>'.$judul.'</center>

	<center>'.$sub_judul.'</center>

	<table border="1px solid black" style="border-collapse: collapse;margin-left: auto;margin-right: auto;">

	';
	
	if ($id == "beras") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>JENIS BERAS</th>
			<th>KATEGORI BERAS</th>
			<th>JUMLAH KARUNG</th>
			<th>BERAT (Kg)</th>
			<th>HARGA (/Kg)</th>
		</tr>	
		';
	} else if ($id == "padi") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>JENIS PADI</th>
			<th>JUMLAH KARUNG</th>
			<th>BERAT (Kg)</th>
		</tr>	
		';
	} else if ($id == "huut") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>BERAT (Kg)</th>
			<th>JUMLAH KARUNG</th>
			<th>HARGA (/Kg)</th>
		</tr>
		';
	}

	$sql = "SELECT * FROM $db ORDER BY tgl_input DESC";
	$no = 0;
	$query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query)) {

		$no++;

		if ($id == "beras") {
			$jenis = $row["jenis"];
			$kategori = $row["kategori"];
			$karung = $row["karung"];
			$berat = $row["berat"];
			$harga = $row["harga"];
	
			$html .= '<tr>
				<td>' . $no . '</td>
				<td>' . $jenis . '</td>
				<td>' . $kategori . '</td>
				<td>' . $karung . '</td>
				<td>' . $berat . '</td>
				<td>Rp ' . number_format($harga) . '</td>
			</tr>';
		} else if ($id == "padi") {
			$jenis = $row["jenis"];
			$karung = $row["karung"];
			$berat = $row["berat"];
	
			$html .= '<tr>
				<td>' . $no . '</td>
				<td>' . $jenis . '</td>
				<td>' . $karung . '</td>
				<td>' . $berat . '</td>
			</tr>';
		} else if ($id == "huut") {
			$berat = $row["berat"];
			$harga = $row["harga"];
			$karung = $row["karung"];
	
			$html .= '<tr>
				<td>' . $no . '</td>
				<td>' . $berat . '</td>
				<td>' . $karung . '</td>
				<td>' . $harga . '</td>
			</tr>';
		}   
    }

$html .= '
	</table>
</html>';

$html .= '
<html>

	<center>'.$sub_judul2.'</center>

	<table border="1px solid black" style="border-collapse: collapse;margin-left: auto;margin-right: auto;">

	';

	if ($id == "beras") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>JENIS BERAS</th>
			<th>JUMLAH KARUNG</th>
			<th>BERAT (Kg)</th>
			<th>TANGGAL</th>
			<th>JAM</th>
			<th>LOG</th>
		</tr>
		';
	} else if ($id == "padi") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>JENIS PADI</th>
			<th>JUMLAH KARUNG</th>
			<th>BERAT (Kg)</th>
			<th>TANGGAL</th>
			<th>JAM</th>
			<th>LOG</th>
		</tr>
		';
	} else if ($id == "huut") {
		$html .= '
		<tr style="background-color:#F6DDCC;">
			<th>NO</th>
			<th>BERAT (Kg)</th>
			<th>JUMLAH KARUNG</th>
			<th>TANGGAL</th>
			<th>JAM</th>
			<th>LOG</th>
		</tr>
		';
	}

	$sql = "SELECT * FROM db_log_history WHERE kategori = '$kategori_history' ORDER BY tgl_input DESC";
	$no = 0;
	$query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query)) {

        $no++;

		if ($id == "beras") {
			$JenisBeras = $row["jenis"];
			$KarungBeras = $row["karung"];
			$BeratBeras = $row["berat"];
			$TanggalInput = $row["tgl_input"];
		} else if ($id == "padi") {
			$JenisPadi = $row["jenis"];
			$KarungPadi = $row["karung"];
			$BeratPadi = $row["berat"];
			$TanggalInput = $row["tgl_input"];
		} else if ($id == "huut") {
			$KarungHuut = $row["karung"];
			$BeratHuut = $row["berat"];
			$TanggalInput = $row["tgl_input"];
		}

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

		if ($id == "beras") {
			$html .= '<tr>
				<td>' . $no . '</td>
				<td>' . $JenisBeras . '</td>
				<td>' . $KarungBeras . '</td>
				<td>' . $BeratBeras . '</td>
				<td>' . $Date . '</td>
				<td>' . $Jam . '</td>
				<td>' . $vLog . '</td>
			</tr>';
		} else if ($id == "padi") {
			$html .= '<tr>
				<td>' . $no . '</td>
				<td>' . $JenisPadi . '</td>
				<td>' . $KarungPadi . '</td>
				<td>' . $BeratPadi . '</td>
				<td>' . $Date . '</td>
				<td>' . $Jam . '</td>
				<td>' . $vLog . '</td>
			</tr>';
		} else if ($id == "huut") {
			$html .= '<tr>
			<td>' . $no . '</td>
				<td>' . $KarungHuut . '</td>
				<td>' . $BeratHuut . '</td>
				<td>' . $Date . '</td>
				<td>' . $Jam . '</td>
				<td>' . $vLog . '</td>
			</tr>';
		}
		
        
    }

$html .= '
	</table>
</html>';

// Load HTML content 
$dompdf->loadHtml($html); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF to Browser 
$dompdf->stream();
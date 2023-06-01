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

function RandomString() {
    date_default_timezone_set('Asia/Jakarta');
    $Date = date("YmdHis");
    echo "TB-" . $Date;
}

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Transaksi</h1>
		<nav>
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="list-transaksi.php">Transaksi</a></li>
			<li class="breadcrumb-item active">Tambah Transaksi</li>
			</ol>
		</nav>
	</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="list-transaksi.php"><i class="bi bi-arrow-left-circle-fill"></i></a> Input Transaksi</h5>

                    <form method="POST" action="review.php">
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">ID Transaksi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id_transaksi" value="<?= RandomString() ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori Pembelian</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="kategori_pembelian" id="kategori_pembelian" onchange="getJenisPembelian()">
                                    <option>Pilih Kategori</option>
                                    <option value="Beras">Beras</option>
                                    <option value="Padi">Padi</option>
                                    <option value="Huut">Huut</option>
                                </select>
                            </div>
                        </div>

                        <div id='jenis'></div>

                        <div id='price'></div>

                        <div id='beli'></div>

                        <div id='total'></div>

                        <div id='harga'></div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Nama Pembeli</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pembeli" required>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-success" name="review">Next</button>
                            </div>
                        </div>

                    </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<script type="text/javascript">

function getJenisPembelian() {
    document.getElementById("jenis").innerHTML = "";
    var x = document.getElementById("kategori_pembelian").value;
    var newHTML = ""
    if (x == "Beras" || x == "Padi") {
        newHTML = `
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Jenis Pembelian</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" id="jenis_pembelian" name="jenis_pembelian" onchange="getPrice()">
                <option value="">Pilih Jenis Pembelian</option>

                <?php
                
                $q = "SELECT * FROM db_beras_jenis";
                $sql = mysqli_query($conn, $q);
                while($row = mysqli_fetch_assoc($sql)) {
                    $JenisBeras = $row["jenis"];

                    ?>
                    
                    <option value="<?= $JenisBeras; ?>"><?= $JenisBeras; ?></option>

                    <?php

                }
                
                ?>
                </select>
            </div>
        </div>
        `;
    }
    
    document.getElementById("price").innerHTML = "";
    document.getElementById('beli').innerHTML = "";
    document.getElementById('total').innerHTML = "";
    document.getElementById("jenis").innerHTML = newHTML;
}

function getPrice() {
    var kategori = document.getElementById('kategori_pembelian').value;
    var jenis = document.getElementById('jenis_pembelian').value;

    console.log("kategori : " + kategori)

    var newHTML = ""
    var newHTMLBeli = ""
    var price = ""
    if (kategori == "Beras") {
        if (jenis == "IR") {
            price = 10600
        } else if (jenis == "Kongga") {
            price = 10600
        } else if (jenis == "Ciherang") {
            price = 10600
        } else if (jenis == "Mawar") {
            price = 12000
        } else if (jenis == "Gaga") {
            price = 11000
        }

        vprice = price.toLocaleString()

        if (jenis != "") {
            newHTML = `
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Harga /Kg</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="harga" id="harga" value="`+vprice+`" readonly>
                    <input type="hidden" class="form-control" name="harga_hidden" id="harga_hidden" value="`+price+`" readonly>
                </div>
            </div>`

            newHTMLBeli = `
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Jumlah Pembelian (Kg)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="jumlah_pembelian" id="jumlah_pembelian" onkeyup="calculate()" required>
                </div>
            </div>`
        } else {
            newHTML = ``
            newHTMLBeli = ``
        }
    }
    
    document.getElementById("price").innerHTML = newHTML;
    document.getElementById("beli").innerHTML = newHTMLBeli;
    document.getElementById("total").innerHTML = "";

}

// getPengiriman() {
//     var newHTML = `
//     <div class="row mb-3">
//         <label class="col-sm-2 col-form-label">Pengiriman</label>
//         <div class="col-sm-10">
//             <select class="form-select" aria-label="Default select example" name="pengiriman" id="pengiriman" onchange="getBIayaKirim()">
//                 <option>Pilih Pengiriman</option>
//                 <option value="Diantar">Diantar</option>
//                 <option value="Ambil di tempat">Ambil di tempat</option>
//             </select>
//         </div>
//     </div>`
//     document.getElementById("kirim").innerHTML = newHTML;
// }

function calculate() {
    var harga = document.getElementById('harga_hidden').value;
    var jumlah_pembelian = document.getElementById('jumlah_pembelian').value;
    var total = jumlah_pembelian * harga
    var vtotal = total.toLocaleString()
    var newHTML = ""
    if (jumlah_pembelian != "") {
        newHTML = `
        <div class="row mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Total Harga</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="total" value="`+vtotal+`" required>
                <input type="hidden" class="form-control" name="total_hidden" value="`+total+`" required>
            </div>
        </div>`
    }

    document.getElementById("total").innerHTML = newHTML;
}

// function getBIayaKirim() {
//     var x = document.getElementById("pengiriman").value;
//     var total = document.getElementById("total").innerHTML = newHTML;
//     var newHTML = ""
//     var newHTMLAlamat = ""
//     if (total != "") {
//         if (x == "Diantar") {
//             newHTML = `
//             <div class="row mb-3">
//                 <label for="inputNumber" class="col-sm-2 col-form-label">Harga Pengiriman</label>
//                 <div class="col-sm-10">
//                     <input type="number" class="form-control" name="biaya_kirim" required>
//                 </div>
//             </div>
//             `;

//             newHTMLAlamat = `
//             <div class="row mb-3">
//                 <label for="inputNumber" class="col-sm-2 col-form-label">Harga Pengiriman</label>
//                 <div class="col-sm-10">
//                     <input type="number" class="form-control" name="alamat" required>
//                 </div>
//             </div>
//             `;
//         }
//     }
   
//     document.getElementById("harga").innerHTML = newHTML;
// }

</script>

<?php

include('footer.php');
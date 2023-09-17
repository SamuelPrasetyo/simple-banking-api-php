<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Saldo</title>
</head>

<body>
    <?php
        include '../include/header.php';
        include '../../koneksi.php';

        // Fungsi untuk cek saldo berdasarkan nomor rekening
        function cekSaldo($nomor_rekening) {
            global $conn;

            $query = "SELECT no_rekening, nama_nasabah, saldo FROM rekening WHERE no_rekening = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $nomor_rekening);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return null;
            }
        }

        // Ambil nomor rekening dari permintaan HTTP
        if (isset($_GET["nomor_rekening"])) {
            $nomor_rekening = $_GET["nomor_rekening"];
            $nasabah = cekSaldo($nomor_rekening);
            
            if ($nasabah !== null) {
                $nomor_rekening = $nasabah["no_rekening"];
                $nama = $nasabah["nama_nasabah"];
                $saldo = $nasabah["saldo"];
                echo '
                <h2 style="margin: 100px 0px 0px 120px;">Saldo Anda</h2>
                <div class="card" style="width: 18rem; margin: 10px 0px 0px 120px">
                    <div class="card-body">
                        <h5 class="card-title">' . $nomor_rekening . '</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">' . $nama . '</h6>
                        <p class="card-text">Rp. ' . $saldo . '</p>
                    </div>                    
                </div>
            ';
            } else {
                echo "Nomor rekening tidak ditemukan.";
            }
        } else {
            echo '<h5 style="margin: 100px 0px 0px 120px;">Masukkan nomor rekening untuk cek saldo.</h5>';
        }
    ?>



    

    <!-- <div class="card" style="width: 18rem; margin: 400px 0px 0px 120px">
        <div class="card-body">
            <h5 class="card-title">
                "Tampilkan Nomor Rekening"
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
                "Nama Nasabah"
            </h6>
            <p class="card-text">
                "Jumlah Saldo"
            </p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div> -->
</body>

</html>
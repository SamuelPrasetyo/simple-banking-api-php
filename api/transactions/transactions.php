<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php
    include '../include/header.php';
    include '../../koneksi.php';

    // Fungsi untuk cek transaksi berdasarkan nomor rekening
    function cekTransaksi($nomor_rekening)
    {
        global $conn;

        $query = "SELECT * FROM transfer WHERE no_rekpengirim = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nomor_rekening);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '
            <h2 style="margin: 100px 0px 0px 120px;">History Transaksi</h2>
            <table class="table table-hover table-striped" style="margin: 10px 120px 0px 120px; width: 85%;">
                <thead>
                    <tr>
                        <th>Rekening Penerima</th>
                        <th>Nama Nasabah</th>
                        <th>Jumlah Transfer</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>';
            
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr>
                        <td>' . $row["nama_penerima"] . '</td>
                        <td>' . $row["no_rekpenerima"] . '</td>
                        <td>Rp. ' . $row["jumlah_transfer"] . '</td>
                        <td>' . $row["time"] . '</td>
                    </tr>';
            }

            echo '
                </tbody>
            </table>';
        } else {
            echo '<h5 style="margin: 20px;">Tidak ada transaksi yang ditemukan untuk nomor rekening ini.</h5>';
        }
    }

    // Ambil nomor rekening dari permintaan HTTP
    if (isset($_GET["nomor_rekening"])) {
        $nomor_rekening = $_GET["nomor_rekening"];
        cekTransaksi($nomor_rekening);
    } else {
        echo '<h5 style="margin: 20px;">Masukkan nomor rekening untuk cek transaksi terakhir.</h5>';
    }
    ?>
</body>

</html>

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
        $query = "SELECT * FROM rekening WHERE no_rekening=1809094352934";
        $result = mysqli_query($conn, $query);
    ?>

    <h2 style="margin: 100px 0px 0px 120px;">Saldo Anda</h2>
    <?php
        while ($rec = mysqli_fetch_assoc($result)) {
            echo '
                <div class="card" style="width: 18rem; margin: 10px 0px 0px 120px">
                    <div class="card-body">
                        <h5 class="card-title">' . $rec['no_rekening'] . '</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">' . $rec['nama_nasabah'] . '</h6>
                        <p class="card-text">Rp. ' . $rec['saldo'] . '</p>
                    </div>                    
                </div>
            ';
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

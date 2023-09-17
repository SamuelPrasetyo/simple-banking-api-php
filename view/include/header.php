<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 50px;
            background-color: #f5f5f5;
            text-align: center;
            z-index: 999;
            /* Memberikan z-index tinggi agar header berada di atas elemen lain */
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px;
            text-align: center;
        }
    </style>
</head>

<body>


    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Navbar brand -->
                <a class="navbar-brand me-2" href="#">
                    <img src="../../assets/logo_fintech.png" height="50" alt="Logo Fintech Technology" loading="lazy" style="margin-top: -1px; margin-right: 30px;" />
                </a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>


                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../home/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cek_saldo/view_saldo.php">Cek Saldo</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Transaksi</a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../transfer/transfer.php">Transfer</a></li>
                                <li><a class="dropdown-item" href="#">History Transaksi</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    </header>
</body>

</html>
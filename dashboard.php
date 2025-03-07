<?php 
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Irfastore</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header, .footer {
            background-color: #C70039; /* Warna merah */
            color: white;
            padding: 4px 0; /* Ukuran header yang lebih kecil */
        }
        .header h1 a, .header ul li a {
            color: white;
            text-decoration: none;
        }
        .header ul {
            list-style: none;
            float: right;
            margin: 0;
            padding: 0;
        }
        .header ul li {
            display: inline;
            margin: 0 10px;
        }
        .header ul li a {
            padding: 8px 12px;
            transition: background 0.3s;
        }
        .header ul li a:hover {
            background-color: #a00027;
            border-radius: 5px;
        }
        .section {
            padding: 50px 0;
            flex: 1;
        }
        .box {
            background: white;
            padding: 40px 20px; /* Menambah jarak antara teks dan kontainer */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align:Left; /* Teks di tengah */
            margin-top: 20px; /* Menambah jarak dari atas */
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            background: #C70039; /* Warna merah */
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h4 {
            margin-bottom: 10px;
            font-size: 1.2em;
        }
        .card p {
            font-size: 1em;
        }
        .footer {
            margin-top: auto;
        }
        .footer small {
            display: block;
            text-align: center;
            padding: 10px 0;
            color: #ddd;
        }
    </style>
</head>
<body>
    <!-- header -->
    <header class="header">
        <div class="container">
            <h1><a href="dashboard.php">Irfastore</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="transaksi.php">Riwayat Transaksi</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Selamat Datang 
                    <?php 
                    if ($_SESSION['role'] == 'admin') {
                        echo 'Admin';
                    } else {
                        echo $_SESSION['a_global']->admin_name;
                    }
                    ?> 
                    di Toko Online
                </h4>
                <div class="grid-container">
                    <div class="card">
                        <h4>Jumlah Produk</h4>
                        <p>120</p>
                    </div>
                    <div class="card">
                        <h4>Jumlah Kategori</h4>
                        <p>15</p>
                    </div>
                    <div class="card">
                        <h4>Transaksi Hari Ini</h4>
                        <p>30</p>
                    </div>
                    <div class="card">
                        <h4>Total Penjualan Bulan Ini</h4>
                        <p>Rp 50,000,000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <small>Copyright &copy; 2024 - Irfastore.</small>
        </div>
    </footer>
</body>
</html>

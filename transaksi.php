<?php
include 'db.php';
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}

// Mengambil data admin
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi - Irfastore</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Irfastore</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- transaction history -->
    <div class="section">
        <div class="container">
            <h3>Riwayat Transaksi</h3>
            <button onclick="printPage()">Cetak</button>
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $query = "SELECT tb_transaksi.*, tb_product.product_name FROM tb_transaksi JOIN tb_product ON tb_transaksi.product_id = tb_product.product_id ORDER BY tb_transaksi.transaksi_id DESC";
                            $transaksi = mysqli_query($conn, $query);
                            if (!$transaksi) {
                                die('Query Error : '.mysqli_error($conn));
                            }
                            while ($row = mysqli_fetch_array($transaksi)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['alamat'] ?></td>
                            <td><?php echo $row['telepon'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td><?php echo $row['jumlah'] ?></td>
                            <td>Rp. <?php echo number_format($row['total_harga']) ?></td>
                            <td><?php echo $row['metode_pembayaran'] ?></td>
                            <td><?php echo $row['tanggal_transaksi'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p>
            <small>Copyright &copy; 2024 - Irfastore.</small>
        </div>
    </div>
</body>
</html>

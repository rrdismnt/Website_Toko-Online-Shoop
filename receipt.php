<?php
    error_reporting(0);
    include 'db.php'; // Mengasumsikan db.php berisi kode koneksi ke database
    
    // Ambil id transaksi dari parameter GET
    $transaction_id = $_GET['transaction_id']; // Mengasumsikan Anda melewatkan transaction_id sebagai parameter
    
    $query = "SELECT * FROM tb_transaksi WHERE id = '$transaction_id'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $transaction = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk - Irfastore</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Struk Pembelian</h1>
        <p><strong>ID Transaksi:</strong> <?php echo $transaction['id']; ?></p>
        <p><strong>Nama:</strong> <?php echo $transaction['nama']; ?></p>
        <p><strong>Alamat:</strong> <?php echo $transaction['alamat']; ?></p>
        <p><strong>Telepon:</strong> <?php echo $transaction['telepon']; ?></p>
        <p><strong>Metode Pembayaran:</strong> <?php echo $transaction['metode_pembayaran']; ?></p>
        <p><strong>Produk:</strong> <?php echo $transaction['product_id']; ?></p>
        <p><strong>Jumlah:</strong> <?php echo $transaction['jumlah']; ?></p>
        <p><strong>Total Harga:</strong> Rp. <?php echo number_format($transaction['total_harga']); ?></p>
        <p><strong>Tanggal Transaksi:</strong> <?php echo $transaction['tanggal_transaksi']; ?></p>
        <br>
        <p>Terima kasih telah berbelanja di Irfastore.</p>
    </div>
</body>
</html>
<?php
    } else {
        echo '<script>alert("Data transaksi tidak ditemukan.");window.location="transaksi.php";</script>';
    }
?>

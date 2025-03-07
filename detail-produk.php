<?php 
    error_reporting(0);
    include 'db.php';
    
    // Memulai sesi
    session_start();
    
    // Memastikan koneksi berhasil
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    // Mengambil data admin
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
    
    // Mengambil data produk
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);

    if(isset($_POST['submit'])){
        // Mengambil data dari form
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
        $product_id = $p->product_id;
        $jumlah = (int)$_POST['jumlah'];
        $total_harga = $jumlah * $p->product_price;
        
        // Menyimpan data transaksi
        $query = "INSERT INTO tb_transaksi (nama, alamat, telepon, metode_pembayaran, product_id, jumlah, total_harga, tanggal_transaksi) VALUES ('$nama', '$alamat', '$telepon', '$metode_pembayaran', '$product_id', '$jumlah', '$total_harga', NOW())";
        $result = mysqli_query($conn, $query);

        if($result){
            // Mengirim notifikasi
            $message = "Halo $nama, pesanan Anda sedang dikemas dan akan segera diantar. Terima kasih sudah berbelanja di Irfastore!";
            // Kirim pesan (misalnya via SMS atau email)
            // mail($telepon.'@smsprovider.com', 'Pesanan Dikirim', $message); // Contoh untuk email/SMS
            
            echo '<script>alert("Transaksi berhasil ditambahkan! Pesanan Anda sedang diproses. Terima kasih sudah berbelanja di Irfastore!");window.location="transaksi.php"</script>';
        } else {
            echo '<script>alert("Transaksi gagal: '.mysqli_error($conn).'");</script>';
        }
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
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Irfastore</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="transaksi.php">Transaksi</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <!-- Formulir Transaksi -->
                    <form action="" method="POST">
                        <p>Nama Lengkap</p>
                        <input type="text" name="nama" required>
                        <p>Alamat</p>
                        <input type="text" name="alamat" required>
                        <p>Telepon</p>
                        <input type="text" name="telepon" required>
                        <p>Jumlah</p>
                        <input type="number" name="jumlah" min="1" required>
                        <p>Metode Pembayaran</p>
                        <select name="metode_pembayaran" required>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="COD">Cash On Delivery (COD)</option>
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="submit" value="Beli Sekarang">
                    </form>
                </div>
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

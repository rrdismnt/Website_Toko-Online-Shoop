<?php
session_start();
include 'db.php';

// Pastikan user sudah login
if(!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true){
    echo '<script>window.location="login.php"</script>';
    exit;
}

// Ambil data admin jika sudah login
$d = null;
if(isset($_SESSION['id'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
}

// Jika data admin tidak ditemukan
if(!$d) {
    echo '<script>alert("Data admin tidak ditemukan")</script>';
    echo '<script>window.location="login.php"</script>';
    exit;
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

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo isset($d->admin_name) ? htmlspecialchars($d->admin_name) : ''; ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo isset($d->username) ? htmlspecialchars($d->username) : ''; ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo isset($d->admin_telp) ? htmlspecialchars($d->admin_telp) : ''; ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo isset($d->admin_email) ? htmlspecialchars($d->admin_email) : ''; ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo isset($d->admin_address) ? htmlspecialchars($d->admin_address) : ''; ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        $nama   = ucwords($_POST['nama']);
                        $user   = $_POST['user'];
                        $hp     = $_POST['hp'];
                        $email  = $_POST['email'];
                        $alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($conn, "UPDATE tb_admin SET 
                                        admin_name = '".$nama."',
                                        username = '".$user."',
                                        admin_telp = '".$hp."',
                                        admin_email = '".$email."',
                                        admin_address = '".$alamat."'
                                        WHERE admin_id = '".$_SESSION['id']."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'Gagal '.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php 
                    if(isset($_POST['ubah_password'])){
                        $pass1  = $_POST['pass1'];
                        $pass2  = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                        }else{
                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
                                        password = '".password_hash($pass1, PASSWORD_DEFAULT)."'
                                        WHERE admin_id = '".$_SESSION['id']."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah data berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'Gagal '.mysqli_error($conn);
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>&copy; 2024 - Irfastore.</small>
        </div>
    </footer>
</body>
</html>

<?php 
	include 'db.php';

	if(isset($_POST['register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if($password == $confirm_password){
			$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$username."'");
			if(mysqli_num_rows($cek) == 0){
				$insert = mysqli_query($conn, "INSERT INTO tb_admin (username, password) VALUES ('".$username."', '".md5($password)."')");
				if($insert){
					echo '<script>alert("Register berhasil, silahkan login!")</script>';
					echo '<script>window.location="login.php"</script>';
				}else{
					echo '<script>alert("Gagal register!")</script>';
				}
			}else{
				echo '<script>alert("Username sudah digunakan!")</script>';
			}
		}else{
			echo '<script>alert("Konfirmasi password tidak cocok!")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - Irfastore</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<style>
		.register-container {
			width: 300px;
			margin: 50px auto;
			padding: 20px;
			border: 1px solid #ff0000;
			border-radius: 5px;
			background: #f9f9f9;
		}
		.register-container h3 {
			text-align: center;
			margin-bottom: 20px;
		}
		.register-container .input-control {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border: 1px solid #ddd;
			border-radius: 5px;
		}
		.register-container .btn {
			width: 100%;
			padding: 10px;
			background: #333;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.register-container .btn:hover {
			background: #555;
		}
	</style>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php">Irfastore</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<div class="register-container">
				<h3>Register</h3>
				<form action="" method="post">
					<input type="text" name="username" placeholder="Username" class="input-control" required>
					<input type="password" name="password" placeholder="Password" class="input-control" required>
					<input type="password" name="confirm_password" placeholder="Konfirmasi Password" class="input-control" required>
					<input type="submit" name="register" value="Register" class="btn">
				</form>
			</div>
		</div>
	</div>
</body>
</html>

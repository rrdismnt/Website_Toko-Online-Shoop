<?php 
	include 'db.php';
	session_start(); // Ensure session is started

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Check for admin credentials
		if ($username == 'admin' && $password == '1234567') {
			$_SESSION['status_login'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['role'] = 'admin';
			echo '<script>window.location="dashboard.php"</script>'; // Redirect to dashboard.php for admin
		} else {
			// Check in the database for other users
			$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$username."' AND password = '".md5($password)."'");
			if(mysqli_num_rows($cek) > 0){
				$d = mysqli_fetch_object($cek);
				$_SESSION['status_login'] = true;
				$_SESSION['a_global'] = $d;
				$_SESSION['id'] = $d->admin_id;
				$_SESSION['role'] = 'pelanggan';
				echo '<script>window.location="index.php"</script>'; // Redirect to index.php for pelanggan
			}else{
				echo '<script>alert("Username atau password Anda salah!")</script>';
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Irfastore</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<style>
		.login-container {
			width: 300px;
			margin: 50px auto;
			padding: 20px;
			border: 1px solid #ff0000;
			border-radius: 5px;
			background: #f9f9f9;
		}
		.login-container h3 {
			text-align: center;
			margin-bottom: 20px;
		}
		.login-container .input-control {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border: 1px solid #ddd;
			border-radius: 5px;
		}
		.login-container .btn {
			width: 100%;
			padding: 10px;
			background: #333;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.login-container .btn:hover {
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
			<div class="login-container">
				<h3>Login</h3>
				<form action="" method="post">
					<input type="text" name="username" placeholder="Username" class="input-control" required>
					<input type="password" name="password" placeholder="Password" class="input-control" required>
					<input type="submit" name="login" value="Login" class="btn">
				</form>
			</div>
		</div>
	</div>
</body>
</html>

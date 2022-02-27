<!-- trang đăng nhập đầu tiên -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<!-- Kiểm tra tài khoản đã có trong db chưa -->
	<?php
	if (isset($_POST['sbm'])) {
		$mail = $_POST['mail'];
		$pass = $_POST['pass'];
		$sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
		$query = mysqli_query($conn, $sql);
		$check_row = mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		
		if ($check_row > 0) {
			$_SESSION['mail'] = $mail;
			$_SESSION['pass'] = $pass;
			$kiemtra = $row['kiemtra'];
			if ($kiemtra == 0){ header('location: change.php');} 
			else { header('location: index.php'); }
		} else { $error =  "<div class='form-group ab' id='warning'><strong>Tên đăng nhập hoặc mật khẩu không đúng!</strong></div>"; }
	} ?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<?php if (isset($error)) {
						echo $error;
					}; ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
							<a class="form-group can" href= "../index.php">Cancel</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<style type="text/css">
	body{
		background-color: #1b2a49;
	}
	.row{
		margin-top: 10%;
	}
	.panel-heading{
		background: rgba(0, 0, 0, 0.5) !important;
		color: black !important;
		font-size: 31px;
		text-align: center;
		font-family: cursive;
	}
	.panel-body{
		background: rgba(0, 0, 0, 0.5);
	}
	.can{
		color: #8f0000;
		padding-left: 62%;
	}
	.ab{
		color: #7a1d1d;
	}
</style>
</html>
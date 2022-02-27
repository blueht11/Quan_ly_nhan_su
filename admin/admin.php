<!-- layout chính của trang web, chứa các chức năng cần thiết (đã phân quyền) -->
<?php
if (!defined('nhanvien')) {
	die('TRUY CẬP SAI CÁCH!');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản lý nhân viên</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"><span>Quản lý nhân viên</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<svg class="glyph stroked male-user">
								<use xlink:href="#stroked-male-user"></use>
							</svg>
							<?php
								$sql = "SELECT*FROM user WHERE username='$mail' AND password='$pass'";
								$query = mysqli_query($conn, $sql);
								$row = mysqli_fetch_array($query);
								if ($row['role'] == 1) {echo "Giám đốc";} else if ($row['role'] == 2) {echo "Trưởng phòng";} else {echo "Nhân viên";}
								if ($row['role'] == 3 || $row['role'] == 2) { ?>
									<a href="index.php?page_layout=changepass">
										<svg class="glyph stroked cancel">
											<!-- <use xlink:href="#stroked-cancel"></use> -->
										</svg> Đổi mật khẩu
									</a>
									<a href="output.php">
										<svg class="glyph stroked cancel">
											<!-- <use xlink:href="#stroked-cancel"></use> -->
										</svg> Đăng xuất
									</a>
								<?php } ?>
							<span class="caret"></span>
						</a>
						<?php if($row['role']==1){ ?>
							<ul class="dropdown-menu" role="menu">
							<li>
								<a href="index.php?page_layout=account">
									<svg class="glyph stroked male-user">
										<use xlink:href="#stroked-male-user"></use>
									</svg> Hồ sơ
								</a>
							</li>
							<li>
								<a href="output.php">
									<svg class="glyph stroked cancel">
										<use xlink:href="#stroked-cancel"></use>
									</svg> Đăng xuất
								</a>
							</li>
						</ul>
						<?php } ?>
						
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
		<?php
			if (isset($_GET['page_layout'])) {
				$row = $_GET['page_layout']; ?>
				<?php if (defined("admin")) { ?>
					<li <?php if ($_GET['page_layout'] == "user" || $_GET['page_layout'] == "add_user" || $_GET['page_layout'] == "edit_user") { ?> class="active" <?php } ?>>
						<a href="index.php?page_layout=user">
							<svg class="glyph stroked male user ">
								<use xlink:href="#stroked-male-user" />
							</svg>Quản lý tài khoản
						</a>
					</li>
				<?php } ?>
				<?php if (defined("admin")) { ?>
				<li <?php if ($_GET['page_layout'] == "phongban" || $_GET['page_layout'] == "add_phongban" || $_GET['page_layout'] == "edit_phongban") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=phongban">
						<svg class="glyph stroked home">
							<use xlink:href="#stroked-home" />
						</svg>Quản lý phòng ban
					</a>
				</li>
				<?php } ?>
				<?php if (defined("admin")) { ?>
				<li <?php if ($_GET['page_layout'] == "nhanvien" || $_GET['page_layout'] == "add_nhanvien" || $_GET['page_layout'] == "edit_nhanvien") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=nhanvien">
						<svg class="glyph stroked eye">
							<use xlink:href="#stroked-eye"></use>
						</svg>Xem nhân viên
					</a>
				</li>
				<?php } ?>
				<?php if (!defined("admin")) { ?>
				<li <?php if ($_GET['page_layout'] == "nhiemvu") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=nhiemvu">
						<svg class="glyph stroked two messages">
							<use xlink:href="#stroked-two-messages" />
						</svg> Công việc</a>
				</li>
				<?php } ?>
				<?php if (!defined("admin")) { ?>
				<li <?php if ($_GET['page_layout'] == "view_nhanvien") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=view_nhanvien">
						<!-- <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"/></svg> -->
						<svg class="glyph stroked male-user">
							<use xlink:href="#stroked-male-user" />
						</svg> Thông tin cá nhân</a>
				</li>
				<?php } ?>
				
				<li <?php if ($_GET['page_layout'] == "ngaynghi" || $_GET['page_layout'] == "add_ngaynghi" || $_GET['page_layout'] == "view_ngaynghi") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=ngaynghi">
						<svg class="glyph stroked calendar">
							<use xlink:href="#stroked-calendar"></use>
						</svg>Xem ngày nghỉ
					</a>
				</li>
				
<!-- -------------------------------------------------------------------------------------------------------------------------- -->
			<?php } else { ?>
				<?php if (defined("admin")) { ?>
					<li>
						<a href="index.php?page_layout=user">
							<svg class="glyph stroked male user ">
								<use xlink:href="#stroked-male-user" />
							</svg>Quản lý tài khoản
						</a>
					</li>
				<?php } ?>
				<?php if (defined("admin")) { ?>
				<li>
					<a href="index.php?page_layout=phongban">
						<svg class="glyph stroked home">
							<use xlink:href="#stroked-home" />
						</svg>Quản lý phòng ban
					</a>
				</li>
				<?php } ?>
				<?php if (defined("admin")) { ?>
				<li>
					<a href="index.php?page_layout=nhanvien">
						<svg class="glyph stroked eye">
							<use xlink:href="#stroked-eye"></use>
						</svg>Xem nhân viên
					</a>
				</li>
				<?php } ?>
				<?php if (!defined("admin")) { ?>
				<li>
					<a href="index.php?page_layout=nhiemvu">
						<svg class="glyph stroked two messages">
							<use xlink:href="#stroked-two-messages" />
						</svg> Công việc</a>
				</li>
				<?php } ?>

				<?php if (!defined("admin")) { ?>
				<li>
					<a href="index.php?page_layout=view_nhanvien">
						<!-- <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"/></svg> -->
						<svg class="glyph stroked male-user">
							<use xlink:href="#stroked-male-user" />
						</svg> Thông tin cá nhân</a>
				</li>
				<?php } ?>
				
				<li>
					<a href="index.php?page_layout=ngaynghi">
						<svg class="glyph stroked calendar">
							<use xlink:href="#stroked-calendar"></use>
						</svg>Xem ngày nghỉ
					</a>
				</li>
				

			<?php } ?>
		</ul>

	</div>
	<?php
	if (isset($_GET['page_layout'])) {
		switch ($_GET['page_layout']) {
			case 'nhanvien':
				include_once('modules/nhanvien/nhanvien.php');
				break;
			case 'add_nhanvien':
				include_once('modules/nhanvien/add_nhanvien.php');
				break;
			case 'edit_nhanvien':
				include_once('modules/nhanvien/edit_nhanvien.php');
				break;
			case 'view_nhanvien':
				include_once('modules/nhanvien/view_nhanvien.php');
				break;
			case 'phongban':
				include_once('modules/phongban/phongban.php');
				break;
			case 'add_phongban':
				include_once('modules/phongban/add_phongban.php');
				break;
			case 'edit_phongban':
				include_once('modules/phongban/edit_phongban.php');
				break;
			case 'view_phongban':
				include_once('modules/phongban/view_phongban.php');
				break;
			case 'user':
				include_once('modules/user/user.php');
				break;
			case 'add_user':
				include_once('modules/user/add_user.php');
				break;
			case 'edit_user':
				include_once('modules/user/edit_user.php');
				break;
			case 'changepass':
				include_once('modules/user/changepass.php');
				break;
			case 'account':
				include_once('modules/account/account.php');
				break;
			case 'nhiemvu':
				include_once('modules/nhiemvu/nhiemvu.php');
				break;
			case 'add_nhiemvu':
				include_once('modules/nhiemvu/add_nhiemvu.php');
				break;
			case 'view_nhiemvu':
				include_once('modules/nhiemvu/view_nhiemvu.php');
				break;
			case 'new_nhiemvu':
				include_once('modules/nhiemvu/new_nhiemvu.php');
				break;
			case 'ngaynghi':
				include_once('modules/ngaynghi/ngaynghi.php');
				break;
			case 'add_ngaynghi':
				include_once('modules/ngaynghi/add_ngaynghi.php');
				break;
			case 'view_ngaynghi':
				include_once('modules/ngaynghi/view_ngaynghi.php');
				break;
			case 'lichsu':
				include_once('modules/ngaynghi/lichsu.php');
				break;
		}
	} else {
		// phân quyền trang đầu tiên vào của nhân viên, trưởng phòng, giám đốc
		if ($row['role'] == 3) {
			include_once('modules/nhiemvu/new_nhiemvu.php');
		} else if ($row['role'] == 2){
			include_once('modules/nhiemvu/nhiemvu.php');
		} else {
			include_once('modules/nhanvien/nhanvien.php');
		}
	}
	?>

</body>

</html>
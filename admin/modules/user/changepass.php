<!-- trang đổi mật khẩu của nhân viên và trưởng phòng -->
<?php
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    $mail = $_SESSION['mail'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $ID= $row['ID'];
    $check = $row['kiemtra'];
    $id_nv1=$row['IDNV'];
    $sql_nv="SELECT * FROM nhanvien WHERE nhanvien.IDNV='$id_nv1'";
    $row_nv=mysqli_fetch_array(mysqli_query($conn,$sql_nv));
    // Kiểm tra nếu nhấn đổi mật khẩu
    if(isset($_POST['sbm'])){
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        //Kiểm tra pass không được để trống
        if(empty($password)){
            $error_pass = '<div class="alert alert-danger">Không được để trống mật khẩu!</div>';
        } else if ($password == $repassword) {
            // cập nhật pass
            $password = $_POST["password"];
            $sql="UPDATE user SET password='$password' WHERE ID='$ID'";
            $query=mysqli_query($conn, $sql);
            if ($password == $pass){header("location: index.php");
            } else {header("location: output.php");}
        } else {
            $error_pass = '<div class="alert alert-danger">Mật khẩu không khớp, vui lòng nhập lại!</div>';
        }
    }
} ?>
    <!-- giao diện -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a>Đổi mật khẩu</a></li>
			<li class="active"><?php echo $row_nv['hoten'];?></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Tài khoản của nhân viên: <?php echo $row_nv['hoten'];?></h1>
		</div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Tài khoản</label>
                            <?php if (isset($error)) {
                                echo $error;
                            } ?>
                            <p class="form-control"><?php echo $row['username'];?></p>
                        </div>                       
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" required value="<?php echo $row['password'];?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" name="repassword" required value="<?php echo $row['password'];?>" class="form-control">
                            <?php if (isset($error_pass)) {
                                echo $error_pass;
                            } ?>

                            </div class="form-group">
                            <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <a href="index.php?page_layout=view_nhanvien" class="btn btn-warning">Quay Lại</a>
                            
                        </div>
                        </div>
                        
                    </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

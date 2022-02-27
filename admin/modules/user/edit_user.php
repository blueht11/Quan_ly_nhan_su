<!-- hiển thị thông tin của tài khoản cần chỉnh sửa với các chức năng theo yêu cầu đề cho -->
<?php
if(!defined('nhanvien')) {die('ban truy cap sai cach');}
    // lấy thông tin nhân viên cần edit
    $ID=$_GET['id'];
    $sql_user="SELECT*FROM user WHERE ID='$ID'";
    $query_user=mysqli_query($conn, $sql_user);
    $row_user=mysqli_fetch_array($query_user);
    $id_nv1=$row_user['IDNV'];
    $sql_nv="SELECT * FROM nhanvien WHERE nhanvien.IDNV='$id_nv1'";
    $row_nv=mysqli_fetch_array(mysqli_query($conn,$sql_nv));
    // kiểm tra nếu nhấn reset mật khẩu
    if(isset($_POST['reset-password'])){
        $query_reset = mysqli_query($conn,"UPDATE user SET password=repass, kiemtra=0 WHERE IDNV='$id_nv1' ");
        header("location: index.php?page_layout=user");
    }
    // nếu nhấn chỉnh sửa nhân viên
    if(isset($_POST['sbm'])){
        // lấy thông tin người dùng nhập
        $IDNV=$_POST['IDNV'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        // $role=$_POST['role'];

        //kiểm tra điều kiện về pass
        if ($password == $repassword) {
            $password = $_POST["password"];
            // mail
            if ($username == $row_user['username']){
                echo $sql="UPDATE user SET IDNV='$IDNV',username='$username',password='$password',kiemtra=0 WHERE ID='$ID'";
                $query=mysqli_query($conn, $sql);
                header("location: index.php?page_layout=user");
            } else if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM user WHERE username = '$username'")) == 0) {
                // if ($password == $repassword) {
                    $username = $_POST["username"];
                    echo $sql="UPDATE user SET IDNV='$IDNV',username='$username',password='$password',kiemtra=0 WHERE ID='$ID'";
                    $query=mysqli_query($conn, $sql);
                    header("location: index.php?page_layout=user");
                // }
            } else {
                $error = '<div class="alert alert-danger">Tài khoản ' .$username .' đã tồn tại, vui lòng chọn tài khoản khác!</div>';
            }
        } else {
            $error_pass = '<div class="alert alert-danger">Mật khẩu không khớp, vui lòng nhập lại!</div>';
        }

    }
?>			
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="./index.php?page_layout=user">Quản lý tài khoản</a></li>
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
                            <label>ID nhân viên</label>
                            <p type="text" name="IDNV" required class="form-control" value="<?php echo $row_user['IDNV'];?>" placeholder=""><?php echo $row_user['IDNV'];?> </p>
                        </div>
                        <div class="form-group">
                            <label>Tài khoản</label>
                            <input type="text" name="username" required value="<?php echo $row_user['username'];?>" class="form-control">
                            <?php if (isset($error)) {
                                echo $error;
                            } ?>
                        </div>                       
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" required value="<?php echo $row_user['password'];?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" name="repassword" required value="<?php echo $row_user['password'];?>" class="form-control">
                            <?php if (isset($error_pass)) {
                                echo $error_pass;
                            } ?>
                        </div>
                       <div class="form-group">
                            <label>Chức vụ</label>
                            <?php
                            $ra="Nhân viên";
                            if($row_user["role"]==2){$ra="Trưởng phòng";}?>
                            <p required class="form-control"><?php echo $ra;?></p>
                        </div>
                            <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-primary" >Làm mới</button>
                            
                            <!-- <button type="submit" name="reset-password" class="btn btn-danger" >Reset mật khẩu</button> -->
                            <!-- <a type="submit" name="reset-password" onclick="return confirm('Bạn muốn đặt lại mật khẩu cho nhân viên này?');" class="btn btn-danger">Reset mật khẩu</a> -->
                           <a href="index.php?page_layout=user" class="btn btn-warning">Quay Lại</a>
                        </div>
                    </form>

                        <div class="col-md-8">
                        <form role="form" method="post" onsubmit ="return confirm('Bạn muốn đặt lại mật khẩu cho nhân viên này?');"> 
                            <br>
                            <button type="submit" name="reset-password" class="btn btn-danger" >Reset mật khẩu</button>
                        </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
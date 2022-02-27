 <!-- trang thêm user mới cho công ty -->
<!-- không sử dụng vì đã tích hợp thêm tài khoản khi thêm nhân viên -->
<?php
if (defined('admin')) {
    $error_role = '<div class="alert alert-danger">Thêm nhân viên sẽ tự động tạo tài khoản</div>';
}
if(isset($_POST['sbm'])){
    $IDNV=$_POST['IDNV'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    //mail
    if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM user WHERE username = '$username'")) == 0) {
            $username = $_POST["username"];
            $password = $username;
            echo $sql_user = "INSERT INTO user( IDNV, username, password, role, repass) value( '$IDNV', '$username', '$password', '$role', '$password' )";
            mysqli_query($conn, $sql_user);
            header("location: index.php?page_layout=user");
    } else {
        $error = '<div class="alert alert-danger">Email ' . $username . ' đã tồn tại, vui lòng chọn Email khác!</div>';
    }
}
?>
<!-- Hiển thị báo lỗi nếu truy cập sai cách -->
<?php 
if (isset($error_role)) { ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <?php echo $error_role; ?>
    </div>
<?php } else { ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="./index.php?page_layout=user">Quản lý tài khoản</a></li>
            <li class="active">Thêm tài khoản</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm tài khoản</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <form role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>ID nhân viên</label>
                                <input name="IDNV" required class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tài khoản</label>
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                                <input name="username" required type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select name="role" class="form-control">
                                    <option value=2>Trưởng phòng</option>
                                    <option value=3>Nhân viên</option>
                                </select>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <button onclick="window.location.href='./index.php?page_layout=user'" class="btn btn-warning">Quay lại</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>
<!--/.main
<?php } ?>
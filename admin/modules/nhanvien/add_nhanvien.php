<!-- trang thêm nhân viên mới, tự tạo tài khoản khi thêm nhân viên -->
<?php
if (!defined('nhanvien')) {
    die('ban truy cap sai cach');
}

if (isset($_POST['sbm'])) {
    //nhan vien
    $hoten = $_POST['hoten'];
    $quequan = $_POST['quequan'];
    $ngaysinh = $_POST['ngaysinh'];
    $email = $_POST['email'];
    $gioitinh = $_POST['gioitinh'];
    $anhdaidien = $_FILES['anhdaidien']['name'];
    $tmp_name = $_FILES['anhdaidien']['tmp_name'];
    // kiểm tra có phòng ban nào được tạo hay chưa
    if (isset($_POST['IDPB'])){
        $IDPB = $_POST['IDPB'];
        $songaynghi = $_POST['songaynghi'];
        $today = date("Y-m-d");
        $a = date('Y-m-d', strtotime('-18 year')). "<br>";
        // user
        $chucvu = $_POST['chucvu'];
        $password = $email;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $_FILES['anhdaidien']['tmp_name']);
        $mimesize = $_FILES['anhdaidien']['size'];
        // Kiểm tra tuổi nhân viên
        if ($ngaysinh > $a) {$error_tuoi = '<div class="alert alert-danger">Nhân viên phải lớn hơn 18 tuổi!</div>';}
        else {
            // Kiểm tra file ảnh có đúng yêu cầu hay không
            if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png') {
                if ($mimesize > 1000000) { $error = '<div class="alert alert-danger">Kích thước ảnh cần nhỏ hơn 1MB</div>';}
                else {
                    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username = '$email'")) == 0) {
                        // them nhan vien
                        $sql_a = "INSERT INTO nhanvien(hoten,quequan,ngaysinh,email,gioitinh,anhdaidien,songaynghi,IDPB
                ) VALUE('$hoten','$quequan','$ngaysinh','$email','$gioitinh','$anhdaidien','$songaynghi','$IDPB')";
                        move_uploaded_file($tmp_name, "modules/nhanvien/img/" . $anhdaidien);
                        $query_a = mysqli_query($conn, $sql_a);
                        $row_a = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.email='$email' "));
                        $IDNV_a = $row_a['IDNV'];
                        // them user
                        $sql_user = "INSERT INTO user( IDNV, username, password, role, repass) value( '$IDNV_a', '$email', '$email', '3', '$email')";
                        mysqli_query($conn, $sql_user);
                        header("location: index.php?page_layout=nhanvien");
                        // $error = '<div class="alert alert-danger">add user</div>';
                    } else {$error_mail = '<div class="alert alert-danger">Email ' . $email . ' đã tồn tại, vui lòng chọn Email khác!</div>';}
                }
            } else {$error = '<div class="alert alert-danger">Ảnh không hợp lệ! Hãy chọn ảnh có định dạng jpeg, png, gif, jpg</div>';}
        }
    } else {$error_phong = '<div class="alert alert-danger">Cần phải tạo phòng ban trước</div>';}
} ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=nhanvien">Quản lý nhân viên</a></li>
            <li class="active">Thêm nhân viên</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm nhân viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên nhân viên</label>
                                <?php
                                if (isset($error_name)) {
                                    echo $error_name;
                                }
                                ?>
                                <input required name="hoten" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Quê quán</label>
                                <input required name="quequan" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input required name="ngaysinh" type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control">
                                <?php
                                if (isset($error_tuoi)) {
                                    echo $error_tuoi;
                                }
                                ?>

                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input required name="email" type="text" class="form-control">
                                <?php
                                if (isset($error_mail)) {
                                    echo $error_mail;
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <input required name="gioitinh" type="text" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <?php if (isset($error)) { echo $error;} ?>
                            <input required name="anhdaidien" type="file">
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                            <select name="IDPB" class="form-control">
                                <?php
                                $sql = "SELECT*FROM phongban ORDER BY IDPB ASC";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <option value=<?php echo $row['IDPB'] ?>><?php echo $row['tenphong']; ?></option>
                                <?php } ?>
                            </select>
                            <?php
                            if (isset($error_phong)) {
                                echo $error_phong;
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <select name="chucvu" class="form-control">
                                <option value=3 selected>Nhân viên</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Số ngày nghỉ</label>
                                <input required name="songaynghi" type="number" min="0" max="15" value="0" class="form-control">
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-primary">Làm mới</button>
                        <button onclick="window.location.href='./index.php?page_layout=nhanvien'" class="btn btn-warning">Quay lại</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
<!--/.main-->
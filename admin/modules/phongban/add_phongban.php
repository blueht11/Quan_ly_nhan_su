<!-- trang thêm phòng ban mới -->
<?php
if (!defined('admin')) {
    $error_role = '<div class="alert alert-danger">Chỉ giám đốc mới có thể vào trang này!</div>';
}
// kiểm tra nếu nhấn submit
if(isset($_POST['sbm'])){
    $tenphong=$_POST['tenphong'];
    $motaphong=$_POST['motaphong'];
    $sophong=$_POST['sophong'];
    // $IDNV=$_POST['IDNV'];
    // Kiểm tra nếu phòng đã tồn tại
    if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM phongban WHERE tenphong = '$tenphong'")) != 0) {
        $error_phongban = '<div class="alert alert-danger">Đã tồn tại phòng ' . $tenphong . ', hãy nhập phòng khác!</div>';
    } else {
        // Thêm phòng vào db
        $sql = "INSERT INTO phongban (tenphong, motaphong, sophong) VALUE ('$tenphong','$motaphong','$sophong')";
        mysqli_query($conn, $sql);
        header('location: index.php?page_layout=phongban');
    }
}
?>

<!-- giao diện -->
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
            <li><a href="index.php?page_layout=phongban">Quản lý phòng ban</a></li>
            <li class="active">Thêm phòng ban</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm phòng ban</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên phòng ban:</label>
                                <input required type="text" name="tenphong" class="form-control" placeholder="Tên phòng ban...">
                            </div>
                            <div class="form-group">
                                <label>Số phòng:</label>
                                <input required type="number" min="1" name="sophong" class="form-control" value="1">
                            </div>
                            <div class="form-group">
                                <label>Mô tả phòng ban:</label>
                                <input required type="text" name="motaphong" class="form-control" placeholder="Mô tả phòng ban...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <a href="index.php?page_layout=phongban" class="btn btn-warning">Quay Lại</a>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main
<?php } ?>
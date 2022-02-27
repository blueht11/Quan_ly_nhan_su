<!-- trang gửi yêu cầu nghỉ của nhân viên -->
<?php
$sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$IDNV = $row['IDNV'];
$today = date("Y-m-d");
if(defined('truongphong')){
    // Nếu trưởng phòng xin nghỉ
    if(isset($_POST['sbm'])){
        // Lấy thông tin ngày nghỉ
        $lydo=$_POST['lydo'];
        $ngaynghi=$_POST['ngaynghi'];
        // kiểm tra ngày nghỉ có phải ở quá khứ không
        if ($ngaynghi <= $today){
            $error_date = '<div class="alert alert-danger">Chỉ được xin nghỉ sau ngày '. $today .'</div>';
        } else {
            // thêm ngày nghỉ vào database
            $row_1=mysqli_query($conn,"INSERT INTO ngaynghi (IDNV, IDND, ngay, lydo, trangthai) VALUE ('$IDNV','1','$ngaynghi','$lydo','0') ");
            header('location: index.php?page_layout=ngaynghi');
        }
    }
} else if (defined('nhanvien')) {
    if(isset($_POST['sbm'])){
        // nếu nhân viên xin nghỉ, lấy các thông tin cần thiết để thêm vào database
        $r1=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));
        $IDPB=$r1['IDPB'];
        $r2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM truongphong WHERE truongphong.IDPB='$IDPB' "));
        $IDND=$r2['IDNV'];
        $lydo=$_POST['lydo'];
        $ngaynghi=$_POST['ngaynghi'];
        // kiểm tra ngày nghỉ có phải ở quá khứ không
        if ($ngaynghi <= $today){
            $error_date = '<div class="alert alert-danger">Chỉ được xin nghỉ sau ngày '. $today .'</div>';
        } else {
            // thêm ngày nghỉ vào database
            $row_1=mysqli_query($conn,"INSERT INTO ngaynghi (IDNV, IDND, ngay, lydo, trangthai) VALUE ('$IDNV','$IDND','$ngaynghi','$lydo','0') ");
            header('location: index.php?page_layout=ngaynghi');
        }
    }
} ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=ngaynghi">Quản lý ngày nghỉ</a></li>
            <li class="active">Xin nghỉ phép</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Xin nghỉ phép</h1>
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
                                <?php
                                    if (isset($error)) {
                                        echo $error;
                                } ?>
                                <label>Lý do:</label>
                                <input required type="text" name="lydo" class="form-control" placeholder="Nhập lý do...">
                            </div>
                            <div class="form-group">
                                <label>Ngày nghỉ:</label>
                                <?php
                                    if (isset($error_date)) {
                                        echo $error_date;
                                } ?>
                                <input type="date" name="ngaynghi" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                            <label>Trưởng phòng: </label>
                            <select name="IDNV" class="form-control">
                                <?php
                                $sql = "SELECT*FROM nhanvien INNER JOIN user WHERE user.role=3";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <?php if($row==0){$row['IDNV']="null";} ?>
                                    <option value=<?php echo $row['IDNV'] ?>><?php echo $row['hoten']; ?>}
                                    </option>
                                <?php } ?>
                            </select>
                      </div> -->
                            <button type="submit" name="sbm" class="btn btn-success">Gửi</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <a href="index.php?page_layout=ngaynghi" class="btn btn-warning">Quay Lại</a>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->
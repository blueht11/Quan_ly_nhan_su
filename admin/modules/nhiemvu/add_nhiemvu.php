<!-- trang thêm nhiệm vụ mới của trưởng phòng cho nhân viên -->
<?php
// Kiểm tra quyền truy cập vào trang web
if (!defined('truongphong')) {
    $error_role = '<div class="alert alert-danger">Chỉ trưởng phòng mới có thể thêm nhiệm vụ!</div>';
} else {
    // lấy thông tin nhân viên truy cập
    $sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $id_tp = $row['IDNV'];
    $row_tp=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM truongphong WHERE truongphong.IDNV='$id_tp' "));
    $id = $row_tp['IDTP'];
    // nếu nhấn submit
    if(isset($_POST['sbm'])){
        $tencv=$_POST['tencv'];
        $motacv=$_POST['motacv'];
        $deadline = $_POST['deadline'];
        if(isset($_POST['IDNV'])){
            $IDNV=$_POST['IDNV'];
            $today = date("Y-m-d");
            // Kiểm tra deadline
            if ($deadline < $today){
                $error_date = '<div class="alert alert-danger">Hạn nộp ít nhất là 1 ngày!</div>';
            } else {
                $taptin = $_FILES['taptin']['name'];
                $tmp_name = $_FILES['taptin']['tmp_name'];
                $sql_smb = "INSERT INTO congviec (tencv, motacv, IDNV, trangthai, IDTP, deadline,file) VALUE ('$tencv','$motacv','$IDNV','1','$id','$deadline','$taptin' )";
                move_uploaded_file($tmp_name, "modules/nhiemvu/file/" . $taptin);
                mysqli_query($conn, $sql_smb);
                header('location: index.php?page_layout=nhiemvu');
            }
        } else {$error_nv = '<div class="alert alert-danger">Cần có nhân viên để giao nhiệm vụ!</div>';}        
    }
} ?>
<!-- Hiển thị báo lỗi nếu truy cập sai cách -->
<?php 
if (isset($error_role)) { ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <?php echo $error_role; ?>
    </div>
<?php } else { ?>
    <!-- Hiển thị nếu truy cập đúng cách-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=nhiemvu">Danh sách công việc</a></li>
            <li class="active">Thêm công việc</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm công việc</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <form role="form" method="POST" enctype = "multipart/form-data">
                            <div class="form-group">
                                <label>Tiêu đề:</label>
                                <input required type="text" name="tencv" class="form-control" placeholder="Tên nhiệm vụ...">
                            </div>
                            <div class="form-group">
                                <label>Mô tả:</label>
                                <input required type="text" name="motacv" class="form-control" placeholder="Mô tả nhiệm vụ...">
                            </div>
                           <div class="form-group">
                                <label>File đính kèm:</label>
                                <?php if (isset($error_name)) {echo $error_name;} ?>
                                <input type="file" required name="taptin">
                            </div>
                            <div class="form-group">
                            <label>Nhân viên thực hiện: </label>
                            <select name="IDNV" class="form-control">
                                <?php
                                // Hiển thị danh sách nhân viên trong phòng
                                $sql = "SELECT * FROM nhanvien WHERE nhanvien.IDPB=(SELECT IDPB FROM truongphong WHERE truongphong.IDNV='$id_tp' AND nhanvien.IDNV NOT IN ('$id_tp') )";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <?php if($row==0){$row['IDNV']="null";} ?>
                                    <option value=<?php echo $row['IDNV']; ?>><?php echo $row['hoten']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php
                                if (isset($error_nv)) {
                                    echo $error_nv;
                                }
                                ?>
                            <div class="form-group">
                                <label>Deadline:</label>
                                <input required name="deadline" type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control">
                            </div>
                            <!-- Kiểm tra nếu có lỗi deadline -->
                            <?php if (isset($error_date)) { echo $error_date; } ?>
                      </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <a href="index.php?page_layout=nhiemvu" class="btn btn-warning">Quay Lại</a>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->
<?php } ?>
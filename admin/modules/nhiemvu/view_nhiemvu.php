<!-- trang xem thông tin chi tiết nhiệm vụ -->
<?php
// if (!defined('nhanvien')) {die('ban truy cap sai cach');}
    $IDCV=$_GET['id'];
    $sql_1 = "SELECT * FROM congviec WHERE congviec.IDCV='$IDCV' ";
    $row_1 = mysqli_fetch_array(mysqli_query($conn,$sql_1));
    $IDNV = $row_1['IDNV'];

    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT*FROM user WHERE username='$mail' AND password='$pass'"));
    $role = $row['role'];
?>  
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=nhiemvu">Danh sách công việc</a></li>
            <li class="active">Xem thông tin</li>
        </ol>
    </div>
    <!-- --------------------------------------------------role trưởng phòng------------------------------------------------------ -->
<?php if ($role == 2) { ?>
    <?php 
        $IDCV = $_GET['id'];
        // kiểm tra nếu duyệt nhiệm vụ
        if(isset($_POST['yes'])){
            $danhgia = $_POST['danhgia'];
            $ghichu = $_POST['ghichu'];
            $today = date("Y-m-d");
            $sql_up_1 = "UPDATE congviec SET trangthai=6, danhgia='$danhgia', ghichu='$ghichu', ngaynop='$today' WHERE IDCV='$IDCV' ";
            $query=mysqli_query($conn, $sql_up_1);
            header('location: index.php?page_layout=nhiemvu');
        }
        // Nếu không duyệt nhiệm vụ
        if(isset($_POST['no'])){
            $deadline = $_POST['redeadline'];
            $ghichu = $_POST['ghichu'];
            $file=$_FILES['taptin']['name'];
            $tmp_name=$_FILES['taptin']['tmp_name'];
            $dead_old = $row_1['deadline'];
            // Kiểm tra deadline mới
            if ($dead_old > $deadline){
                $error_date = '<div class="alert alert-danger">Hạn nộp phải sau ngày '. $dead_old .'</div>';
            } else {
                $sql_up_1 = "UPDATE congviec SET trangthai=5, deadline='$deadline', ghichu='$ghichu', file='$file' WHERE IDCV='$IDCV' ";
                $query=mysqli_query($conn, $sql_up_1);
                move_uploaded_file($tmp_name,'modules/nhiemvu/file/'.$file);
                header('location: index.php?page_layout=nhiemvu');
            }
        }
        // Nếu nhấn hủy nhiệm vụ
        if(isset($_POST['delete'])){
            $sql_up_1 = "UPDATE congviec SET trangthai=3 WHERE IDCV='$IDCV' ";
            $query=mysqli_query($conn, $sql_up_1);
            header('location: index.php?page_layout=nhiemvu');
        }
    ?>
    <!-- Giao diện -->
    <div class="row">
        <div class="col-lg-12">
            <?php 
                $sql_2 = "SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' ";
                $row_2 = mysqli_fetch_array(mysqli_query($conn,$sql_2));
            ?>
            <h1 class="page-header">Nhân viên thực hiện: <?php echo $row_2['hoten'];?></h1>
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
                                <label>Tên nhiệm vụ:</label>
                                <p required class="form-control"><?php echo $row_1['tencv'];?></p>
                            </div>

                            <div class="form-group">
                                <label>Mô tả:</label>
                                <p required class="form-control"><?php echo $row_1['motacv'];?></p>
                            </div>
                            <div class="form-group">
                                <?php if ($row_1['trangthai'] == 4) { ?>
                                    <label>Đánh giá</label>
                                    <select name="danhgia" class="form-control">
                                        <option value="Bad">Bad</option>
                                        <option value="Ok" selected>Ok</option>
                                        <option value="Good">Good</option>
                                    </select>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label>Đánh giá:</label>
                                        <p required class="form-control"><?php echo $row_1['danhgia'];?></p>
                                    </div>
                                <?php } ?>

                                <?php if($row_1['trangthai'] >= 4) { ?>
                                <div class="form-group">
                                    <label>Ngày nộp</label>
                                        <p required class="form-control"> <?php echo $row_1['ngaynop'];?> </p>
                                </div>
                                <?php } ?>
                                
                                <br>
                                <a href="index.php?page_layout=nhiemvu" class="btn btn-warning">Quay Lại</a>
                                <?php if ($row_1['trangthai'] == 1) { ?>
                                    <button type="submit" name="delete" class="btn btn-danger">Hủy task</button>
                                <?php } ?>
                                <?php if ($row_1['trangthai'] == 4) { ?>
                                    <button type="submit" name="yes" class="btn btn-success">Đồng ý</button>
                                    <button type="submit" name="no" class="btn btn-danger">Không đồng ý</button>
                                <?php } ?>
                            </div>
                            
                        </div>
                    <div class="col-md-6">
                        <?php if ($row_1['trangthai'] != 4) { ?>
                            <div class="form-group">
                                <label>File đính kèm</label>
                                <?php if(isset($row_1['file'])){ ?>
                                    <a class="form-control" href="modules/nhiemvu/file/<?php echo $row_1['file'];?>"><?php echo $row_1['file'];?></a>
                                <?php } else { ?>
                                    <p class="form-control">Không có tập tin đính kèm!</p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        
                        <?php if ($row_1['trangthai'] == 4){ ?>
                            <div class="form-group">
                                <label>File đã gửi</label>
                                    <div class="form-group">
                                        <?php if(isset($row_1['file'])){ ?>
                                            <a class="form-control" href="modules/nhiemvu/file/<?php echo $row_1['file'];?>"><?php echo $row_1['file'];?></a>
                                        <?php } else { ?>
                                            <p class="form-control">Không có tập tin đính kèm!</p>
                                        <?php } ?>
                                    </div>
                                    <input required name="taptin" type="file">
                            </div>
                            <div class="form-group">
                                <label>Thời hạn</label>
                                    <input required name="redeadline" type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" required value="<?php echo $row_1['deadline'];?>">
                            </div>
                            <?php
                                if (isset($error_date)) {
                                    echo $error_date;
                            } ?>
                            <div class="form-group">
                                <label>Ghi chú:</label>
                                <input required type="text" name="ghichu" class="form-control" value="Chưa có nhận xét!">
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label>Thời hạn</label>
                                    <p required class="form-control"> <?php echo $row_1['deadline'];?> </p>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                    <p required class="form-control"> <?php echo $row_1['ghichu'];?> </p>
                            </div>
                        <?php } ?>
                        
                        <div class="form-group">
                                <label>Trạng thái</label>
                                <p class="ffff"><span class="label label-<?php if ($row_1['trangthai'] == 1) {
                                                                            echo "primary";
                                                                        } else if ($row_1['trangthai'] == 2){
                                                                            echo "info";
                                                                        } else if ($row_1['trangthai'] == 3){
                                                                            echo "danger";
                                                                        } else if ($row_1['trangthai'] == 4){
                                                                            echo "default";
                                                                        } else if ($row_1['trangthai'] == 5){
                                                                            echo "warning";
                                                                        } else { echo "success";
                                                                        }; ?>"><?php if ($row_1['trangthai'] == 1) {
                                                                            echo "New";
                                                                        }else if ($row_1['trangthai'] == 2){
                                                                            echo "In process";
                                                                        }else if ($row_1['trangthai'] == 3){
                                                                            echo "Canceled";
                                                                        }else if ($row_1['trangthai'] == 4){
                                                                            echo "Waiting";
                                                                        }else if ($row_1['trangthai'] == 5){
                                                                            echo "Rejected";
                                                                        } else {echo "Completed"; }; ?>
                                </span></p>
                                <?php if ($row_1['trangthai']==6){ ?>
                                    <p></p>
                                    <?php if ($row_1['ngaynop'] <= $row_1['deadline']){ ?>
                                        <p class="label label-success">Đúng hạn</p>
                                    <?php } else { ?>
                                        <p class="label label-danger">Trễ hạn</p>
                                    <?php } ?>  
                                <?php } ?>
                        </div>
                        
                    </div>
                        
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

<!-- ---------------------------------------------------role nhân viên------------------------------------------------------ -->
<?php } else { ?>
    <?php 
        $IDCV = $_GET['id'];
        // Nếu nhấn bắt đầu công việc
        if(isset($_POST['start'])){
            $sql_up_1 = "UPDATE congviec SET trangthai=2 WHERE IDCV='$IDCV' ";
            $query=mysqli_query($conn, $sql_up_1);
            header('location: index.php?page_layout=nhiemvu');
        }
        // Nếu nhấn hoàn tất công việc
        if(isset($_POST['submit'])){
            $today=date("Y-m-d");
            $sql_up_1 = "UPDATE congviec SET trangthai=4,ngaynop='$today' WHERE IDCV='$IDCV' ";
            $query=mysqli_query($conn, $sql_up_1);
            header('location: index.php?page_layout=nhiemvu');
        }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <?php 
                $sql_2 = "SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' ";
                $row_2 = mysqli_fetch_array(mysqli_query($conn,$sql_2));
            ?>
            <h1 class="page-header">Nhân viên thực hiện: <?php echo $row_2['hoten'];?></h1>
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
                                <label>Tên nhiệm vụ:</label>
                                <p required class="form-control"><?php echo $row_1['tencv'];?></p>
                            </div>

                            <div class="form-group">
                                <label>Mô tả:</label>
                                <p required class="form-control"><?php echo $row_1['motacv'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Đánh giá</label>
                                <p required class="form-control"><?php echo $row_1['danhgia'];?></p>

                                <a href="index.php?page_layout=nhiemvu" class="btn btn-warning">Quay Lại</a>
                                <?php if ($row_1['trangthai'] == 1) { ?>
                                    <button type="submit" name="start" class="btn btn-primary">Start</button>
                                <?php } else if ($row_1['trangthai'] == 2 || $row_1['trangthai'] == 5) { ?>
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                <?php } ?>
                            </div>
                            
                        </div>
                    <div class="col-md-6">
                        
                        <div class="form-group">
                                <label>File đính kèm</label>
                                <?php if(isset($row_1['file'])){ ?>
                                    <a class="form-control" href="modules/nhiemvu/file/<?php echo $row_1['file'];?>"><?php echo $row_1['file'];?></a>
                                <?php } else { ?>
                                    <p class="form-control">Không có tập tin đính kèm!</p>
                                <?php } ?>
                            </div>
                        <div class="form-group">
                            <label>Thời hạn</label>
                                <p required class="form-control"> <?php echo $row_1['deadline'];?> </p>
                        </div>
                        <!-- Hiển thị ngày nộp nếu nhân viên đã nhấn submit -->
                        <?php if($row_1['trangthai'] >= 4) { ?>
                        <div class="form-group">
                            <label>Ngày nộp</label>
                                <p required class="form-control"> <?php echo $row_1['ngaynop'];?> </p>
                        </div>
                        <?php } ?>
                        <?php if($row_1['trangthai'] >= 5) { ?>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                    <p required class="form-control"> <?php echo $row_1['ghichu'];?> </p>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                                <label>Trạng thái</label>
                                <p class="ffff"><span class="label label-<?php if ($row_1['trangthai'] == 1) {
                                                                            echo "primary";
                                                                        } else if ($row_1['trangthai'] == 2){
                                                                            echo "info";
                                                                        } else if ($row_1['trangthai'] == 4){
                                                                            echo "default";
                                                                        } else if ($row_1['trangthai'] == 5){
                                                                            echo "warning";
                                                                        } else if ($row_1['trangthai'] == 6){ echo "success";
                                                                        }; ?>"><?php if ($row_1['trangthai'] == 1) {
                                                                            echo "New";
                                                                        }else if ($row_1['trangthai'] == 2){
                                                                            echo "In process";
                                                                        }else if ($row_1['trangthai'] == 4){
                                                                            echo "Waiting";
                                                                        }else if ($row_1['trangthai'] == 5){
                                                                            echo "Rejected";
                                                                        } else if ($row_1['trangthai'] == 6){echo "Completed"; }; ?>
                                </span></p>
                                <?php if ($row_1['trangthai']==6){ ?>
                                    <p></p>
                                    <?php if ($row_1['ngaynop'] <= $row_1['deadline']){ ?>
                                        <p class="label label-success">Đúng hạn</p>
                                    <?php } else { ?>
                                        <p class="label label-danger">Trễ hạn</p>
                                    <?php } ?>  
                                <?php } ?>
                        </div>
                    </div>
                        
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
<?php } ?>

</div>
<style type="text/css">
    .ffff{
        padding-top: 0px;
        font-size: large;
    }
</style>
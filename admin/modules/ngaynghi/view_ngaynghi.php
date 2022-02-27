<!-- trang hiển thị chi tiết thông tin ngày nghỉ của nhân viên -->
<?php
    $sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    // lấy thông tin nhân viên từ id ngày nghỉ
    $IDNN=$_GET['id'];
    $sql_prd="SELECT*FROM ngaynghi WHERE IDNN=$IDNN";
    $query_prd=mysqli_query($conn, $sql_prd);
    $row_prd=mysqli_fetch_array($query_prd);
    $IDNV = $row_prd['IDNV'];
    $row_nhanvien=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));
// Nếu cấp trên duyệt đơn xin nghỉ
if (isset($_POST['yes'])) {
    $sql_UPDATE="UPDATE ngaynghi SET trangthai='3' WHERE ngaynghi.IDNN='$IDNN' ";
    $query_up = mysqli_query($conn,$sql_UPDATE);
    $sql_up_nv="UPDATE nhanvien SET nhanvien.songaynghi=nhanvien.songaynghi+1 WHERE nhanvien.IDNV='$IDNV' ";
    $query_up_nv = mysqli_query($conn,$sql_up_nv);
    header('location: index.php?page_layout=ngaynghi');
}
// cấp trên không duyệt đơn xin nghỉ
if (isset($_POST['no'])) {
    $sql_UPDATE="UPDATE ngaynghi SET trangthai='5' WHERE ngaynghi.IDNN='$IDNN' ";
    $query_up = mysqli_query($conn,$sql_UPDATE);
    // $sql_up_nv="UPDATE nhanvien SET nhanvien.songaynghi=nhanvien.songaynghi+1 WHERE nhanvien.IDNV='$IDNV' ";
    // $query_up_nv = mysqli_query($conn,$sql_up_nv);
    header('location: index.php?page_layout=ngaynghi');
}

?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=ngaynghi">Quản lý ngày nghỉ</a></li>
            <li class="active">Xem thông tin</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đơn xin nghỉ của nhân viên: <?php echo $row_nhanvien['hoten'];?></h1>
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
                                <p required class="form-control"><?php echo $row_nhanvien['hoten'];?></p>
                            </div>

                            <div class="form-group">
                                <label>Tổng số ngày nghỉ</label>
                                <p required class="form-control"><?php echo $row_nhanvien['songaynghi'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Ngày xin nghỉ</label>
                                <p required class="form-control"><?php echo $row_prd['ngay'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Lý do</label>
                                <p required class="form-control"><?php echo $row_prd['lydo'];?></p>
                            </div>
                            <a href="index.php?page_layout=ngaynghi" class="btn btn-warning">Quay Lại</a>
                            <!-- chỉ cấp trên mới có thể duyệt đơn -->
                            <?php 
                            $row_check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien "));
                            if ($row_prd['IDND']==$row['IDNV']) { ?>
                                <button type="submit" name="yes" class="btn btn-success">Đồng ý</button>
                                <button type="submit" name="no" class="btn btn-danger">Không đồng ý</button>
                            <?php } ?>
                            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <br>
                            <div>
                                <img width="100" height="100" src="modules/nhanvien/img/<?php echo $row_nhanvien['anhdaidien'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                                <?php
                                $ca=$row_nhanvien['IDPB'];
                                $sql_cat="SELECT*FROM phongban WHERE IDPB='$ca' ";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                $row_cat=mysqli_fetch_array($query_cat);?>
                                <p required class="form-control"> <?php echo $row_cat['tenphong'];?></p>
                        </div>

                        <div class="form-group">
                            <label>Chức vụ</label>
                            <?php $ra="";
                                $row_user=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM user WHERE user.IDNV='$IDNV' "));
                                if ($row_user['role']==1){$ra="Giám đốc";}
                                else if($row_user['role']==3){$ra="Nhân viên";}
                                else {$ra="Trưởng phòng";}
                            ?>
                            <p required class="form-control"><?php echo $ra;?></p>
                        </div>
                            
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>

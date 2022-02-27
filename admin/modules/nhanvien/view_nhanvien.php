<!-- trang xem thông tin chi tiết của nhân viên -->
<?php
if (!defined('nhanvien')) {
    die('ban truy cap sai cach');
}
    $sql = "SELECT * FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $id_nv = $row['IDNV'];
    // $IDNV=$_GET['id'];

    if(isset($_POST['change'])){
        $sql_prd="SELECT*FROM nhanvien WHERE nhanvien.IDNV=$id_nv";
        $query_prd=mysqli_query($conn, $sql_prd);
        $row_prd=mysqli_fetch_array($query_prd);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $_FILES['anhdaidien']['tmp_name']);
        $mimesize = $_FILES['anhdaidien']['size'];
        if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png') {
            if ($mimesize > 1000000) { $error = '<div class="alert alert-danger">Kích thước ảnh cần nhỏ hơn 1MB</div>';}
            else {
                if($anhdaidien=$_FILES['anhdaidien']['name'] !=''){
                    $anhdaidien=$_FILES['anhdaidien']['name'];
                    $tmp_name=$_FILES['anhdaidien']['tmp_name'];
                    move_uploaded_file($tmp_name,'modules/nhanvien/img/'.$anhdaidien);
                } else {$anhdaidien=$row_prd['anhdaidien'];}

                $sql_up = "UPDATE nhanvien SET anhdaidien='$anhdaidien' WHERE nhanvien.IDNV='$id_nv' ";
                $query_up=mysqli_query($conn, $sql_up);
                header('location: index.php?page_layout=view_nhanvien');
            }
        } else {
            $error = '<div class="alert alert-danger">Ảnh không hợp lệ! Hãy chọn ảnh có định dạng jpeg, png, gif, jpg</div>';
        }       
    }


    if ($row['role']==3 || $row['role']==2){ ?>
        <?php
            $sql_1 = "SELECT * FROM nhanvien JOIN user WHERE nhanvien.IDNV='$id_nv'";
            $row_1=mysqli_fetch_array(mysqli_query($conn,$sql_1));
         ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Thông tin</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Xin chào: <?php echo $row_1['hoten'];?></h1>
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
                                <p required class="form-control"><?php echo $row_1['hoten'];?></p>
                            </div>

                            <div class="form-group">
                                <label>Quê quán</label>
                                <p required class="form-control"><?php echo $row_1['quequan'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <p required class="form-control"><?php echo $row_1['ngaysinh'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p required class="form-control"><?php echo $row_1['email'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <p required class="form-control"><?php echo $row_1['gioitinh'];?></p>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                                if (isset($error)) {
                                    echo $error;
                            } ?>
                            <label>Ảnh đại diện</label>
                            <br>
                            <div>
                                <img width="100" height="100" src="modules/nhanvien/img/<?php echo $row_1['anhdaidien'];?>">
                            </div>
                            <input class="form-control" type="file" name="anhdaidien">
                            <br>
                            <button class="form-control btn btn-primary" type="submit" name="change">Thay đổi ảnh đại diện</button>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                                <?php
                                $ca=$row_1['IDPB'];
                                $sql_cat="SELECT*FROM phongban WHERE IDPB='$ca' ";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                $row_cat=mysqli_fetch_array($query_cat);?>
                                <p required class="form-control"> <?php echo $row_cat['tenphong'];?></p>
                        </div>

                        <div class="form-group">
                            <label>Chức vụ</label>
                            <?php
                            $ra="Nhân viên";
                            if($row["role"]==2){$ra="Trưởng phòng";}?>
                            <p required class="form-control"><?php echo $ra;?></p>
                        </div>
                        <div class="form-group">
                                <label>Số ngày nghỉ</label>
                                <p required class="form-control"><?php echo $row_1['songaynghi'];?></p>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>
    <?php } else { $IDNV=$_GET['id'];
    $sql_prd="SELECT*FROM nhanvien WHERE IDNV=$IDNV";
    $query_prd=mysqli_query($conn, $sql_prd);
    $row_prd=mysqli_fetch_array($query_prd);
    ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <?php if (defined("admin") || defined("truongphong")) { ?>
            <li><a href="index.php?page_layout=nhanvien">Quản lý nhân viên</a></li>
            <?php } ?>
            <li class="active">Xem thông tin</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Nhân viên: <?php echo $row_prd['hoten'];?></h1>
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
                                <p required class="form-control"><?php echo $row_prd['hoten'];?></p>
                            </div>

                            <div class="form-group">
                                <label>Quê quán</label>
                                <p required class="form-control"><?php echo $row_prd['quequan'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <p required class="form-control"><?php echo $row_prd['ngaysinh'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p required class="form-control"><?php echo $row_prd['email'];?></p>
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <p required class="form-control"><?php echo $row_prd['gioitinh'];?></p>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <!-- <input type="file" name="anhdaidien"> -->
                            <br>
                            <div>
                                <img width="100" height="100" src="modules/nhanvien/img/<?php echo $row_prd['anhdaidien'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                                <?php
                                $ca=$row_prd['IDPB'];
                                $sql_cat="SELECT*FROM phongban WHERE IDPB='$ca' ";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                $row_cat=mysqli_fetch_array($query_cat);?>
                                <p required class="form-control"> <?php echo $row_cat['tenphong'];?></p>
                        </div>

                        <div class="form-group">
                            <label>Chức vụ</label>
                            <?php 
                                $cc=$row_prd['IDNV'];
                                $sql_cc="SELECT*FROM user WHERE IDNV='$cc' ";
                                $query_cc=mysqli_query($conn, $sql_cc);
                                $row_cc=mysqli_fetch_array($query_cc);
                            $ra="Nhân viên";
                            if($row_cc["role"]==2){$ra="Trưởng phòng";}?>
                            <!-- <p><?php echo $row_cc['role']; ?></p> -->
                            <p required class="form-control"><?php echo $ra;?></p>
                        </div>
                        <div class="form-group">
                                <label>Số ngày nghỉ</label>
                                <p required class="form-control"><?php echo $row_prd['songaynghi'];?></p>
                            </div>
                            <a href="index.php?page_layout=nhanvien" class="btn btn-warning">Quay Lại</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>
    <?php } ?>

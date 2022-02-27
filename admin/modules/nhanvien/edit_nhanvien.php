<!-- trang chỉnh sửa thông tin nhân viên -->
<?php
if (!defined('nhanvien')) {
    die('ban truy cap sai cach');
}
$IDNV=$_GET['id'];
$sql_prd="SELECT*FROM nhanvien INNER JOIN user WHERE nhanvien.IDNV=$IDNV";
$query_prd=mysqli_query($conn, $sql_prd);
$row_prd=mysqli_fetch_array($query_prd);
$email_old = $row_prd['email'];
$role_old = $row_prd['role'];

    if(isset($_POST['sbm'])){
        $hoten=$_POST['hoten'];
        $quequan=$_POST['quequan'];
        $ngaysinh=$_POST['ngaysinh'];
        $email=$_POST['email'];
        $gioitinh=$_POST['gioitinh'];
        if($anhdaidien=$_FILES['anhdaidien']['name'] !=''){
            $anhdaidien=$_FILES['anhdaidien']['name'];
            $tmp_name=$_FILES['anhdaidien']['tmp_name'];
            move_uploaded_file($tmp_name,'modules/nhanvien/img/'.$anhdaidien);
        }else{$anhdaidien=$row_prd['anhdaidien'];}

        // $IDPB=$_POST['IDPB'];
        $role=$_POST['role'];
        $songaynghi=$_POST['songaynghi'];

        $sql="UPDATE nhanvien SET hoten='$hoten',quequan='$quequan',ngaysinh='$ngaysinh',email='$email',gioitinh='$gioitinh',anhdaidien='$anhdaidien',songaynghi='$songaynghi' WHERE IDNV='$IDNV'";
        $query=mysqli_query($conn, $sql);
        header('location: index.php?page_layout=nhanvien');

        if ($email != $email_old){
            $sql_user = "UPDATE user SET username='$email', password='$email' WHERE IDNV='$IDNV'";
            mysqli_query($conn, $sql_user);
            header("location: index.php?page_layout=nhanvien");
        }

        // if ($role != $role_old){
        //     $sql_role = "UPDATE user SET role='$role' WHERE IDNV='$IDNV'";
        //     mysqli_query($conn, $sql_role);
        //     header("location: index.php?page_layout=nhanvien");
        // }
    }

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=nhanvien">Quản lý nhân viên</a></li>
            <li class="active">Sửa thông tin</li>
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
                                <input type="text" name="hoten" required class="form-control" value="<?php echo $row_prd['hoten'];?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Quê quán</label>
                                <input type="text" name="quequan" required value="<?php echo $row_prd['quequan'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" data-date="" data-date-format="DD MMMM YYYY" name="ngaysinh" required value="<?php echo $row_prd['ngaysinh'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required value="<?php echo $row_prd['email'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <input type="text" name="gioitinh" required value="<?php echo $row_prd['gioitinh'];?>" type="text" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" name="anhdaidien">
                            <br>
                            <div>
                                <img width="100" height="100" src="modules/nhanvien/img/<?php echo $row_prd['anhdaidien'];?>">
                            </div>
                        </div>
                        <!-- edit phong ban -->
                        <!-- <div class="form-group">
                            <label>Phòng ban</label>
                            <select name="IDPB" class="form-control">
                                <?php
                                $sql_cat="SELECT*FROM phongban ORDER BY IDPB";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                while($row_cat=mysqli_fetch_array($query_cat)){?>
                                    <option <?php if($row_prd['IDPB']==$row_cat['IDPB']){echo 'selected';}?> value=<?php echo $row_cat['IDPB'];?>><?php echo $row_cat['tenphong'];?></option>
                                <?php }?>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label>Phòng ban</label>
                                <?php
                                $ca=$row_prd['IDPB'];
                                $sql_cat="SELECT*FROM phongban WHERE IDPB='$ca' ";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                $row_cat=mysqli_fetch_array($query_cat);?>
                                <p required class="form-control"> <?php echo $row_cat['tenphong'];?></p>
                        </div>
                        <!-- <div class="form-group">
                            <label>Chức vụ</label>
                            <select name="role" class="form-control">
                                <option <?php if($row_prd["role"]==2){echo "selected";}?> value=2>Trưởng phòng</option>
                                <option <?php if($row_prd["role"]==3){echo "selected";}?> value=3>Nhân viên</option>

                            </select>
                        </div> -->
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <?php
                                $cc=$IDNV;
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
                                <input type="text" name="songaynghi" required value="<?php echo $row_prd['songaynghi'];?>" type="text" class="form-control">
                            </div>
                        <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
                        <button type="reset" class="btn btn-primary">Làm mới</button>
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
<!--/.main-->
<!-- trang thay đổi thông tin phòng ban -->
    <?php
    if(!defined('admin')){
        die('ban truy cap sai cach');
    }
    $IDPB=$_GET['id'];
    $sql="SELECT*FROM phongban WHERE IDPB=$IDPB";
    $query=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($query);
    if(isset($_POST['sbm'])){
        $tenphong=$_POST['tenphong'];
        $motaphong=$_POST['motaphong'];
        $sophong=$_POST['sophong'];
        $IDTP=$_POST['IDTP'];
        $sql_UPDATE="UPDATE phongban SET tenphong='$tenphong', motaphong='$motaphong',sophong='$sophong' WHERE IDPB='$IDPB'";
        mysqli_query($conn, $sql_UPDATE);
        header('location: index.php?page_layout=phongban');

        //truong phong
        $sql_tp = "SELECT * FROM truongphong WHERE IDPB='$IDPB'";
        $query_tp = mysqli_query($conn,$sql_tp);
        $row_tp = mysqli_fetch_array($query_tp);
        // update truong phong
        $sql_cre="";
        if (mysqli_num_rows($query_tp)==0){
            $sql_cre = "INSERT INTO truongphong(IDNV, IDPB) VALUE ('$IDTP','$IDPB')";
        } else {
            $sql_cre = "UPDATE truongphong SET IDNV='$IDTP', IDPB='$IDPB' WHERE IDPB='$IDPB'";
        }
        $query_cre = mysqli_query($conn,$sql_cre);
        $row_cre = mysqli_fetch_array($query_cre);

        $sql_1="SELECT * FROM user JOIN nhanvien WHERE user.IDNV = nhanvien.IDNV AND nhanvien.IDPB='$IDPB'";
        $query_1 = mysqli_query($conn,$sql_1);
        $row_1 = mysqli_fetch_array($query_1);
        $id_nv = $row_tp['IDNV'];
        // update trạng thái công việc của trưởng phòng cũ
        $query_2 = mysqli_query($conn,"UPDATE user SET role=3 WHERE IDNV='$id_nv'");
        $query_3 = mysqli_query($conn,"UPDATE user SET role=2 WHERE IDNV='$IDTP'");
        $query_4 = mysqli_query($conn,"UPDATE congviec SET congviec.trangthai=1 WHERE IDNV='$IDTP' AND congviec.trangthai!=6 AND congviec.trangthai!=3");

        // update ngày nghỉ của nhân viên
        $id1 = $row_tp['IDNV'];
        $query_5 = mysqli_query($conn,"UPDATE ngaynghi SET IDND='$IDTP' WHERE IDNV='$id_nv' ");
        // update ngày nghỉ của trưởng phòng
        $query_6 = mysqli_query($conn,"UPDATE ngaynghi SET IDND='1' WHERE IDNV='$IDTP' ");
    }
    ?>			
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="index.php?page_layout=phongban">Quản lý phòng ban</a></li>
				<li class="active">Chỉnh sửa phòng ban</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Phòng ban:<?php echo $row['tenphong'];?></h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <!-- <div class="alert alert-danger">Danh mục đã tồn tại !</div> -->
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên phòng ban:</label>
                                <input type="text" name="tenphong" required value="<?php echo $row['tenphong'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            
                            <div class="form-group">
                                <label>Số phòng:</label>
                                <input type="number" name="sophong" required value="<?php echo $row['sophong'];?>" class="form-control" placeholder="Số phòng...">
                            </div>
                            <div class="form-group">
                                <label>Mô tả phòng ban:</label>
                                <input type="text" name="motaphong" required value="<?php echo $row['motaphong'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <!-- Hiển thị danh sách nhân viên trong phòng ban để chọn trưởng phòng -->
                            <div class="form-group">
                            <label>Chọn trưởng phòng: </label>
                            <select name="IDTP" class="form-control">
                                <?php
                                $a= $row['IDPB'];
                                $sql_cat="SELECT*FROM nhanvien WHERE IDPB='$a'";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                while($row_cat=mysqli_fetch_array($query_cat)){?>
                                    <option <?php if($row['IDPB']==$row_cat['IDPB']){echo 'selected';}?> value=<?php echo $row_cat['IDNV'];?>><?php echo $row_cat['hoten'];?></option>
                                <?php }?>
                            </select>
                            </div>
                       
                            <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-primary">Làm mới</button>
                            <a href="index.php?page_layout=phongban" class="btn btn-warning">Quay Lại</a>
                             </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	


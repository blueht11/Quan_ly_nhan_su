<!-- trang hiển thị lịch sử các ngày đã nghỉ của nhân viên -->
<?php
	// lấy các thông tin cần thiết để hiển thị
	$row_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE username='$mail' AND password='$pass'"));
	$IDNV = $row_user['IDNV'];
	
	$query_tp = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDNV='$IDNV' ");
	$row=mysqli_fetch_array($query_tp);

	$IDNN=$_GET['id'];
    $sql_prd="SELECT*FROM ngaynghi WHERE IDNV=$IDNV";
    $query_prd=mysqli_query($conn, $sql_prd);
    $row_prd=mysqli_fetch_array($query_prd);

	$row_nhanvien=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="index.php?page_layout=ngaynghi">Quản lý ngày nghỉ</a></li>
			<li class="active">Lịch sử ngày nghỉ</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lịch sử ngày nghỉ</h1>
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
                            	<table data-toolbar="#toolbar" class="table">
		                            <thead>
			                            <tr>
			                                <th data-field="id" data-sortable="true">STT</th>
			                                <th data-field="id">Ngày xin nghỉ</th>
			                                <th data-field="id">Lý do</th>
			                                <th data-field="id">Kết quả</th>
			                            </tr>
			                        </thead>
			                        <tbody>
										<?php 
									    $query = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDNV='$IDNV'");
									    $stt=0;
									    while ($row=mysqli_fetch_array($query)) { $stt=$stt+1 ?>
									    	<tr>
									            <td style=""><?php echo $stt;?></td>
									        	<td style=""><?php echo $row['ngay'];?></td>
									        	<td style=""><?php echo $row['lydo'];?></td>
									        	<!-- Hiển thị kết quả của đơn xin nghỉ -->
									        	<?php 
									        		$ketqua="";
									        		if($row['trangthai']==0) { $ketqua = "Đang chờ xét";}
									        		else if ($row['trangthai']==3) {$ketqua = "Đã duyệt";}
									        		else {$ketqua = "Không được duyệt";}
									        	?>
									        	<td style=""><?php echo $ketqua;?></td>
									        </tr>
									    <?php } ?>
									    	<!-- <tr>
									            <td>1</td>
									        	<td>2</td>
									        	<td>3</td>
									        </tr> -->
			                        </tbody>
			                    </table>
                            </div>
                            <a href="index.php?page_layout=ngaynghi" class="btn btn-warning">Quay Lại</a>
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
                            <?php
                            	$ra="";
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
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
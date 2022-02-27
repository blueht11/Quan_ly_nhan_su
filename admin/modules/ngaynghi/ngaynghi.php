<!-- trang hiển thị danh sách ngày nghỉ -->
<?php
	$row_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE username='$mail' AND password='$pass'"));
	$IDNV = $row_user['IDNV'];
	
	$query_tp = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDNV='$IDNV' ");
	$row=mysqli_fetch_array($query_tp);

	$row_abc = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý ngày nghỉ</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý ngày nghỉ</h1>
		</div>
	</div>
	<!--/.row-->
	<?php if (!defined('admin')) { ?>
		<!-- Hiển thị nút xin nghỉ khi nhân viên vẫn chưa sử dụng hết ngày nghỉ -->
		<div id="toolbar" class="btn-group">
			<?php if($row_abc['songaynghi']<20 && defined('truongphong')){ ?>
					<a href="index.php?page_layout=add_ngaynghi" class="btn btn-success">Xin nghỉ phép</a>
			<?php } ?>
			
			<?php if($row_abc['songaynghi']<15 && !defined('truongphong')){ ?>
					<a href="index.php?page_layout=add_ngaynghi" class="btn btn-success">Xin nghỉ phép</a>
			<?php } ?>
			<!-- Hiển thị lịch sử ngày nghỉ khi nhân viên đã nghỉ trên 1 ngày -->
			<?php if($row_abc['songaynghi']!=0){?>
				<a href="index.php?page_layout=lichsu&id=<?php echo $row['IDNV'];?>" class="btn btn-primary">Các ngày đã nghỉ</a>
			<?php } ?>
			
		</div>
	<?php } ?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">STT</th>
								<th>Tên nhân viên</th>
								<th>Chức vụ</th>
								<th>Ngày xin nghỉ</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//
							if(isset($_GET['page'])){
								$page=$_GET['page'];
							}else{$page=1;}
							$row_per_page=10;
							$per_page=$page*$row_per_page-$row_per_page;
							//
							$total_row=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM ngaynghi"));
							$total_page=ceil($total_row/$row_per_page);
							$list_page=" ";
							//// previous page
							$prv_page=$page-1;
							if($prv_page<1){
								$prv_page=1;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$prv_page.'">&laquo;</a></li>';
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_page; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
							//page next
							$next_page=$page+1;
							if($next_page>$total_page){
								$next_page=$total_page;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=ngaynghi&page='.$next_page.'">&raquo;</a></li>';
							$query = mysqli_query($conn, "SELECT * FROM ngaynghi ORDER BY ngaynghi.IDNN ASC LIMIT $per_page,$row_per_page");
							$stt=0;
							?>
<!-- --------------------------------------------------------role 1------------------------------------------------------------ -->
		<?php if (defined('admin')) {
			// lấy thông tin của bảng truongphong
			$row_tp = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM truongphong"));
			// Nếu chưa có trưởng phòng nào thì set IDTP="" để tránh bị lỗi.
			$IDTP = "";
			if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM truongphong"))!=0){
				$IDTP = $row_tp['IDNV'];
			}
			
			$query_tp = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDND=1 AND ngaynghi.trangthai=0 ORDER BY ngaynghi.IDNN ASC LIMIT $per_page,$row_per_page");
			while ($row=mysqli_fetch_array($query_tp)) { $stt=$stt+1;?>
			<form role="form" method="post" enctype="multipart/form-data">
			<tr>
				<td style=""><?php echo $stt;?></td>
				<?php $query_a = mysqli_query($conn, "SELECT * FROM ngaynghi LEFT JOIN nhanvien ON ngaynghi.IDNV=nhanvien.IDNV ORDER BY ngaynghi.IDNV ASC LIMIT $per_page,$row_per_page");
                	$row_user=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM user WHERE user.IDNV='$IDTP' "));
                	$id1=$row['IDNV'];
                	$ten=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$id1' "));
				?>
				<td style="" name="idd" value="<?php echo $ten['IDNV'];?> "><?php echo $ten['hoten'];?></td>
				<td><span class="label label-<?php if ($row_user['role'] == 2) {
                                                echo "primary";
                                            } else if ($row_user['role'] == 1){
                                                echo "danger";
                                            } else {
                                                echo "success";
                                            }; ?>"><?php if ($row_user['role'] == 2) {
                                                echo "Trưởng phòng";
                                            }else if ($row_user['role'] == 1){
                                                echo "Giám đốc";
                                            } else { 
                                                echo "Nhân viên";
                                            }; ?>
            	</span></td>
				<td style=""><?php echo $row['ngay'];?></td>
				<td class="form-group">
					
					<a href="index.php?page_layout=view_ngaynghi&id=<?php echo $row['IDNN'];?>" class="btn btn-primary">Xem đơn</a>
						
                    
				</td>
			</tr>
		</form>

		<?php } } ?>
<!-- --------------------------------------------------------role 2------------------------------------------------------------ -->
		<?php if (defined('truongphong')) {
			$row_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE username='$mail' AND password='$pass'"));
			$IDTP = $row_user['IDNV'];
			$query_tp = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDND='$IDTP' AND ngaynghi.trangthai=0  ORDER BY ngaynghi.IDND ASC LIMIT $per_page,$row_per_page");
			// hiển thị ngày nghỉ 
			while ($row=mysqli_fetch_array($query_tp)) { $stt=$stt+1; ?>
			<tr>
				<td style=""><?php echo $stt;?></td>
				<?php 
					$IDNV = $row['IDNV'];
					$row_nhanvien=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));
					$row_user_tp=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM user WHERE user.IDNV = '$IDNV' "));
				?>
				<td style=""><?php echo $row_nhanvien['hoten'];?></td>
				<td><span class="label label-<?php if ($row_user_tp['role'] == 2) {
                                                echo "primary";
                                            } else if ($row_user_tp['role'] == 1){
                                                echo "danger";
                                            } else {
                                                echo "success";
                                            }; ?>"><?php if ($row_user_tp['role'] == 2) {
                                                echo "Trưởng phòng";
                                            }else if ($row_user_tp['role'] == 1){
                                                echo "Giám đốc";
                                            } else { 
                                                echo "Nhân viên";
                                            }; ?>
            	</span></td>
				<td style=""><?php echo $row['ngay'];?></td>
				<td class="form-group">

					<a href="index.php?page_layout=view_ngaynghi&id=<?php echo $row['IDNN'];?>" class="btn btn-primary">Xem</a>
				</td>
			</tr>
		
		<?php } } ?>

<!-- --------------------------------------------------------role 3------------------------------------------------------------ -->
		<?php if (defined('nhanvien')) {
			$row_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE username='$mail' AND password='$pass'"));
			$IDNV = $row_user['IDNV'];
			$query_tp = mysqli_query($conn, "SELECT * FROM ngaynghi WHERE ngaynghi.IDNV='$IDNV' AND ngaynghi.trangthai=0  ORDER BY ngaynghi.IDND ASC LIMIT $per_page,$row_per_page");
			while ($row=mysqli_fetch_array($query_tp)) { $stt=$stt+1; ?>
			<tr>
				<td style=""><?php echo $stt;?></td>
				<?php
					$row_nhanvien=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$IDNV' "));
				?>
				<td style=""><?php echo $row_nhanvien['hoten'];?></td>
				<td><span class="label label-<?php if ($row_user['role'] == 2) {
                                                echo "primary";
                                            } else if ($row_user['role'] == 1){
                                                echo "danger";
                                            } else {
                                                echo "success";
                                            }; ?>"><?php if ($row_user['role'] == 2) {
                                                echo "Trưởng phòng";
                                            }else if ($row_user['role'] == 1){
                                                echo "Giám đốc";
                                            } else { 
                                                echo "Nhân viên";
                                            }; ?>
            	</span></td>
				<td style=""><?php echo $row['ngay'];?></td>
				<td class="form-group">
					<a href="index.php?page_layout=view_ngaynghi&id=<?php echo $row['IDNN'];?>" class="btn btn-primary">Xem</a>
				</td>
			</tr>
		
		<?php } } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							
							<?php echo $list_page;?>
							
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
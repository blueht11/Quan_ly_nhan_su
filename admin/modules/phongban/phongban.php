<!-- trang hiển thị danh sách phòng ban -->
<?php
if (!defined('admin')) {
	$error_role = '<div class="alert alert-danger">Chỉ giám đốc mới có thể vào trang này!</div>';
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
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý phòng ban</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý phòng ban</h1>
		</div>
	</div>
	<!--/.row-->
	<div id="toolbar" class="btn-group">
		<a href="index.php?page_layout=add_phongban" class="btn btn-success">
			Thêm phòng ban
		</a>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">ID phòng</th>
								<th>Tên phòng ban</th>
								<th>Số phòng</th>
								<th>Mô tả</th>
								<th>Trưởng phòng</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<!-- Phân trang -->
							<?php
							//
							if(isset($_GET['page'])){
								$page=$_GET['page'];
							}else{$page=1;}
							$row_per_page=3;
							$per_page=$page*$row_per_page-$row_per_page;
							//
							$total_row=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM phongban"));
							$total_page=ceil($total_row/$row_per_page);
							$list_page=" ";
							//// previous page
							$prv_page=$page-1;
							if($prv_page<1){
								$prv_page=1;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=phongban&page='.$prv_page.'">&laquo;</a></li>';
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=phongban&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_page; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=phongban&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=phongban&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=phongban&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
							//page next
							$next_page=$page+1;
							if($next_page>$total_page){
								$next_page=$total_page;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=phongban&page='.$next_page.'">&raquo;</a></li>';
							// Kết thúc phân trang, hiển thị danh sách phòng ban
							$query = mysqli_query($conn, "SELECT * FROM phongban ORDER BY phongban.IDPB ASC LIMIT $per_page,$row_per_page");
							while ($row=mysqli_fetch_array($query)) { ?>
								<tr>
									<td style=""><?php echo $row['IDPB'];?></td>
									<td style=""><?php echo $row['tenphong'];?></td>
									<td style=""><?php echo $row['sophong'];?></td>
									<td style=""><?php echo $row['motaphong'];?></td>
									<!-- Lấy tên trưởng phòng -->
									<?php $query_a = mysqli_query($conn, "SELECT * FROM phongban LEFT JOIN nhanvien ON phongban.IDPB=nhanvien.IDPB ORDER BY phongban.IDPB ASC LIMIT $per_page,$row_per_page");
									$row_a=mysqli_fetch_array($query_a); ?>
									<?php
										$ia = $row['IDPB'];
										$sql_1="SELECT * FROM nhanvien JOIN truongphong WHERE nhanvien.IDNV=truongphong.IDNV AND truongphong.IDPB='$ia'";
										$row_1=mysqli_fetch_array(mysqli_query($conn,$sql_1));
										$khong = "";
                                            if (!isset($row_1['hoten'])){$khong="Chưa có!";}
                                            else {$khong=$row_1['hoten'];}
									?>
									<td style=""><?php echo $khong;?></td>
									<td class="form-group">
										<a href="index.php?page_layout=edit_phongban&id=<?php echo $row['IDPB'];?>" class="btn btn-primary">Chỉnh sửa</a>
										<a href="index.php?page_layout=view_phongban&id=<?php echo $row['IDPB'];?>" class="btn btn-success">Xem</a>
										<a href="del_phongban.php?id=<?php echo $row['IDPB'];?>" onclick="return confirm('Bạn có chắc chắn xóa phòng ban này? Tất cả nhân viên trong phòng ban sẽ bị xóa!');" class="btn btn-danger">Xóa</a>
									</td>
								</tr>
							<?php } ?>
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
<?php } ?>
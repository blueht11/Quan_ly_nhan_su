<!-- layout hiển thị danh sách tài khoản của công ty -->
<?php
if (!defined('nhanvien')) {
    die('ban truy cap sai cach');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách tài khoản</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách tài khoản</h1>
        </div>
    </div>
    <!-- <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_user" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm tài khoản
        </a>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">STT</th>
                                <th data-field="name" data-sortable="true">Tên nhân viên</th>
                                <th data-field="price" data-sortable="true">Username</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- phân trang -->
                            <?php
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }else{$page=1;}
                            $row_per_page=10; //Số hàng hiển thị
                            $per_page=$page*$row_per_page-$row_per_page;
                            $total_page=mysqli_num_rows(mysqli_query($conn,"SELECT*FROM user"));
                            $total_row=ceil($total_page/$row_per_page);
                            // declare variable
                            $list_page=" ";
                            // previous page
                            $row_prv=$page-1;
                            if($row_prv<1){
                                $row_prv=1;
                            }
                            $list_page='<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$row_prv.'"">&laquo;</a></li>';
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_row; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_row; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_row; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
                            // next page
                            $row_next=$page+1;
                            if($row_next>$total_row){
                                $row_next=$total_row;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$row_next.'">&raquo;</a></li>';
                            // hoàn tất phân trang, hiển thị danh sách user
                            $sql = "SELECT*FROM user LIMIT $per_page,$row_per_page";
                            $query = mysqli_query($conn, $sql);
                            $stt=0;
                            while ($row = mysqli_fetch_array($query)) { $stt=$stt+1;?>
                                <tr>
                                    <td style=""><?php echo $stt;?></td>
                                    <?php 
                                        $idnvv = $row['IDNV'];
                                        $row_nv = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$idnvv' "));
                                    ?>
                                    <td style=""><?php echo $row_nv['hoten'];?></td>
                                    <td style=""><?php echo $row['username'];?></td>
                                    <td><span class="label label-<?php if($row['role']==1){echo "danger";}else if($row['role']==2){echo 'primary';}else{echo"success";}?>"><?php if($row['role']==1){echo 'Giám đốc';}else if($row['role']==2){echo'Trưởng phòng';}else{echo"Nhân viên";}?></span></td>
                                    <td class="form-group">

                                        <?php if($row['role']!=1){ ?>
                                            <!-- edit user -->
                                            <a href="index.php?page_layout=edit_user&id=<?php echo $row['ID'];?>" class="btn btn-primary">Chỉnh sửa</a>
                                            <!-- delete user -->
                                            <!-- <a href="del_user.php?id=<?php echo $row['ID'];?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa tài khoản này?');" ><i class="glyphicon glyphicon-remove"></i></a> -->
                                        <?php } ?>
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
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
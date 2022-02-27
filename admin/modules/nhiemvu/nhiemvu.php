<!-- trang hiển thị danh sách nhiệm vụ -->
<?php
// if (!defined('nhanvien')) {die('ban truy cap sai cach');}
$row = mysqli_fetch_array(mysqli_query($conn, "SELECT*FROM user WHERE username='$mail' AND password='$pass'"));
$role = $row['role'];
$id_nv = $row['IDNV'];
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách công việc</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách công việc</h1>
        </div>
    </div>
    <!--/.row-->
        <?php if ($role==2){ ?>
            <div id="toolbar" class="btn-group">
                <a href="index.php?page_layout=add_nhiemvu" class="btn btn-success">Thêm công việc</a>
            </div>
       <?php } ?>
       <?php if ($role==3){ ?>
            <div id="toolbar" class="btn-group">
                <a href="index.php?page_layout=new_nhiemvu" class="btn btn-success">Công việc mới</a>
            </div>
       <?php } ?>
<?php if ($role==2) { ?>
    <?php 
        $sql_tp = "SELECT * FROM truongphong WHERE truongphong.IDNV='$id_nv'";
        $row_1=mysqli_fetch_array(mysqli_query($conn,$sql_tp));
        $phong_tp = $row_1['IDTP'];
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">STT</th>
                                <th>Tiêu đề</th>
                                <th>Nhân viên thực hiện</th>
                                <!-- <th>Mô tảc</th> -->
                                <th>Trạng thái</th>
                                <!-- <th>Đánh giá</th> -->
                                
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- phân trang -->
                            <?php
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }else{$page=1;}
                            $row_per_page=5;
                            // $per_rows = $page * $row_per_page - $row_per_page;
                            $per_page=$page*$row_per_page-$row_per_page;
                            //
                            $total_row=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM congviec"));
                            $total_page=ceil($total_row/$row_per_page);
                            $list_page=" ";
                            //// previous page
                            $prv_page=$page-1;
                            if($prv_page<=1){ //<=
                                $prv_page=1;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$prv_page.'">&laquo;</a></li>';
                            if (!isset($_GET['page'])) {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == 1) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    for ($i = 2; $i <= $total_page; $i++) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == $_GET['page']) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    if ($i != $_GET['page']) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            }
                            //page next
                            $next_page=$page+1;
                            if($next_page>$total_page){
                                $next_page=$total_page;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$next_page.'">&raquo;</a></li>';
                            // hoàn tất phân trang, hiển thị nhiệm vụ
                            $query = mysqli_query($conn, "SELECT * FROM congviec WHERE congviec.IDTP='$phong_tp' ORDER BY congviec.IDCV ASC LIMIT $per_page,$row_per_page");
                            $stt=0;
                            while ($row=mysqli_fetch_array($query)) { $stt=$stt+1?>
                                <tr>
                                    <td style=""><?php echo $stt;?></td>
                                    <td style=""><?php echo $row['tencv'];?></td>   
                                    <?php
                                        $ia = $row['IDCV'];
                                        $sql_1="SELECT * FROM nhanvien JOIN congviec WHERE nhanvien.IDNV=congviec.IDNV AND congviec.IDCV='$ia'";
                                        $row_1=mysqli_fetch_array(mysqli_query($conn,$sql_1));
                                        $khong = ""; 
                                        if (!isset($row_1['hoten'])){$khong="Chưa có!";}
                                            else {$khong=$row_1['hoten'];}
                                    ?>
                                    <td style=""><?php echo $khong;?></td>
                                    <!-- <td style=""><?php echo $row['trangthai'];?></td> -->
                                    <td><span class="label label-<?php if ($row['trangthai'] == 1) {
                                                                            echo "primary";
                                                                        } else if ($row['trangthai'] == 2){
                                                                            echo "info";
                                                                        } else if ($row['trangthai'] == 3){
                                                                            echo "danger";
                                                                        } else if ($row['trangthai'] == 4){
                                                                            echo "default";
                                                                        } else if ($row['trangthai'] == 5){
                                                                            echo "warning";
                                                                        } else { echo "success";
                                                                        }; ?>"><?php if ($row['trangthai'] == 1) {
                                                                            echo "New";
                                                                        }else if ($row['trangthai'] == 2){
                                                                            echo "In process";
                                                                        }else if ($row['trangthai'] == 3){
                                                                            echo "Canceled";
                                                                        }else if ($row['trangthai'] == 4){
                                                                            echo "Waiting";
                                                                        }else if ($row['trangthai'] == 5){
                                                                            echo "Rejected";
                                                                        } else {echo "Completed"; }; ?>
                                        </span>
                                        <!-- Kiểm tra hạn nộp nếu nhiệm vụ đã hoàn tất -->
                                        <?php if ($row['trangthai']==6){ ?>
                                            <p></p>
                                            <?php if ($row['ngaynop'] <= $row['deadline']){ ?>
                                                <p class="label label-success">Đúng hạn</p>
                                            <?php } else { ?>
                                                <p class="label label-danger">Trễ hạn</p>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                        
                                    </td>

                                    <td class="form-group">
                                        <a href="index.php?page_layout=view_nhiemvu&id=<?php echo $row['IDCV'];?>" class="btn btn-primary">Xem</a>
                                        <!-- <?php if($row['trangthai'] == 1) { ?>
                                            <a href="del_nhiemvu.php?id=<?php echo $row['IDCV'];?>" onclick="return confirm('Bạn có chắc chắn xóa task này?');" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                            <button type="submit" name="delete" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                        <?php } ?> -->
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
<!-- ------------------------------------------------------- role 3 ----------------------------------------------------- -->
<?php } else { ?>
    <?php
        $row = mysqli_fetch_array(mysqli_query($conn, "SELECT*FROM user WHERE username='$mail' AND password='$pass'"));
        $IDNV = $row['IDNV'];
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">STT</th>
                                <th>Tiêu đề</th>
                                <!-- <th>Nhân viên thực hiện</th> -->
                                <!-- <th>Mô tảc</th> -->
                                <th>Trạng thái</th>
                                <th>Hạn nộp</th>
                                
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }else{$page=1;}
                            $row_per_page=10;
                            $per_page=$page*$row_per_page-$row_per_page;
                            //
                            $total_row=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM congviec"));
                            $total_page=ceil($total_row/$row_per_page);
                            $list_page=" ";
                            //// previous page
                            $prv_page=$page-1;
                            if($prv_page<1){
                                $prv_page=1;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$prv_page.'">&laquo;</a></li>';
                            if (!isset($_GET['page'])) {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == 1) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    for ($i = 2; $i <= $total_page; $i++) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == $_GET['page']) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    if ($i != $_GET['page']) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            }
                            //page next
                            $next_page=$page+1;
                            if($next_page>$total_page){
                                $next_page=$total_page;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=nhiemvu&page='.$next_page.'">&raquo;</a></li>';
                            $query = mysqli_query($conn, "SELECT * FROM congviec WHERE congviec.IDNV='$IDNV'AND congviec.trangthai NOT IN (3) ORDER BY congviec.IDCV ASC LIMIT $per_page,$row_per_page");
                            $stt=0;
                            while ($row=mysqli_fetch_array($query)) { $stt = $stt+1 ?>
                                <tr>
                                    <td style=""><?php echo $stt;?></td>
                                    <td style=""><?php echo $row['tencv'];?></td>   
                                    
                                    <td><span class="label label-<?php if ($row['trangthai'] == 1) {
                                                                            echo "primary";
                                                                        } else if ($row['trangthai'] == 2){
                                                                            echo "info";
                                                                        } else if ($row['trangthai'] == 3){
                                                                            echo "danger";
                                                                        } else if ($row['trangthai'] == 4){
                                                                            echo "default";
                                                                        } else if ($row['trangthai'] == 5){
                                                                            echo "warning";
                                                                        } else { echo "success";
                                                                        }; ?>"><?php if ($row['trangthai'] == 1) {
                                                                            echo "New";
                                                                        }else if ($row['trangthai'] == 2){
                                                                            echo "In process";
                                                                        }else if ($row['trangthai'] == 3){
                                                                            echo "Canceled";
                                                                        }else if ($row['trangthai'] == 4){
                                                                            echo "Waiting";
                                                                        }else if ($row['trangthai'] == 5){
                                                                            echo "Rejected";
                                                                        } else {echo "Completed"; }; ?>
                                        </span>
                                        <?php if ($row['trangthai']==6){ ?>
                                            <p></p>
                                            <?php if ($row['ngaynop'] <= $row['deadline']){ ?>
                                                <p class="label label-success">Đúng hạn</p>
                                            <?php } else { ?>
                                                <p class="label label-danger">Trễ hạn</p>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                    </td>
                                        <td style=""><?php echo $row['deadline'];?></td> 
                                    <td class="form-group">
                                        <a href="index.php?page_layout=view_nhiemvu&id=<?php echo $row['IDCV'];?>" class="btn btn-primary">Xem</a>
                                        <!-- <a href="del_nhiemvu.php?id=<?php echo $row['IDCV'];?>" onclick="return confirm('Bạn có chắc chắn xóa task này?');" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a> -->
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
<?php } ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
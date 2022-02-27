<!-- trang hiển thị danh sách nhiệm vụ mới của nhân viên -->
<?php
// if (!defined('nhanvien')) {die('ban truy cap sai cach');}
$row = mysqli_fetch_array(mysqli_query($conn, "SELECT*FROM user WHERE username='$mail' AND password='$pass'"));
$role = $row['role'];

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách công việc mới</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách công việc mới</h1>
        </div>
    </div>
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
                            $query = mysqli_query($conn, "SELECT * FROM congviec WHERE congviec.IDNV='$IDNV'AND congviec.trangthai='1' ORDER BY congviec.IDCV ASC LIMIT $per_page,$row_per_page");
                            $stt=0;
                            while ($row=mysqli_fetch_array($query)) { $stt = $stt+1 ?>
                                <tr>
                                    <td style=""><?php echo $stt;?></td>
                                    <td style=""><?php echo $row['tencv'];?></td>   
                                    
                                    <td><span class="label label-<?php if ($row['trangthai'] == 1) {
                                                                            echo "primary";
                                                                        }; ?>"><?php if ($row['trangthai'] == 1) {
                                                                            echo "New";} ?>
                                        </span></td>
                                        <td style=""><?php echo $row['deadline'];?></td> 
                                    <td class="form-group">
                                        <a href="index.php?page_layout=view_nhiemvu&id=<?php echo $row['IDCV'];?>" class="btn btn-primary">Xem</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="index.php?page_layout=nhiemvu" class="btn btn-warning">Trở về danh sách công việc</a>
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

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
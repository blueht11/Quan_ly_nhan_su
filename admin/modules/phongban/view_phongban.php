<!-- trang hiển thị danh sách nhân viên có trong phòng ban -->
<?php 
    $IDPB=$_GET['id'];
    $row_1 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM phongban WHERE phongban.IDPB='$IDPB' "));

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="index.php">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li><a href="index.php?page_layout=phongban">Quản lý phòng ban</a></li>
            <li>Nhân viên trong phòng</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách nhân viên phòng <?php echo $row_1['tenphong'] ?> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID nhân viên</th>
                                    <th data-field="name" data-sortable="true">Tên nhân viên</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Chức vụ</th>
                                    <th>Số ngày nghỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                $row_per_page = 5;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nhanvien WHERE nhanvien.IDPB='$IDPB' "));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $page_prev . '">&laquo;</a></li>';
                                
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=view_phongban&id='.$IDPB.'&page=' . $page_next . '">&raquo;</a></li>';
                                $sql = "SELECT * FROM nhanvien INNER JOIN user ON nhanvien.IDNV=user.IDNV AND nhanvien.IDPB='$IDPB' ORDER BY nhanvien.IDNV ASC LIMIT $per_rows, $row_per_page";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td style=""><?php echo $row['IDNV'] ?></td>
                                        <td style=""><?php echo $row['hoten'] ?></td>
                                        <td style="text-align: center"><img width="50" height="50" src="modules/nhanvien/img/<?php echo $row['anhdaidien']; ?>" /></td>
                                        <td><span class="label label-<?php if ($row['role'] == 2) {
                                                                            echo "primary";
                                                                        } else if ($row['role'] == 1){
                                                                            echo "danger";
                                                                        } else {
                                                                            echo "success";
                                                                        }; ?>"><?php if ($row['role'] == 2) {
                                                                            echo "Trưởng phòng";
                                                                        }else if ($row['role'] == 1){
                                                                            echo "Giám đốc";
                                                                        } else { 
                                                                            echo "Nhân viên";
                                                                        }; ?>
                                        </span></td>
                                        <td style=""><?php echo $row['songaynghi'] ?></td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    
                    </form>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php echo $list_page; ?>
                        </ul>
                    </nav>
                    <a href="index.php?page_layout=phongban" class="btn btn-warning ">Quay Lại</a>
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
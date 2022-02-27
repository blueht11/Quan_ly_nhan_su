<!-- trang hiển thị danh sách nhân viên trong công ty -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Danh sách nhân viên</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách nhân viên</h1>
        </div>
    </div>
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_nhanvien" class="btn btn-success">
            Thêm nhân viên
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $sql = "SELECT*FROM user WHERE username='$mail' AND password='$pass'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    if (isset($_SESSION['mail']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) {
                        $mail = $_SESSION['mail'];
                        $pass = $_SESSION['pass'];
                        $id = $_SESSION['id'];
                        $_GET['check'] = 1;
                        if ($row['role'] == 1) {
                            header('location: index.php?page_layout=edit_nhanvien&id=' . $id . '');
                            unset($_SESSION['id']);
                        } else {
                            $erorr = '<div class="alert alert-danger">Bạn không có quyền này!</div>';
                            unset($_SESSION['id']);
                        }
                    }
                    if (isset($_SESSION['mail']) && isset($_SESSION['pass']) && isset($_SESSION['id_del']) && isset($_SESSION['idnv_del']) && isset($_SESSION['img'])) {
                        $id_delete = $_SESSION['id_del'];
                        $idnv_delete = $_SESSION['idnv_del'];
                        $img = $_SESSION['img'];
                        if ($row['role'] == 1) {
                            header('location: del_nhanvien.php?id=' . $id_delete . '&name=' . $idnv_delete . '&img=' . $img . '');
                            unset($_SESSION['id_del']);
                            unset($_SESSION['idnv_del']);
                        } else {
                            $erorr_del = '<div class="alert alert-danger">Bạn không có quyền xóa' . $_SESSION['idnv_del'] . ' này!!!</div>';
                            unset($_SESSION['id_del']);
                            unset($_SESSION['idnv_del']);
                        }
                    }
                    if (isset($erorr)) {
                        echo $erorr;
                    }
                    if (isset($erorr_del)) {
                        echo $erorr_del;
                    }
                    ?>
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID nhân viên</th>
                                    <th data-field="name" data-sortable="true">Tên nhân viên</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Chức vụ</th>
                                    <th>Số ngày nghỉ</th>
                                    <th>Phòng ban</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                $row_per_page = 10;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nhanvien"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=del_nhanvien&page=' . $page_prev . '">&laquo;</a></li>';
                                
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhanvien&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhanvien&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=nhanvien&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhanvien&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=nhanvien&page=' . $page_next . '">&raquo;</a></li>';
                                $sql = "SELECT * FROM nhanvien INNER JOIN user ON nhanvien.IDNV=user.IDNV ORDER BY nhanvien.IDNV ASC LIMIT $per_rows, $row_per_page";
                                $query = mysqli_query($conn, $sql);
                                // if (!$query) {
                                //     echo "Error:", mysqli_error($conn);
                                //     exit();
                                // }
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
                                        <?php $te = $row['IDPB'] ?>
                                        <?php $sql_a = "SELECT * FROM phongban WHERE phongban.IDPB='$te'";
                                            $query_a = mysqli_query($conn, $sql_a);
                                            $row_a = mysqli_fetch_array($query_a);
                                            $khong = "";
                                            if (!isset($row_a['tenphong'])){$khong="Chưa có!";}
                                            else {$khong=$row_a['tenphong'];}
                                            ?>
                                        <td><?php echo $khong ?></td>
                                        <?php if ($row['role'] != 1) { ?>
                                            <td class="form-group">
                                                <a href="controller_nhanvien.php?id=<?php echo $row['IDNV']; ?>" class="btn btn-primary">Chỉnh sửa</a>
                                                <a href="del_nhanvien.php?id=<?php echo $row['IDNV'];?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa nhân viên này?');" >Xóa</a>
                                                <a href="index.php?page_layout=view_nhanvien&id=<?php echo $row['IDNV']; ?>" class="btn btn-success">Xem</a>
                                            </td>
                                        <?php } ?>
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
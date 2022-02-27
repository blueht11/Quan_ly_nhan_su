<!-- trang hiển thị thông tin tài khoản đăng nhập -->
<?php
// if (!defined('nhanvien')) {
//     die('Bạn không có quyền truy cập file account');
// }
include_once('modules/connect/connect.php');
$mail=$_SESSION['mail'];
$pass=$_SESSION['pass'];
$sql="SELECT*FROM user WHERE username='$mail' AND password='$pass'";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
?>
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
            <li class="active">Tài khoản: <?php if($row['role']==2){ echo "Trưởng phòng";} else if($row['role']==1){ echo "Giám đốc";} else {echo "Nhân viên";} {
                // code...
            }?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Xin chào: <?php if($row['role']==2){ echo "Trưởng phòng";} else if($row['role']==1){ echo "Giám đốc";} else {echo "Nhân viên";}?></h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td style=""><?php echo $row['ID'];?></td>
                                    <td style=""><?php echo $row['IDNV'];?></td>
                                    <td style=""><?php echo $row['username'];?></td>
                                    <td><span class="label label-<?php if($row['role']==1){echo "danger";}else if($row['role']==2){echo 'primary';} else{echo'success';}?>"><?php if($row['role']==2){ echo "Trưởng phòng";} else if($row['role']==1){ echo "Giám đốc";}else {echo'Nhân viên';}?></span></td>
                                </tr>
                        </tbody>
                    </table>
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
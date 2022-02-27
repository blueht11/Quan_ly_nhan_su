<!-- xóa phòng ban, xóa tất cả nhân viên, công việc, ngày nghỉ có trong phòng ban đó -->
<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $phongban_id=$_GET['id'];

    // lấy thông tin nhân viên và tài khoản sẽ xóa
    $sql_1="SELECT * FROM user JOIN nhanvien WHERE user.IDNV=nhanvien.IDNV AND nhanvien.IDPB='$phongban_id' ";
    $row_1=mysqli_fetch_array(mysqli_query($conn,$sql_1));
    $ID = $row_1['ID'];
    $IDNV = $row_1['IDNV'];

    // xóa phòng ban
    $sql="DELETE FROM phongban WHERE IDPB='$phongban_id' ";
    mysqli_query($conn, $sql);

    while($row_1=mysqli_fetch_array(mysqli_query($conn,$sql_1))) {
        $ID = $row_1['ID'];
        $IDNV = $row_1['IDNV'];
        // xóa tài khoản
        $sql_d = "DELETE FROM user WHERE IDNV='$IDNV' ";
        mysqli_query($conn, $sql_d);
        // xóa ngày nghỉ của nhân viên
        $sql_nn = "DELETE FROM ngaynghi WHERE IDNV = '$IDNV' ";
        mysqli_query($conn, $sql_nn);
        // xóa công việc của nhân viên
        $sql_cv = "DELETE FROM congviec WHERE IDNV='$IDNV' ";
        mysqli_query($conn, $sql_cv);
    }
    
    // xóa thông tin trưởng phòng
    $sql_tp = "DELETE FROM truongphong WHERE IDPB='$phongban_id' ";
    mysqli_query($conn,$sql_tp);
    // xóa nhân viên trong phòng
    $sql_nv = "DELETE FROM nhanvien WHERE IDPB='$phongban_id' ";
    mysqli_query($conn, $sql_nv);

    header('location: index.php?page_layout=phongban');
    
} ?>
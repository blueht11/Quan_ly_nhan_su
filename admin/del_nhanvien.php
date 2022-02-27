<!-- xóa nhân viên, nếu nhân viên có công việc chưa hoàn thành thì chuyển tất cả công việc về cho trưởng phòng với trạng thái là NEW, và xóa ngày nghỉ của nhân viên -->
<?php
session_start();
include_once('modules/connect/connect.php');

if (isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    $id = $_GET['id']; //id nhan vien
    $sql_cat = "SELECT * FROM user WHERE IDNV='$id'";
    $query_cat=mysqli_query($conn, $sql_cat);
    $row_cat=mysqli_fetch_array($query_cat);
    $idd = $row_cat['ID'];
    
    // xoa user
    $sql = "DELETE FROM user WHERE id='$idd'";
    mysqli_query($conn, $sql);
    // Nếu là nhân viên
    if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM truongphong WHERE truongphong.IDNV='$id' ")) == 0 ){
        // update cong viec
        $row_t = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nhanvien WHERE nhanvien.IDNV='$id' "));
        $id_phong = $row_t['IDPB'];
        $row_q = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM truongphong WHERE truongphong.IDPB='$id_phong' "));
        $id_tp = $row_q['IDNV'];
        $sql_cv = "UPDATE congviec SET congviec.trangthai=1, congviec.IDNV='$id_tp' WHERE IDNV='$id' AND congviec.trangthai<6";
        mysqli_query($conn, $sql_cv);
    // nếu là trưởng phòng
    } else {
        // xóa công việc
        mysqli_query($conn,"DELETE FROM congviec WHERE congviec.IDNV='$id' ");
    }

    // delete ngày nghỉ của nhân viên
    $sql_nn = "DELETE FROM ngaynghi WHERE IDNV='$id'";
    mysqli_query($conn, $sql_nn);

    // delete table truongphong
    $sql_tp = "DELETE FROM truongphong WHERE IDNV='$id'";
    mysqli_query($conn, $sql_tp);

    // xoa nhan vien
    $img=$_GET['img'];
    unlink("modules/nhanvien/img/$img");
    $sql_nv="DELETE FROM nhanvien WHERE IDNV=$id";
    mysqli_query($conn, $sql_nv);

    header('location: index.php?page_layout=nhanvien');
} else {
    die('ban can dang nhap truoc!');
}
?>


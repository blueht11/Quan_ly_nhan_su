<!-- chuyển quền truy cập vào file cần thiết khi xóa hoặc edit nhân viên -->
<?php
session_start();
include_once('modules/connect/connect.php');
if (isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    //update
    if (isset($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];
        $_SESSION['mail'];
        $_SESSION['pass'];
        header('location: index.php?page_layout=nhanvien');
    }
    //delete
    if (isset($_GET['id_del'])) {
        $_SESSION['id_del'] = $_GET['id_del'];
        $_SESSION['name_del'] = $_GET['name_del'];
        $_SESSION['img'] = $_GET['img'];
        header('location: index.php?page_layout=del_nhanvien');
    }
}else{
    die('Bạn không có quyền truy cập vào đây!');
}
?>
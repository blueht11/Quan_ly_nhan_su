<!-- phân quyền người đăng nhập -->
<?php
ob_start();
include_once("modules/connect/connect.php");
define('nhanvien', true);
session_start();
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    $mail = $_SESSION['mail'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT*FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row['role'] == 1) {
        define("admin", true);
        include_once('admin.php');
    } else if ($row['role'] == 2) {
        define("truongphong", true);
        include_once('admin.php');
    } else {
        include_once('admin.php');
    }
}
else{
    include_once('login.php');
}
?>
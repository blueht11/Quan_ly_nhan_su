<!-- logout tài khoản -->
<?php
session_start();
echo $_SESSION['mail'];
echo $_SESSION['pass'];
unset($_SESSION['mail']);
unset($_SESSION['pass']);
header('location: index.php');
?>
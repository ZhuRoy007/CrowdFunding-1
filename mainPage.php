<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
session_start();

mysqli_select_db($con, "crowdfunding");

if (isset($_GET['user_name']) && (isset($_GET['password']))) {
    $user_name = $_GET['user_name'];
    $password = $_GET['password'];

    $check = mysqli_query($con, "SELECT * FROM user WHERE user.user_name='{$user_name}';");
    $row = mysqli_fetch_array($check);

    if ((!isset($row)) || ($row['password'] != $password)) {
        $_SESSION["error_info"] = 'Username didn\'t exist or Password didn\'t match!';
        header("Location:Error.php");
    }
    $_SESSION["username"] = $user_name;

} else {
    header("Location:login.php");
    exit;
}
?>

个人主页

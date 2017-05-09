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
    $_SESSION["user_name"] = $user_name;

} else {
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h4 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Main Page</h4>
        </div>
    </div>
    <div style="width: 1000px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 800px;margin: 50px auto 50px">
            <form style="margin-top: 40px;padding-top: 10px" action="searchResult.php" method="get">
                <input type="text"
                       style="margin-top: 40px;height: 40px;font-size: 20px;border-radius: 5px;margin-left: 20px"
                       name="keyword">
                <button type="submit" class="btn btn-primary"
                        style="width: 50%;margin-top: 40px;margin-left: 100px;height: 50px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen">
                    Search Project
                </button>
            </form>

<!--            <form style="margin-top: 0px;padding-top: 10px" action="project.php" method="get">-->
<!--                <tab style='float: left;margin-top: 25px;height: 50px;font-size: 20px;border-radius: 5px'><h4>-->
<!--                        </h4></tab>-->
<!--                <input type="text"-->
<!--                       style="margin-top: 40px;height: 40px;font-size: 20px;border-radius: 5px;margin-left: 20px"-->
<!--                       required="required">-->
<!--                <button type="submit" class="btn btn-primary"-->
<!--                        style="width: 50%;margin-top: 40px;margin-left: 20px;height: 50px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen">-->
<!--                    Search User-->
<!--                </button>-->
<!--            </form>-->
            <br/>
            <br/>

        </div>
    </div>
</div>


</body>
</html>

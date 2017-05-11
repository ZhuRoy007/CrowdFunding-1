<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
session_start();

mysqli_select_db($con, "crowdfunding");

if (isset($_GET['user_name']) && (isset($_GET['password']))) {
    $user_name = mysqli_real_escape_string($con, $_GET['user_name']);
    $password = mysqli_real_escape_string($con, $_GET['password']);

    $check = mysqli_query($con, "SELECT * FROM user WHERE user.user_name='{$user_name}';");
    $row = mysqli_fetch_array($check);
    if ((!isset($row)) || (password_verify($password, $row['password'])) != 1) {
        $_SESSION["error_info"] = 'Username didn\'t exist or Password didn\'t match!';
        header("Location:Error.php");
        exit;
    }
    $_SESSION["user_name"] = $user_name;
    $_SESSION["logged_in"] = true;
} elseif (!$_SESSION['logged_in']) {
    header("Location:login.php");
    exit;
}
$user_name = $_SESSION["user_name"];
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
            <?php
            echo "<br />";
            echo "Welcome: <a href='profile.php?user_id=0' style='text-decoration: none;color: #3c3f41'>" . $_SESSION['user_name'] . "</a>";
            echo "
            <a href=\"newProject.php\">
                <button class=\"btn btn-primary\"
                style=\"float: right;width: 30%;margin-left:20px;height: 30px;font-size: 15px;border-radius: 5px;color: whitesmoke;background-color: forestgreen\">Creat A New Project
                </button>
            </a>";
            ?>
            <hr>
            <form style="margin-top: 10px;padding-top: 10px" action="searchResult.php" method="get">
                <input type="text"
                       style="margin-top: 20px;height: 40px;font-size: 20px;border-radius: 5px;width: 100%"
                       name="keyword"><br/><br/>
                <button type="submit" class="btn btn-primary"
                        style="float: right;width: 30%;margin-left:20px;height: 30px;font-size: 15px;border-radius: 5px;color: whitesmoke;background-color: forestgreen">
                    Search Project
                </button>
            </form>
            <br/>
            <hr>
            <?php

            $notification = mysqli_query($con, "SELECT *  FROM user_notify NATURAL JOIN notification NATURAL JOIN user WHERE user_name = '{$user_name}';");

            while ($row = mysqli_fetch_array($notification)) {
                echo "<hr><div>{$row['user_name']}" . " has " . $row['subtype'] . " a " . $row['type'] . " at " . $row['notify_time'];
                echo "<br /><br />";
            }
            mysqli_close($con);
            ?>
            <br/>
            <br/>

        </div>
    </div>
</div>


</body>
</html>

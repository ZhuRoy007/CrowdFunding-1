<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
mysqli_select_db($con, "crowdfunding");

session_start();

$user_name = $_SESSION["user_name"];
if ($user_name == "") {
    header("Location:login.php");
    exit;
}

$project_name = $_GET['project_name'];
$category = $_GET['category'];
$description = $_GET['description'];
$sample = $_GET['sample'];
$min_fund = $_GET['min_fund'];
$max_fund = $_GET['max_fund'];
$sample = $_GET['sample'];
$raisingend_time = $_GET['raisingend_time'];
$projectend_time = $_GET['projectend_time'];


$check = mysqli_query($con, "SELECT * FROM project WHERE project_name='{$project_name}';");
$row = mysqli_fetch_array($check);

if (isset($row)) {
    $_SESSION["error_info"] = 'This project name has already existed';
    header("Location:Error.php");
    exit;
}

$insert = mysqli_query($con, "INSERT INTO project SET 
project_name  ='{$project_name}', 
category ='{$category}', 
description ='{$description}', 
sample ='{$sample}', 
min_fund ='{$min_fund}', 
max_fund ='{$max_fund}', 
post_time = now(),  
raisingend_time ='{$raisingend_time}', 
projectend_time ='{$projectend_time}', 
if_approved = 0;");

$checkPro = mysqli_query($con, "SELECT project_id FROM project WHERE project_name = '{$project_name}';");
$checkUser = mysqli_query($con, "SELECT user_id FROM user WHERE user_name = '{$user_name}';");

$project = mysqli_fetch_array($checkPro);
$user = mysqli_fetch_array($checkUser);

mysqli_query($con, "INSERT INTO own SET user_id  ={$user['user_id']},project_id ={$project['project_id']};");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">

        </div>
    </div>
    <div style="width: 400px;height: 450px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" method="post" action="mainPage.php">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center">Success</h4>
                    </label>
                </div>
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h5 style="color: #545657;line-height: 50px;margin: 0" align="center">Congratulations, you've
                            created a new project!</h5>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 102px;height: 50px;font-size: 20px;border-radius: 5px">Back to
                    Main Page
                </button>

            </form>
        </div>
    </div>

</div>

<?php

?>
</body>
</html>
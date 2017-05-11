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
$description = htmlentities($_GET['description'], ENT_QUOTES, 'UTF-8');
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
$checkUser = mysqli_query($con, "SELECT * FROM user WHERE user_name = '{$user_name}';");

$project = mysqli_fetch_array($checkPro);
$user = mysqli_fetch_array($checkUser);

mysqli_query($con, "INSERT INTO own SET user_id  ={$user['user_id']},project_id ={$project['project_id']};");

/*Insert informatin to Table: Notification*/
/*Define: type has categories: 1,user 2,project.   user has subtype:1,like 2,new 3.donate   project has 1.update 2.create 3.like  */
$notify_message = $user['user_name'] . " has created a new project: " . $project_name . " at " . date("Y-m-d H:i:s");
$notify_message = (string)$notify_message;
mysqli_query($con, "INSERT INTO notification (type, subtype, target_id, message, notify_time)
    values('project', 'create', {$user['user_id']},'$notify_message' , now());");

$notify_id = mysqli_query($con, "SELECT notify_id FROM notification WHERE message = '{$notify_message}';");
$notify_id = mysqli_fetch_array($notify_id);

$who_followed = mysqli_query($con, "SELECT user_id from follow WHERE followed_id='{$user['user_id']}}';");
if (mysqli_num_rows($who_followed) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($who_followed)) {
        mysqli_query($con, "INSERT INTO user_notify SET user_id  ={$row['user_id']},notify_id ={$notify_id['notify_id']},if_read='0';");
    }
} else {
   echo "No need to update user_notify table";
}
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
</body>
</html>
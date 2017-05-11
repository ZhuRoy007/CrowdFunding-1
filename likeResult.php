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

$project_id = $_GET['project_id'];

$check = mysqli_query($con, "SELECT * FROM project NATURAL JOIN `like` NATURAL JOIN user WHERE project_id='{$project_id}' AND user_name='$user_name';");
$row = mysqli_fetch_array($check);
$user_id = $row['user_id'];

if (!isset($user_name)) {
    $_SESSION["error_info"] = 'Error';
    header("Location:Error.php");
    exit;
} else if (isset($row)) {
    $_SESSION["error_info"] = 'You\'ve already liked this project!';
    header("Location:Error.php");
    exit;
}

$getId = mysqli_query($con, "SELECT user_id FROM user WHERE user_name='$user_name';");
$row = mysqli_fetch_array($getId);

$insert = mysqli_query($con, "INSERT INTO `like` SET 
user_id ={$row['user_id']},project_id={$project_id};");

/*Insert informatin to Table: Notification*/
/*Define: type has categories: 1,user 2,project.   user has subtype:1,like 2,new 3.donate   project has 1.update 2.create 3.like  */
$project_name = mysqli_fetch_array(mysqli_query($con, "SELECT project_name FROM project WHERE project_id='{$project_id}';"));

$notify_message = $user_name. " liked a project: " . $project_name['project_name'] . " at " . date("Y-m-d H:i:s");
$notify_message = (string)$notify_message;
mysqli_query($con, "INSERT INTO notification (type, subtype, target_id, message, notify_time)
    values('user', 'liked', {$project_id},'$notify_message' , now());");

$notify_id = mysqli_query($con, "SELECT notify_id FROM notification WHERE message = '{$notify_message}';");
$notify_id = mysqli_fetch_array($notify_id);

$who_followed = mysqli_query($con, "SELECT user_id from `like` WHERE `like`.project_id='{$project_id}}';");

if (mysqli_num_rows($who_followed) > 0) {
    // output data of each row
    while($tuple = mysqli_fetch_assoc($who_followed)) {
        mysqli_query($con, "INSERT INTO user_notify SET user_id  ={$tuple['user_id']},notify_id ={$notify_id['notify_id']},if_read='0';");
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
    <div style="width: 400px;height: 450px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">

            <?php echo "
            <form style = 'margin-top: 40px;padding-top: 10px' method = 'get' action = 'project.php' >
                <div class='form-group' align = 'center' style = 'margin: 50px auto auto' >
                    <label style = 'font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;' >
                        <h4 style = 'color: #545657;line-height: 50px;margin: 0' align = 'center' > Success</h4 >
                    </label >
                </div >
                <div class='form-group' align = 'center' style = 'margin: 50px auto auto' >
                    <label style = 'font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;' >
                        <h5 style = 'color: #545657;line-height: 50px;margin: 0' align = 'center' > You've liked this project</h5 >
                    </label >
                </div >
                <input type='hidden' name='project_id' value='$project_id'>
                <button type = 'submit' class='btn btn-primary'
                        style = 'width: 100%;margin-top: 102px;height: 50px;font-size: 20px;border-radius: 5px' > Back to project
            </button >

            </form >";
            ?>
        </div>
    </div>

</div>
</body>
</html>
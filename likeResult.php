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
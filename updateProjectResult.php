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
$description = $_GET['description'];
$sample = $_GET['sample'];
$if_finished = isset($_GET['if_finished']) ? 1 : 0;

if (!isset($project_id) || !isset($description)) {
    $_SESSION["error_info"] = 'Error';
    header("Location:Error.php");
    exit;
}

$upd = mysqli_query($con, "INSERT INTO update_record
SET project_id ='{$project_id}', update_time = now(), update_description ='{$description}', update_sample ='{$sample}', if_finished ='{$if_finished}';");
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
                        <h5 style = 'color: #545657;line-height: 50px;margin: 0' align = 'center' > You've updated the project</h5 >
                    </label >
                    <input type='hidden' name='project_id' value='{$project_id}'>
                </div >
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
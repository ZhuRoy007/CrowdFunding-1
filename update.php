<?php

session_start();

$user_name = $_SESSION["user_name"];
$project_id = $_GET["project_id"];
if ($user_name == "") {
    header("Location:login.php");
    exit;
} elseif (!isset($project_id)) {
    $_SESSION["error_info"] = 'No project to update';
    header("Location:Error.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Project</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h2 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Update A Project</h2>
        </div>
    </div>
    <div style="width: 400px;height: 550px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" action="updateProjectResult.php"
                  method="get">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center" id="sign">Please input
                            version information</h4>
                    </label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description" required="required"
                              style="width: 100%;height: 100px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px"></textarea>
                </div>
                <div class="form-group">
                    <label style="font-size: small;margin-top: 10px;margin-left: 10px;float: left">sample file</label>
                    <input type="file" class="form-control" name="sample"
                           style="width: 50%;margin-top: 10px;border-radius: 5px;float: right">
                </div>
                <div style="margin-top: 80px">
                    <hr>
                    <label style="font-size: small;margin-top: 10px;margin-left: 10px;float: left"><input
                                type="checkbox" class="form-control" name="if_finished"
                                style="margin-top: 10px;border-radius: 5px">if finished</label>
                </div>
                <?php
                echo "                
                <input type='hidden' name='project_id' value='$project_id'>"
                ?>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 40px;height: 50px;font-size: 20px;border-radius: 5px">Update
                </button>
            </form>

            <button onclick="goBack()"
                    style="width: 100%;margin-top: 10px;height: 50px;font-size: 20px;border-radius: 5px">Back
            </button>

        </div>
    </div>

</div>
</body>
</html>
<?php

session_start();

$user_name = $_SESSION["user_name"];
if ($user_name == "") {
    header("Location:login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Project</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h2 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Create A New Project</h2>
        </div>
    </div>
    <div style="width: 400px;height: 750px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" action="createProjectResult.php"
                  method="get">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center" id="sign">Please input
                            project information</h4>
                    </label>
                </div>
                <div class="form-group" style="margin-top: 40px;">
                    <input type="text" class="form-control" name="project_name" placeholder="project name" required="required"
                           style="width: 100%;height: 50px;font-size: 18px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="category" placeholder="category" required="required"
                           style="width: 100%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description" placeholder="brief description"
                              style="width: 100%;height: 100px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px"></textarea>
                </div>
                <div class="form-group">
                    <label style="font-size: small;margin-top: 10px;margin-left: 10px;float: left">sample file</label>
                    <input type="file" class="form-control" name="sample" placeholder="sample"
                           style="width: 50%;margin-top: 10px;border-radius: 5px;float: right">
                </div>
                <div class="form-group" style="margin-top: 40px">
                    <input type="number" class="form-control" name="max_fund" placeholder="goal fund" required="required"
                           style="width: 48%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px;float: left">
                    <input type="number" class="form-control" name="min_fund" placeholder="minimum fund" required="required"
                           style="width: 48%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px;float: right">
                </div>
                <div class="form-group">
                    <label style="font-size: small;margin-top: 10px;margin-left: 10px;float: left">raising end time</label>
                    <input type="datetime-local" class="form-control" name="raisingend_time" required="required"
                           placeholder="raising end time" style="width: 50%;margin-top: 10px;border-radius: 5px;float: right">
                </div>
                <div class="form-group">
                    <label style="font-size: small;margin-top: 10px;margin-left: 10px;float: left">project end time</label>
                    <input type="datetime-local" class="form-control" name="projectend_time" required="required"
                           placeholder="raising end time" style="width: 50%;margin-top: 10px;border-radius: 5px;float: right">
                </div>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 40px;height: 50px;font-size: 20px;border-radius: 5px">Create
                </button>
            </form>
            <a href="mainPage.php">
                <button class="btn btn-primary"
                        style="width: 100%;margin-top: 10px;height: 50px;font-size: 20px;border-radius: 5px">back
                </button>
            </a>
        </div>
    </div>

</div>
</body>
</html>
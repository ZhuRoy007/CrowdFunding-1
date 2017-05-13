<?php
//$con = mysqli_connect("localhost", "root", "root");
//if (!$con) {
//    die('Could not connect: ' . 'mysqli_error()');
//}
//mysqli_select_db($con, "crowdfunding");

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
    <title>Profile</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h2 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">update profile</h2>
        </div>
    </div>
    <div style="width: 400px;height: 600px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" action="profileResult.php"
                  method="get">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center" id="sign">Please input
                            your information</h4>
                    </label>
                </div>
                <div class="form-group" style="margin-top: 40px;">
                    <input type="text" class="form-control" name="interest" placeholder="interest"
                           style="width: 100%;height: 50px;font-size: 18px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="hometown" placeholder="hometown"
                           style="width: 100%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="address"
                           style="width: 100%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="contact" placeholder="contact"
                           style="width: 100%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px">
                </div>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 40px;height: 50px;font-size: 20px;border-radius: 5px">Update
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
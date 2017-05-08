<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
mysqli_select_db($con, "crowdfunding");

if (isset($_GET['user_name']) && (isset($_GET['password'])) && (isset($_GET['email'])) && (isset($_GET['credit_card']))) {
    $user_name = $_GET['user_name'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    $credit_card = $_GET['credit_card'];
} else {
    header("Location:login.php");
    exit;
}

$check = mysqli_query($con, "SELECT * FROM user WHERE user.user_name='{$user_name}';");

if (mysqli_fetch_array($check)) {
    header("Location:userNameError.php");
    exit;
}

$ins = mysqli_query($con, "INSERT INTO crowdfunding.user (user_name, email, credit_card,`password`) VALUES ('{$user_name}', '{$email}','{$credit_card}','{$password}');");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
<!--            <script>-->
<!--                if-->
<!--                    document.write("<h4 style=\"color: #c5c5c5;line-height: 50px;margin: 0\" align=\"center\">Error</h4>")-->
<!--                else-->
<!--                    document.write("<h4 style=\"color: #c5c5c5;line-height: 50px;margin: 0\" align=\"center\">Error</h4>")-->
<!--            </script>-->
        </div>
    </div>
    <div style="width: 400px;height: 450px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" method="post">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center">Success</h4>
                    </label>
                </div>
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h5 style="color: #545657;line-height: 50px;margin: 0" align="center">Congratulations, you've been signed up!</h5>
                    </label>
                </div>
                <button onclick="history.go(-1)" type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 102px;height: 50px;font-size: 20px;border-radius: 5px">Back
                </button>

            </form>
        </div>
    </div>

</div>

</body>
</html>
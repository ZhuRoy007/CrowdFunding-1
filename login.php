<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h2 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Crowd Funding System</h2>
        </div>
    </div>
    <div style="width: 400px;height: 450px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" action="mainPage.php" method="get">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center">Login</h4>
                    </label>
                </div>
                <div class="form-group" style="margin-top: 40px;">
                    <input type="text" class="form-control" name="user_name" placeholder="username" required="required"
                           style="width: 100%;height: 50px;font-size: 18px;border-radius: 5px;text-indent:10px">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="password"
                           required="required"
                           style="width: 100%;height: 50px;font-size: 18px;margin-top: 10px;border-radius: 5px;text-indent:10px">
                </div>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 40px;height: 50px;font-size: 20px;border-radius: 5px">Login
                </button>
            </form>
            <a href="register.php">
                <button class="btn btn-primary"
                        style="width: 100%;margin-top: 10px;height: 50px;font-size: 20px;border-radius: 5px">Register
                </button>
            </a>
        </div>
    </div>

</div>

</body>
</html>
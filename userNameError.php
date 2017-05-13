<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h4 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Error</h4>
        </div>
    </div>
    <div style="width: 400px;height: 450px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 350px;height: 300px;margin: 50px auto auto">
            <form style="margin-top: 40px;padding-top: 10px" action="register.php" method="post">
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h4 style="color: #545657;line-height: 50px;margin: 0" align="center">Error Info</h4>
                    </label>
                </div>
                <div class="form-group" align="center" style="margin: 50px auto auto">
                    <label style="font-size: 24px;color:#545657;padding-top: 8px;padding-left: 0;">
                        <h5 style="color: #545657;line-height: 50px;margin: 0" align="center">Username has been used!</h5>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary"
                        style="width: 100%;margin-top: 102px;height: 50px;font-size: 20px;border-radius: 5px">Back
                </button>
            </form>
        </div>
    </div>

</div>

<?php

?>
</body>
</html>
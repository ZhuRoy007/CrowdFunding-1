<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
mysqli_select_db($con, "crowdfunding");

session_start();
$user_name = $_SESSION["user_name"];
$user_id = $_GET["user_id"];

$check = mysqli_query($con, "SELECT * FROM user WHERE user_name='{$user_name}';");
$row = mysqli_fetch_array($check);

if ($user_id == 0 || $user_id == $row['user_id']) {
    $isSelf = true;
    $check = mysqli_query($con, "SELECT * FROM user WHERE user_name='{$_SESSION["user_name"]}';");
    $row = mysqli_fetch_array($check);
} else if ($user_id != $row['user_id']) {
    $isSelf = false;
    $check = mysqli_query($con, "SELECT * FROM user WHERE user_id='{$user_id}';");
    $row = mysqli_fetch_array($check);
} else {
    $_SESSION["error_info"] = 'Error';
    header("Location:Error.php");
}

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Profile</title>
</head>
<body style='background-color: #3c3f41; font-family: \"Microsoft YaHei UI Light\",sans-serif'>

<div class='container'>

    <div class='container' style='width: 400px;margin: auto;'>
        <div style='height: 50px;margin-top: 50px' align='center'>
            <h4 style='color: #c5c5c5;line-height: 50px;margin: 0' align='center'>Personal Profile</h4>
        </div>
    </div>

  <div style='width: 1000px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;'>
    <div class='container' style='width: 800px;margin: 50px auto 50px'>    
    <br />
                Welcome: " . $_SESSION['user_name'];
if ($isSelf) {
    echo "
    <a href='updateprofile.php'>      
        <button class='btn btn-primary'
            style='float:right;width: 30%;margin-left:20px;height: 30px;font-size: 15px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>Update Profile
    </button>
    </a>";
} else {
    echo "
    <a href='followResult.php?user_id=$user_id'>      
        <button class='btn btn-primary'
            style='float:right;width: 30%;margin-left:20px;height: 30px;font-size: 15px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>Follow
    </button>
    </a>";
}

echo "
    <div><h4><tab>" . "User Name" . "</tab></h4></div>
    <tab style='font-weight: bold;font-size: x-large '>" . $row['user_name'] . "</tab><br /><hr>
    <tab style='font-weight: bold;font-size: large '>email:<tab style='float: right;'>" . $row['email'] . "</tab></tab><br /><br />
    <tab style='font-weight: bold;font-size: large '>interest:<tab style='float: right;'>" . $row['interest'] . "</tab></tab><br /><br />
    <tab style='font-weight: bold;font-size: large '>hometown:<tab style='float: right;'>" . $row['hometown'] . "</tab></tab><br /><br />
    <tab style='font-weight: bold;font-size: large '>address:<tab style='float:right'>" . $row['address'] . "</tab></tab><br /><br />
    <tab style='font-weight: bold;font-size: large '>contact:<tab style='float:right'>" . $row['contact'] . "</tab></tab><br /><hr><br />
    </div>
  </div>
</div>
</body>
</html>
";

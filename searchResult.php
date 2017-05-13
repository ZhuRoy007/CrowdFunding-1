<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
mysqli_select_db($con, "crowdfunding");
session_start();

$user_name = $_SESSION["user_name"];
$keyword = mysqli_real_escape_string($con,$_GET['keyword']);

if ($user_name == "") {
    header("Location:login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Result</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h4 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Search Result</h4>
        </div>
    </div>
    <div style="width: 1200px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 1000px;margin: 50px auto auto">
            <?php

            if ($keyword == null) {
                $result = mysqli_query($con, "SELECT * FROM project  NATURAL JOIN own  NATURAL JOIN user");
            } else {
                $result = mysqli_query($con, "SELECT * FROM project  NATURAL JOIN own  NATURAL JOIN user WHERE description LIKE '%{$keyword}%' OR project.project_name LIKE '%{$keyword}%'OR project.category LIKE '%{$keyword}%'");
            }
            echo "<br />";
            echo "Welcome: <a href='profile.php?user_id=0' style='text-decoration: none;color: #3c3f41'>" . $_SESSION['user_name'] . "</a>";
            echo "
                    <a href=\"mainPage.php\">
                    <button class=\"btn btn-primary\"
                        style=\"float:right;width: 20%;margin-top: 0;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen\">Main Page
                    </button>
                    </a>";
            echo "<br />";
            echo "<div><h4>
                            <tab>" . "Project Name" . "</tab>
                            <tab style='position: absolute;left: 700px;'>" . "Category" . "</tab>
                            <tab style='position: absolute;left: 950px;'>" . "Owner" . "</tab>
                            <tab style='position: absolute;left: 1200px;'>" . "Goal" . "</tab>
                            <tab style='float: right'>" . "End time" . "</tab>
                            </h4></div>";
            echo "<br />";
            while ($row = mysqli_fetch_array($result)) {
                $project_id = $row['project_id'];
                echo "<div><a href='project.php?project_id=$project_id' " . "style='text-decoration: none;color: black'>
                            <tab>" . $row['project_name'] . "</tab>
                            <tab style='position: absolute;left: 700px'>" . $row['category'] . "</tab>
                            <tab style='position: absolute;left: 950px'>" . $row['user_name'] . "</tab>
                            <tab style='position: absolute;left: 1200px'>" . $row['max_fund'] . "</tab>
                            <tab style='float: right'>" . $row['raisingend_time'] . "</tab>
                            </a></div>";
                echo "<br />";
            }
            mysqli_close($con);
            ?>
        </div>
    </div>
</div>


</body>
</html>
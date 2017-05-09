<?php
$con = mysqli_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . 'mysqli_error()');
}
mysqli_select_db($con, "crowdfunding");

session_start();
$user_name = $_SESSION["user_name"];
$project_id = $_GET['project_id'];

if ($user_name == "" || $project_id == null) {
    header("Location:login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project</title>
</head>
<body style="background-color: #3c3f41;font-family: 'Microsoft YaHei UI Light',sans-serif">

<div class="container">
    <div class="container" style="width: 400px;margin: auto;">
        <div style="height: 50px;margin-top: 50px" align="center">
            <h4 style="color: #c5c5c5;line-height: 50px;margin: 0" align="center">Project detail</h4>
        </div>
    </div>
    <div style="width: 1000px;background-color: #c6c6c6;border-radius: 10px;margin: 100px auto auto;">
        <div class="container" style="width: 800px;margin: 50px auto 50px">
            <?php
            echo "<br />";
            $project = mysqli_query($con, "SELECT * FROM project  NATURAL JOIN own  NATURAL JOIN user WHERE project.project_id = '{$project_id}';");
            $amount = mysqli_query($con, "SELECT sum(amount) AS amount FROM sponsor  WHERE project_id =  '{$project_id}';");

            //            if (!$detail = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM product WHERE product.pname = '{$itemname}' AND pstatus='available'"))) {
            //                header("Location:unavailable.php");
            //                exit;
            //            }

            $row = mysqli_fetch_array($project);
            $amount = mysqli_fetch_array($amount);

            echo "<br />";
            echo "Welcome: " . $_SESSION['user_name'];
            echo "
                    <a href=\"mainPage.php\">
                    <button class=\"btn btn-primary\"
                        style=\"float:right;width: 20%;margin-top: 0;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen\">Main Page
                    </button>
                    </a>";
            echo "<br />";
            echo "<div><h4><tab>" . "Project Name" . "</tab></h4></div>";
            echo "<div>
                    <tab style='font-weight: bold;font-size: x-large '>" . $row['project_name'] . "</tab><br /><br />
                    <h4>
                    <tab style='float: left'>" . 'Category' . "</tab>
                    <tab style='position: absolute;left: 800px'>" . 'Owner' . "</tab>
                    <tab style='position: absolute;left: 1000px'>" . 'Raised / Goal' . "</tab>
                    <tab style='float: right'>" . 'End time' . "</tab><br /><br />
                    </h4>
                    <tab style='float: left'>" . $row['category'] . "</tab>
                    <tab style='position: absolute;left: 800px'>" . $row['user_name'] . "</tab>
                    <tab style='position: absolute;left: 1000px'>" . $amount['amount'] . " / " . $row['max_fund'] . "</tab>
                    <tab style='float: right'>" . $row['raisingend_time'] . "</tab><br />
                    </div>";
            echo "<br />";
            echo "<br />";
            echo "<h4>About this project</h4>";
            echo "<br />";
            echo $row['description'];
            mysqli_close($con);
            ?>
            <form style="margin-top: 40px;padding-top: 10px" action="donateResult.php" method="get">
                <tab style='float: left;margin-top: 25px;height: 50px;font-size: 20px;border-radius: 5px'><h4>Donate</h4></tab>
                <input type="number"  style="margin-top: 40px;height: 40px;font-size: 20px;border-radius: 5px;margin-left: 20px" required="required">
                <button type="submit" class="btn btn-primary"
                        style="width: 50%;margin-top: 40px;margin-left: 20px;height: 50px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen">
                    Donate This
                    Project
                </button>
            </form>
            <!--            <a href="startPage.php">-->
            <!--                <button class="btn btn-primary"-->
            <!--                        style="width: 100%;margin-top: 20px;height: 50px;font-size: 20px;border-radius: 5px">Back to-->
            <!--                    Start Page-->
            <!--                </button>-->
            <!--            </a>-->
            <br/>
            <br/>
            <h4>Discussions</h4>
            <br/>
            <br/>
        </div>
    </div>
</div>


</body>
</html>
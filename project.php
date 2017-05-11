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
            $project = mysqli_query($con, "SELECT * FROM project  NATURAL JOIN own  NATURAL JOIN user WHERE project.project_id = {$project_id};");
            $amount = mysqli_query($con, "SELECT sum(amount) AS amount FROM sponsor  WHERE project_id =  '{$project_id}';");
            $row = mysqli_fetch_array($project);
            $amount = mysqli_fetch_array($amount);

            $checkOwn = mysqli_query($con, "SELECT * FROM own NATURAL JOIN user WHERE user_name= '{$user_name}' AND project_id='{$project_id}';");
            $check = mysqli_fetch_array($checkOwn);


            echo "<br />";
            echo "Welcome: <a href='profile.php?user_id=0' style='text-decoration: none;color: #3c3f41'>" . $_SESSION['user_name'] . "</a>";
            echo "
                    <a href='mainPage.php'>
                    <button class='btn btn-primary'
                        style='float:right;width: 20%;margin-top: 0;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>Main Page
                    </button>
                    </a>";

            if ($check) {
                echo "
                    <a href='finishResult.php'>
                    <button style='float:right;width: 20%;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: firebrick'>Finish project
                    </button>
                    </a>
                    <a href='update.php'>
                    <button style='float:right;width: 20%;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>Update project
                    </button>
                    </a>
                    ";
            } else {
                echo "
                    <a href='likeResult.php?project_id=$project_id'>
                    <button style='float:right;width: 20%;margin-left:20px;height: 30px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>like
                    </button>
                    </a>
                    ";
            }

            echo "<br />";
            echo "<div><h4><tab>" . "Project Name" . "</tab></h4></div>";
            echo "<div>
                    <tab style='font-weight: bold;font-size: x-large '>" . $row['project_name'] . "</tab><br /><br />
                    <h4>
                    <tab style='float: left'>" . 'Category' . "</tab>
                    <tab style='position: absolute;left: 800px'>
                    " . 'Owner' . "</tab>
                    <tab style='position: absolute;left: 1000px'>" . 'Raised / Goal' . "</tab>
                    <tab style='float: right'>" . 'End time' . "</tab><br /><br />
                    </h4>
                    <a href='searchResult.php?keyword={$row['category']}' style='text-decoration: none;color: #3c3f41'>
                    <tab style='float: left'>                    
                    " . $row['category'] . "
                    </tab>
                    </a>
                    <tab style='position: absolute;left: 800px'>
                    <a href='profile.php?user_id={$row['user_id']}' style='text-decoration: none;color: #3c3f41'>
                    " . $row['user_name'] . "
                    </a>
                    </tab>
                    <tab style='position: absolute;left: 1000px'>" . $amount['amount'] . " / " . $row['max_fund'] . "</tab>
                    <tab style='float: right'>" . $row['raisingend_time'] . "</tab><br />
                    </div>";
            echo "<br />";
            echo "<br />";
            echo "<h4>About this project</h4>";
            echo "<br />";
            echo $row['description'];
            echo "<br />";
            echo "<br />";
            echo "<h4>Sample</h4>";
            echo "<br />";
            echo $row['sample'];

            echo "
            
            <form style='margin-top: 40px;padding-top: 10px' action='donateResult.php' method='get'>
                <tab style='float: left;margin-top: 25px;height: 50px;font-size: 20px;border-radius: 5px'><h4>
                        Donate</h4></tab>
                <input type='number'
                       style='margin-top: 40px;height: 40px;font-size: 20px;border-radius: 5px;margin-left: 20px'
                       name='amount' required='required'>
                <button type='submit'
                        style='width: 50%;margin-top: 40px;margin-left: 20px;height: 50px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>
                    Donate This
                    Project
                </button>
                <input type='hidden' name='project_id' value='$project_id'>'                
            </form>
            <br/>
            <br/>
            <h4>Discussions</h4>
            <br/>
            <br/>";


            $discussion = mysqli_query($con, "SELECT user_id, user_name, comment FROM discussion NATURAL JOIN user WHERE project_id = '{$project_id}';");

            while ($row = mysqli_fetch_array($discussion)) {
                echo "<hr><div><a href='profile.php?user_id=" . $row['user_id'] . "' " . "style='text-decoration: none;color: black;font-weight: bold'>
                            <tab>" . $row['user_name'] . ":</tab></a>
                            <tab>" . $row['comment'] . "</tab>                           
                            </div>";
                echo "<br />";
            }

            echo "<form action='commentResult.php' method='get'><hr><textarea name='comment' style='width: 100%;height: 100px;border-radius: 5px'></textarea>
                    <input type='hidden' name='project_id' value='$project_id'>
                    <button type='submit'
                        style='float:right;width: 20%;margin-top: 10px;bottom:50px;height: 40px;font-size: 20px;border-radius: 5px;color: whitesmoke;background-color: forestgreen'>
                       comment
                    </button></form>
            <br /><br /><br /><br />";
            mysqli_close($con);
            ?>
        </div>
    </div>
</div>


</body>
</html>
<?php
    /*
        B.Tech Computer Science and Engineering
        SAURABH YADAV
        202103103510362
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        h1#scressTxt {
            color: #88B04B;
        }
        h1#failTxt {
            color: #FF1A1A;
        }
        i {
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
        i#sucess {
            color: #9ABC66;
        }
        i#fail {
            color: #FF1A1A;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        #username{
            display: none;
        }
    </style>
</head>
<body>
    <div class="card">
    <?php
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['umail'];
            $password = $_POST['upass1'];
            
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "userData";
            $port = "3306";

            try {
                $conn = mysqli_connect($host, $user, $pass, $db, $port);
                try {
                    $sql = 'SELECT email,password from datails where email = "'.$username.'"';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $userdata = $result->fetch_assoc();
                        if ($username == $userdata['email'] && $password == $userdata['password']){
                            echo '
                            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                                <i class="checkmark" id="sucess">✓</i>
                            </div>
                            <h1 id="scressTxt">LOGIN SUCESS</h1>
                            <form action="changePass.php" method="POST">
                                <input type="text" value="'.$username.'" id="username" name="username" />
                                <input type="submit" class="goTo" id="sucessText" value="Change Password" style="font-size: 24px;text-transform: uppercase;padding: 0.5rem 1rem;border-radius: 6px;color: #EBF0F5;background-color: #88B04B;border=none;"/>
                            </form>
                            ';
                        } else {
                            echo '
                            <div style="border-radius:200px; height:200px; width:200px; background: #FFB3B3; margin:0 auto;">
                                <i class="checkmark" id="fail">Y</i>
                            </div>
                            <h1 id="failTxt">LOGIN FAILED</h1>
                            <a href="loginDash.php" class="goTo" id="failedTxt" style="font-size: 24px;text-transform: uppercase;padding: 0.5rem 1rem;border-radius: 6px;color: #EBF0F5;background-color: #FF1A1A;border=none;">Go Back</a>';
                        }
                    }

                } catch (Exception $e) {
                    echo '
                    <div style="border-radius:200px; height:200px; width:200px; background: #FFB3B3; margin:0 auto;">
                        <i class="checkmark" id="fail">Y</i>
                    </div>
                    <h1 id="failTxt">LOGIN FAILED</h1>
                    <a href="loginDash.php" class="goTo" id="failedTxt" >Go Back</a>';
                }
            } catch(Exception $e) {
                echo $e;
            }
        }
    ?>
    </div>
</body>
</html>
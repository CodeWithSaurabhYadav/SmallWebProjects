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
    <title>Registration Sucssful</title>

    <style>
        * {
            text-decoration: none;
        }

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

        .goTO {
            text-decoration: none;
            font-size: 24px;
            text-transform: uppercase;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: #EBF0F5;
        }

        .goTO#sucessText {
            background-color: #88B04B;
        }

        .goTO#failedTxt {
            background-color: #FF1A1A;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>


</head>

<body>


<div class="card">
    <?php
    session_start();
    $genOtp = $_SESSION['OTP'];
    $uname = $_SESSION['uname'];
    $umail = $_SESSION['umail'];
    $pass1 = $_SESSION['pass1'];
    $pass2 = $_SESSION['pass2'];
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $UserOtp = $_POST['OTP'];
        if ($genOtp == $UserOtp) {
            

            include_once "../misc/conn.ini.php";
            try {
                if ($pass1 != $pass2) {
                    echo "Password did not match";
                } else {
                    try {
                        $sql = "INSERT INTO user (username,password,name) VALUES (?,?,?)";
                        $smtm = $conn->prepare($sql);
                        $smtm->bind_param('sss',$umail, $pass2, $uname);
                        $smtm->execute();
                        ?>
                            <script>
                                alert("Registeration SucessFull Login to your dash board");
                            </script>
                        <?php
                        header("Refresh: 0.1, URL=../login.php");
                    } catch (Exception $e) {
                        echo '
                        <div style="border-radius:200px; height:200px; width:200px; background: #FFB3B3; margin:0 auto;">
                        <i class="checkmark" id="fail">X</i>
                        </div>
                        <h1 id="failTxt">Account already exist.</h1>
                        <a href="index.php" class="goTo" id="failedTxt" style="font-size: 24px;text-transform: uppercase;padding: 0.5rem 1rem;border-radius: 6px;color: #EBF0F5;background-color: #FF1A1A;border=none;">Regiser again</a>';
                    }
                }
            } catch (Exception $ë) {
                echo "connection failed";
            }
        } else {
            echo "Verification Failed";
        }
    }
    ?>
</div>
</body>

</html>
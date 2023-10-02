<?php
    /*
        B.Tech Computer Science and Engineering
        SAURABH YADAV
        202103103510362
    */
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $uname = $_POST['uname'];
        $umail = $_POST['umail'];
        $pass1 = $_POST['upass1'];
        $pass2 = $_POST['upass2'];

        session_start();
        $_SESSION['uname'] = $uname;
        $_SESSION['umail'] = $umail;
        $_SESSION['pass1'] = $pass1;
        $_SESSION['pass2'] = $pass2;
?>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <title>Register Message</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap');

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EBF0F5;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .container {
        display: block;
        width: 700px;
        height: 450px;
        margin: auto;
        background-color: #fff;
        border-radius: 18px;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #OTP {
        letter-spacing: 2rem;
        font-family: 'Josefin Sans', sans-serif;
        width: 450px;
        font-size: 40px;
        text-align: center;
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

    a:hover {
        color: white;
    }
</style>

<body>
    <div class="card">
        <?php
            //mailing
            $otp = rand(000000, 999999);
            if ($otp < 000000) {
                $otp = 999999 - $otp;
            }
            $_SESSION['OTP'] = $otp;
            $to = $umail;
            $subject = "Confirm you email and phone.";
            $message = '
                <html>
                <head?>
                    <title>HTML email</title>
                    <style>
                        .container{
                            display: grid;
                            grid-template-columns: 1fr;
                            justify-content: center;
                            align-items: center;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Hey, <span style="text-transform: capitalize;">' . $uname . '</span></h1>
                        <h3>The OTP for your registration is : <h3>
                        <h1 style="width: 150px;background:#3333ff;font-size: 30px;color:white;padding: 1rem 2rem;text-align: center;">' . $_SESSION['OTP'] . '<h1>
                    </div>
                </body>
                </html>
                ';
            $headers = "From: sy8502630@gmail.com\r\n" . "Reply-To: noreply@mail.com\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            if ($pass1 == $pass2) {
                if (mail($to, $subject, $message, $headers)) {
                    echo '
                    <div class="container d-flex justify-content-center">
                        <form action="confirmReg.php" method="POST">
                            <span class="my-5">ENTER THE OTP SENT TO YOUR EMAIL ADDRESS.</span>
                            <input type="number" name="OTP" id="OTP" class="form-control" max="999999" min="000000"/>
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 my-5">
                                <input type="submit" class="btn btn-primary btn-lg" value="CONFIRM">
                            </div>
                            <span class="my-2">OTP is only valid for 5 minutes</span>
                        </form>
                    </div>
                    ';
                    header("refresh:300");
                } else {
                    echo '
                    <h1 id="failTxt">Failed to send OTP</h1>
                    <a href="index.php" class="goTo" id="failedTxt">Regiser again</a>';
                }
            } else {
        ?>
        <script>
            alert("Password Did not match");
        </script>
        <?php
                header('Refresh: 0.1; url=http://localhost/saurabh/PHP/practical_programs/prog9');
            }
        }
        ?>
    </div>
</body>

</html>
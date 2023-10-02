<?php
/*
        B.Tech Computer Science and Engineering
        SAURABH YADAV
        202103103510362
    */
?>

<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <title>Register Message</title>
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            include_once "conn.ini.php";

            if (!$conn) {
        ?>
                <script>
                    alert("Unable to reach our server! Try again later with your internet switched on.");
                </script>
        <?php
            } else {

                $serachSQL = "SELECT email FROM subscribers WHERE email = ?";
                $searchSMTM = $conn->prepare($serachSQL);
                $searchSMTM->bind_param("s", $_POST['subscriberEmail']);

                if ($searchSMTM->execute()) {
                    $result = $searchSMTM->get_result();
                    $previousEmail = $result->fetch_assoc();
                    if (is_null($previousEmail)) {
                        echo "Subscriber not found";
                        $sql = "INSERT INTO subscribers (email) VALUES(?)";
                        $smtm = $conn->prepare($sql);
                        $smtm->bind_param("s", $_POST['subscriberEmail']);

                        if ($smtm->execute()) {
                            echo '
                        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                        <i class="checkmark" id="sucess">✓</i>
                        </div>
                        <h1 id="scressTxt">SUBSCRIBED</h1>
                        <p>Now you will receive latest updates to the blog page on your email address.</p>
                        <a href="/" class="goTo" id="sucessText">Back</a>';
                        } else {
                            echo '
                        <div style="border-radius:200px; height:200px; width:200px; background: #FFB3B3; margin:0 auto;">
                        <i class="checkmark" id="fail">X</i>
                        </div>
                        <h1 id="failTxt">FAILED</h1>
                        <a href="/" class="goTo" id="failedTxt">Back</a>
                        ';
                        }
                    } else {
                        echo '
                        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                        <i class="checkmark" id="sucess">✓</i>
                        </div>
                        <h1 id="scressTxt">SUBSCRIBED</h1>
                        <p>Now you will receive latest updates to the blog page on your email address.</p>
                        <a href="/" class="goTo" id="sucessText">Back</a>';
                    }
                }
            }
        }
        ?>
    </div>
</body>

</html>
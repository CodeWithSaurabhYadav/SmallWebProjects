<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $loginUser =  $_POST['username'];
        $loginPassword = $_POST['password'];

        include_once "conn.ini.php";
    
        $sql = "SELECT username,password from user where username = ?";
        $smtm = $conn->prepare($sql);
        $smtm->bind_param("s",$loginUser);
        $smtm->execute();

        $result = $smtm->get_result();
        $loginResult = $result->fetch_assoc();

        session_start();
        $_SESSION['blogUsername'] = $loginResult['username'];
        $_SESSION['blogPassword'] = $loginResult['password'];

        if ($loginUser == $_SESSION['blogUsername'] && $loginPassword == $_SESSION['blogPassword']) {
            if (!isset($_COOKIE['blogUsername'])){
                setcookie('blogUsername',$_SESSION['blogUsername'],time() + (86400),'/');
                setcookie('blogPassword',$_SESSION['blogPassword'],time() + (86400),'/');
            }
            header("Location: ../dashboard.php");
        } else {
            ?> 
            <script>
                alert("Invalid Credentials");
            </script>
            <?php
            header("Refresh: 0.5, URL=authenticate.php");
        }
    }
?>
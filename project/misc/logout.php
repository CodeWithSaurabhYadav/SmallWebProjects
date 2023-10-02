<?php
    session_destroy();
    setcookie('blogUsername',"", time() - 3600,"/"); 
    setcookie('blogPassword', "", time() - 3600,"/"); 
    echo "DONE";
    header("Location: ../authenticate.php");
?>
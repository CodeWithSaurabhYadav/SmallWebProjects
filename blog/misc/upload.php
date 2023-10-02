<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once "conn.ini.php";

    $newDate = date("Y-m-d");
    $newBlogTitle = $_POST['newBlogTitle'];
    $newBlogContent = $_POST['newBlogContent'];
    $newBlogWriter = $_POST['newBlogWriter'];

    $fileUpload = $_FILES['newBlogImage'];

    $sql = 'INSERT INTO blog (blogDate,blogTitle,blogImageUrl,blogDescription,blogWriter) VALUES (?,?,?,?,?)';
    $smtm = $conn->prepare($sql);
    $smtm->bind_param("sssss", $newDate, $newBlogTitle, $fileUpload['name'], $newBlogContent, $newBlogWriter);

    if ($smtm->execute()) {
        if (move_uploaded_file($fileUpload["tmp_name"], "../blogImages/" . $fileUpload['name'])) {

            $notifySQL = "SELECT email FROM subscribers";
            $result = $conn->query($notifySQL);


            $subscribersArray = array();
            foreach ($result as $r) {

                $subscribersArray[] = $r['email'];
            }
            $subscribersArrayTO = implode(", ", $subscribersArray);
            echo "<br>" . $subscribersArrayTO;

            $to = $subscribersArrayTO;
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
                    <h2>Hey, Subscriber</h2><br><br>
                    <h3>A New blog has been Posted on Sauraj Blogs Read it now.💖💖</h3>
                </body>
                </html>
                ';
            $headers = "From: sy8502630@gmail.com\r\n" . "Reply-To: noreply@mail.com\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to, $subject, $message, $headers);


            ?>
                <script>
                    alert("Blog Posted");
                </script>
            <?php
            header("Refresh: 0.5, URL=../dashboard.php");
        }
    }
}
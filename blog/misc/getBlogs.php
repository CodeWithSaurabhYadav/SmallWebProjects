<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include "conn.ini.php";

    ?>
    <?php
    if ($conn) {
        $sql = "SELECT id,blogTitle FROM blog";
        $result = $conn->query($sql);
        $row = mysqli_fetch_all($result);

        $conn->close();

        $q = $_REQUEST["q"];
        foreach($result as $val){
            if (stristr($val['blogTitle'],$q)){
                echo '
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">'.$val['blogTitle'].'</h2>
                        <a class="text-indigo-500 inline-flex items-center mt-4" href="readBlog.php?id='.$val['id'].'">Read
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            ';
            }
        }
    } else {
        $hint = "Could not load hint";
    }
    ?>
</body>

</html>



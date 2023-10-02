<?php

if (!isset($_COOKIE["blogUsername"])) {
    header("Location: authenticate.php");
}
session_start();

include "misc/conn.ini.php";

if ($conn) {
    $sql = "SELECT * FROM user WHERE username = ?";
    $smtm = $conn->prepare($sql);
    $smtm->bind_param("s", $_SESSION['blogUsername']);
    $smtm->execute();

    $resultData = $smtm->get_result();
    $resultDataValues = $resultData->fetch_assoc();

    $_SESSION['user'] = $resultDataValues['name'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saurabh Blogs | Dashboard</title>


    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="text-gray-400 bg-gray-900 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
                <a class="mr-5 hover:text-white cursor-pointer" href="/">Home</a>
                <a class="mr-5 hover:text-white cursor-pointer">About</a>
                <a class="mr-5 hover:text-white cursor-pointer">Contact</a>
                <a class="hover:text-white cursor-pointer">My Details</a></a>
            </nav>
            <a class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-white lg:items-center lg:justify-center mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl xl:block lg:hidden">Sauraj Blogs</span>
            </a>
            <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
                <a class="cursor-pointer inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0" href="misc/logout.php">Log Out
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center mt-20">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900" style="text-transform: CAPITALIZE;">Hey, <?php echo $_SESSION['user'] ?></h1>
        <p class="text-xl">Here is your dashboard to post a new Blob.👍</p>
    </div>
    
    <div class="flex justify-center">
        <form action="misc/upload.php" class="w-full p-12" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 w-9/12" >Title</label >
                <input name="newBlogTitle" type="text" class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleFormControlInput1" placeholder="Example label" />
            </div>
            <div class="mb-3 w-full">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700 w-full">Upload Image</label>
                <input name="newBlogImage" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile"  accept="image/png, image/gif, image/jpeg" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label inline-block mb-2 text-gray-700">Blog Content</label>
                <textarea name="newBlogContent" class="resize-none form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none " id="exampleFormControlTextarea1" rows="15" placeholder="Blog Content" ></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 w-9/12"
                >Writer Name</label >
                <input name="newBlogWriter" type="text" class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleFormControlInput1" placeholder="Example label" value="<?php echo $_SESSION['user'] ?>" readonly/>
            </div>
            <div class="mb-3">
                <input type="submit" value="POST BLOG" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</body>

</html>
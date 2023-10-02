<?php

if (isset($_COOKIE['blogUsername'])) {
    include_once "misc/conn.ini.php";
    session_start();
    $_SESSION['blogUsername'] = $_COOKIE['blogUsername'];
    $_SESSION['blogPassword'] = $_COOKIE['blogPassword'];

    $sql = "SELECT username,password from user WHERE username = ?";
    $smtm = $conn->prepare($sql);
    $smtm->bind_param("s",$_SESSION['blogUsername']);
    $smtm->execute();
    $result = $smtm->get_result();
    $data = $result->fetch_assoc();

    $serverUser =  $data['username'];
    $serverPasword = $data['password'];


    echo $_SESSION['blogUsername']."<br>";
    echo $_SESSION['blogPassword']."<br>";
    echo $serverUser."<br>";
    echo $serverPasword."<br>";

    if ($_SESSION['blogUsername'] == $serverUser && $serverPasword == $_SESSION['blogPassword']) {
        header("Location: dashboard.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autheticate</title>

    
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Login In</h1>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <form action="misc/login.php" method="POST">
                <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Email</label>
                                <input type="email" id="username" name="username" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Password</label>
                                <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                    </div>
                    <div class="p-2 w-full">
                        <input type="submit" class=" w-32 flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded " value="Log In" />
                        <a href="signUp" class=" w-32 my-4 flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded ">Sign Up</a>
                    </div>
                </form>
                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                        <a class="text-indigo-500">Forgot Password</a><br>
                        <a class="text-indigo-500" href="/">Go to homepage</a>
                        <br>
                        <span class="inline-flex my-7">
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a class="ml-4 text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a class="ml-4 text-gray-500">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                </svg>
                            </a>
                            <a class="ml-4 text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAURAJ | Search Blog</title>

    <script>
        function showHint(str) {
            if (str == "") {
                document.getElementById("suggestions").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("suggestions").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "misc/getBlogs.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <header class="text-gray-400 bg-gray-900 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-blue-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl cursor-pointer">Sauraj Blogs</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-white cursor-pointer" href="/">Home</a>
                <a class="mr-5 hover:text-white cursor-pointer">About</a>
                <a class="mr-5 hover:text-white cursor-pointer">Contact Us</a>
                <a class="mr-5 hover:text-white cursor-pointer" href="searchBlog.php">Search Blog</a>
            </nav>
            <a class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0" href="authenticate.php">POST BLOG
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </header>

    <div class="flex justify-center mt-12">
        <div class="mb-3 xl:w-96">
            <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700">Search for blog</label>
            <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleFormControlInput1" onkeyup="showHint(this.value)" placeholder="Type the title" />
        </div>
    </div>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100" id="suggestions">
            </div>
        </div>
    </section>

</body>

</html>
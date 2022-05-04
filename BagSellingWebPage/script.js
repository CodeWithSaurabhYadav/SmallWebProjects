navbar2 = document.querySelector(".navbar2").querySelectorAll(".navbar2 ul.nav2-ul-2 li a");
console.log(navbar2);

navbar2.forEach(element => {
    element.addEventListener("click", function(){
        navbar2.forEach(nav=>nav.classList.remove("active"))

        this.classList.add("active");
    })
});

if (screen.width < 500) {
    console.log()
    $(".left").remove();
}

console.log(screen.width)
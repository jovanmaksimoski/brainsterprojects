document.addEventListener("DOMContentLoaded", function () {
    const scrollDownBtn = document.getElementById("scrollDownBtn");
    const targetElement = document.querySelector(".flex.flex-col.items-center.justify-center.p-5");

    scrollDownBtn.addEventListener("click", function () {
        targetElement.scrollIntoView({
            behavior: "smooth"
        });
    });
});
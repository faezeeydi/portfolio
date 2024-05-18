const navBtn = document.querySelector(".nav__btn")
const Menu = document.querySelector(".menu")

let navOpen = false;
navBtn.addEventListener("click", function () {
    if (navOpen) {
        navBtn.classList.remove("nav__btn--open")
        Menu.classList.remove("menu--open")
        navOpen = false
    } else {
        navBtn.classList.add("nav__btn--open")
        Menu.classList.add("menu--open")
        navOpen = true
    }
})
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

const Nav = document.querySelector(".nav");
const Menu_Link = document.querySelector(".menu");
const scroll_top = document.querySelector(".scroll-top");
var scrollTrigger = 10;

window.onscroll = function() {
  if (window.scrollY >= scrollTrigger) {
    Nav.classList.add("nav--scroll");
    scroll_top.classList.add("scroll-top--active");
    Menu_Link.classList.add("menu--scroll-position");
    if (screen.width > 767){
      Menu_Link.classList.add("menu--scroll-color");
    }
  } else {
    Nav.classList.remove("nav--scroll");
    scroll_top.classList.remove("scroll-top--active");
    Menu_Link.classList.remove("menu--scroll-color");
    Menu_Link.classList.remove("menu--scroll-position");
  }
};
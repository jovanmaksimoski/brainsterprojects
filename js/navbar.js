"use strict";

// ----------------------NAVBAR----------------- //

const navBtn = document.querySelector(".navbar-toggle");
const menu = document.querySelector(".menu-wrapper");
const closeBtn = document.querySelector(".close-btn");

navBtn.addEventListener("click", () => {
  menu.classList.add("open");
});

closeBtn.addEventListener("click", () => {
  menu.classList.remove("open");
});

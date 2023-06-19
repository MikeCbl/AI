import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
  const sunIcon = document.querySelector(".sun");
  const moonIcon = document.querySelector(".moon");

  const userTheme = localStorage.getItem("theme");
  const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

  const iconToggle = () => {
    moonIcon.classList.toggle("display-none");
    sunIcon.classList.toggle("display-none");
  };

  const themeCheck = () => {
    if (userTheme === "dark" || (!userTheme && systemTheme)) {
      document.documentElement.classList.add("dark");
      moonIcon.classList.add("display-none");
    } else {
      sunIcon.classList.add("display-none");
    }
  };

  const themeSwitch = () => {
    if (document.documentElement.classList.contains("dark")) {
      document.documentElement.classList.remove("dark");
      localStorage.setItem("theme", "light");
    } else {
      document.documentElement.classList.add("dark");
      localStorage.setItem("theme", "dark");
    }

    iconToggle();
  };

  sunIcon.addEventListener("click", themeSwitch);
  moonIcon.addEventListener("click", themeSwitch);

  themeCheck();
});

document.addEventListener("DOMContentLoaded", function () {
  const button = document.querySelector('[data-drawer-toggle="sidebar-multi-level-sidebar"]');
  const sidebar = document.querySelector("aside");

  button.addEventListener("click", function () {
    sidebar.classList.toggle("translate-x-0");
  });

  document.addEventListener("click", function (event) {
    if (!sidebar.contains(event.target) && !button.contains(event.target)) {
      sidebar.classList.remove("translate-x-0");
    }
  });
});

function toggleMenu() {
  const menu = document.getElementById("navbarSupportedContent");
  menu.classList.toggle("hidden");
}

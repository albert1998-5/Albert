let header = document.querySelector("header");
window.addEventListener("scroll", () => {
  if (window.pageYOffset != 0) {
    header.style = "background-color: rgba(0,0,0,0.8);animation: fadein 1.5s ease;";
  } else {
    header.style = "color:#fff;";
  }
});
let a = document.querySelectorAll('.link');
window.addEventListener("scroll", () => {
  if (window.pageYOffset != 0) {
    a[0].style = "color: #fff;";
    a[1].style = "color: #fff;";
    a[2].style = "color: #fff;";
    a[3].style = "color: #fff;";
  } else {
    a[0].style = "color: #000;";
    a[1].style = "color: #000;";
    a[2].style = "color: #000;";
    a[3].style = "color: #000;";
  }
});

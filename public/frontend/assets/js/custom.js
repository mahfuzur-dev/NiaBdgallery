const nav = document.querySelectorAll(".nav-link");
nav.forEach(navlink => {
     navlink.addEventListener('click', function() {
          document.querySelector('.active')?.classList.remove('active');
          this.classList.add('active');
     });
});

//==== Back-to-top button
  $(window).on('scroll', function(event) {
    if($(this).scrollTop() > 600){
        $('.back-to-top').fadeIn(200)
    } else{
        $('.back-to-top').fadeOut(200)
    }
});
//==== Animate the scroll to top
$('.back-to-top').on('click', function(event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: 0,
    }, 1000);
});

// sticky menu js 
$(window).scroll(function () {
  var sticky = $(this).scrollTop()
  if (sticky > 300) {
    $(".navbar").addClass("sticki_menu");
  } else {
    $(".navbar").removeClass("sticki_menu");
  }
});

// sticky menu js

const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 1000;
priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});
rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);
    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});


function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function account(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}



// Shop Grid
var li_links = document.querySelectorAll(".shop_nav_icon ul li");
var view_wraps = document.querySelectorAll(".view-wrap");
var list_view = document.querySelector(".list_view");
var grid_view = document.querySelector(".grid_view");

li_links.forEach(function (link) {
  link.addEventListener("click", function () {
    li_links.forEach(function (item) {
      item.classList.remove("active");
    })
    link.classList.add("active");
    var li_view = link.getAttribute("data-view");
    
    view_wraps.forEach(function (view) {
      view.style.display = "none";
    });
    if (li_view == "list-view") {
      list_view.style.display = "block";
    } else {
      grid_view.style.display = "block";
    }

  });
});







var quantity = $("#quantity").val();

$("#plus").click(function () {
  quantity++;
  $("#quantity").val(quantity);
});
$("#minus").click(function () {
  if (quantity > 1) {
    quantity--
    $('#quantity').val(quantity);
  }
});






// Banner Slick Slider
$(".banner_slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2500,
  prevArrow: '<i class="fa-solid fa-chevron-left left_arrow"></i>',
  nextArrow: '<i class="fa-solid fa-chevron-right right_arrow"></i>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
           dots: false,
        arrows:false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
           slidesToScroll: 1,
        arrows:false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
           slidesToScroll: 1,
        arrows:false,
      },
    },
  ],
});
// Banner Slick Slider
// Category Slick Slider
$(".category_slider").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
  arrows:false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
      },
    },
  ],
});
// Category Slick Slider




// Product Slick Slider
$(".product_slider").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 15500,
  prevArrow: '<i class="fa-solid fa-chevron-left left_arrow_product"></i>',
  nextArrow: '<i class="fa-solid fa-chevron-right right_arrow_product"></i>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      },
    },
  ],
});
// Client Slick Slider
$(".client_slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  arrows: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      },
    },
  ],
});
// Product Slick Slider
// Product Details
 $(".slider-for").slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   asNavFor: ".slider-nav",
 });
 $(".slider-nav").slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   autoplay: true,
   arrows: false,
   autoplaySpeed: 2000,
   asNavFor: ".slider-for",
   dots: false,
   centerMode: false,
   focusOnSelect: true,
 });
// Counter Js
$(function () {
  $(".counter").counterUp({
    delay: 10,
    time: 2000,
  });
});





// Password Eye

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function (e) {
  const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
  this.classList.toggle("fa-eye");
});

// Password Eye

const toggleconPassword = document.querySelector("#toggleconPassword");
const conpassword = document.querySelector("#conpassword");

toggleconPassword.addEventListener("click", function (e) {
  const type =
    conpassword.getAttribute("type") === "password" ? "text" : "password";
  conpassword.setAttribute("type", type);
  this.classList.toggle("fa-eye");
});









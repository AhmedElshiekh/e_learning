import $ from "jquery";

$(document).ready(function () {
  $(".div_in_sections").hover(
    function () {
      $(this).siblings(".background").hide();

      $(this).children("p").css("color", "black");
      $(this).siblings(".courses .Sections ").css("background", "#f8951d;");
    },
    function () {
      $(".background").show();
      $(this).parent(".courses .Sections ").css("background", "transparent");
    }
  );

  $("#overview_one").click(function () {
    $("#instructor").removeClass("active");
    $(this).addClass("active");
  });

  $("#instructor").click(function () {
    $("#overview_one").removeClass("active");
    $(this).addClass("active");
  });

  $(".headernav_mobile .navbar-toggler").click(function () {
    $("#collapsibleNavbar").show();
  });

  $(".collapsed").click(function () {
    $(this).siblings("panel-heading").fadeToggle();
  });
  //   $(window).scroll(function(){
  //     if($(window).scrollTop() > 500){
  //         $(".courses .slick-slider").addClass("animate_header2");
  //     }
  //     if($(window).scrollTop() > 700){
  //         $(".courses .row_bottom").addClass("animate_header");
  //     }
  //     if($(window).scrollTop() > 1500){
  //       $(".counter .counter_divs").addClass("animate_header");
  //     }
  //     if($(window).scrollTop() > 1900){
  //       $(".classes").addClass("animate_header2");
  //     }

  //   if($(window).scrollTop() > 2700){
  //     $(".testing .row").addClass("animate_header");
  //   }
  // if($(window).scrollTop() > 3000){
  //   $(".instructors").addClass("animate_header2");
  // }

  // // });
  // // $(".profile .classes .part_img ").hover(function(){
  //   $(".profile .classes .part_img .action").show();
  // });

  $("#dropdownMenu").click(function () {
    $("#ul_form_droupdown").slideToggle();
  });
  $(document).on("click", function (event) {
    var $trigger = $(".dropdown");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".dropdown-menu").slideUp("fast");
    }
  });
  $(".slider").not(".slick-initialized").slick();
  $(".responsive-slider").slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: false,
          arrows: true,
        },
      },

      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },

      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ],
  });
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
    asNavFor: ".slider-for",
    dots: true,
    focusOnSelect: true,
  });

  $("a[data-slide]").click(function (e) {
    e.preventDefault();
    var slideno = $(this).data("slide");
    $(".slider-nav").slick("slickGoTo", slideno - 1);
  });

  $("#changbuttton").click(function () {
    $("#password_Change").fadeIn();
  });
  $(".headernav_mobile .ul_list li").click(function () {
    $("#collapsibleNavbar2").removeClass("show");
  });
});

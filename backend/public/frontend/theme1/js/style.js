$(document).ready(function(){

     
$('.div_in_sections').hover(function(){
	$(this).siblings(".background").hide();
	
	$(this).children("p").css("color","black");
	$(this).siblings(".courses .Sections ").css("background","#f8951d;");
}, function(){
	$(".background").show();
	$(this).parent(".courses .Sections ").css("background","transparent");
	
});

	  


	$('#overview').click(function(){
	   $(".categorie_ul li a").removeClass("active");
	   $(this).addClass("active");
	   $(".overview").show();
	   $(".lessons").hide();
	   $(".instructor").hide();
     });	
	$('#lesson').click(function(){
	   $(".categorie_ul li a").removeClass("active");
	   $(this).addClass("active");
	   $(".overview").hide();
	   $(".instructor").hide();
	   $(".lessons").show();
     });	
	$('#instructor').click(function(){
	   $(".categorie_ul li a").removeClass("active");
	   $(this).addClass("active");
	   $(".overview").hide();
	   $(".lessons").hide();
	   $(".instructor").show();
     });	

	$('.headernav_mobile .navbar-toggler').click(function(){
	   $("#collapsibleNavbar").show();
     });	
	 $('#scrollToTop').click(function(){
	$('html, body').animate({scrollTop : 0},800);
	return false;
});	

	$('#dropdownMenuButton1').click(function(){
	   $(".dropdown-menu").fadeToggle();
     });	
     
     $(".collapsed").click(function(){
       $(this).siblings("panel-heading").fadeToggle();
     });

	 
	
});
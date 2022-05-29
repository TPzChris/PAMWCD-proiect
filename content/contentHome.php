<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="/css/home.css" />

</head>
<body style="background-color: #717171;">

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 2</div>
  <img src="./../images/general/Best-electric-guitars-under-500-1000-300-and-200.jpg" style="width:100%">
  <div class="text">Instrumente electrice</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 2</div>
  <img src="./../images/general/logo2.png" style="width:100%">
  <div class="text">Magazin</div>
</div>


</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html> 
<?php
include 'layout/bottomnav.php';
include '../src/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/welcome.css">


  </head>
<body>

   <!--ARROWS--->
   <a class="carousel-control-prev d-none" href="#carouselExampleDark" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon left" aria-hidden="true"></span>
    <span class="visually-hidden left">Previous</span>
  </a>
  <a class="carousel-control-next d-none" href="#carouselExampleDark" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon right" aria-hidden="true"></span>
    <span class="visually-hidden right">Next</span>
  </a>



<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-wrap="false" data-bs-interval="false" data-bs-touch="true">

  <div class="carousel-inner">

    <div class="carousel-item active" >
    <div class="slide1"><h3 class="mx-5">Välkommen till Officefinder. Ditt nya sätt att hitta kontor runt om i Sverige!</h3></div>
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
    <div class="slide2"><h3 class="mx-5">Hos oss hittar du information om flera olika kontorshotell, allt för att hitta ett kontor som passar dig bäst.</h3></div>
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
    <div class="slide3"><h3 class="mx-5">Börja med att lokalisera dig själv på kartan eller välj från vår lista av kontor. Klicka på denna knappen vid start sidan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg></a>
 </h3></div>
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
    <div class="slide4"><h3 class="mx-5">Klicka igång direkt och hitta din nästa arbetsplats!</h3></div>
    <a href="index.php"><button id="introbtn" class="btn btn-warning start-50 translate-middle position-absolute">klicka här</button></a>
      <div class="carousel-caption d-none d-md-block"></div>
    </div>


  </div>
 
</div>

<script >
// if (localStorage.getItem("visited")) {
//     window.location.href = "index.php";
// }
// localStorage.setItem("visited", "true");

var carouselLength = $('.carousel-item').length - 1;

// If there is more than one item
if (carouselLength) {
    $('.carousel-control-next').removeClass('d-none');
}

$('.carousel').on('slide.bs.carousel', function (e) {
    // First one
    if (e.to == 0) {
        $('.carousel-control-prev').addClass('d-none');
        $('.carousel-control-next').removeClass('d-none');
    } // Last one
    else if (e.to == carouselLength) {
        $('.carousel-control-prev').removeClass('d-none');
        $('.carousel-control-next').addClass('d-none');
    } // The rest
    else {
        $('.carousel-control-prev').removeClass('d-none');
        $('.carousel-control-next').removeClass('d-none');
    }
});
</script>
</body>
</html>



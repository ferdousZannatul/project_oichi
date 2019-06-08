<?php include "header.php";?>

<script>
    $(document).ready(function(){
        $('#index').addClass('active');
    });
</script>

<div id="carouselExampleIndicators" class="carousel carousel-fade" data-ride="carousel" data-interval="2000" data-pause="false" style="height:70% !important; overflow: hidden !important;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="image/malay.jpg" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/dubai.jpg" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/random1.jpg" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/qatar.jpg" alt="">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php include "footer.php";?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
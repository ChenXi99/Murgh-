<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="sale!2.css" rel="stylesheet">
    <title>Offer</title>

    <style>
    /* マップを表示する div 要素の高さを必ず明示的に指定します。 */
    #map {
    height: 400px;
    width: 600px;
    }
    </style>

</head>
<body>

<div class="screen">

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../sale.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="offer.php">My Offer</a></div>
          <div class="navbar-header"><a class="a_nav" href="market.php">Market</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Map</h1>

<div id="map" style='width:480px;height:480px;margin:auto;'></div><!-- 地図を表示する div 要素（id="map"）-->

            <form method="POST" action="" enctype="multipart/form-data">
                
            </form>
    
<script>
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 26.88353770941183, lng: 80.91297622037398},
      zoom: 7
    });
  }
</script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFVhB-uuYmqfqqL2tJFyohdk7sgBBuM7o&callback=initMap" async defer></script>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="sale!.css" rel="stylesheet">
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

//初期表示
  // var map;
  // function initMap() {
  //   map = new google.maps.Map(document.getElementById('map'), {
  //     center: {lat: 26.88353770941183, lng: 80.91297622037398},
  //     zoom: 7
  //   });
  // }

//infoboxチュートリアル
  // This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.
// function initMap() {
//   const lucknow = { lat: 26.88353770941183, lng: 80.91297622037398 };
//   const map = new google.maps.Map(document.getElementById("map"), {
//     zoom: 7,
//     center: lucknow,
//   });
//   const contentString =
//     '<div id="content">' +
//     '<div id="siteNotice">' +
//     "</div>" +
//     '<h1 id="firstHeading" class="firstHeading">Uluru</h1>' +
//     '<div id="bodyContent">' +
//     "<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large " +
//     "sandstone rock formation in the southern part of the " +
//     "Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) " +
//     "south west of the nearest large town, Alice Springs; 450&#160;km " +
//     "(280&#160;mi) by road. Kata Tjuta and Uluru are the two major " +
//     "features of the Uluru - Kata Tjuta National Park. Uluru is " +
//     "sacred to the Pitjantjatjara and Yankunytjatjara, the " +
//     "Aboriginal people of the area. It has many springs, waterholes, " +
//     "rock caves and ancient paintings. Uluru is listed as a World " +
//     "Heritage Site.</p>" +
//     '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
//     "https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
//     "(last visited June 22, 2009).</p>" +
//     "</div>" +
//     "</div>";
//   const infowindow = new google.maps.InfoWindow({
//     content: contentString,
//   });
//   const marker = new google.maps.Marker({
//     position: lucknow,
//     map,
//     title: "Uluru (Ayers Rock)",
//   });
//   marker.addListener("click", () => {
//     infowindow.open({
//       anchor: marker,
//       map,
//       shouldFocus: false,
//     });
//   });
// }

</script> 
<script type="text/javascript" src="script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFVhB-uuYmqfqqL2tJFyohdk7sgBBuM7o&libraries=places&callback=initAutocomplete" async defer></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFVhB-uuYmqfqqL2tJFyohdk7sgBBuM7o&callback=initMap" async defer></script> -->

</div>

</body>
</html>
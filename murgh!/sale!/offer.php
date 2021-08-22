<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="sale!.css" rel="stylesheet">
    <title>Offer</title>
</head>
<body>

    <div class="screen">

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../sale.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="market.php">Market</a></div>
          <div class="navbar-header"><a class="a_nav" href="map.php">Map</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>My Offer</h1>
    <form method="POST" action="insert_o.php">
        <div class="d"><label>Delivery Date  <input type="date" name="date"></label></div>
        <div class="d"><label>Number  <input type="number" name="number"></label>birds</div>
        <div class="d"><label>Price  <input type="number" name="price"></label>Rs./kg</div>
        <div class="d"><label>Terms
            <input type="radio" name="terms" value="ex-farm">Ex-farm</label>
            <input type="radio" name="terms" value="delivery included">Delivery included</label>
        </div>  
        <div class="d"><label>Payment</label>
            <select name="payment">
            <option value="cash on delivery">Cash</option>
            <option value="online, advance">Online, advance</option>
            <option value="online, deferred">Online, deferred</option>
            </select>
        </div>  
        <div class="d"><label>Notes  <textarea type="text" cols="50" rows="2" name="notes"></textarea></label></div>

        <input type="submit" class="btn" value="OFFER!">
        <p></p>
    </form>

    <p margin="0" align="center"><a href="offer_status.php">Browse Offer Status</a></p>

    </div>
</body>
</html>
<?php
session_start();
require_once('../funcs.php');

$pdo = db_conn();

if(isset($_POST['submit'])){
    // $POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE);//セキュリティ上、コードの内容をsanitizeする
    $upd_buy_offer = $pdo->prepare('UPDATE buy_offers SET eval=? WHERE id=?');
    $upd_buy_offer->execute(array($_POST['review'],$_REQUEST['id']));
}


if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time(); //最後の行動から1時間経過したらログアウト

  $users = $pdo->prepare('SELECT * FROM users WHERE id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();

} else {
  header('Location: ../login.php');
  exit();
}

if (empty($_REQUEST['id'])) {
    header('Location: offer_status.php');
    exit();
  }
  
$buy_offers = $pdo->prepare("SELECT u.name, u.image, u.mobile, b.* FROM 
users u, buy_offers b WHERE u.id=b.user_id AND b.id=? ");
$buy_offers->execute(array($_REQUEST['id']));


// var_dump($buy_offers['name']);
// var_dump(array($_REQUEST['id']));

// $buy_offers = $pdo->prepare("SELECT u.name, u.image, u.mobile, b.* FROM
// users u, buy_offers b WHERE u.id=b.user_id ORDER BY b.buy_offer_date ASC");
// $buy_offers->execute();

// print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="sale!2.css" rel="stylesheet">
    <title>Offer</title>
</head>
<body>

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

    <?php if ($buy_offer = $buy_offers->fetch()): ?>

    <div class="msg">
        <img class="dp" src="../user_image/<?php echo(h($buy_offer['image'])); ?>" width="200" height="200" />
        <p class="dpname"><?php echo(h($buy_offer['name'])); ?></p>

        <table style="font-size:18px; margin: 5px 60px;">
            <tr><td width="120px">Response:</td><td><?php echo(h($buy_offer['interest'])); ?></td></tr>
            <tr><td width="120px">Time:</td><td><?php echo(h($buy_offer['buy_offer_date'])); ?></td></tr>
            <tr><td width="120px">Mobile No.:</td><td style="font-weight:bold"><?php echo(h($buy_offer['mobile'])); ?><a href=""> 📞</a></td></tr>
        </table>

        <div class="notes">
            <p style="font-size:22px; font-weight:bold">Notes</p>
            <p><?php echo(h($buy_offer['notes'])); ?></p>
        </div>
    </div>

    <?php else: ?>
    <p>Oops.. something's wrong.</p>
    <?php endif; ?>
        
    <!-- 評価 -->
    <form method="POST" action="">

    <div class="review">
        <p>Review this buyer</p>
        <div class="stars">
        <span>
            <input id="review1" type="radio" name="review" value="5"><label for="review1">★</label>
            <input id="review2" type="radio" name="review" value="4"><label for="review2">★</label>
            <input id="review3" type="radio" name="review" value="3"><label for="review3">★</label>
            <input id="review4" type="radio" name="review" value="2"><label for="review4">★</label>
            <input id="review5" type="radio" name="review" value="1"><label for="review5">★</label>
        </span>
        </div>
    </div>

        <button class="btn" name="submit" type="submit" style="margin-left: 140px;">Close My Offer!</button>

        </form>
    </div>
    
</body>
</html>
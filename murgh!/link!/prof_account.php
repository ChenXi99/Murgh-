<?php
session_start();
require_once('../funcs.php');

$pdo = db_conn();

if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time(); //最後の行動から1時間経過したらログアウト

  $users = $pdo->prepare('SELECT * FROM users WHERE id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();

} else {
  header('Location: ../login.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="link!.css" rel="stylesheet">
    <title>Offer</title>
</head>
<body>

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../link.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="community.php">Community</a></div>
          <div class="navbar-header"><a class="a_nav" href="rank.php">Rank!</a></div>
          <div class="navbar-header"><a class="a_nav" href="recruit.php">Recruit!</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<!-- <h1>My Profile</h1> -->

    <img class="dp" src="../user_image/<?php echo(h($user['image']))?>" width="300" height="300" alt="<?php echo(h($user['name']))?>" />
    <p class="dpname"><?php echo(h($user['name'])); ?></p>
    <p class="type"><?php echo(h($user['type'])); ?></p>
    <p class="status"><?php echo(h($user['status'])); ?></p>
    <table>
        <tr><td>Experience </td><td><?php echo(h($user['experience'])); ?> years</td></tr>
        <tr><td>Capacity </td><td><?php echo number_format(h($user['capacity'])); ?> birds</td></tr>
        <tr><td>Location </td><td><?php echo(h($user['location'])); ?></td></tr>
        <tr><td>Mobile No. </td><td><?php echo(h($user['mobile'])); ?></td></tr>
    </table>
   
</body>
</html>
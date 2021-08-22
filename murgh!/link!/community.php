<?php
session_start();
require_once('../funcs.php');

$pdo = db_conn();

$users = $pdo->prepare('SELECT name,image FROM users WHERE id=?');
$users->execute(array($_SESSION['id']));
$user = $users->fetch();

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
          <div class="navbar-header"><a class="a_nav" href="rank.php">Rank!</a></div>
          <div class="navbar-header"><a class="a_nav" href="recruit.php">Recruit!</a></div>
          <div class="navbar-header"><a class="a_nav" href="prof_account.php">My Profile</a></div>
          <!-- <div class="navbar-header">
              <img class="dp_header" src="../user_image/<?php echo(h($user['image']))?>" alt="<?php echo(h($user['name']))?>" /></div>
          </div> -->
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Community</h1>

<h2 class="btn2"><a href="">National</a></h2>
<h2 class="btn2"><a href="sns.php">Regional</a></h2>
<h2 class="btn2"><a href="">Top Farmer💎</a></h2>

            <form method="POST" action="" enctype="multipart/form-data">
                
            </form>
    
</body>
</html>
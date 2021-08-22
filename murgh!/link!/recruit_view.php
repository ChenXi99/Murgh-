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

$recruits = $pdo->prepare('SELECT * FROM recruits ORDER BY id DESC LIMIT 1');
$recruits->execute();
$recruit = $recruits->fetch();

// print_r($recruit);

$date_from = strtotime($recruit['date_from']);
$date_until = strtotime($recruit['date_until']);
$salary = $recruit['salary'];
$salary_ttl = $salary * ( ($date_until - $date_from) / 86400 + 1);

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
 
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<div class="r_wrap">
    <div class="r1">
        <img class="dp_r" src="../user_image/<?= (h($user['image']))?>" width="70" height="70" alt="<?php echo(h($user['name']))?>" />
        <p class="dp_r_name"><?= (h($user['name'])); ?></p>
    </div>
    <div class="r2">
        <p><?= (h($user['experience'])); ?> years experience in poultry farming</p>
        <p><?= (h($user['location'])); ?></p>
    </div>
</div>

<div class="r_wrap2">
    <div class="r3">
        <button style="font-size:16px">#poultry</button>
        <button style="font-size:16px">#topfarmer</button>
        <button style="font-size:16px">#welcomebeginners</button>
    </div>

    <h3 style="color: white; margin-left:5px;">Job Description</h3>
    <div class="r4">
        <p style="margin-left:5px;"><?= (h($recruit['description'])); ?></p>
    </div>
    
    <table style="color:white">
        <tr><td>From:</td><td><?= (h($recruit['date_from'])); ?></td></tr>
        <tr><td>To:</td><td><?= (h($recruit['date_until'])); ?></td></tr>
        <tr><td>Salary:</td><td>Rs.<?= (h(number_format($recruit['salary']))); ?>/day</td></tr>
    </table>
    <table style="color:white">
        <tr style="font-weight:bold"><td>Total Salary:</td><td>Rs.<?= (h(number_format($salary_ttl))); ?></td></tr>
    </table>

</div>

<div class="r5">
    <p style="margin-left:5px;"><?= (h($recruit['notes'])); ?></p>
</div>

<div class="r6">
    <button>Send my profile</button>
    <button>Ask question</button>
</div>
    
</body>
</html>
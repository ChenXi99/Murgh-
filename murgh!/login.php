<?php
session_start();
require('funcs.php');
$pdo = db_conn();

if ($_COOKIE['email'] !== '') {
  $email = $_COOKIE['email'];
}

if (!empty($_POST)) {
  $email = $_POST['email'];
  if ($_POST['email'] !== '' && $_POST['password'] !== '') {
$login = $pdo->prepare('SELECT * FROM users WHERE email =? AND password =?');
$login->execute(array(
  $_POST['email'], 
  sha1($_POST['password'])
)); //sha1は、非可逆暗号。暗号化したものから推測はできない
$member = $login->fetch();

if ($member) {
  $_SESSION['id'] = $member['id']; //ログイン情報を同セッション内で保存
  $_SESSION['time'] = time(); //セキュリティの為passwordは保存しない！

//   if ($_POST['save'] === 'on') {
//     setcookie('email', $_POST['email'], time()+60*60*24*14);
//   }
//次回から入力省略できる

  header('Location: top.html');
  exit();
} else {
  $error['login'] = 'failed';
}
  } else {
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href="top.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>Login</title>
<link href="login.css" rel="stylesheet">
</head>
<body>

<div class="icon_wrap1">
    <div class="icon"><a href=""><img src="murgh.png" alt=""></a></div>
    <div class="icon"></div>
</div>

<div class="icon_wrap2">
  <form action="" method="post">
  ID:<input type="email" name="email" /><br>
  PW:<input type="password" name="password" /><br>
  <input type="submit" value="LOGIN" />
  </form>

  <div class=""><br><a href="create_account.php">Create Account</a></br></div>

</div>

</body>
</html>
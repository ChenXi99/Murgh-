<?php
session_start();
require('funcs.php');
$pdo = db_conn();

if (!isset($_SESSION['join'])){
	header('Location:create_account.php');
	exit();
}

if (!empty($_POST)) {
	$statement = $pdo->prepare( 'INSERT INTO users SET type=?, 
    name=?, email=?, password=?, mobile=?, location=?, capacity=?,
    image=?, created=NOW()' );
	echo $statement->execute(array(
        $_SESSION['join']['type'],
		$_SESSION['join']['name'],
		$_SESSION['join']['email'],
		sha1($_SESSION['join']['password']),
        $_SESSION['join']['mobile'],
        $_SESSION['join']['location'],
        $_SESSION['join']['capacity'],
		$_SESSION['join']['image'],
	));
	unset($_SESSION['join']);

	header('Location: thanks.php');
	exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Check</title>

	<link rel="stylesheet" href="top.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>Check contents</h1>
</div>

<div id="content">
<p>Pls check out below contents. If ok, press REGISTER!</p>
<form action="" method="post">
	<input type="hidden" name="action" value="submit" />
	<dl>
		<dt>Type</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['type'], ENT_QUOTES)); ?>
        </dd>
        <dt>Name</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>
        </dd>
		<dt>Email</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
        </dd>
		<dt>Password</dt>
		<dd>
		【Password is not shown. Pls keep a memo!】
		</dd>
        <dt>Mobile no.</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['mobile'], ENT_QUOTES)); ?>
        </dd>
        <dt>Farm Location</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['location'], ENT_QUOTES)); ?>
        </dd>
        <dt>Farm Capacity</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['capacity'], ENT_QUOTES)); ?>
        </dd>

		<dt>Profile Picture</dt>
		<dd>
		<?php if ($_SESSION['join']['image'] !=='' ): ?>
		<img src="user_image/<?php print(htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES)); ?>">
		<?php endif; ?>
		</dd>
	</dl>
	<div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="REGISTER" /></div>
</form>
</div>

</div>
</body>
</html>
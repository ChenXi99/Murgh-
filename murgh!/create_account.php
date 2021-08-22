<?php
session_start();
require('funcs.php');

if (!empty($_POST)){
	if ($_POST['type'] === ''){
		$error['type'] = 'blank';
	} 
    if ($_POST['name'] === ''){
		$error['name'] = 'blank';
	} 
	if ($_POST['email'] === ''){
		$error['email'] = 'blank';
	} 
	if (strlen($_POST['password']) < 6 ){
		$error['password'] = 'length';
	} 
	if ($_POST['password'] === ''){
		$error['password'] = 'blank';
	} 
    if ($_POST['mobile'] === ''){
		$error['mobile'] = 'blank';
	} 
	$fileName = $_FILES['image']['name'];
	if(!empty($fileName)){
		$ext = substr($fileName, -3);
		if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
			$error['image'] = 'type';
		}
	}
	
	// アカウント重複チェック ※なぜ実装できない？！
	// if (empty($error)){
	// 	$member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
	// 	$member->execute(array($_POST['email']));
	// 	$record = $member->fetch(); //いなければ０
	// 	if ($record['cnt'] > 0) {
	// 		$erroe['email'] = 'duplicate';
	// 	}
	// }

	if (empty($error)){
		$image = date('YmdHis') . $_FILES['image']['name'];
		// ファイル名の作成
		move_uploaded_file($_FILES['image']['tmp_name'], 'user_image/' . $image);
		$_SESSION['join'] = $_POST;
		$_SESSION['join']['image'] = $image;
		header('Location: check.php');
		exit();
	}
}
// フォーム送信した時のみエラーチェック
// phpではボタンクリックしたかは判別つかないので、!empty (空ではない)として判別

if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])){
	$_POST = $_SESSION['join'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CreateAccount</title>

	<link rel="stylesheet" href="create_account.css" />
	
</head>

<body>
<div id="head">
	<h1>Create Your Account</h1>
</div>

<div id="">
	<p>Pls fill out below contents!</p>

	<form action="" method="post" enctype="multipart/form-data">
		<dl>
			<dt>You are..<span class="required">*required</span></dt>
			<dd>
				<input type="radio" name="type" value="Farmer">Farmer<br>
				<input type="radio" name="type" value="Dealer">Dealer</p>
				<?php if ($error['type'] === 'blank'): ?>
				<p class="error">Pls choose your type.</p>
				<?php endif; ?>
			</dd>

			<dt>Name<span class="required">*required</span></dt>
			<dd>
				<input type="text" name="name" size="35" maxlength="255" value="<?php print (htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" />
				<?php if ($error['name'] === 'blank'): ?>
				<p class="error">Pls enter your name.</p>
				<?php endif; ?>
			</dd>

			<dt>Email<span class="required">*required</span></dt>
			<dd>
				<input type="text" name="email" size="35" maxlength="255" value="<?php print (htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>" />
				<p>This email address will be your login ID!</p>
				<?php if ($error['email'] === 'blank'): ?>
				<p class="error">Pls enter your email.</p>
				<?php endif; ?>
				<?php if ($error['email'] === 'duplicate'): ?>
				<p class="error">Your email is already in use.</p>
				<?php endif; ?>

			<dt>Password<span class="required">*required</span></dt>
			<dd>
				<input type="password" name="password" size="15" maxlength="35" value="<?php print (htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" />
				<?php if ($error['password'] === 'length'): ?>
				<p class="error">Password needs to be at least 6 letters.</p>
				<?php endif; ?>
				<?php if ($error['password'] === 'blank'): ?>
				<p class="error">Pls enter your password.</p>
				<?php endif; ?>

			<dt>Mobile No.<span class="required">*required</span></dt>
			<dd>
				<input type="tel" name="mobile" size="15" maxlength="35" value="<?php print (htmlspecialchars($_POST['mobile'], ENT_QUOTES)); ?>" />
				<?php if ($error['mobile'] === 'blank'): ?>
				<p class="error">Pls enter your mobile no..</p>
				<?php endif; ?>

			<dt>Location</dt>
			<dd>
				<input type="text" name="location" size="55" maxlength="280" value="<?php print (htmlspecialchars($_POST['location'], ENT_QUOTES)); ?>" />
			
			<dt>Farm Capacity (no. of birds)<span class="">*for farmers only</span></dt>
			<dd>
				<input type="text" name="capacity" size="10" maxlength="20" value="<?php print (htmlspecialchars($_POST['capacity'], ENT_QUOTES)); ?>" />birds

			</dd>
			

			<dt>Profile Picture</dt>
			<dd>
				<input type="file" name="image" size="35" value="test"  />
				<?php if ($error['image'] === 'type'): ?>
				<p class="error">Pls choose other file type.</p>
				<?php endif; ?>
			</dd>
		</dl>

		<div><input type="submit" value="Check Contents!" /></div>
	</form>
</div>
</body>
</html>
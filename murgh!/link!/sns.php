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

if (!empty($_POST)) {
  if ($_POST['message'] !== '') {
    $message = $pdo->prepare('INSERT INTO posts SET user_id=?, 
    message=?, reply_message_id=?, created=NOW()');
    $message->execute(array(
    $user['id'], //SESSIONよりDBのIDの方が確実
    $_POST['message'],
    $_POST['reply_post_id'],
    ));

    header('Location: sns.php'); 
    //同じ画面を初期状態で呼び出す(これがないとリロードの度に投稿される)
    exit();
  }
}


if (!empty($_GET)) {
  if ($_GET['post_id'] !== '') {

    $new_likes = $_GET['current_like']+1;

    $like_stmt = $pdo->prepare('UPDATE posts SET liked=? WHERE id=?');
    $like_stmt->execute(array($new_likes, $_GET['post_id']));

    header('Location: sns.php'); 
    //同じ画面を初期状態で呼び出す(これがないとリロードの度に投稿される)
    exit();
  }
}

$page = $_REQUEST['page'];
if ($page == '') {
  $page = 1;
}
$page = max($page, 1); //１以下にはならないように

$counts = $pdo->query('SELECT count(*) AS cnt FROM posts');
$cnt = $counts->fetch();
$maxPage = ceil($cnt['cnt'] / 5);
$page = min($page, $maxPage); //メッセージのあるページ分だけ表示

$start = ($page - 1) * 5;

$posts = $pdo->prepare('SELECT u.name, u.image, p.* FROM 
users u, posts p WHERE u.id=p.user_id ORDER BY p.created DESC LIMIT ?,5'); //５件ずつ
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();


//入力した値を使うわけではないので、query methodでSQL呼び出す
//u, pは、テーブルの略称。
//usersテーブルのname, image, postsテーブルの全ての値
//WHERE~~: 両テーブルのidを一致

if (isset($_REQUEST['res'])) {
  //返信処理
  $response = $pdo->prepare('SELECT u.name, u.image,
  p.* FROM users u, posts p WHERE u.id=p.user_id AND p.id=?');

  $response->execute(array($_REQUEST['res']));

  $table = $response->fetch();
  $message = '@' . $table['name'] . ' ' . $table['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="link!.css" rel="stylesheet">
    <title></title>
</head>
<body>

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../link.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="rank.php">Rank!</a></div>
          <div class="navbar-header"><a class="a_nav" href="recruit.php">Recruit!</a></div>
          <div class="navbar-header"><a class="a_nav" href="prof_account.php">Profile</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Regional</h1>

<form action="" method="post">
      <dl>
        <dt><?php echo(h($user['name'])); ?> 's post</dt>
        <dd>
          <textarea name="message" cols="50" rows="2"><?php echo(h($message)); ?></textarea>
          <input type="hidden" name="reply_post_id" value="<?php echo(h($_REQUEST['res'])); ?>" />
        </dd>
      </dl>
      <div>
          <input class="btn3" type="submit" value="POST" />
      </div>
    </form>

    <?php foreach ($posts as $post): ?>

    <div class="msg">
      <div>
      <img src="../user_image/<?php echo(h($post['image']))?>" width="52" height="52" alt="<?php echo(h($post['name']))?>" />
      <?php echo(h($post['name']))?>
      </div>
    <div class="msg_post">
      <p><?php echo(h($post['message']))?>
      <!-- <span class="name">（<?php echo(h($post['name']))?>） -->
      </span>[<a href="sns.php?res=<?php echo(h($post['id'])); ?>">Re</a>]
      </p>

      <p class="day"><a href="view.php?id=<?php echo(h($post['id'])); ?>">
      <?php echo(h($post['created']))?></a>
      
      <?php if ($post['reply_message_id'] > 0): ?>
      <a href="view.php?id=<?php echo(h($post['reply_message_id']))?>">
      original message</a>
      <?php endif; ?>

      <?php if($_SESSION['id'] == $post['user_id']): ?>

      [<a href="delete.php?id=<?php echo(h($post['id'])); ?>"
      style="color: #F33;">Delete</a>]
      <?php endif;?>
      </p>
    </div>

    <div style="text-align: center; margin-right: 10px">
      <a href="?post_id=<?=$post['id']?>&current_like=<?=$post['liked']?>"><img src="icon_like.jpeg" width="30" height="30" name="like" /></a>
      <p><?=$post['liked']?></p>
    </div>

    </div>

    <?php endforeach; ?>

<ul class="paging">
<?php if($page > 1): ?>
<li><a href="sns.php?page=<?php print($page-1); ?>">Previous page</a></li>
<?php else: ?>
<li><a href="sns.php?page=<?php print($page+1); ?>">Next page</a></li>
<?php endif; ?>

</ul>

</body>
</html>
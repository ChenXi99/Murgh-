<?php
session_start();
require_once('../funcs.php');

$pdo = db_conn();

if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
//   $_SESSION['time'] = time(); //最後の行動から1時間経過したらログアウト
$uid = $_SESSION['id'];

$cost_kg = $pdo->query("SELECT cost_kg FROM ranks WHERE user_id=$uid")->fetchColumn();
$profit_ratio = $pdo->query("SELECT profit_ratio FROM ranks WHERE user_id=$uid")->fetchColumn();




// RANK NUMBER
$rank_likes = $pdo->query("SELECT * FROM posts");
$user_likes = $pdo->query("SELECT id,likes FROM users ORDER BY likes DESC");
$rank_likes->execute();

foreach($rank_likes AS $rank_like){
    $uid = $rank_like['user_id'];
    $likes_ttl = $pdo->query("SELECT SUM(liked) AS total FROM posts WHERE user_id=$uid")->fetchColumn();
    $likes_update = $pdo->query("UPDATE users SET likes=$likes_ttl WHERE id=$uid");
}

// foreach ($user_likes as $key => $value) {
//     // $arr[3] が、$arr の各要素で上書きされて...
//     echo "{$key} => {$value} ";
//     print_r($arr);
// }

$rank_result = $user_likes->fetchALL(PDO::FETCH_ASSOC);
$rank_result_user = $rank_result[1];
echo $rank_result_user;

echo "<pre>";
print_r($rank_result);
echo "</pre>";

$idArray = array_column($rank_result, 'id');
// var_dump($idArray);
// echo '
// ';
$result = array_search($uid, $idArray);
$cnt = count($rank_result);
echo($result);
echo($cnt);

//   $likes = $pdo->prepare('SELECT * FROM posts WHERE user_id=?');
//   $likes->execute(array($_SESSION['id']));
  
//   while($like_sql = $likes->fetch(PDO::FETCH_ASSOC)){
//     //$resultに格納した連想配列のplanを抽出し、$rowsに格納。planがある限り、$rowsに追加していく
//     $likes_ttl = $likes_ttl + $like_sql['liked'];   
//   }

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
          <div class="navbar-header"><a class="a_nav" href="top_farmer.php">Top Farmer💎</a></div>
          <div class="navbar-header"><a class="a_nav" href="prof.php">Profile</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Rank!</h1>
    <h2>My Performance</h2>

    <div class="perf">

    <form method="GET" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Cost/kg</td>
                <td>Rs.<?= number_format($cost_kg,1)?></td>
            </tr>
            <tr>
                <td>Profit Ratio</td>
                <td><?= number_format($profit_ratio,1)?>%</td>
            </tr>
            <tr>
                <td>Monitor Score</td>
                <td></td>
            </tr>
            <tr>
                <td>Evaluations</td>
                <td></td>
            </tr>
            <tr>
                <td>Likes</td>
                <td><?=$likes_ttl?></td>
            </tr>
        </table>
            </form>

    </div>

    <button class="btn"><a href="rank2.php">See My Rank!</a></button>

    <h2>You are..  No. <?php echo($result)+1 ?> among <?php echo($cnt) ?> users!</h2><br>
    
   
</body>
</html>
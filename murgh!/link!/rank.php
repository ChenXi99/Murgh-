<?php
session_start();
require_once('../funcs.php');

$pdo = db_conn();

if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
//   $_SESSION['time'] = time(); //最後の行動から1時間経過したらログアウト
$uid = $_SESSION['id'];

// PERFORMANCE

// cost
$cost_kg = $pdo->query("SELECT cost_kg FROM ranks WHERE user_id=$uid")->fetchColumn();
$user_costs = $pdo->query("SELECT user_id,cost_kg FROM ranks ORDER BY cost_kg ASC");

// profit
$profit_ratio = $pdo->query("SELECT profit_ratio FROM ranks WHERE user_id=$uid")->fetchColumn();
$user_profits = $pdo->query("SELECT user_id,profit_ratio FROM ranks ORDER BY profit_ratio DESC");

// monitor

// Reviews
$rank_reviews = $pdo->query("SELECT * FROM sale_offers");
$user_reviews = $pdo->query("SELECT id,reviews FROM users ORDER BY reviews DESC");
$rank_reviews->execute();

foreach($rank_reviews AS $rank_review){
    $reviews_avr = $pdo->query("SELECT AVG(eval) AS average FROM sale_offers WHERE user_id=$uid")->fetchColumn();
    $reviews_update = $pdo->query("UPDATE users SET reviews=$reviews_avr WHERE id=$uid");
}

// likes
$rank_likes = $pdo->query("SELECT * FROM posts");
$user_likes = $pdo->query("SELECT id,likes FROM users ORDER BY likes DESC");
$rank_likes->execute();

foreach($rank_likes AS $rank_like){
    $likes_ttl = $pdo->query("SELECT SUM(liked) AS total FROM posts WHERE user_id=$uid")->fetchColumn();
    $likes_update = $pdo->query("UPDATE users SET likes=$likes_ttl WHERE id=$uid");
}


// RANK
$costs_result = $user_costs->fetchALL(PDO::FETCH_ASSOC);
$profits_result = $user_profits->fetchALL(PDO::FETCH_ASSOC);
$reviews_result = $user_reviews->fetchALL(PDO::FETCH_ASSOC);
$likes_result = $user_likes->fetchALL(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($costs_result);
// print_r($profits_result);
// print_r($likes_result);
// print_r($reviews_result);
echo "</pre>";

$idArray_costs = array_column($costs_result, 'user_id');
$idArray_profits = array_column($profits_result, 'user_id');
$idArray_reviews = array_column($reviews_result, 'id');
$idArray_likes = array_column($likes_result, 'id');
// var_dump($idArray_likes);

$rank_costs = array_search($uid, $idArray_costs);
$rank_profits = array_search($uid, $idArray_profits);
$rank_reviews = array_search($uid, $idArray_reviews);
$rank_likes = array_search($uid, $idArray_likes);
$cnt = count($likes_result);

// echo($uid);
// echo($_SESSION['id']);
// echo($result);
// echo($cnt);

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
          <div class="navbar-header"><a class="a_nav" href="recruit.php">Recruit!</a></div>
          <div class="navbar-header"><a class="a_nav" href="prof_account.php">Profile</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Rank!</h1>
    <h2>My Performance</h2>

    <div class="perf">
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
                <td>Monitor</td>
                <td></td>
            </tr>
            <tr>
                <td>Reviews</td>
                <td><?= number_format($reviews_avr,1)?></td>
            </tr>
            <tr>
                <td>Likes</td>
                <td><?=$likes_ttl?></td>
            </tr>
        </table>
    </div>

    <button class="btn"><a href="rank2.php">See My Rank!</a></button>

    <div class="perf">
        <table>
            <tr>
                <td>Cost/kg</td>
                <td>No.<?php echo($rank_costs)+1 ?></td>
                <td>/ <?php echo($cnt) ?> users</td>
            </tr>
            <tr>
                <td>Profit Ratio</td>
                <td>No.<?php echo($rank_profits)+1 ?></td>
                <td>/ <?php echo($cnt) ?> users</td>
            </tr>
            <tr>
                <td>Monitor</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Reviews</td>
                <td>No.<?php echo($rank_reviews)+1 ?></td>
                <td>/ <?php echo($cnt) ?> users</td>
            </tr>
            <tr>
                <td>Likes</td>
                <td>No.<?php echo($rank_likes)+1 ?></td>
                <td>/ <?php echo($cnt) ?> users</td>
            </tr>
        </table>
    </div>
    
   
</body>
</html>
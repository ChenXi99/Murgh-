<?php
// 1. DB接続
require_once('../funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM monitors");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error();
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= $r["date"];
    $view .= '<p><img src="upload/'.$r["photo"].'"></p><br>';
  }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result</title>
    <title>
    </title>
    <style>
        #photarea {
            padding: 2%;
            width: 90%;
            background:none;
        }

        img {
            width: 400px
        }

        #upload_btn {
            display: none;
        }
    </style>
    <link href="" rel="stylesheet">
</head>

<body id="main">

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../farm.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="diary.php">Diary</a></div>
          <div class="navbar-header"><a class="a_nav" href="dashboard.php">Dashboard</a></div>
          <div class="navbar-header"><a class="a_nav" href="to_do.php">To-do</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

    <div class="container-fluid">
        
        <div id="photarea">
            <!-- ここにPHPの変数を記述 -->
            <?=$view?>
        </div>
    </div>
    <!-- コンテンツ -->

    

</body>

</html>
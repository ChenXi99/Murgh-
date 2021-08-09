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
    $view .= '<p><img class="photo" src="upload/'.$r["photo"].'"></p><br>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="farm!2.css" rel="stylesheet">
    <title>Monitor</title>

    <style>
        #photoarea {
            padding: 2%;
            width: 90%;
            background:none;
        }

        .photo {
            width: 440px;
            
        }

    </style>
</head>
<body>

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

    <h1>Monitor</h1>

<h2>Today's shed</h2>

<form method="POST" action="file_upload.php" enctype="multipart/form-data">
    <input type="file" name="upfile"><br>
    <input type="submit" class="btn" value="UPLOAD">
</form>


<div id="photoarea">
    <!-- ここにPHPの変数を記述 -->
    <?=$view?>
</div>
    
</body>
</html>
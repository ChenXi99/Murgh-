<?php
session_start();

//1. POSTデータ取得
$description   = $_POST["description"];
$staffs   = $_POST["staffs"];
$date_from  = $_POST["date_from"];
$date_until = $_POST["date_until"];
$salary = $_POST["salary"];
$notes   = $_POST["notes"];

//2. DB接続します
//以下を関数化！この二行で、DB接続完了
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

$user_id = $user['id'];

//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO recruits( id, user_id, description, staffs, date_from, date_until, salary, notes )
  VALUES( NULL, :user_id, :description, :staffs, :date_from, :date_until, :salary, :notes )"
);

// 4. バインド変数を用意
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':staffs', $staffs, PDO::PARAM_STR);
$stmt->bindValue(':date_from', $date_from, PDO::PARAM_STR);
$stmt->bindValue(':date_until', $date_until, PDO::PARAM_STR);
$stmt->bindValue(':salary', $salary, PDO::PARAM_STR);
$stmt->bindValue(':notes', $notes, PDO::PARAM_STR);

// 5. 実行
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    sql_error($stmt);
  }else{
    //５．index.phpへリダイレクト
    //以下を関数化
    redirect('recruit.php');
  }
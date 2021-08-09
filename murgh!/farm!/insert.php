<?php
//1. POSTデータ取得

$batch   = $_POST["batch"];
$date   = $_POST["date"];
$mort  = $_POST["mort"];
$wgt    = $_POST["wgt"];

$feed_1    = $_POST["feed_1"];
$feed_2    = $_POST["feed_2"];
$feed    = $_POST["feed"];
$labor_1    = $_POST["labor_1"];
$labor_2    = $_POST["labor_2"];
$labor    = $_POST["labor"];
$medicine_1    = $_POST["medicine_1"];
$medicine_2    = $_POST["medicine_2"];
$medicine    = $_POST["medicine"];
$equipment_1    = $_POST["equipment_1"];
$equipment_2    = $_POST["equipment_2"];
$equipment    = $_POST["equipment"];
$cost_others_1    = $_POST["cost_others_1"];
$cost_others_2    = $_POST["cost_others_2"];
$cost_others    = $_POST["cost_others"];

$big_1    = $_POST["big_1"];
$big_2    = $_POST["big_2"];
$big    = $_POST["big"];
$tandoori_1    = $_POST["tandoori_1"];
$tandoori_2    = $_POST["tandoori_2"];
$tandoori    = $_POST["tandoori"];
$sales_others_1    = $_POST["sales_others_1"];
$sales_others_2    = $_POST["sales_others_2"];
$sales_others    = $_POST["sales_others"];

//2. DB接続します
//以下を関数化！この二行で、DB接続完了
require_once('../funcs.php');
$pdo = db_conn();

//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO dashboard( id, batch, date, mort, wgt, feed_1, feed_2, feed, 
  labor_1, labor_2, labor, medicine_1, medicine_2, medicine, 
  equipment_1, equipment_2, equipment, cost_others_1, cost_others_2, cost_others,
  big_1, big_2, big, tandoori_1, tandoori_2, tandoori, sales_others_1, sales_others_2, sales_others )
  VALUES( NULL, :batch, :date, :mort, :wgt, :feed_1, :feed_2, :feed,
  :labor_1, :labor_2, :labor, :medicine_1, :medicine_2, :medicine, 
  :equipment_1, :equipment_2, :equipment, :cost_others_1, :cost_others_2, :cost_others, 
  :big_1, :big_2, :big, :tandoori_1, :tandoori_2, :tandoori, :sales_others_1, :sales_others_2, :sales_others )"
);

// 4. バインド変数を用意
$stmt->bindValue(':batch', $batch, PDO::PARAM_STR);
// $stmt->bindValue(':date', date("Y-m-d", strtotime($date)), PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':mort', $mort, PDO::PARAM_INT);
$stmt->bindValue(':wgt', $wgt, PDO::PARAM_INT);

$stmt->bindValue(':feed_1', $feed_1, PDO::PARAM_INT);
$stmt->bindValue(':feed_2', $feed_2, PDO::PARAM_INT);
$stmt->bindValue(':feed', $feed, PDO::PARAM_INT); 
$stmt->bindValue(':labor_1', $labor_1, PDO::PARAM_INT); 
$stmt->bindValue(':labor_2', $labor_2, PDO::PARAM_INT); 
$stmt->bindValue(':labor', $labor, PDO::PARAM_INT); 
$stmt->bindValue(':medicine_1', $medicine_1, PDO::PARAM_INT); 
$stmt->bindValue(':medicine_2', $medicine_2, PDO::PARAM_INT); 
$stmt->bindValue(':medicine', $medicine, PDO::PARAM_INT);
$stmt->bindValue(':equipment_1', $equipment_1, PDO::PARAM_INT); 
$stmt->bindValue(':equipment_2', $equipment_2, PDO::PARAM_INT);
$stmt->bindValue(':equipment', $equipment, PDO::PARAM_INT); 
$stmt->bindValue(':cost_others_1', $cost_others_1, PDO::PARAM_INT); 
$stmt->bindValue(':cost_others_2', $cost_others_2, PDO::PARAM_INT); 
$stmt->bindValue(':cost_others', $cost_others, PDO::PARAM_INT);

$stmt->bindValue(':big_1', $big_1, PDO::PARAM_INT); 
$stmt->bindValue(':big_2', $big_2, PDO::PARAM_INT); 
$stmt->bindValue(':big', $big, PDO::PARAM_INT);
$stmt->bindValue(':tandoori_1', $tandoori_1, PDO::PARAM_INT); 
$stmt->bindValue(':tandoori_2', $tandoori_2, PDO::PARAM_INT); 
$stmt->bindValue(':tandoori', $tandoori, PDO::PARAM_INT);
$stmt->bindValue(':sales_others_1', $sales_others_1, PDO::PARAM_INT);
$stmt->bindValue(':sales_others_2', $sales_others_2, PDO::PARAM_INT); 
$stmt->bindValue(':sales_others', $sales_others, PDO::PARAM_INT); 

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
    redirect('diary.php');
  }
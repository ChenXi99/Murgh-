<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Diary</title>
    <link href="farm!2.css" rel="stylesheet">
</head>

<body>
<!-- Head[Start] -->
<header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../farm.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="dashboard.php">Dashboard</a></div>
          <div class="navbar-header"><a class="a_nav" href="monitor.php">Monitor</a></div>
          <div class="navbar-header"><a class="a_nav" href="to_do.php">To-do</a></div>
          </div>
        </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

 <!-- method, action, 各inputのnameを確認してください。  -->
    
    <h1>Diary</h1>
    <div class="diary" style="height: 600px">

        <form method="POST" action="insert.php">

            <div class="d"><label>Current Batch:  since  </label><input type="date" name="batch"></div>
            <div class="d"><label>Date  <input type="date" name="date"></label></div>
            <div class="d"><label>Mortality  <input type="number" name="mort"></label>birds</div>
            <div class="d"><label>Weight  <input type="number" name="wgt"></label>g</div>

            <div class="d"><label>Cost  </label>
                <table>
                <tr>
                    <th>Category</th>
                    <th>@price</th>
                    <th>no.s</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Feed</td>
                    <td><input type="text" size="8" id="feed_1" name="feed_1"> x</td>
                    <td><input type="text" size="8" id="feed_2" name="feed_2"></td>
                    <td>Rs.<input type="text" size="10" id="feed" name="feed"></td>
                </tr>
                <tr>
                    <td>Labor</td>
                    <td><input type="text" size="8" id="labor_1" name="labor_1"> x</td>
                    <td><input type="text" size="8" id="labor_2" name="labor_2"></td>
                    <td>Rs.<input type="text" size="10" id="labor" name="labor"></td>
                </tr>
                <tr>
                    <td>Medicine</td>
                    <td><input type="text" size="8" id="medicine_1" name="medicine_1"> x</td>
                    <td><input type="text" size="8" id="medicine_2" name="medicine_2"></td>
                    <td>Rs.<input type="text" size="10" id="medicine" name="medicine"></td>
                </tr>
                <tr>
                    <td>Equipment</td>
                    <td><input type="text" size="8" id="equipment_1" name="equipment_1"> x</td>
                    <td><input type="text" size="8" id="equipment_2" name="equipment_2"></td>
                    <td>Rs.<input type="text" size="10" id="equipment" name="equipment"></td>
                </tr>
                <tr>
                    <td>Others</td>
                    <td><input type="text" size="8" id="cost_others_1" name="cost_others_1"> x</td>
                    <td><input type="text" size="8" id="cost_others_2" name="cost_others_2"></td>
                    <td>Rs.<input type="text" size="10" id="cost_others" name="cost_others"></td>
                </tr>
                </table>
            </div>

            <div class="d"><label>Sales </label>
                <table>
                    <tr>
                        <th width="90px">Category</th>
                        <th>@price</th>
                        <th>no.s</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>Big</td>
                        <td><input type="text" size="8" id="big_1" name="big_1"> x</td>
                        <td><input type="text" size="8" id="big_2" name="big_2"></td>
                        <td>Rs.<input type="text" size="10" id="big" name="big"></td>
                    </tr>
                    <tr>
                        <td>Tandoori</td>
                        <td><input type="text" size="8" id="tandoori_1" name="tandoori_1"> x</td>
                        <td><input type="text" size="8" id="tandoori_2" name="tandoori_2"></td>
                        <td>Rs.<input type="text" size="10" id="tandoori" name="tandoori"></td>
                    </tr>
                    <tr>
                        <td>Others</td>
                        <td><input type="text" size="8" id="sales_others_1" name="sales_others_1"> x</td>
                        <td><input type="text" size="8" id="sales_others_2" name="sales_others_2"></td>
                        <td>Rs.<input type="text" size="10" id="sales_others" name="sales_others"></td>
                    </tr>
                    </table>
            
            <input type="submit" class="btn" value="SEND">
        </form>

        </div>

<script>
// cost
  $('#feed').keyup(function(){
    var feed_1 = $('#feed_1').val();
    var feed_2 = $('#feed_2').val();
    //parseIntで文字列を数値に
    feed_1 = parseInt(feed_1);
    feed_2 = parseInt(feed_2);
    //左側の入力値が数値では無い場合の処理
    if(!feed_1){
      //計算結果表示のinput内を削除
      $('#feed_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!feed_2){
      //計算結果表示のinput内を削除
      $('#feed_2').val('');
      return false;
    };
    $('#feed').val(feed_1 * feed_2);
  });

  $('#labor').keyup(function(){
    var labor_1 = $('#labor_1').val();
    var labor_2 = $('#labor_2').val();
    //parseIntで文字列を数値に
    labor_1 = parseInt(labor_1);
    labor_2 = parseInt(labor_2);
    //左側の入力値が数値では無い場合の処理
    if(!labor_1){
      //計算結果表示のinput内を削除
      $('#labor_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!labor_2){
      //計算結果表示のinput内を削除
      $('#labor_2').val('');
      return false;
    };
    $('#labor').val(labor_1 * labor_2);
  });

  $('#medicine').keyup(function(){
    var medicine_1 = $('#medicine_1').val();
    var medicine_2 = $('#medicine_2').val();
    //parseIntで文字列を数値に
    medicine_1 = parseInt(medicine_1);
    medicine_2 = parseInt(medicine_2);
    //左側の入力値が数値では無い場合の処理
    if(!medicine_1){
      //計算結果表示のinput内を削除
      $('#medicine_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!medicine_2){
      //計算結果表示のinput内を削除
      $('#medicine_2').val('');
      return false;
    };
    $('#medicine').val(medicine_1 * medicine_2);
  });

  $('#equipment').keyup(function(){
    var equipment_1 = $('#equipment_1').val();
    var equipment_2 = $('#equipment_2').val();
    //parseIntで文字列を数値に
    equipment_1 = parseInt(equipment_1);
    equipment_2 = parseInt(equipment_2);
    //左側の入力値が数値では無い場合の処理
    if(!equipment_1){
      //計算結果表示のinput内を削除
      $('#equipment_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!equipment_2){
      //計算結果表示のinput内を削除
      $('#equipment_2').val('');
      return false;
    };
    $('#equipment').val(equipment_1 * equipment_2);
  });

  $('#cost_others').keyup(function(){
    var cost_others_1 = $('#cost_others_1').val();
    var cost_others_2 = $('#cost_others_2').val();
    //parseIntで文字列を数値に
    cost_others_1 = parseInt(cost_others_1);
    cost_others_2 = parseInt(cost_others_2);
    //左側の入力値が数値では無い場合の処理
    if(!cost_others_1){
      //計算結果表示のinput内を削除
      $('#cost_others_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!cost_others_2){
      //計算結果表示のinput内を削除
      $('#cost_others_2').val('');
      return false;
    };
    $('#cost_others').val(cost_others_1 * cost_others_2);
  });

//sales
$('#big').keyup(function(){
    var big_1 = $('#big_1').val();
    var big_2 = $('#big_2').val();
    //parseIntで文字列を数値に
    big_1 = parseInt(big_1);
    big_2 = parseInt(big_2);
    //左側の入力値が数値では無い場合の処理
    if(!big_1){
      //計算結果表示のinput内を削除
      $('#big_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!big_2){
      //計算結果表示のinput内を削除
      $('#big_2').val('');
      return false;
    };
    $('#big').val(big_1 * big_2);
  });

  $('#tandoori').keyup(function(){
    var tandoori_1 = $('#tandoori_1').val();
    var tandoori_2 = $('#tandoori_2').val();
    //parseIntで文字列を数値に
    tandoori_1 = parseInt(tandoori_1);
    tandoori_2 = parseInt(tandoori_2);
    //左側の入力値が数値では無い場合の処理
    if(!tandoori_1){
      //計算結果表示のinput内を削除
      $('#tandoori_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!tandoori_2){
      //計算結果表示のinput内を削除
      $('#tandoori_2').val('');
      return false;
    };
    $('#tandoori').val(tandoori_1 * tandoori_2);
  });

  $('#sales_others').keyup(function(){
    var sales_others_1 = $('#sales_others_1').val();
    var sales_others_2 = $('#sales_others_2').val();
    //parseIntで文字列を数値に
    sales_others_1 = parseInt(sales_others_1);
    sales_others_2 = parseInt(sales_others_2);
    //左側の入力値が数値では無い場合の処理
    if(!sales_others_1){
      //計算結果表示のinput内を削除
      $('#sales_others_1').val('');
      return false;
    };
    //右側の入力値が数値では無い場合の処理
    if(!sales_others_2){
      //計算結果表示のinput内を削除
      $('#sales_others_2').val('');
      return false;
    };
    $('#sales_others').val(sales_others_1 * sales_others_2);
  });

</script>

</body>
</html>
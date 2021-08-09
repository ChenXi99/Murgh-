<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../funcs.php');

//ログインチェック
// loginCheck();
// $user_name = $_SESSION['name'];

//以下ログインユーザーのみ

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM dashboard ORDER BY `dashboard`.`date` ASC");
$status = $stmt->execute();

//関数定義
$date_chart = '';
$wgt_chart = '';
$mort_chart = '';
$cost_chart = '';

$plcmt = 10000; //後日修正！
$chick = 20 * 10000; //後日修正！

$feed = '';
$labor = '';
$medicine = '';
$equipment = '';
$cost_others = '';

$feed_chart = '';
$labor_chart = '';
$medicine_chart = '';
$equipment_chart = '';
$cost_others_chart = '';

$feed_ttl = '';
$labor_ttl = '';
$medicine_ttl = '';
$equipment_ttl = '';
$cost_others_ttl = '';

$cost = '';
$cost_ttl = '';

$big = '';
$tandoori = '';
$sales_others = '';

//PRODUCTIVITY集計用
$cost_kg = '';
$feed_2 = '';
$big_2 = '';
$tandoori_2 = '';
$sales_others_2 = '';
$sales_kg = '';
$sales_kg_ttl = '';

$sales = '';
$sales_ttl = '';

$profit = '';
$profit_ratio = '';

$mort_ttl = '';
$mort_ttl_r = '';
$feed_kg = '';
$fc = '';


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $batch = h($result['batch']);
        $date = h($result['date']);
        // $plcmt = h($result['plcmt']);
        $mort = h($result['mort']);
        $wgt = h($result['wgt']);

        $feed_1 = h($result['feed_1']);
        $feed_2 = h($result['feed_2']);
        $feed = h($result['feed']);

        $labor_1 = h($result['labor_1']);
        $labor_2 = h($result['labor_2']);
        $labor = h($result['labor']);

        $medicine_1 = h($result['medicine_1']);
        $medicine_2 = h($result['medicine_2']);
        $medicine = h($result['medicine']);

        $equipment_1 = h($result['equipment_1']);
        $equipment_2 = h($result['equipment_2']);
        $equipment = h($result['equipment']);

        $cost_others_1 = h($result['cost_others_1']);
        $cost_others_2 = h($result['cost_others_2']);
        $cost_others = h($result['cost_others']);

        $big_1 = h($result['big_1']);
        $big_2 = h($result['big_2']);
        $big = h($result['big']);

        $tandoori_1 = h($result['tandoori_1']);
        $tandoori_2 = h($result['tandoori_2']);
        $tandoori = h($result['tandoori']);

        $sales_others_1 = h($result['sales_others_1']);
        $sales_others_2 = h($result['sales_others_2']);
        $sales_others = h($result['sales_others']);
        
        $date_chart = $date_chart . '"'. $date.'",';
        $wgt_chart = $wgt_chart . '"'. $wgt.'",';
        $mort_chart = $mort_chart . '"'. $mort.'",';

        //COST
        $feed_chart = $feed_chart . '"'. $feed.'",';
        $labor_chart = $labor_chart . '"'. $labor.'",';
        $medicine_chart = $medicine_chart . '"'. $medicine.'",';
        $equipment_chart = $equipment_chart . '"'. $equipment.'",';
        $cost_others_chart = $cost_others_chart . '"'. $cost_others.'",';

        $cost = $feed + $labor + $medicine + $equipment + $cost_others;
        $cost++;

        $cost_ttl = $cost_ttl + $cost;
        $cost_ttl_chick = $cost_ttl + $chick;

        $feed_ttl = $feed_ttl + $feed;
        $labor_ttl = $labor_ttl + $labor;
        $medicine_ttl = $medicine_ttl + $medicine;
        $equipment_ttl = $equipment_ttl + $equipment;
        $cost_others_ttl = $cost_others_ttl + $cost_others;

        //SALES
        $big = $big++;
        $tandoori = $tandoori++;
        $sales_others = $sales_others++;
        $sales = $big + $tandoori + $sales_others;
        $sales++;

        $sales_ttl = $sales_ttl + $sales;

        //PROFIT
        $profit = $sales_ttl - $cost_ttl_chick;
        $profit_ratio = ($profit / $sales_ttl) * 100;

        //PRODUCTIVITY
        $big_2 = $big_2++;
        $tandoori_2 = $tandoori_2++;
        $sales_others_2 = $sales_others_2++;
        $sales_kg = $big_2 + $tandoori_2 + $sales_others_2;
        $sales_kg++;

        $sales_kg_ttl = $sales_kg_ttl + $sales_kg;

        $cost_kg = $cost_ttl_chick / $sales_kg_ttl;
 
        $mort_ttl = $mort_ttl + $mort;
        $mort_ttl_r = 100 - ($mort_ttl / $plcmt * 100);

        $feed_kg = $feed_kg + $feed_2++;
        $fc = $feed_kg / $sales_kg_ttl;

    }

}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="farm!2.css" rel="stylesheet">
</head>

<body id="main">

    <div class="screen">
    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../farm.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="diary.php">Diary</a></div>
          <div class="navbar-header"><a class="a_nav" href="monitor.php">Monitor</a></div>
          <div class="navbar-header"><a class="a_nav" href="to_do.php">To-do</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
 
    <h1>Dashboard</h1>

        <div class="wrap1" style="width:460px;">
            
            <h2>Daily Body Weight</h2>
            <canvas id="Chart_wgt" width="420px" height="280px" margin-bottom="35px";></canvas>
            <br>

            <h2>Daily Mortality</h2>
            <canvas id="Chart_mort" width="420px" height="280px"></canvas>
            <br>

            <h2>Daily Cost</h2>
            <canvas id="Chart_cost_day" width="450px" height="600px" margin-bottom="35px";></canvas>
            <br>

            <h2>Total Cost Breakdown</h2>
            <canvas id="Chart_cost" width="420px" height="420px" margin-bottom="35px";></canvas>

            <button class="btn">Finalize the Batch!</button>

            <div class="pl">
                <p>P/L</p>
                <table>
                    <tr>
                        <td>Total Sales</td><td>Rs.</td>
                        <td><?php echo number_format($sales_ttl) ?></td>
                    </tr>
                    <tr>
                        <td>Total Cost</td><td>Rs.</td>
                        <td><?php echo number_format($cost_ttl_chick) ?></td>
                    </tr>
                    <tr>
                        <td>Total Profit</td><td>Rs.</td>
                        <td><?php echo number_format($profit) ?></td>
                    </tr>
                    <tr>
                        <td>Profit Ratio</td><td></td>
                        <td><?php echo number_format($profit_ratio,1) ?> ％</td>
                    </tr>
                </table>
            </div>

            <div class="prod">
                <p>Productivity</p>
                <table>
                    <tr>
                        <td>Cost/kg</td>
                        <td><?php echo number_format($cost_kg,1) ?></td>
                    </tr>
                    <tr>
                        <td>100% - Mortality</td>
                        <td><?php echo number_format($mort_ttl_r,1) ?>%</td>
                    </tr>
                    <tr>
                        <td>Feed Convergence</td>
                        <td><?php echo number_format($fc,2) ?></td>
                    </tr>
                </table>
            </div>

            <form action="insert_d.php" method="post">
                <input type="hidden" id="cost_kg" name="cost_kg" value="<?php echo $cost_kg ?>">
                <input type="hidden" id="p_ratio" name="p_ratio" value="<?php echo $profit_ratio ?>">

                <input class="btn" type="submit" value="Store the Result!">

            </form>
        </div>

    </div>

    <!-- Main[End] -->

    </div>

    <script>
    var ctx = document.getElementById('Chart_wgt').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $date_chart ?>],//日付
            datasets: [{
                label: 'g',
                data: [<?php echo $wgt_chart ?>],//体重
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>

<script>
    var ctx = document.getElementById('Chart_mort').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $date_chart ?>],//日付
            datasets: [{
                label: 'birds',
                data: [<?php echo $mort_chart ?>],//死鳥
                fill: false,
                borderColor: 'red',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>

<script>
 var ctx = document.getElementById('Chart_cost_day').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $date_chart ?>],//日付
            datasets: [
                {
                label: 'Feed',
                data: [<?php echo $feed_chart ?>],
                backgroundColor: 'rgba(255,140,0,0.5)',
                borderColor: 'rgba(255,140,0,1)',
                borderWidth: 1,
                },
                // {
                // label: 'Chick',
                // data: [<?php echo $chick ?>],
                // backgroundColor: 'rgba(255,215,0,0.5)',
                // borderColor: 'rgba(255,215,0,1)',
                // borderWidth: 1,
                // },
                {  
                label: 'Labor',
                data: [<?php echo $labor_chart ?>],
                backgroundColor: 'rgba(34,139,34,0.5)',
                borderColor: 'rgba(34,139,34,1)',
                borderWidth: 1,
                },
                {
                label: 'Medicine',
                data: [<?php echo $medicine_chart ?>],
                backgroundColor: 'rgba(0,206,209,0.5)',
                borderColor: 'rgba(0,206,209,1)',
                borderWidth: 1,
                },
                {
                label: 'Equipment',
                data: [<?php echo $equipment_chart ?>],
                backgroundColor: 'rgba(221,160,221,0.5)',
                borderColor: 'rgba(221,160,221,1)',
                borderWidth: 1,
                },
                {
                label: 'Others',
                data: [<?php echo $cost_others_chart ?>],
                backgroundColor: 'rgba(128,128,128,0.5)',
                borderColor: 'rgba(128,128,128,1)',
                borderWidth: 0.7,
                },
        ]
        },
        options: {
            indexAxis: 'y',
            plugins: {
            // title: {
            //     display: true,
            //     text: 'Chart.js Bar Chart - Stacked'
            // },
            },
            responsive: true,
            scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
            }
        },
    });

</script>

<script>
    var ctx = document.getElementById('Chart_cost').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Feed',
                'Chick',
                'Labor',
                'Medicine',
                'Equipment',
                'Others',
            ],
            datasets: [{
                label: 'Cost Breakdown',
                data: [
                    <?php echo $feed_ttl ?>,
                    <?php echo $chick ?>,
                    <?php echo $labor_ttl ?>,
                    <?php echo $medicine_ttl ?>,
                    <?php echo $equipment_ttl ?>,
                    <?php echo $cost_others_ttl ?>],
                backgroundColor: [
                'rgba(255,140,0,0.5)',
                'rgba(255,215,0,0.5)',
                'rgba(34,139,34,0.5)',
                'rgba(0,206,209,0.5)',
                'rgba(221,160,221,0.5)',
                'rgba(128,128,128,0.5)',
                ],
                borderColor: [
                'rgba(255,140,0,1)',
                'rgba(255,215,0,1)',
                'rgba(34,139,34,1)',
                'rgba(0,206,209,1)',
                'rgba(221,160,221,1)',
                'rgba(128,128,128,1)',
                ],
                borderWidth: 1.5,
                hoverOffset: 6
            }]
        // },
        // options: {
        //     scales: {
        //         yAxes: [{
        //             ticks: {
        //                 beginAtZero: true
        //             }
        //         }]
        //     }
        }
    });
    </script>

</body>

</html>
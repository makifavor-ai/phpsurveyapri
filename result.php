<?php
$host = 'localhost';
$dbname = 'survey';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 全回答取得
    $stmt = $pdo->query("SELECT * FROM answers ORDER BY created_at DESC");
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // 回答数
    $total = count($answers);
    
    // 言語集計
    $language_count = [];
    $profitable_count = [];
    $job_count = [];
    $easiest_count = [];
    
    foreach ($answers as $a) {
        $lang = $a['language'];
        $language_count[$lang] = isset($language_count[$lang]) ? $language_count[$lang] + 1 : 1;
        
        $prof = $a['most_profitable'];
        $profitable_count[$prof] = isset($profitable_count[$prof]) ? $profitable_count[$prof] + 1 : 1;
        
        $job = $a['best_for_job'];
        $job_count[$job] = isset($job_count[$job]) ? $job_count[$job] + 1 : 1;
        
        $easy = $a['easiest'];
        $easiest_count[$easy] = isset($easiest_count[$easy]) ? $easiest_count[$easy] + 1 : 1;
    }
    
    arsort($language_count);
    arsort($profitable_count);
    arsort($job_count);
    arsort($easiest_count);

} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート結果</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Arial', sans-serif;
            padding: 40px;
        }
        h1 {
            color: #ff6987;
            text-align: center;
        }
        .total {
            text-align: center;
            font-size: 20px;
            color: #ff6987;
            margin: 20px 0;
            font-weight: bold;
        }
        .chart-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(255,105,135,0.2);
        }
        .chart-title {
            color: #ff6987;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            text-align: center;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(255,105,135,0.2);
        }
        .item {
            margin-bottom: 10px;
            border-bottom: 1px solid #ffb3c6;
            padding-bottom: 10px;
        }
        .label {
            color: #ff6987;
            font-weight: bold;
            font-size: 13px;
        }
        .value {
            color: #333;
            font-size: 15px;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin: 30px auto;
            padding: 12px 30px;
            background-color: #ff6987;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            width: 200px;
        }
    </style>
</head>
<body>
    <h1>💻 アンケート結果 💻</h1>
    <a href="index.php" class="back-btn">アンケートに戻る</a>
    
    <div class="total">現在の回答数：<?= $total ?>名</div>

    <!-- 好きな言語グラフ -->
    <div class="chart-container">
        <div class="chart-title">好きなプログラミング言語ランキング</div>
        <canvas id="languageChart"></canvas>
    </div>

    <!-- お金になる言語グラフ -->
    <div class="chart-container">
        <div class="chart-title">お金になる言語ランキング</div>
        <canvas id="profitableChart"></canvas>
    </div>

    <!-- 転職に有利な言語グラフ -->
    <div class="chart-container">
        <div class="chart-title">転職に有利な言語ランキング</div>
        <canvas id="jobChart"></canvas>
    </div>

    <!-- 学習コストが低い言語グラフ -->
    <div class="chart-container">
        <div class="chart-title">学習コストが低い言語ランキング</div>
        <canvas id="easiestChart"></canvas>
    </div>

    <!-- 個別回答一覧 -->
    <h2 style="color:#ff6987; text-align:center; margin-top:40px;">個別回答一覧</h2>
    <?php foreach ($answers as $answer): ?>
    <div class="card">
        <div class="item">
            <div class="label">ニックネーム</div>
            <div class="value"><?= $answer['nickname'] ?></div>
        </div>
        <div class="item">
            <div class="label">好きな言語</div>
            <div class="value"><?= $answer['language'] ?>
                <?= $answer['language_free'] ? '（' . $answer['language_free'] . '）' : '' ?>
            </div>
            <?php if ($answer['language_reason']): ?>
            <div class="value">💬 <?= $answer['language_reason'] ?></div>
            <?php endif; ?>
        </div>
        <div class="item">
            <div class="label">経験年数</div>
            <div class="value"><?= $answer['experience'] ?></div>
        </div>
        <div class="item">
            <div class="label">現在の使用状況</div>
            <div class="value"><?= $answer['using_now'] ?></div>
        </div>
        <?php if ($answer['comment']): ?>
        <div class="item">
            <div class="label">一言コメント</div>
            <div class="value"><?= $answer['comment'] ?></div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>

    <script>
    const pink = 'rgba(255,105,135,0.7)';
    const pinkBorder = 'rgba(255,105,135,1)';

    // 好きな言語
    new Chart(document.getElementById('languageChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($language_count)) ?>,
            datasets: [{
                label: '票数',
                data: <?= json_encode(array_values($language_count)) ?>,
                backgroundColor: pink,
                borderColor: pinkBorder,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // お金になる言語
    new Chart(document.getElementById('profitableChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($profitable_count)) ?>,
            datasets: [{
                label: '票数',
                data: <?= json_encode(array_values($profitable_count)) ?>,
                backgroundColor: pink,
                borderColor: pinkBorder,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // 転職に有利
    new Chart(document.getElementById('jobChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($job_count)) ?>,
            datasets: [{
                label: '票数',
                data: <?= json_encode(array_values($job_count)) ?>,
                backgroundColor: pink,
                borderColor: pinkBorder,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // 学習コスト
    new Chart(document.getElementById('easiestChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($easiest_count)) ?>,
            datasets: [{
                label: '票数',
                data: <?= json_encode(array_values($easiest_count)) ?>,
                backgroundColor: pink,
                borderColor: pinkBorder,
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });
    </script>
</body>
</html>
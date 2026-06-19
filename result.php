<?php
$host = 'localhost';
$dbname = 'survey';
$username = 'root';
$password = '';

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->query("SELECT * FROM answers ORDER BY created_at DESC");
$answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
echo 'エラー: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アンケート結果</title>
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

```
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
        <div class="label">お金になる言語</div>
        <div class="value"><?= $answer['most_profitable'] ?>
            <?= $answer['most_profitable_free'] ? '（' . $answer['most_profitable_free'] . '）' : '' ?>
        </div>
        <?php if ($answer['most_profitable_reason']): ?>
        <div class="value">💬 <?= $answer['most_profitable_reason'] ?></div>
        <?php endif; ?>
    </div>
    <div class="item">
        <div class="label">転職に有利な言語</div>
        <div class="value"><?= $answer['best_for_job'] ?>
            <?= $answer['best_for_job_free'] ? '（' . $answer['best_for_job_free'] . '）' : '' ?>
        </div>
        <?php if ($answer['best_for_job_reason']): ?>
        <div class="value">💬 <?= $answer['best_for_job_reason'] ?></div>
        <?php endif; ?>
    </div>
    <div class="item">
        <div class="label">学習コストが低い言語</div>
        <div class="value"><?= $answer['easiest'] ?>
            <?= $answer['easiest_free'] ? '（' . $answer['easiest_free'] . '）' : '' ?>
        </div>
        <?php if ($answer['easiest_reason']): ?>
        <div class="value">💬 <?= $answer['easiest_reason'] ?></div>
        <?php endif; ?>
    </div>
    <div class="item">
        <div class="label">使っている領域</div>
        <div class="value"><?= $answer['domain'] ?>
            <?= $answer['domain_free'] ? '（' . $answer['domain_free'] . '）' : '' ?>
        </div>
        <?php if ($answer['domain_reason']): ?>
        <div class="value">💬 <?= $answer['domain_reason'] ?></div>
        <?php endif; ?>
    </div>
    <div class="item">
        <div class="label">次に学びたい言語</div>
        <div class="value"><?= $answer['next_language'] ?>
            <?= $answer['next_language_free'] ? '（' . $answer['next_language_free'] . '）' : '' ?>
        </div>
        <?php if ($answer['next_language_reason']): ?>
        <div class="value">💬 <?= $answer['next_language_reason'] ?></div>
        <?php endif; ?>
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
```

</body>
</html>
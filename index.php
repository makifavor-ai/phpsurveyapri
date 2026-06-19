<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>好きなプログラミング言語アンケート</title>
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            padding: 40px;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 500px;
            box-shadow: 0 4px 15px rgba(255,105,135,0.2);
        }
        h1 {
            color: #ff6987;
            text-align: center;
            font-size: 22px;
        }
        label {
            color: #ff6987;
            font-weight: bold;
            display: block;
            margin-top: 20px;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ffb3c6;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }
        button {
            margin-top: 30px;
            width: 100%;
            padding: 12px;
            background-color: #ff6987;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff4d73;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💻 好きなプログラミング言語アンケート 💻</h1>
        <form action="register.php" method="post">
            <label>ニックネーム</label>
            <input type="text" name="nickname" placeholder="例：たろう" required>

            <label>好きなプログラミング言語</label>
            <select name="language">
    <option value="PHP">PHP</option>
    <option value="JavaScript">JavaScript</option>
    <option value="TypeScript">TypeScript</option>
    <option value="Python">Python</option>
    <option value="Java">Java</option>
    <option value="Ruby">Ruby</option>
    <option value="Swift">Swift</option>
    <option value="Kotlin">Kotlin</option>
    <option value="Go">Go</option>
    <option value="Rust">Rust</option>
    <option value="C">C</option>
    <option value="C++">C++</option>
    <option value="C#">C#</option>
    <option value="Scala">Scala</option>
    <option value="R">R</option>
    <option value="Dart">Dart</option>
    <option value="その他">その他</option>
</select>

            <label>経験年数</label>
            <select name="experience">
                <option value="1年未満">1年未満</option>
                <option value="1〜3年">1〜3年</option>
                <option value="3〜5年">3〜5年</option>
                <option value="5年以上">5年以上</option>
            </select>

            <label>一言コメント</label>
            <textarea name="comment" rows="4" placeholder="この言語の好きなところを教えてください！"></textarea>

            <button type="submit">送信する 💌</button>
        </form>
    </div>
</body>
</html>
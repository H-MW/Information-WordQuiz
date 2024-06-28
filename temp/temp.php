<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ <?php echo htmlspecialchars($id) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="question" data-question-id="question<?php echo htmlspecialchars($id) ?>">
                <p>問題文: <span id="question"><?php echo $question; ?></span></p>
            </div>
            <div class="remaining">
                <p>問題数: <span id="answeredSum"><?php echo $id ?></span>/<span id="questionSum"><?php echo $questionSum ?></span></p>
            </div>
        </div>
        <form class="form" onsubmit="return checkAnswer(<?php echo htmlspecialchars($id) ?>)">
            <input type="text" name="answer" id="answer" class="answer" placeholder="答えを入力">
            <button type="submit" id="submit-button" class="submit-button">答え合わせ</button>
        </form>
        <div id="result" class="result"></div>
        <div class="next-button-container">
        <button id="next-question-button" class="next-button" onclick="loadNextQuestion(<?php echo htmlspecialchars($id) ?>)" style="display:none;">次の問題へ</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
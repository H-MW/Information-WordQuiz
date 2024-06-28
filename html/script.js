function checkAnswer(id) {

    const userAnswer = document.getElementById("answer").value.trim();

    // フォームデータの入れ物を作る
    const formData = new FormData();

    // 送信したい値を追加
    formData.append('id', id);
    formData.append('userAnswer', userAnswer);

    //xhr = XHRHttpRequestの頭文字です
    const xhr = new XMLHttpRequest();

    // HTTPメソッドをPOSTに指定、送信するURLを指定
    xhr.open('POST', './answer.php');

    // フォームデータを送信
    xhr.send(formData);

    // loadendはリクエストが完了したときにイベントが発生する
    xhr.addEventListener('loadend', function(event) {
        /** @type {XMLHttpRequest} */
        const xhr = event.currentTarget;

        // リクエストが成功したかステータスコードで確認
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.response);

            const result = response.result;
            const correctAnswerText = response.correctAnswerText;
        
            displayResult(result, correctAnswerText);
        }else {
            //エラー
            alert('Error: 回答データの取得に失敗しました')
        }
    });

    return false; // フォームの送信を防ぐ
}

function loadNextQuestion(id) {
    // 新しい問題を読み込むロジックをここに追加
    // document.getElementById("question").textContent = "";
    // document.getElementById("answer").value = "";
    // document.getElementById("submit-button").disabled = null;
    // document.getElementById("result").textContent = "";
    // document.getElementById("next-question-button").style.display = "none";

    // 残り問題数の更新など必要な処理を追加


    //とりあえずランダムにしない方針に変更したため、urlのidを変更して対応する
    // 現在のURLを取得
    var currentUrl = window.location.href;

    // 新しいIDに置き換える
    var newId = id + 1;
    var updatedUrl = currentUrl.replace(/id=\d+/, 'id=' + newId);
    console.log(updatedUrl);

    // 更新されたURLにリダイレクトする
    window.location.href = updatedUrl;
}

function displayResult(result, correctAnswerText) {
    const submitButton = document.getElementById("submit-button");
    const resultText = document.getElementById("result");
    const nextButton = document.getElementById("next-question-button");

    if (result) {
        resultText.textContent = "正解です！";
        resultText.className = "result correct";
    } else {
        resultText.textContent = "不正解。答えは " + correctAnswerText + " です。";
        resultText.className = "result incorrect";
    }

    submitButton.disabled = "disabled";
    nextButton.style.display = "block";
}
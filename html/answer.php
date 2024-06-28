<?php

require __DIR__.'/../lib/functions.php';

$id = $_POST['id'] ?? '';
$userAnswer = $_POST['userAnswer'] ?? '';

$data = fetchByID($id);

if (empty($data)) {
    // HTTPレスポンスのヘッダを404にする
    header('HTTP/1.1 404 Not Found');
    // レスポンスの種類を指定する
    header('Content-Type: text/html; charset=UTF-8');
    include __DIR__.'/../temp/404temp.php';
    exit(0);
}

$formattedData = generateFormattedData($data);

$correctAnswer = $formattedData['correctAnswer'];
$correctAnswer2 = $formattedData['correctAnswer2'];

$result = $userAnswer === $correctAnswer || $userAnswer === $correctAnswer2;
$correctAnswerText;
if ($correctAnswer2 !== "nothing") {
    $correctAnswerText = $correctAnswer . "、" . $correctAnswer2;
}else {
    $correctAnswerText = $correctAnswer;
}

$response = [
    'result' => $result,
    'correctAnswerText' => $correctAnswerText,
];

echo json_encode($response);
<?php

require __DIR__.'/../lib/functions.php';

$id = htmlspecialchars($_GET['id'] ?? '');
$answeredSum = htmlspecialchars($_GET['answeredSum'] ?? '');

$data = fetchByID($id);

if (!$data) {
    // HTTPレスポンスのヘッダを404にする
    header('HTTP/1.1 404 Not Found');
    // レスポンスの種類を指定する
    header('Content-Type: text/html; charset=UTF-8');
    include __DIR__.'/../temp/404temp.php';
    exit(0);
}

$formattedData = generateFormattedData($data);

$question = $formattedData['question'];
$correctAnswer = $formattedData['correctAnswer'];
$correctAnswer2 = $formattedData['correctAnswer2'];

$questionSum = questionSum();

include __DIR__.'/../temp/temp.php';
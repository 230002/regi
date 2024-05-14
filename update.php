<?php
// データベースに接続
require_once "db.php";

// POSTデータを受け取る
$posts = $_POST;
$price = $posts['price'];

// 正規表現で演算子とオペランドを分離する
if (is_numeric($price) && $price > 0) {
    // 合計金額「sales.price」を保存するSQLを作成
    $sql = "INSERT INTO sales (price) VALUES (:price)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':price', $price);
    $stmt->execute();
} else {
    // 正規表現のマッチングが失敗した場合はエラー処理するなどの適切な対処を行う
}

// レジ画面に戻る
header('Location: index.php');
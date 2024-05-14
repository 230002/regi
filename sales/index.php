<?php
// データベースに接続
require_once "../db.php";

// 売上一覧をすべて取得
$sql = "SELECT * FROM sales;";
// SQLを実行
$stmt = $pdo->query($sql);

// PHP配列に変換
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sales[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>売上一覧</h2>
    <a href="../">戻る</a>
    <table>
        <thead>
            <tr>
                <th>売上日時</th>
                <th>売上高</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sales as $sale): ?>
            <tr>
                <td><?= $sale['created_at'] ?>　　</td>
                <td><?= $sale['price'] ?>円</td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>
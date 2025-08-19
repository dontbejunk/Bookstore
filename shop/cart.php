<?php 
session_start();
include("../config/mysql_connect.inc.php");

// 取得購物車資料
$cart = $_SESSION['gwc'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>我的購物車</title>
<style>
body { background-color: #FFBFBF; font-family: Arial, sans-serif; text-align: center; }
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
}
th, td {
    border: 1px solid #999;
    padding: 10px;
    text-align: center;
}
th {
    background-color: #FFD78C;
}
tr:nth-child(even) {
    background-color: #FFEFD5;
}
a {
    text-decoration: none;
    color: #fff;
    background: #FF9800;
    padding: 5px 10px;
    border-radius: 5px;
}
a:hover { background: #F57C00; }
</style>
</head>
<body>

<a href="../index.php">上一頁</a>
<h2>我的購物車</h2>

<?php if(empty($cart)): ?>
    <p>購物車目前沒有商品。</p>
<?php else: ?>
<table>
    <tr>
        <th>商品名</th>
        <th>數量</th>
        <th>單價</th>
        <th>庫存</th>
        <th>操作</th>
    </tr>
    <?php
    foreach($cart as $item_id => $qty) {
        // 使用 Prepared Statement 查商品
        $stmt = $con->prepare("SELECT item_name, price, storage FROM shop WHERE `item.no` = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(!$row) continue; // 商品不存在就跳過

        $subtotal = $qty * $row['price'];
        $total += $subtotal;
        $_SESSION['total'] = $total; // 儲存總價
    ?>
    <tr>
        <td><?= htmlspecialchars($row['item_name']) ?></td>
        <td><?= $qty ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['storage'] ?></td>
        <td><a href="delete_item.php?ids=<?= $item_id ?>">刪除</a></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="5" style="text-align:right; font-weight:bold;">總價格：<?= $total ?> 元</td>
    </tr>
</table>

<a href="insert_to_db.php">提交訂單</a>
<?php endif; ?>

</body>
</html>

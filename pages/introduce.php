<?php 
include("../config/mysql_connect.inc.php");

$id = $_GET['ids'] ?? '';
$price = $_GET['price'] ?? '';

if(!$id || !$price){
    echo "參數錯誤";
    exit();
}

// 使用 Prepared Statement 防 SQL Injection
$stmt = $con->prepare("
    SELECT s.`item.no`, s.`item_name`, s.`price`, i.`article`
    FROM shop s
    LEFT JOIN introduce i ON s.`item.no` = i.`item.no`
    WHERE s.`item.no` = ?
");

if(!$stmt){
    die("Prepare failed: " . $con->error);
}
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row){
    echo "找不到商品";
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<title><?= htmlspecialchars($row['item_name']) ?></title>
<style>
    body { 
        font-family: Arial, sans-serif; 
        background: #FFD78C; 
        margin: 0; 
        padding: 20px; 
    }
    a { 
        text-decoration: none; 
        color: #FF9800; 
        font-weight: bold;
    }
    .container { 
        display: flex; 
        gap: 30px; 
        align-items: flex-start;
        margin-top: 20px;
    }
    .container img { 
        width: 400px; 
        height: 500px; 
        object-fit: cover; 
        border-radius: 10px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .info { 
        max-width: 600px; 
        background: #fff; 
        padding: 20px; 
        border-radius: 10px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .info h2 {
        margin-top: 0;
        color: #333;
    }
    .desc {
        background: #fff8e1;
        padding: 15px;
        border-radius: 8px;
        line-height: 1.8;
        margin: 15px 0;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .desc h3 {
        margin-top: 0;
        color: #FF9800;
    }
    .desc p {
        white-space: pre-line; /* 保留換行 */
    }
    .btn { 
        display: inline-block; 
        margin-top: 15px; 
        padding: 10px 15px; 
        background: #FF9800; 
        color: #fff; 
        border-radius: 5px; 
        text-decoration: none; 
        font-weight: bold;
    }
    .btn:hover { 
        background: #F57C00; 
    }
</style>
</head>
<body>

<a href="../index.php">← 回上一頁</a>
<div class="container">
    <img src="../assets/images/<?= htmlspecialchars($row['item_name']) ?>.jpg" 
         alt="<?= htmlspecialchars($row['item_name']) ?>">
    <div class="info">
        <h2>📚 書名: <?= htmlspecialchars($row['item_name']) ?></h2>
        
        <div class="desc">
            <h3>📖 大意：</h3>
            <p><?= nl2br(htmlspecialchars($row['article'])) ?></p>
        </div>
        
        <p><strong>💲 價格:</strong> <?= $row['price'] ?> 元</p>
        <a class="btn" href="../shop/process.php?ids=<?= $row['item.no'] ?>">加入購物車</a>
    </div>
</div>

</body>
</html>

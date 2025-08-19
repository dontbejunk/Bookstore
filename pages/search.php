<?php
include("../config/mysql_connect.inc.php");

$search = $_POST['search'] ?? '';

// 使用 Prepared Statement 避免 SQL Injection
$stmt = $con->prepare("SELECT `item.no`, `item_name`, `price` FROM `shop` WHERE `item_name` LIKE ?");
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<title>搜尋結果</title>
<style>
    body { background-color: #FFD78C; font-family: Arial, sans-serif; }
    a { text-decoration: none; color: #FF9800; }
    .products { display: flex; flex-wrap: wrap; gap: 20px; }
    .product { background: #fff; padding: 10px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    .product img { width: 200px; height: 200px; object-fit: cover; border-radius: 8px; }
    .btn { display: inline-block; margin-top: 10px; padding: 5px 10px; background: #FF9800; color: #fff; border-radius: 5px; text-decoration: none; }
    .btn:hover { background: #F57C00; }
</style>
</head>
<body>
    <a href="../index.php">← 回上一頁</a>
    <h2>搜尋結果：<?= htmlspecialchars($search) ?></h2>

    <div class="products">
    <?php if($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <a href="./introduce.php?ids=<?= $row['item.no'] ?>&price=<?= $row['price'] ?>">
                    <img src="../assets/images/<?= htmlspecialchars($row['item_name']) ?>.jpg" alt="<?= htmlspecialchars($row['item_name']) ?>">
                </a>
                    <h3><?= htmlspecialchars($row['item_name']) ?></h3>
                <p><?= $row['price'] ?> 元</p>
                <a class="btn" href="../shop/process.php?ids=<?= $row['item.no'] ?>">加入購物車</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>找不到符合「<?= htmlspecialchars($search) ?>」的商品</p>
    <?php endif; ?>
    </div>

</body>
</html>

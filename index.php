<?php 
session_start(); 
include("./config/mysql_connect.inc.php"); 
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <title>Buy Book Store</title>
    <style>
        body { background-color: #FFF3E0; font-family: Arial, sans-serif; margin: 0; }
        header { background: #FF9800; padding: 15px; color: #fff; display: flex; justify-content: space-between; }
        header a { color: #fff; margin-left: 15px; text-decoration: none; }
        .search-bar { margin: 20px auto; text-align: center; }
        .search-bar input[type=text] { padding: 8px; width: 200px; }
        .search-bar input[type=submit] { padding: 8px 12px; background: #FF9800; border: none; color: #fff; cursor: pointer; }
        .container { padding: 20px; }
        .products { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .product { background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 15px; text-align: center; }
        .product img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
        .btn { display: inline-block; margin-top: 10px; padding: 8px 12px; background: #FF9800; color: #fff; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #F57C00; }
    </style>
</head>
<body>

<header>
    <div><strong>📚 Buy Book Store</strong></div>
    <div>
        <?php if(isset($_SESSION['username'])): ?>
            歡迎, <?= htmlspecialchars($_SESSION['username']) ?> 
            <a href="./auth/logout.php">登出</a>
            <a href="./auth/update.php">修改會員資料</a>
            <a href="./shop/cart.php">購物車</a>
            <a href="./shop/myorder.php">我的訂單</a>
        <?php else: ?>
            <a href="./auth/login.php">登入</a>
        <?php endif; ?>
    </div>
</header>

<div class="search-bar">
    <form method="post" action="./pages/search.php">
        <input type="text" name="search" placeholder="輸入書名或關鍵字..."/> 
        <input type="submit" value="搜尋"/>
    </form>
</div>

<div class="container">
    <h2>📖 商品列表</h2>
    <div class="products">
    <?php
    $sql = "SELECT `item.no`, `item_name`, `price` FROM shop";
    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="product">';
            echo "<a href='./pages/introduce.php?ids=" . urlencode($row['item.no']) . "&price=" . $row['price'] . "'>";
            echo "<img src='./assets/images/" . htmlspecialchars($row['item_name']) . ".jpg' alt='" . htmlspecialchars($row['item_name']) . "'>";
            echo "</a>";
            echo "<h3>" . htmlspecialchars($row['item_name']) . "</h3>";
            echo "<p>" . $row['price'] . " 元</p>";
            echo "<a class='btn' href='./shop/process.php?ids=" . $row['item.no'] . "'>加入購物車</a>";
            echo '</div>';
        }
    } else {
        echo "目前沒有商品";
    }
    ?>
    </div>
</div>

</body>
</html>

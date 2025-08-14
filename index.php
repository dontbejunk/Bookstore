<?php 
session_start(); 
include("./config/mysql_connect.inc.php"); // 連線資料庫
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buy Book Store</title>
    <style>
        body { background-color: #FFD78C; }
        .product { display: inline-block; margin: 10px; text-align: center; }
        .top-right { position: absolute; top: 10px; right: 10px; }
        img { width: 200px; height: 200px; }
    </style>
</head>
<body>

<div class="top-right">
<?php
if(isset($_SESSION['username'])) {
    echo "歡迎, " . htmlspecialchars($_SESSION['username']) . " | <a href='../auth/logout.php'>登出</a>";
} else {
    echo "<a href='./auth/login.php'>登入</a>";
}
?>
</div>

<center>
<form name="form" method="post" action="./pages/search.php">
    搜尋欄：<input type="text" name="search" /> 
    <input type="submit" name="button" value="搜尋"/>
</form>
</center>

<hr>

<?php


if(isset($_SESSION['username'])) {
    echo '<a href="./auth/update.php">修改會員資料</a><br><br>';
    echo '<a href="./shop/cart.php">查看購物車</a><br><br>';
    echo '<a href="./shop/myorder.php">我的訂單</a><br><br>';

    // 從 login 資料表抓會員資料
    $username = mysqli_real_escape_string($con, $_SESSION['username']);
    $sql = "SELECT * FROM login WHERE username = '$username'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_row($result)){
        echo "用戶名(帳號)：$row[0], 電話：$row[2], 地址：$row[3]<br>";
    }
} else {
    echo '錯誤!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
    exit();
}

$sql = "SELECT `item.no`, `item_name`, `price` FROM shop";
$result = mysqli_query($con, $sql);

if($result && mysqli_num_rows($result) > 0){
    echo '<div style="display:flex; flex-wrap: wrap;">'; 
    while($row = mysqli_fetch_assoc($result)){
        echo '<div class="product" style="width:220px; margin:10px; text-align:center;">';
        echo "<a href='./pages/introduce.php?ids=" . urlencode($row['item_name']) . "&price=" . $row['price'] . "'>";
        echo "<img src='./assets/images/" . htmlspecialchars($row['item_name']) . ".jpg' alt='" . htmlspecialchars($row['item_name']) . "' style='width:200px; height:200px;'>";
        echo "</a><br>";
        echo "<strong>" . htmlspecialchars($row['item_name']) . "</strong><br>";
        echo $row['price'] . "$<br>";
        echo "<a href='./shop/process.php?ids=" . $row['item.no'] . "'>加入購物車</a>";
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "目前沒有商品";
}
?>


</body>
</html>

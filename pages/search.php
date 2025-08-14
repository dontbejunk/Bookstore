<body bgcolor =#FFD78C>
<?php
include("../config/mysql_connect.inc.php");
$search = $_POST['search'];

$sql = "SELECT `item_name`  FROM `shop` WHERE `item_name` Like '%$search%' ";
$result = mysqli_query($con , $sql);

echo '<a href="../index.php">上一頁</a><br><br>';
if (mysqli_num_rows($result) > 0){
    foreach ($result as $v){
        
        echo '<img src="../assets/images/' . $v['item_name']. '.jpg" width="200" height="200"/>';
        echo "<br>　　　{$v['item_name']}";
        echo '　　　<a href="../shop/process.php?ids=1">加入購物車</a>';
        echo "<br><br>";
    }
}

?>
</body>

<body>
<?php 
include("../config/mysql_connect.inc.php");
echo '<a href="member.php">上一頁</a><br><br>';
$id = $_GET['ids'];
$price = $_GET['price'];
echo '<img src="../assets/images/' . $id . '.jpg" width="700" height="600" style="float: left"/>';

$sql = "SELECT * FROM introduce  WHERE `item.no` = (SELECT `item.no` FROM shop WHERE item_name = '$id')";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);

echo '<br>';
echo "<h2>書名:$id</h2> <br><br>";
echo '大意:';
echo "{$row[0]}";
echo "<br><br><br>";
echo "價格:$price$<br>";
echo '<a href="../shop/process.php?ids=1">加入購物車</a>';
?>

</body>
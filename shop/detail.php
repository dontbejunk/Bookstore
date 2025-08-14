
<body bgcolor=#FFBFBF>
    <a href="../index.php">上一頁</a>
    <br><br>
    <?php $title = $_GET['ids'];
    echo "<h1>訂單號:$title 此訂單含有:</h1>";
    ?>
    
<table border="" cellpadding="0" cellspacing="0" width="100%" >
    <tr> 
        <td>商品名</td>
        <td>數量</td>
    </tr>

<?php 
include("../config/mysql_connect.inc.php");
$orderid = $_GET['ids'];
$sql = "SELECT * FROM detail WHERE `order.no` = $orderid";
$result = mysqli_query($con, $sql);
$sqll = "SELECT * FROM detail WHERE order.no = $orderid";

if (mysqli_num_rows($result) > 0){

    foreach ($result as $v){
        $sqll = "SELECT * FROM shop WHERE `item.no` = {$v['item.no']}";
        $result = mysqli_query($con, $sqll);
        $row = mysqli_fetch_row($result);

        echo "<tr><td>{$row[1]}</td> 
              <td>$v[amount]</td>
              <br></tr>";
    }
}

?>

</table>
</body>
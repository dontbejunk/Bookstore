
<body bgcolor=#FFBFBF>
    <a href="../index.php">上一頁</a>
    <br><br>
<table border="" cellpadding="0" cellspacing="0" width="100%" >
    <tr> 
        <td>商品名</td>
        <td>數量</td>
        <td>單價</td>
        <td>庫存</td>
        <td>操作</td>
    </tr>
    <?php session_start();
    include("../config/mysql_connect.inc.php");

    $arr = array();

    if (!empty($_SESSION["gwc"])){
        $arr = $_SESSION["gwc"];
    }

    $total = 0;

    
    foreach($arr as $item){

        $sql = "SELECT item_name , price , storage FROM `shop` WHERE `item.no` = '{$item[0]}'";
        $result = mysqli_query($con ,$sql);
        $row = mysqli_fetch_row($result);
        $total = $total + $item[1] * $row[1];

        echo "<tr>
        <td>$row[0]</td>
        <td>$item[1]</td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td><a href='delete_item.php?ids={$item[0]}'>刪除</a> </td>

        </tr>";

    }
    echo"總價格：{$total}<br/>";
    $_SESSION['total'] = $total; 
    

    ?>

</table>

<a href="insert_to_db.php?tota=$total" rel="external nofollow" rel="external nofollow" ?>提交訂單</a>

</body>


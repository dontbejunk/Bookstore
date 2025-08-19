<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>訂單明細</title>
<style>
    body {
        margin: 0;
        font-family: "Microsoft JhengHei", Arial, sans-serif;
        background: linear-gradient(to right, #FFD78C, #FFBFBF);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 0;
    }
    a.back-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background: #FF9800;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background 0.3s;
    }
    a.back-link:hover { background: #F57C00; }

    h1 {
        color: #E53935;
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 80%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    th {
        background-color: #FFBFBF;
        color: #fff;
        font-size: 16px;
    }
    tr:hover { background-color: #FFE5D1; }
</style>
</head>
<body>

<a href="./myorder.php" class="back-link">上一頁</a>

<?php 
include("../config/mysql_connect.inc.php");

$orderid = isset($_GET['ids']) ? intval($_GET['ids']) : 0;
echo "<h1>訂單號: $orderid 此訂單含有:</h1>";
?>

<table>
    <tr> 
        <th>商品名</th>
        <th>數量</th>
    </tr>

<?php 
$sql = "
    SELECT d.amount, s.item_name
    FROM detail d
    JOIN shop s ON d.`item.no` = s.`item.no`
    WHERE d.`order.no` = $orderid
";

$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
                <td>{$row['item_name']}</td>
                <td>{$row['amount']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>此訂單沒有商品</td></tr>";
}
?>

</table>

</body>
</html>

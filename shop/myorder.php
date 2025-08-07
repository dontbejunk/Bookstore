<body bgcolor=#FFBFBF>
    <a href="../pages/member.php">上一頁</a>
    <br><br>
<table border="" cellpadding="0" cellspacing="0" width="100%" >
    <tr> 
        <td>訂單編號</td>
        <td>總價格</td>
        <td>日期</td>
    </tr>

    <?php session_start();
        include("../config/mysql_connect.inc.php");

        $sql = "SELECT * FROM `orders` where `user` = '{$_SESSION['username']}'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) > 0){

            foreach ($result as $v){
        
                $order = $v['order.no'];
                echo "<tr>
                    <td><a href=detail.php?ids=$order>{$v['order.no']}</a></td>
                    <td>{$v['total']}</td>
                    <td>{$v['date']}</td>
                </tr>";
            }
        }
    ?>
</table>
</body>

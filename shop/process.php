<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insert to your cart</title>
  </head>
  <body background="https://png.pngtree.com/thumb_back/fh260/background/20201208/pngtree-beautiful-purple-blooming-christmas-snowflake-image_503982.jpg">
  </body>
</html>
<?php session_start(); 
include("../config/mysql_connect.inc.php");
$item = $_GET['ids'];
$sql = "SELECT storage FROM `shop` WHERE `item.no` = $item";
$result =  mysqli_query($con , $sql);
$row = mysqli_fetch_row($result);

if ( ($row[0] - 1) < 0){
        echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>庫存不足!</h2></center>";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../pages/member.php>';
        exit;
}


if(empty($_SESSION["gwc"])){    //此為購物車
        
        echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>加入中，請稍後!</h2></center>";
        $arr = array(
                array($item, 1 ) //第一個為商品編號 第二個為數量
        );
        $_SESSION["gwc"] = $arr;
}
else{
        $arr = $_SESSION["gwc"];
        $found = false;

        foreach ($arr as $value){

                if ($value[0] == $item){
                        $found = true;
                        if( ($row[0] - $value[1] - 1) < 0){

                                echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>庫存不足!</h2></center>";
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=../pages/member.php>';
                                exit;
                        }
                }
        }

        echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>加入中，請稍後!</h2></center>";
        

        if ($found){

                for ($i = 0 ; $i < count($arr) ; $i++){
                        
                        if ($arr[$i][0] == $item){
                                $arr[$i][1] = $arr[$i][1]+ 1;
                        }
                }
        }
        else{ //如果購物車裡面沒有此商品 新增進去

                $new_item = array($item, 1);
                $arr[] = $new_item;
        }
        $_SESSION["gwc"] = $arr;

}
echo '<meta http-equiv=REFRESH CONTENT=2;url=../pagesmember.php>';

?>

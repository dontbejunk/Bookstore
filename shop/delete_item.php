<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insert to your cart</title>
    
  </head>
  <body background="https://png.pngtree.com/thumb_back/fh260/background/20201208/pngtree-beautiful-purple-blooming-christmas-snowflake-image_503982.jpg">
     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>    
    <center><h4>刪除中，請稍後</h4></center>
  </body>
</html>
<?php session_start();
include("../config/mysql_connect.inc.php");
$item_no = $_GET["ids"];
$arr = $_SESSION["gwc"];
//增加回來
foreach($arr as $key => $item){
    if($item[0] == $item_no){

        if($item[1] > 1){

            $arr[$key][1] = $arr[$key][1] - 1;
        }
        else {  //數量等於1時
            unset($arr[$key]);  //移除掉此列
        }
    }
}

$_SESSION["gwc"] = $arr;    
echo '<meta http-equiv=REFRESH CONTENT=2;url=cart.php>';

?>
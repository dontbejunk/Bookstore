<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../config/mysql_connect.inc.php");
echo '<a href="../auth/logout.php">登出</a>  <br><br>';

if($_SESSION['username'] != null)
{
        echo '<a href="../auth/update.php">修改會員資料</a>    <br><br>';
        echo '<a href="../shop/cart.php">查看購物車</a>    <br><br>';
        echo '<a href="../shop/myorder.php">我的訂單</a>    <br><br>';
    
        //將資料庫裡會員資料顯示在畫面上
        $sql = "SELECT * FROM login  where username = '{$_SESSION['username']}'";
        $result = mysqli_query( $con , $sql );
        $row = mysqli_fetch_row($result);
         echo "用戶名(帳號)：$row[0], " . 
        "電話：$row[2], 地址：$row[3]<br>";

}
else
{
        echo '錯誤!';;
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Buy book store page</title>
    
  </head>
  <body bgcolor =#FFD78C>
    <form name="form" method="post" action="search.php">
    <center>搜尋欄：<input type="text" name="search" /> 
    <input type="submit" name="button" value="搜尋"/></center>
    </form>
    <br>
    <a href="introduce.php?ids=不敗學習力&price=300"><img src="../assets/images/不敗學習力.jpg" alt="不敗學習力(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=我喜歡我自己&price=582"><img src="../assets/images/我喜歡我自己.jpg" alt="我喜歡我自己(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=我不是怪物&price=316"><img src="../assets/images/我不是怪物.jpg" alt="我不是怪物(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=鯨魚少年之歌&price=277"><img src="../assets/images/鯨魚少年之歌.jpg" alt="鯨魚少年之歌(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=江戶川亂步的偵探小說&price=315"><img src="../assets/images/江戶川亂步的偵探小說.jpg" alt="江戶川亂步的偵探小說(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=可以強悍，也可以示弱&price=292"><img src="../assets/images/可以強悍，也可以示弱.jpg" alt="可以強悍，也可以示弱(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=你發生過什麼事&price=379"><img src="../assets/images/你發生過什麼事.jpg" alt="你發生過什麼事(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=好好再見 不負遇見&price=300"><img src="../assets/images/好好再見 不負遇見.jpg" alt="好好再見 不負遇見(圖片)" width="200" height="200"> </a>
   
    </form>
    <br>
    <p>　　　不敗學習力　　　　　　　　　我喜歡我自己　　　　　　　　我不是怪物　　　　　　　　　鯨魚少年之歌　　　　　　江戶川亂步的偵探小說　
      　　　可以強悍，也可以示弱　　　　　　你發生過什麼事　　　　　　好好再見 不負遇見
    </p>

    <p>　　　　300$　　　　　　　　　　　　　582$　　　　　　　　　　　　316$　　　　　　　　　　　　277$　　　　　　　　　　　　315$
    　　　　　　　　　　　　292$　　　　　　　　　　　　379$　　　　　　　　　　　　300$
    </p>

    　　　<a href="../shop/process.php?ids=1">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=2">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=4">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=3">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=5">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=6">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=7">加入購物車</a>
    　　　　　　　　<a href="../shop/process.php?ids=8">加入購物車</a>

    <br><br><br><br>
    <a href="introduce.php?ids=阿共打來怎麼辦：你以為知道但實際一無所知的台海軍事常識&price=300"><img src="../assets/images/阿共打來怎麼辦：你以為知道但實際一無所知的台海軍事常識.jpg" alt="阿共打來怎麼辦：你以為知道但實際一無所知的台海軍事常識(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=原子習慣&price=261"><img src="../assets/images/原子習慣.jpg" alt="原子習慣(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=聲音簡史&price=246"><img src="../assets/images/聲音簡史.jpg" alt="聲音簡史(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=艾希曼審判&price=232"><img src="../assets/images/艾希曼審判.jpg" alt="艾希曼審判(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=為了活下去的思想&price=275"><img src="../assets/images/為了活下去的思想.jpg" alt="為了活下去的思想(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=停雲&price=260"><img src="../assets/images/停雲.jpg" alt="停雲(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=遇蛇&price=260"><img src="../assets/images/遇蛇.jpg" alt="遇蛇(圖片)" width="200" height="200"> </a>
    　
    <a href="introduce.php?ids=人魚陷落&price=250"><img src="../assets/images/人魚陷落.jpg" alt="人魚陷落(圖片)" width="200" height="200"> </a>
    <br>

    <p>　　阿共打來怎麼辦..　　　　　　　　&nbsp原子習慣　　　　　　　　　　&nbsp聲音簡史　　　　　　　　　　艾希曼審判　　　　　　　　&nbsp為了活下去的思想
    　　　　　　　　停雲　　　　　　　　　　　　遇蛇　　　　　　　　　　　人魚陷落</p>

    <p>　　　　300$　　　　　　　　　　　　　&nbsp261$　　　　　　　　　　　　&nbsp246$　　　　　　　　　　　　&nbsp232$
    　　　　　　　　　　　　&nbsp275$　　　　　　　　　　　&nbsp260$　　　　　　　　　　　　&nbsp261$　　　　　　　　　　　　250$
    </p>

    　　　<a href="../shop/process.php?ids=9">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=10">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=11">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=12">加入購物車</a>
    　　　　　　　　　&nbsp<a href="../shop/process.php?ids=13">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=14">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=15">加入購物車</a>
    　　　　　　　　　<a href="../shop/process.php?ids=16">加入購物車</a>
  </body>
</html>
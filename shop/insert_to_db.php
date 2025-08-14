<body background="https://png.pngtree.com/thumb_back/fh260/background/20201208/pngtree-beautiful-purple-blooming-christmas-snowflake-image_503982.jpg">>
<?php session_start();
include("../config/mysql_connect.inc.php");

if (empty($_SESSION['gwc'])){
    echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>購物車為空!</h2></center>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
    exit;
}

$total = $_SESSION['total'];
$arr = array();
$arr = $_SESSION['gwc'];
$time = time();
$date = date("Y-m-d");
$sql = "insert into orders VALUES ($time,'{$_SESSION['username']}', $total , '$date' )";

if(mysqli_query(mysql: $con , query: $sql)){
    echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>提交成功!</h2></center>';
}
else{
    echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>提交失敗!</h2></center>';
}

foreach ($arr as $value){
    
    $sqll = "insert into detail VALUES ($time , $value[0] , $value[1] )";
    mysqli_query($con , $sqll);
    $sql = "update shop set storage = storage - $value[0] where `item.no`='{$value[0]}'";;
    mysqli_query($con , $sql);
}

unset($_SESSION['gwc']); 
unset($_SESSION['total']); 
echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
?>

</body>
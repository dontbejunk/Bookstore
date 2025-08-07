<body bgcolor=#FF7878>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "../style.css">   
<div id = "frm">
<?php session_start();
include("../config/mysql_connect.inc.php");
$id = $_POST['id'];
$tel = $_POST['telephone'];
$adr = $_POST['address'];

$sql = "SELECT * FROM `login` WHERE  `username` = '$id'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0 && $tel != NULL && $adr != NULL ){
    foreach ($result as $v){
        if ($v['telephone'] == $tel && $v['address'] == $adr){
            $_SESSION['user'] = $id;
            echo "<form name=\"form\" method=\"post\" action=\"revise_real.php\">";
            echo '<center><br><br><br>新密碼：<input type="password" name="pw" /> <br></center>
           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            第二次輸入新密碼:<input type="password" name="pw2" /> <br>
                    <center> <input type="submit" name="button" value="確認" id = "btn" />
            </center>
            </form>';

            exit;

        }
    }
}
else{
    echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>資料錯誤!</h2>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
    exit;
}

echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>資料錯誤!</h2>';
echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
exit;

?>

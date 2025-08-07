<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_server = "localhost";
$db_name = "project";
$db_user = "root";
$db_passwd = '';

$con = mysqli_connect($db_server, $db_user, $db_passwd, $db_name);  
if(mysqli_connect_error())
        die("無法對資料庫連線");

?> 
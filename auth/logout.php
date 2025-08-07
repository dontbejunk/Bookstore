
<body background ="https://img.1ppt.com/uploads/allimg/1604/4_160415110243_1.jpg"></body>
<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['username']);

?>
<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>    
    <center><h2>登出中......</h2></center>
    <?php
    echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
    ?>
</body>
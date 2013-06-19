<!doctype html>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<?php
session_start();
//  这种方法是销毁整个 Session 文件
//  这种方法是将原来注册的某个变量销毁
unset($_SESSION['admin']);
session_destroy();
echo("您已经登出,正跳转到登录页！");
echo("<meta http-equiv=refresh content='2; url=login.php'>"); 
?>
</html>
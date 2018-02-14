<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php include_once('header.php'); ?>
<title>Software Download</title>
</head>
<body>
	<?php 
	//  判断是否登陆
	if (!(isset($_SESSION["success"]) && $_SESSION["success"] == true)) {
		//  验证失败，将 $_SESSION["success"] 置为 false
		$_SESSION["success"] = false;
		echo("You are not logged in. Redirecting to login page.");
		echo("<meta http-equiv=refresh content='2; url=login.php'>");
		die();
	}
	else {
?>

	<div style="text-align: center;">
		<br> <a href="./doc/openvpn-install-2.3.2-I001-i686.exe">Windows版下载 32位（通用版）</a>
		<br>
		<br> <a href="./doc/openvpn-install-2.3.2-I001-x86_64.exe">Windows版下载64位</a>
		<br>
		<br> <a href="./doc/Tunnelblick_3.3beta21b.dmg">Mac版下载</a>
	</div>
</body>
<?php } ?>
</html>

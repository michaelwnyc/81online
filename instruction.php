<!doctype html>
<html>
<head>
<?php include_once('header.php'); ?>
<title>vpn Instructions</title>
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


<body>
	Windows版
	<br>
	<br> 1.点击 openvpn程序下载
	，选择合适的版本，并执行安装。Windows版32位可以运行在32和64位操作系统上，如果不清楚是什么系统，可以直接下载32位的。
	<br> 2.点击 openvpn证书文件下载 vpn-noncert.zip
	<br> 3.打开OPENVPN安装文件夹，默认的为C:/Program Files
	(x86)/OpenVPN/config,将vpn-config.zip中所有文件直接解压到这个文件夹中。config文件夹也可在开始菜单--程序--OpenVPN--Shortcuts--OpenVPN
	configuration file directory找到。
	<br> 4.然后解压的证书文件中找到 passwd.txt，打开它并把your username 和 your password
	换成你的用户名密码 保存
	<br>
	5.在开始菜单中找到openvpn这个程序，右键用管理员权限运行OPENVPN，在右下角会出现小图标，右键点connect，等待小图标变绿既成功。每人初始流量10G，超过流量会无法连接，不用的时候需要手动断开连接。
	<br>
	<br>
	<br>Mac版
	<br>
	<br> 1.点击 openvpn程序下载 ，选择 Mac 版本，并执行安装。
	<br> 2.点击 openvpn证书文件下载 vpn-noncert.zip
	<br> 3.运行 TunnelBlick
	<br> 4.会提示要添加一个设置，点击 我有设置文件，再点击 OpenVPN 设置，然后点击 打开私人设置文件夹。
	<br> 5.将刚才第二部中下载的压缩包中的内容解压缩到这个私人设置文件夹中。
	<br> 6.然后在解压的证书文件中找到 passwd.txt，打开它并把your username 和 your password
	换成你的用户名密码 保存。用户名和密码各占一行，每行中没有空格。
	<br> 7.在右上角找到小隧道图标，右键点击 connect (连接)，具体名称可能有出入。
	<br> 8.连接成功后就可以使用了。每人初始流量 10G，超过流量会无法连接。不需要的时候要手动断开连接，在小隧道上右键点击
	disconnect（断开）。
</body>
<?php } ?>
</html>

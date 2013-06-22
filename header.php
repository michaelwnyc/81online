<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link
	rel="stylesheet" type="text/css" href="css/style.css">
<?php 
include("./data/config.inc.php");
require_once("functions.php");
?>
<title>VPN状态信息</title>

<?php

//  防止全局变量造成安全隐患
$admin = false;
session_id($_GET['s']);
session_start();
$sn=session_id();
//  判断是否登陆
if (!(isset($_SESSION["success"]) && $_SESSION["success"] == true)) {
	//  验证失败，将 $_SESSION["success"] 置为 false
	$_SESSION["success"] = false;
	echo("<meta http-equiv=refresh content='0; url=login.php'>");
} else {

	$username          =$_SESSION["username"];

	?>

<div align="center">

	<table style="width: 762px; border: 1px solid black;" cellpadding="0"
		cellspacing="0">
		<tr>
			<TH align=left style="height:113px;"><a
				href="index.php?s=<?php echo ''.$sn.''; ?>" title="首页"><IMG style="height:113px; width:auto;"
					src="images/logo.png" alt=""> </a>
			</TH>
		</tr>
	</table>
	<table style="width: 762px;" cellpadding="1" cellspacing="1">
		<tr class="Title_style1" bgcolor="#92ccfd">
			<td width="20%">
				<div align="center">
					<a href="./download.php?s=<?php echo ''.$sn.''; ?>">openvpn程序下载</a>
				</div>
			</td>

			<td width="20%">
				<div align="center">
					<a href="./doc/vpn-noncert.zip">openvpn证书文件下载</a>
				</div>
			</td>

			<td width="20%">
				<div align="center">
					<a href="./instruction.php?s=<?php echo ''.$sn.''; ?>"
						target="_blank">openvpn使用说明</a>
				</div>
			</td>

			<td width="15%">
				<div align="center">
					<a href="change.php?s=<?php echo ''.$sn.''; ?>">修改密码</a>
				</div>
			</td>

			<td width="10%">
				<div align="center">
					<a href="logout.php?s=<?php echo ''.$sn.''; ?>">退出</a>
				</div>
			</td>

			<td width="auto">
			</td>
		</tr>
	</table>
</div>
<?php } ?>

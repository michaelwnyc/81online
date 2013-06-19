<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link
	rel="stylesheet" type="text/css" href="../css/style.css">
<?php 
include("../data/config.inc.php");
require_once("admin_functions.php");
?>
<title>Admin</title>

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

	$sql="SELECT admin_level FROM admin WHERE username = '$username' GROUP BY username";

	$result=mysql_query($sql);

	$admin_row=mysql_fetch_row($result);

	?>

<div align="center">

	<table style="width: 762px; border: 1px solid black;" cellpadding="1"
		cellspacing="0">
		<tr>
			<TH align=left height=113><a
				href="index.php?s=<?php echo ''.$sn.''; ?>" title="首页"><IMG height=113
					src="../images/logo.png" alt=""> </a>
			</TH>
		</tr>
	</table>
	<table style="width: 762px;" cellpadding="1" cellspacing="1">
		<tr class="Title_style1" bgcolor="#92ccfd">
			<td width="20%">
				<div align="center">
					<a href="./index.php?s=<?php echo ''.$sn.''; ?>">首页</a>
				</div>
			</td>

			<td width="20%">
				<div align="center">
					<a href=""></a>
				</div>
			</td>

			<td width="20%">
				<div align="center">
					<a href=""
						target="_blank"></a>
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
				<div align="center">
					<?php if($admin_row[0]!=1){ ?>
					<a href="newuser.php?s=<?php echo ''.$sn.''; ?>">管理界面</a>
					<?php } ?>
				</div>
			</td>
		</tr>
	</table>
</div>
<?php } ?>

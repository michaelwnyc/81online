<!doctype html>
<html>
<head>
<?php include_once('header.php'); ?>
</head>
<body>
	<?php 
	//  判断是否登陆
	if (!(isset($_SESSION["success"]) && $_SESSION["success"] == true)) {
		//  验证失败，将 $_SESSION["success"] 置为 false
		$_SESSION["success"] = false;
		echo("您没有登录,正跳转到登录页");
		echo("<meta http-equiv=refresh content='2; url=login.php'>");
		die();
	}
	else if($admin_row[0]!=3){					//判断是否是管理员 3 级
		echo("您没有权限。正跳转回上一页。");
		echo("<meta http-equiv=refresh content='0; url=index.php?s=".$sn."'>");
	}
	else {
?>
	<div align="center">
		<div style="width: 762px; border: 1px solid balck;" cellpadding="1"
			cellspacing="0">
			<table style="width: 762px; height: 30px; margin: 10px 0;"
				cellpadding="1" cellspacing="1">
				<tr class="Title_style2" style="background-color: #92ccfd;">

					<td width="10%">
						<div align="center">
							<a href="index.php?s=<?php echo ''.$sn.''; ?>">首页</a>
						</div>
					</td>
					<td width="20%">
						<div align="center">
							<?php if($admin_row[0]!=1){ ?>
							<a href="newuser.php?s=<?php echo ''.$sn.''; ?>">添加用户</a>
							<?php } ?>
						</div>
					</td>

					<td width="20%">
						<div align="center">
							<?php if($admin_row[0]==3){ ?>
							<a href="deluser.php?s=<?php echo ''.$sn.''; ?>">删除用户</a>
							<?php } ?>
						</div>
					</td>

					<td width="20%">
						<div align="center">
							<?php if($admin_row[0]!=1){ ?>
							<a href="admin_list.php?s=<?php echo ''.$sn.''; ?>">管理员列表</a>
							<?php } ?>
						</div>
					</td>

					<td width="20%">
						<div align="center">
							<a href=""></a>
						</div>
					</td>

					<td width="10%">
						<div align="center">
							<a href="logout.php?s=<?php echo ''.$sn.''; ?>">退出</a>
						</div>
					</td>
				</tr>
			</table>

			<FORM ACTION="" METHOD="POST">
				<TABLE cellSpacing=0 cellPadding=0 width=350 align=center
					bgColor=#ffff99 border=0>
					<TBODY>
						<TR>
							<TD align=right height=25>用户名：&nbsp; <INPUT tabIndex=1 type=text
								maxLength=20 size=20 name=username>
							</TD>
						</TR>
						<TR>
							<TD align=right>密码：&nbsp; <INPUT tabIndex=2 type=password
								maxLength=20 size=20 name=password>
							</TD>
						</TR>
						<TR>
							<TD align=right>是否管理员（1为是 0为否）：&nbsp; <INPUT tabIndex=2 type=text
								maxLength=20 size=20 name=admin_level value=0>
							</TD>
						</TR>
						<TR>
							<TD align=middle height=25><INPUT id=del_user
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 65px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type=submit value="删除用户" name=del_user> <INPUT id=reset
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type=reset value="重置" name=reset>
							</TD>
						</TR>

					</TBODY>
				</TABLE>
			</FORM>
		</div>
	</div>
	<?php
	}
	?>
</body>
</html>

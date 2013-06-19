<!DOCTYPE html>
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
	else if($admin_row[0]==1){
		echo("您没有权限。正跳转回首页。");
		echo("<meta http-equiv=refresh content='0; url=index.php?s=".$sn."'>");
	}
	else {
    ?>
	<div align="center">
		<div
			style="width: 762px; border: 1px solid balck; text-align: center;"
			cellpadding="1" cellspacing="0" align="center">
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

			<form action="" method="post">
				<table cellspacing="0" cellpadding="0" width="350" align="center"
					bgcolor="#FFFF99" border="0">
					<tbody>
						<tr>
							<td align="right" height="25">用户名：&nbsp; <input tabindex="1"
								type="text" maxlength="20" size="20" name="username">
							</td>
						</tr>
						<tr>
							<td align="right">密码：&nbsp; <input tabindex="2" type="password"
								maxlength="20" size="20" name="password">
							</td>
						</tr>
						<tr>
							<td align="right">重复密码：&nbsp; <input tabindex="3" type="password"
								maxlength="20" size="20" name="repassword">
							</td>
						</tr>
						<tr>
							<td align="right">姓名：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="name">
							</td>
						</tr>
						<tr>
							<td align="right">Email：&nbsp; <input tabindex="3" type="text"
								maxlength="40" size="20" name="email">
							</td>
						</tr>
						<tr>
							<td align="right">管理员(默认为1)：&nbsp; <input tabindex="3"
								type="text" maxlength="1" size="20" name="admin_level" value="1">
							</td>
						</tr>
						<tr>
							<td align="right">周期（天）：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="cycle" value="30">
							</td>
						</tr>
						<tr>
							<td align="right">流量(GB)：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="quota_bytes" value="10">
							</td>
						</tr>
						<tr>
							<td align="right">状态(1是活跃)：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="active" value="1">
							</td>
						</tr>
						<tr>
							<td align="right">启用：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="enable" value="1">
							</td>
						</tr>
						<tr>
							<td align="middle" height="25"><input id="new_user"
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 65px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type="submit" value="添加用户" name="new_user"> <input id="reset"
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type="reset" value="重置" name="reset">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<?php
            }
            ?>
</body>
</html>

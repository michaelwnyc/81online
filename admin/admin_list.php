<!doctype html>
<html>
<head>
<?php include_once('header.php'); ?>
<title>Admin</title>
</head>
<body>
	<?php
	if (!(isset($_SESSION["success"]) && $_SESSION["success"] == true)) {
		//  验证失败，将 $_SESSION["success"] 置为 false
		$_SESSION["success"] = false;
		echo("<meta http-equiv=refresh content='0; url=login.php'>");
	}
	else if($admin_row[0]==1){					//判断是否是管理员 3 级
		echo("您没有权限。正跳转回上一页。");
		echo("<meta http-equiv=refresh content='0; url=index.php?s=".$sn."'>");
	}
	else {
		$sql="SELECT * FROM  `admin`";
		$result=mysql_query($sql);
		?>
	<div align="center">
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
		<table
			style="width: 762px; border: 1px solid black; border-bottom: 0px; margin-top: 10px"
			cellpadding="1" cellspacing="0">
			
			<?php while($row = mysql_fetch_array($result)){ ?>
			<tr class="Title_style2">
				<td width="25%">
					<div align="left">
						<a> 用户名</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> Email</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> Admin Level</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a></a>
					</div>
				</td>
			</tr>
			<tr class="Content_style1">
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['admin_level'] ?></td>
				<td></td>
			</tr>
			<tr></tr>
			<tr>
				<td colspan=4></td>
			</tr>
			<?php } ?>
		</table>
		<p align="center" class="Content_style1">本页面每5分钟刷新一次</p>
	</div>
	<?php 
	mysql_close($conn);
} ?>
</body>
</html>

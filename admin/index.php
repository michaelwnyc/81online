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
	} else {

		function sizeformat($bytesize)
		{
			$i=0;
			while(abs($bytesize) >= 1024)
			{
				$bytesize=$bytesize/1024;
				$i++;
				if($i==4) break;
			}
			$units = array("字节","KB","MB","GB","TB");
			$newsize=round($bytesize,2);
			return("$newsize $units[$i]");
		}

		function actformat($value)
		{
			if ($value==1){
				return "活跃";
			}
			else{
				return "停用";
			}
		}

		$sql="SELECT username,name,email,quota_cycle,quota_bytes,used_quota,left_quota,active FROM  `user`";
		$result=mysql_query($sql);
		?>
	<div align="center">
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
						<a> 姓名</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> Email</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a>状态</a>
					</div>
				</td>
			</tr>
			<tr class="Content_style1">
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php if($row['active']==1){
					echo "活跃";
				}
				else{
						echo "停用";
					} ?>
				</td>
			</tr>
			<tr></tr>
			<tr class="Title_style2">

				<td width="25%">
					<div align="left">
						<a> 周期</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> 总流量</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> 总使用量</a>
					</div>
				</td>

				<td width="25%">
					<div align="left">
						<a> 剩余流量</a>
					</div>
				</td>
			</tr>
			<tr class="Content_style1">
				<td><?php echo $row['quota_cycle'] ?></td>

				<td><?php echo sizeformat($row['quota_bytes']) ?></td>

				<td><?php echo  sizeformat($row['used_quota']) ?></td>

				<td><?php echo  sizeformat($row['left_quota']) ?></td>
			</tr>
			<tr><td colspan=4 style="height:10px;"></td></tr>
			<?php } ?>
		</table>
		<p align="center" class="Content_style1">本页面每5分钟刷新一次</p>
	</div>
	<?php 
	mysql_close($conn);
} ?>
</body>
</html>

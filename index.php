<!doctype html>
<html>
<head>
<?php include_once('header.php'); ?>
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
	
	$sql="SELECT stat.*,user.active,user.quota_cycle,user.quota_bytes,user.left_quota,user.admin_level FROM stat,user WHERE stat.username = '$username' and user.username='$username' GROUP BY stat.username";
	
	//mysqli_query("SET NAMES gbk");
	
	$result=mysql_query($sql);
	
	$row=mysql_fetch_row($result);
	?>

<div align="center" >
	<table style="width: 762px; border: 1px solid black; border-bottom:0px; margin-top:10px" cellpadding="1"
		cellspacing="0">
		<tr class="Title_style2">

			<td width="25%">
				<div align="left">
					<a> 用户名</a>
				</div>
			</td>

			<td width="25%">
				<div align="left">
					<a> 开始时间</a>
				</div>
			</td>

			<td width="25%">
				<div align="left">
					<a> 统计周期</a>
				</div>
			</td>

			<td width="25%">
				<div align="left">
					<a></a>
				</div>
			</td>
		</tr>
		<tr class="Content_style1">

			<td><?php echo $row[1] ?></td>

			<td><?php echo $row[2] ?></td>

			<td><?php echo $row[4] ?>天</td>

		</tr>
		<tr></tr>
		<tr class="Title_style2">

			<td width="25%">
				<div align="left">
					<a> 用户状态</a>
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
			<td><?php echo actformat($row[3]) ?></td>

			<td><?php echo sizeformat($row[5]) ?></td>

			<td><?php echo  sizeformat($row[0]) ?></td>

			<td><?php echo  sizeformat($row[6]) ?></td>
		</tr>
	</table>
	<p align="center" class="Content_style1">本页面每5分钟刷新一次</p>
</div>
<?php 
mysqli_close($conn);
} ?>
</body>
</html>

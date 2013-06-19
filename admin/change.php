<!doctype html>
<html>
<head>
<?php include_once('header.php'); ?>
<title>Admin</title>
</head>
<body>
	<?php 

	//  判断是否登陆
	if (!(isset($_SESSION["success"]) && $_SESSION["success"] === true)) {
		//  验证失败，将 $_SESSION["success"] 置为 false
		$_SESSION["success"] = false;
		echo("您没有登录,正跳转到登录页");
		echo("<meta http-equiv=refresh content='2; url=login.php'>");
		die();
	}
	else {

?>
	<FORM ACTION="" METHOD="POST">
		<TABLE cellSpacing=0 cellPadding=0 width=268 align=center
			bgColor=#ffff99>
			<TBODY>
				<TR>
					<TD align=center height=25>原密码：&nbsp; <INPUT tabIndex=1
						type=password maxLength=20 size=15 name=oldpassword>
					</TD>
				</TR>
				<TR>
					<TD align=center>新密码：&nbsp; <INPUT tabIndex=2 type=password
						maxLength=20 size=15 name=newpassword>
					</TD>
				</TR>
				<TR>
					<TD align=center>重复新密码：&nbsp; <INPUT tabIndex=3 type=password
						maxLength=20 size=15 name=renewpassword>
					</TD>
				</TR>
				<TR>
					<TD align=center height=25><INPUT id=pw_manager
						style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 65px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
						type=submit value="修改密码" name=pw_manager> <INPUT id=reset
						style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
						type=reset value="重置" name=reset>
					</TD>
				</TR>

			</TBODY>
		</TABLE>
	</FORM>

	<?php
	}
	?>
</body>
</html>

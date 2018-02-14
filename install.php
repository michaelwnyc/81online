<!DOCTYPE html>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link
	rel="stylesheet" type="text/css" href="css/style.css">
<?php require_once("install_functions.php"); ?>
</head>
<?php
if(file_exists('./data/install.lock')){
	echo("Need to delete data/install.lock to reinstall.");
}
else{
	?>
<body>
	<div align="center">
		<div
			style="width: 762px; border: 1px solid balck; text-align: center;"
			align="center">

			<form action="" method="post">
				<table cellspacing="0" cellpadding="0" width="350" align="center"
					bgcolor="#FFFF99">
					<tbody>
						<tr>
							<td align="right" height="25">Hostname:&nbsp; <input tabindex="1"
								type="text" maxlength="20" size="20" name="hostname"
								value="localhost">
							</td>
						</tr>
						<tr>
							<td align="right">DB Username:&nbsp; <input tabindex="2" type="text"
								maxlength="20" size="20" name="db_username">
							</td>
						</tr>
						<tr>
							<td align="right">DB Password:&nbsp; <input tabindex="3"
								type="password" maxlength="20" size="20" name="db_password">
							</td>
						</tr>
						<tr>
							<td align="right">DB Name:&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="db_name" value="openvpn">
							</td>
						</tr>
						<tr>
							<td align="right">Admin Username:&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="admin_username">
							</td>
						</tr>
						<tr>
							<td align="right">Admin Password:&nbsp; <input tabindex="3"
								type="password" maxlength="20" size="20" name="admin_passwd">
							</td>
						</tr>
						<tr>
							<td align="right">Email：&nbsp; <input tabindex="3" type="text"
								maxlength="20" size="20" name="email">
							</td>
						</tr>
						<tr>
							<td align="center" height="25"><input
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 65px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type="submit" value="Add User" name="install"> <input
								style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px"
								type="reset" value="Reset" name="reset">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
<?php 
}
?>
</html>

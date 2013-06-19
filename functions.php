<?php
include("./data/config.inc.php");
//表单提交后...
$posts = $_POST;
//清除一些空白符号
foreach ($posts as $key => $value) {
	$posts[$key] = trim($value);
}


mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error()); //填写mysql用户名和密码

mysql_select_db($db_name)or die(mysql_error());

if(isset($_POST['login'])){
	echo checklogin(mysql_real_escape_string($posts["username"]),mysql_real_escape_string($posts["password"]));
}
else if(isset($_POST['pw_manager'])){
	session_id($_GET['s']);
	session_start();
	echo $_SESSION["username"];
	echo pwchange(mysql_real_escape_string($_SESSION["username"]),mysql_real_escape_string($posts["oldpassword"]),mysql_real_escape_string($posts["newpassword"]),mysql_real_escape_string($posts["renewpassword"]));
}
else if(isset($_POST['new_user'])){
	session_id($_GET['s']);
	session_start();
	//echo $_SESSION["username"];
	$active = mysql_real_escape_string($posts["active"]);
	$name = mysql_real_escape_string($posts["name"]);
	$email = mysql_real_escape_string($posts["email"]);
	$cycle = mysql_real_escape_string($posts["cycle"]);
	$quota_bytes = mysql_real_escape_string($posts["quota_bytes"])*1024*1024*1024;
	$enable = mysql_real_escape_string($posts["enable"]);
	$admin_level = mysql_real_escape_string($posts["admin_level"]);
	echo new_user(mysql_real_escape_string($posts["username"]),mysql_real_escape_string($posts["password"]),mysql_real_escape_string($posts["repassword"]),$active,$name,$email,$cycle,$quota_bytes,$enable,$admin_level);
}
else if(isset($_POST['del_user'])){
	session_id($_GET['s']);
	session_start();
	//echo $_SESSION["username"];
	echo del_user($_SESSION["username"],mysql_real_escape_string($posts["username"]),mysql_real_escape_string($posts["password"]));
}

/**
 * 这是用来检测由前端用户输入的内容是否含有不安全因素，进行过滤，防止数据库注入
 */
function check_input($value){
	// Stripslashes
	if (get_magic_quotes_gpc())  {
		$value = stripslashes($value);
	}
	// Quote if not a number
	if (!is_numeric($value))  {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

/**
 * 这是用来登录的功能。
 * 用户登录后，检测用户名密码是否正确。
 * 如果正确，就赋一个session id，lifeTime超过后就会失效。
 */
function checklogin($username,$password){
	$sql = "SELECT * FROM user WHERE password = password('$password') AND username = '$username'";
	//  取得查询结果
	$result = mysql_query($sql) or die ("wrong");
	$userInfo = mysql_fetch_array($result);
	if (!empty($userInfo)) {
		if ($userInfo["username"] == $username) {
			//  设置一个存放目录
			$savePath = '../ss_save_dir/';
			//  保存半小时  3600是一小时
			$lifeTime = 0.5 * 3600;
			//  取得当前 Session 名，默认为 PHPSESSID
			$sessionName = session_name();
			//  取得 Session ID
			$sessionID = $_GET[$sessionName];
			//  使用 session_id() 设置获得的 Session ID
			session_id($sessionID);
			session_set_cookie_params($lifeTime);
			//  当验证通过后，启动 Session
			session_start();
			//  注册登陆成功的 admin 变量，并赋值 true
			$_SESSION["success"] = true;
			$_SESSION["username"] = $username;
			$sn = session_id();
			echo("<meta http-equiv=refresh content='0; url=index.php?s=".$sn."'>");
		}
	} else {
		echo("用户名密码错误!");
		//echo("<meta http-equiv=refresh content='3; url=login.php'>");
	}
}



/**
 * 修改密码
 * 用旧密码先验证，再核对新密码和重复新密码是否一样
 */
function pwchange($username,$oldpassword,$newpassword,$renewpassword){
	$sql = "SELECT * FROM user WHERE password = password('$oldpassword') AND username = '$username'";
	$result = mysql_query($sql) or die ("wrong");
	$userInfo = mysql_fetch_array($result);

	if($newpassword != $renewpassword){
		echo('两次输入的新密码不正确,请重新输入!密码应在6-20位之间.');
		//echo("<meta http-equiv=refresh content='2; url=change.php'>");
	}else{
		//如果密码正确，会有一行返回结果
		if(mysql_num_rows(mysql_query($sql))==1 ){
			$sql="Update user set password=password('$newpassword') where username='$username'";
			mysql_query($sql) or die(mysql_error());
			echo('密码修改成功!正跳转到登录页');
			echo("<meta http-equiv=refresh content='2; url=login.php'>");
		}else{
			echo('旧密码不正确,请重新输入!正跳转回前一页');
			//echo("<meta http-equiv=refresh content='2; url=change.php?s='.$sn.''>");
		}
	}
}

/**
 * 添加新用户
 * 将相应的栏目信息添加到数据库中
 * 这里可以以后尝试改为将一个数组传送进来，以便添加其他信息。
 */
function new_user($username,$password,$repassword,$active,$name,$email,$cycle,$quota_bytes,$enable,$admin_level){
	session_id($_GET['s']);
	session_start();
	$sn = session_id();
	if( $password != $repassword){
		echo('两次输入的新密码不正确,请重新输入!密码应在6-20位之间。');
	}else{
		$sql="INSERT INTO `user` (`username`, `password`, `active`, `creation`, `name`, `email`, `note`, `admin_level`, `quota_cycle`, `quota_bytes`, `used_quota`, `left_quota`, `enabled`) VALUES ('$username', PASSWORD('$password'), '$active', CURRENT_TIMESTAMP, '$name', '$email', NULL,'$admin_level','$cycle', '$quota_bytes', '0', '$quota_bytes', '$enable')";
		$sql1="INSERT INTO `stat` (`total_used`,`username`, `origin_time`) VALUES ('0','$username', CURRENT_TIMESTAMP)";
		mysql_query($sql) or die(mysql_error());
		mysql_query($sql1) or die(mysql_error());
		echo("用户添加成功!");
		echo("<meta http-equiv=refresh content='2; url=index.php?s=".$sn."'>");
	}
}

/**
 * 删除用户
 * 用管理员用户名和输入的密码来检测是否是管理员，这样同时可以避免误删
 * 然后正确的话直接删除输入的用户名
 * 需要添加：在删除后显示出删除的用户名
 */
function del_user($admin_username,$username,$password){
	session_id($_GET['s']);
	session_start();
	$sn = session_id();
	$sql = "SELECT * FROM `user` WHERE `password` = password('$password') AND `username` = '$admin_username'";
	//  取得查询结果
	$result = mysql_query($sql) or die("wrong");
	$userInfo = mysql_fetch_array($result);
	if(!empty($userInfo)){
		$sql1="DELETE FROM `user` WHERE `username`='$username'";
		$sql2="DELETE FROM `stat` WHERE `username`='$username'";
		mysql_query($sql1) or die(mysql_error());
		mysql_query($sql2) or die(mysql_error());
		echo('用户'); echo $username; echo('删除成功!');
		echo("<meta http-equiv=refresh content='2; url=index.php?s=".$sn."'>");
	}
	else{
		echo("密码错误!返回上一页");
		echo("<meta http-equiv=refresh content='2; url=deluser.php?s=".$sn."'>");
	}
}

?>

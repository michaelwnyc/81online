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
		echo("Username and password don't match!");
		//echo("<meta http-equiv=refresh content='3; url=login.php'>");
	}
}



/**
 * Change Password
 * Validate current password, and check if the new password confirmaton matches.
 */
function pwchange($username,$oldpassword,$newpassword,$renewpassword){
	$sql = "SELECT * FROM user WHERE password = password('$oldpassword') AND username = '$username'";
	$result = mysql_query($sql) or die ("wrong");
	$userInfo = mysql_fetch_array($result);

	if($newpassword != $renewpassword){
		echo('Password confirmation doesn\'t match. The password should be between 6-20 characters.');
		//echo("<meta http-equiv=refresh content='2; url=change.php'>");
	}else{
		//If password is correct, will have one row in result.
		if(mysql_num_rows(mysql_query($sql))==1 ){
			$sql="Update user set password=password('$newpassword') where username='$username'";
			mysql_query($sql) or die(mysql_error());
			echo('Success. Redirecting to home page.');
			echo("<meta http-equiv=refresh content='2; url=login.php'>");
		}else{
			echo('The current password is not correct. Redirecting back.');
			//echo("<meta http-equiv=refresh content='2; url=change.php?s='.$sn.''>");
		}
	}
}
?>

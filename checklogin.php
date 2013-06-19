<?php
include("./data/config.inc.php");
//表单提交后...
$posts = $_POST;
//清除一些空白符号
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}

echo($db_host+$db_user+$db_pass);

mysql_connect($db_host,$db_user,$db_pass) //填写mysql用户名和密码  
   or die("abc"+mysql_error());    

mysql_select_db($db_name) or die("bcd"+mysql_error()); 

mysql_query('set names "gbk"'); //数据库内数据的编码  
$password =  mysql_real_escape_string($posts["password"]);
$username = mysql_real_escape_string($posts["username"]); 
$sql = "SELECT * FROM user WHERE password = password('$password') AND username = '$username'";
//  取得查询结果
$result = mysql_query($sql) or die ("wrong"); 
$userInfo = mysql_fetch_array($result); 

if (!empty($userInfo)) {

if ($userInfo["username"] == $username) { 
    //  设置一个存放目录
    $savePath = '../ss_save_dir/';
    //  保存一天
    $lifeTime = 24 * 3600;
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
    $_SESSION["admin"] = true;
    $_SESSION["username"] = $username;
    $sn = session_id();
        echo("<meta http-equiv=refresh content='0; url=index.php?s=".$sn."'>"); 
} else { 
echo("用户名密码错误code2,5秒后跳转到登录页"); 

echo("<meta http-equiv=refresh content='5; url=login.php'>");

} 

} else {
    echo("用户名密码错误code1,5秒后跳转到登录页");

    echo("<meta http-equiv=refresh content='5; url=login.php'>");

}
?>

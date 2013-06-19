<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF8">
<?php
	include(".。/data/config.inc.php");
    require_once("admin_functions.php");

    $sn = session_id();
?>
<title>Admin</title>
</head>
<body>
    <FORM ACTION="" METHOD="POST">
             <TABLE height=159 cellSpacing=0 cellPadding=0 width=268 align=center bgColor=#558bba border=0> 
                <TBODY>
                    <TR>
                        <TD align=center style="width:234px; height:43px;"><IMG style="height:113px; width:auto;" src="../images/logo.png"></TD>
                    </TR>
                    <TR> 
                        <TD align=center background=../images/loginbg.gif bgColor=#fafafa height=180> 
                            <TABLE width=250 border=0> 
                                <TBODY> 
                                    <TR> 
                                        <TD align=center height=25>用户名： <INPUT tabIndex=1 maxLength=20 size=15 name=username></TD>
                                    </TR>
                                    <TR> 
                                        <TD align=center>&nbsp;&nbsp;&nbsp;密码： <INPUT tabIndex=2 type=password maxLength=20 size=15 name=password></TD>
                                    </TR>
                                    <TR> 
                                        <TD align=center height=25>
                                            <INPUT id=login style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BACKGROUND-IMAGE: url(../images/loginbutton.gif); BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px" type=submit value="登录" name=login>
                                            <INPUT id=reset style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BACKGROUND-IMAGE: url(../images/loginbutton2.gif); BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px" type=reset value="重置" name=reset>
                                        </TD>
                                    </TR>
                                    <TR> 
                                        <TD align=center> 
                                        <TABLE border=0> 
                                            <TBODY> 
                                                <TR> 
                                                    <TD></TD> 
                                                    <TD width=10></TD> 
                                                    <TD></TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE></TD>
                                    </TR>
                                </TBODY>
                            </TABLE>
                        </TD>
                    </TR>
                    <TR> 
                        <TD align=center background=../images/loginend.gif height=5></TD>
                    </TR>
                </TBODY>
            </TABLE>
    </FORM>
</body>

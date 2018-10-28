<!DOCTYPE html>
<html>
<head>
    <title>Take Me Home</title>
    <link rel="stylesheet" type="text/css" media="screen" href="file:///C|/xampp/htdocs/softdev/post.css" />
</head>
<body>
<?php require_once('Connections/MyConnect.php'); ?>
<?php 	
	mysql_query('SET character_set_results=utf8');
	mysql_query('SET names=utf8');  
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_connection=utf8');   
	mysql_query('SET character_set_results=utf8');   
	mysql_query('SET collation_connection=utf8_general_ci');  
	session_start();
	$username = mysql_real_escape_string($_POST['uName']);
	$password = mysql_real_escape_string($_POST['pWord']);
	$fname = mysql_real_escape_string($_POST['fName']);
	$lname = mysql_real_escape_string($_POST['lName']);
	$email = mysql_real_escape_string($_POST['email']);
	$tel = mysql_real_escape_string($_POST['tel']);
	$gender = mysql_real_escape_string($_POST['gender']);
	
	mysql_select_db($database_MyConnect, $MyConnect);
	$username_check = mysql_query("SELECT user_username FROM user WHERE user_username='".$username."'");
	$email_check = mysql_query("SELECT user_email FROM user_detail WHERE user_email='".$email."'");
	$row_sql1 = mysql_num_rows($username_check);
	$row_sql2 = mysql_num_rows($email_check);
	if($row_sql1==0&&$row_sql2==0){
	mysql_query("INSERT INTO user (user_username,user_password) VALUES ('$username','$password')");
	$sqlmax=mysql_query("SELECT user_id FROM user ");
	$row_max = mysql_num_rows($sqlmax);
	mysql_query("INSERT INTO user_detail (user_id,user_fname,user_lname,user_email,user_tel,user_gender) VALUES ('$row_max','$fname','$lname','$email','$tel','$gender')");
	echo "<script language=\"JavaScript\">alert('ลงทะเบียนสำเร็จ!')</script><meta http-equiv='refresh' content='0;URL=main.php?uName=".$username."&pWord=".$password."'>";
	}
	else{
		if($row_sql1>0&&$row_sql2>0){echo "<script language=\"JavaScript\">alert('User นี้มีผู้ใช้เเล้ว และ E-mail มีผู้ใช้แล้ว')</script>";}
		else if($row_sql1>0){echo "<script language=\"JavaScript\">alert('User นี้มีผู้ใช้เเล้ว')</script>";}
		else if($row_sql2>0){echo "<script language=\"JavaScript\">alert('E-mail มีผู้ใช้แล้ว')</script>";}
		echo "<meta http-equiv='refresh' content='0;URL=register.php'>";
	}
?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Take Me Home</title>
    <link rel="stylesheet" type="text/css" media="screen" href="post.css" />
</head>
<body>
<?php require_once('Connections/MyConnect.php'); ?>
<?php include("storageData.php"); ?>
<?php
	mysql_query('SET character_set_results=utf8');
	mysql_query('SET names=utf8');  
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_connection=utf8');   
	mysql_query('SET character_set_results=utf8');   
	mysql_query('SET collation_connection=utf8_general_ci');
	session_start();
	$filePic = $_FILES['pic'];;
	$filePicName = $_FILES['pic']['name'];
	$filePicSize = $_FILES['pic']['size'];
	
	$filePicExt = explode('.',$filePicName);
	$filePicActualExt = strtolower(end($filePicExt));
	$allowedPic = array('jpg','jpeg','png');
	if(in_array($filePicActualExt,$allowedPic)){
		if($filePicSize<500000){
			$user_id = mysql_real_escape_string($_SESSION['MM_UserId']);;
			$picture = mysql_real_escape_string(uploadFile($_FILES['pic'],'storageData/'));
			$detail = mysql_real_escape_string($_POST['detail']);
			$location = mysql_real_escape_string($_POST['location']);
			$tel = mysql_real_escape_string($_POST['tel']);
			$status = 0;
			
			mysql_select_db($database_MyConnect, $MyConnect);
			mysql_query("INSERT INTO post (user_id,post_pic,post_desc,post_location,post_tel,post_status,post_date) VALUES ('$user_id','$picture','$detail','$location','$tel','$status',CURDATE())");
			echo "<script language=\"JavaScript\">alert('Post Success!')</script><meta http-equiv='refresh' content='0;URL=feed.php'>";
		}else{
			echo "<script language=\"JavaScript\">alert('Your picture file is too big!')</script><meta http-equiv='refresh' content='0;URL=post.php'>";
		}
	}else{
		echo "<script language=\"JavaScript\">alert('Please upload picture files of type jpg,jepg or png!')</script><meta http-equiv='refresh' content='0;URL=post.php'>";
	}
?>
</body>
</html>
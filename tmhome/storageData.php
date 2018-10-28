<?php require_once('Connections/MyConnect.php'); ?>
<?php 
function uploadFile($file,$path="storageData/"){
	$hostname_MyConnect = "localhost";
	$database_MyConnect = "tmhome";
	$username_MyConnect = "root";
	$password_MyConnect = "";
	$MyConnect = mysql_pconnect($hostname_MyConnect, $username_MyConnect, $password_MyConnect) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_MyConnect, $MyConnect);
	$sql = mysql_query("SELECT MAX(post_pic) FROM post");
	$rs = mysql_fetch_array($sql);
	$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
	if(isset($rs[0])){
		$n1 = explode('.',$rs[0]);
		$n2 = explode('-',$n1[0]);
		$n3 = (int)$n2[1]+1;
		$n4 = sprintf("%04d",$n3);
	}else{
		$n4 = 0001;
	}
	$newName = "pic-".$n4;	
	$file['name'] = $newName.'.'.$ext;
	if(@copy($file['tmp_name'],$path.$file['name'])){
		@chmod($path.$file,0777);
		return $file['name'];
	}else{
		return false;
	}
}
?>
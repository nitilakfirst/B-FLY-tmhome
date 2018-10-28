<?php require_once('Connections/MyConnect.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
mysql_query('SET character_set_results=utf8');
mysql_query('SET names=utf8');  
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');   
mysql_query('SET character_set_results=utf8');   
mysql_query('SET collation_connection=utf8_general_ci');
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['MM_UserId'] = NULL;
  $_SESSION['user_fname'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['MM_UserId']);
  unset($_SESSION['user_fname']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "main.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
if(!isset($_SESSION['user_fname'])&&isset($_SESSION['MM_UserId'])){
	mysql_select_db($database_MyConnect, $MyConnect);
	$sqlRea = mysql_query("SELECT user_fname FROM user_detail WHERE user_id='".$_SESSION['MM_UserId']."'");
	$rsRea = mysql_fetch_array($sqlRea)  or die(mysql_error());
	$_SESSION['user_fname']=$rsRea[0];
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "main.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_MyConnect, $MyConnect);
$query_Recordset1 = "SELECT b.post_pic, b.post_desc, b.post_location, b.post_tel, b.post_date,b.post_status,u.user_username,b.post_id FROM post b,user u, user_detail ud WHERE b.user_id=u.user_id AND u.user_id=ud.user_id ORDER BY b.post_id DESC";
$Recordset1 = mysql_query($query_Recordset1, $MyConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Take Me Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="feed.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" class="table">
        <tr height="150">
        <div class="iBannerFixTop2" style="align:center; background-image: url(img/bg.jpg);height:150px; width: 800px;">
          <td  align="right" height="50" id="proTop">
              <div id="profile2" class="iBannerFixTop">
                <span class="btn-group">
                        <button class="btPost bt1" onclick="window.location='post.php'">โพสต์</button>
                    </span>
                <img class="circle w3-hover-opacity" id="profile" src="img/u1.jpg" onclick="window.location='profile.php'">
                    <span><?php if(isset($_SESSION['user_fname'])){echo "ผู้ใช้ : ".$_SESSION['user_fname'];}?></span><br>
                    <button class="btLogout bt1" onclick="window.location='<?php echo $logoutAction ?>'">ออกจากระบบ</button><br>
              </div>
          </td>
         </div>
        </tr>
        <tr>
          <td align="center" height="450"><table border="0">
            <?php if(isset($row_Recordset1['user_username'])){do { ?>
            	<table border="0">
              <tr>
              	<td id="name"><i class="fa fa-user-circle icon"></i> <?php echo $row_Recordset1['user_username']; ?></td>
                <td id="date" style="text-align:right; width:100px;"><?php echo $row_Recordset1['post_date']; ?></td>
              </tr>
              <tr class="detail">
                <td>
					<img src="storageData/<?php echo $row_Recordset1['post_pic']; ?>" width="200" height="200" />
                
                </td>
                <td style="width:500px;" valign="top">
                	<p id="desc">รายละเอียด</p>
					<p><?php echo $row_Recordset1['post_desc']; ?></p>
                    <p>สถานะ : <?php if($row_Recordset1['post_status']==0){echo "ยังไม่มีผู้รับเลี้ยง";}else{echo "มีผู้รับไปเลี้ยงแล้ว";} ?></p>
                    <p>เบอร์ติดต่อ : <?php echo $row_Recordset1['post_tel'];?></p>
                    
                
                </td>
              </tr>
              </table><br>
              <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); }?>
          </table></td>    
      </tr>
        
    </table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

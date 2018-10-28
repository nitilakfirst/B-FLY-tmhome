<?php require_once('Connections/MyConnect.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
mysql_query('SET character_set_results=utf8');
mysql_query('SET names=utf8');  
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');   
mysql_query('SET character_set_results=utf8');   
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

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_Recordset1 = $_SESSION['MM_UserId'];
}
mysql_select_db($database_MyConnect, $MyConnect);
$query_Recordset1 = sprintf("SELECT b.post_pic, b.post_desc, b.post_location, b.post_tel, b.post_date,b.post_status,u.user_username,b.post_id,ud.* FROM post b,user u, user_detail ud WHERE b.user_id=u.user_id AND u.user_id=ud.user_id AND b.user_id Like %s ORDER BY b.post_id DESC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_Recordset1 = $_SESSION['MM_UserId'];
}
mysql_select_db($database_MyConnect, $MyConnect);
$query_Recordset1 = sprintf("SELECT b.post_pic, b.post_desc, b.post_location, b.post_tel, b.post_date,b.post_status,u.user_username,b.post_id,ud.* FROM post b,user u, user_detail ud WHERE b.user_id=u.user_id AND u.user_id=ud.user_id AND b.user_id Like %s ORDER BY b.post_id DESC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
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
    <link rel="stylesheet" type="text/css" media="screen" href="profile.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <table class="table" cellpadding="0" cellspacing="0"  align="center">
        <tr>
            <td>
                <table  align="center" cellpadding="0" cellspacing="0" class="tableIn">
                    <tr>
                        <td width="50%">
                                <img class="circle" src="img/u1.jpg" width="100" height="100" align="right">  
                        </td>
                        <td align="left" id="detail">
                                    ชื่อ : <?php echo $row_Recordset1['user_fname']." ".$row_Recordset1['user_lname']; ?><br>
                                    อีเมล์ : <?php echo $row_Recordset1['user_email']; ?><br>
                                    เบอร์โทร : <?php echo $row_Recordset1['user_tel']; ?><br>
                                    เพศ : <?php if($row_Recordset1['user_gender']=="male"){echo "ชาย";}else{echo "หญิง";}; ?><br>
                        </td>
                    </tr>
                   
                        <td colspan="2" align="center">&nbsp;
                                <div class="btn-group">
                                        <button class="bt bt1">แก้ไข</button><br>
                                        <button class="bt2 bt1" onclick="window.location='feed.php'">ยกเลิก</button>
                                  <p>&nbsp;</p>
                          </div>
                        </td>
                    </tr>
                </table>
              

          </td>
        </tr>
    </table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

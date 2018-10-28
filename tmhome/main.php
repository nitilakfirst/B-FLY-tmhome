<?php require_once('Connections/MyConnect.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['uName'])||isset($_GET['uName'])) {
  if(isset($_POST['uName'])){
  $loginUsername=$_POST['uName'];
  $password=$_POST['pWord'];
  }
  else{
  $loginUsername=$_GET['uName'];
  $password=$_GET['pWord'];
  }
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "feed.php";
  $MM_redirectLoginFailed = "main.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyConnect, $MyConnect);
  
  $LoginRS__query=sprintf("SELECT user_username, user_password FROM `user` WHERE user_username=%s AND user_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyConnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	mysql_select_db($database_MyConnect, $MyConnect);
	$sqlid = mysql_query("SELECT user_id FROM user WHERE user_username='".$loginUsername."' AND user_password='".$password."'");
	$rsid = mysql_fetch_array($sqlid)  or die(mysql_error());
	$_SESSION['MM_UserId']=$rsid[0];     

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Take Me Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" class="table">
        <tr>
            <td align="center">
                <img src="img/logo.png" width="250" height="250"><br><br> 
                <div class="btn-group">
                    <button id="myBtn" class="bt bt1">เข้าสู่ระบบ</button><br>
                    <button  class="bt2 bt1" onclick="window.location='register.php'">สมัครสมาชิก</button><br>
                    
                    <!-- login -->
                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Sign in</h2>
                            </div>
                            <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
                            <div class="modal-body">
                            <!-- bodyModal -->
                            <img src="img/user.png" width="150" height="150"><br>
                            <p class="input-container">
                                <i class="fa fa-user-circle icon"></i>
                                
                                <input type="text" name="uName" id="uName"   placeholder="Username " required autocomplete="off"/>
                            </p>
                            <p class="input-container">
                                <i class="fa fa-key icon"></i>
                                <input type="password" name="pWord" id="pWord"   placeholder="Password " required autocomplete="off"/>
                            </p>
                            </div>
                            <div class="modal-footer">
                            <!-- footerModal -->
                            <button type="submit" class="btLogin">LOGIN</button><br>
                            </div>
                            </form>
                        </div>

                    </div>
                    <script>
                    // Get the modal
                    var modal = document.getElementById('myModal');

                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks the button, open the modal 
                    btn.onclick = function() {
                        modal.style.display = "block";
                    }

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                    </script>
                </div>
            </td>
        </tr>
        
    </table>
</body>
</html>
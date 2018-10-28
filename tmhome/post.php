<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Take Me Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="post.css" />
</head>
<body>
    <table class="table" cellpadding="0" cellspacing="0"  align="center">
        <tr>
            <td>
              <h1>โพสต์เรื่องราวของคุณ</h1><br>
              <form name="form1"method="post" action="insertPost.php" enctype="multipart/form-data">
              	<h3>เลือกรูปภาพ : </h3>		
                <input type="file" name="pic" accept="image/*" >
                <h3>รายละเอียด : </h3>
                <p>
                    <textarea  cols="40" rows="5"  name="detail" autocomplete="off"></textarea>
                </p>
                <h3>สถานที่ : </h3>
                <p>
                    <input name="location" type="text" id="loca" maxlength="100" autocomplete="off">
                </p>
                <h3>เบอร์โทร : </h3>
                <p>
                    <input name="tel" type="tel"autocomplete="off" id="tel" maxlength="10" >
                </p>
                </p>
                <div class="btn-group">
                    <button type="submit" name="submit"class="bt bt1">โพสต์</button><br>
                    
                </div>
             </form>
             <button class="bt2 bt1" onClick="window.location='feed.php'">ยกเลิก</button>
           </td>
       	</tr>
    </table>
</body>
</html>
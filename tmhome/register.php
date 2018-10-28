<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Take Me Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" class="table" id="regis">
        <tr>
            <td align="center" >
            			<form name="form1" method="post" action="insertUser.php">
                        <h1>สมัครสมาชิก</h1>
                        <p class="input-container2">
                            <i class="fa fa-user-circle icon"></i>
                            <input type="text" name="uName" id="uName"   placeholder="ชื่อผู้ใช้ " required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-key icon"></i>
                            <input type="password" name="pWord" id="pWord"   placeholder="รหัสผ่าน " required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-user icon"></i>
                            <input type="text" name="fName" id="fName"   placeholder="ชื่อ " required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-user icon"></i>
                            <input type="text" name="lName" id="lName"   placeholder="นามสกุล " required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-envelope icon"></i>
                            <input type="text" name="email" id="email"   placeholder="อีเมลล์" required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-phone-square icon"></i>
                            <input type="tel" name="tel" id="tel"  placeholder="เบอร์โทรศัพท์ " maxlength="10" required autocomplete="off"/>
                        </p>
                        <p class="input-container2">
                            <i class="fa fa-venus-mars icon"></i>
                            <select name="gender">
                                    <option value="male">ชาย</option>
                                    <option value="female">หญิง</option>
                            </select>
                        </p>
                        <div class="btn-group">
                                <button type="submit" class="btRE bt1RE">ยืนยัน</button><br>
                                <button class="bt2RE bt1RE" onclick="window.location='main.php'">ยกเลิก</button>
                        </div>
                        </form>
            </td>
        </tr>
        
    </table>
</body>
</html>
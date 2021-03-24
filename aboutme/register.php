<!DOCTYPE html>
<html lang="zh">

<head>
    <?php require_once("headfile.php"); ?>
</head>

<body style="padding-top: 60px;">
<script src="gotop.js"></script>
    <section id="mainmenu">
    <?php require_once("navbor.php"); ?>
    </section>
    <hr>
    <section id="content">
        <!-- 新的內容 -->
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>會員註冊頁面</h1>
                    <p>請輸入相關資料，*為必填欄位</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-2 text-left">
                    <form action="register.php" id="reg" name="reg" method="post">
                        <div class="row form-group"><input type="email" class="form-control" id="email" name="email" placeholder="*請輸入email帳號"></div>

                        <div class="row form-group"><input type="password" class="form-control" id="pw1" name="pw1" placeholder="*請輸入密碼"></div><br>

                        <div class="row form-group"><input type="password" class="form-control" id="pw2" name="pw2" placeholder="*請再次確認密碼"></div><br>

                        <div class="row form-group"><input type="text" class="form-control" id="cname" name="cname" placeholder="*請輸入姓名"></div><br>

                        <div class="row form-group"><input type="text" class="form-control" id="tssn" name="tssn" placeholder="*請輸入身份證字號"></div><br>

                        <div class="row form-group"><input type="text" class="form-control" id="birthday" name="birthday" readonly onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" placeholder="*請選擇生日"></div><br>

                        <div class="row form-group"><input type="text" class="form-control" id="mobile" name="mobile" placeholder="*請輸入手機號碼"></div><br>

                        <div class="row form-group"><select name="myCity" id="myCity" class="form-control">
                            <option value="">請選擇市區</option><?php $city="SELECT FROM `city` where State=0";$city_rs=mysqli_query($link,$city);while($city_rows=mysqli_fetch_array($city_rs)){ ?>



                            <?php } ?>
                        </select></div><br>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.php"); ?>
    <?php require_once("jsfile.php"); ?>
    
    
    
</body>

</html>
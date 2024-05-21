
<div class="login">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm" style="position:relative;">
            <?php
if(isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])){
    $action = 'verifycode';
}elseif(isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])){
    $action = 'changepassword';
}else{
    $action= 'forgotpassword';
}
            ?>
            <form method="post" action="assets/php/actions.php?<?=$action?>" >
            <h1 style="text-align: center;">NETlink</h1>
            <h1 class="h5 mb-3 fw-bold" style="text-align: center;">ئایە تێپەرەوشەکەت لە یاد کردووە؟</h1>
                <div class="d-flex justify-content-center">
                <img src="images/undraw_forgot_password_re_hxwm.svg" style="width:100%; opacity:0.8; margin-top:20px; padding-bottom:20px;" alt="">
                </div>
                
<?php
if($action=='forgotpassword'){
    ?>
  <div class="form-floating" >
                    <input type="email" name="email" class="form-control rounded-6 " placeholder="username/email">
                    <label for="floatingInput"> <span class="bi bi-envelope"></span> ئیمەیڵ </label>
                </div>
                <?=showError('email')?>
<br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:32%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF;">ناردنی کۆدی سەلماندن</button>

    <?php
}
?>
   
   
   <?php
if($action=='verifycode'){
    ?>
<p style="text-align:right;">ئەو شەش ژمارەی ناردرا بۆتۆ داخلی بکە  - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control rounded-6" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword"></label>
                </div>
                <?=showError('email_verify')?>

                <br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:30%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF; ">سەلماندنی کۆدەکە</button>

    <?php
}
?>


<?php
if($action=='changepassword'){
    ?>
<p style="text-align:right;">تێپەرەوشەی نوێ داخل بکە  - <?=$_SESSION['forgot_email']?></p>
<div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-6" id="floatingPassword" placeholder="Password">
                    <!---<style>
.form-control:focus {
  outline: 2px solid #8467D7;
  box-shadow: none;
}
</style>---->
                    <label for="floatingPassword" style="text-align:right;">تێپەرەوشەی نوێ</label>
                </div> 
                <?=showError('password')?>

                <br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:30%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF;">گۆرینی تێپەرەوشە</button>


    <?php
}
?>

                 
            
                <br>
                <br>

                <a href="?login" class="text-decoration-none mt-5" style="color: #8467D7;"><i class="bi bi-arrow-left-circle-fill"></i>چوونەژوورەوە</a>
            </form>
        </div>
    </div>


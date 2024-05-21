<?php
global $user;
/*echo '<pre>';
 echo print_r($_SERVER);
 echo '</pre>';*/
?>

   
<div class="login">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white p-4 login_form" style="position:relative;">
            <?php
if(isset($_SESSION['forgot_code'])){
    $action = 'verifyphone';
}else{
    $action= 'stepver';
}
            ?>
            <form method="post" action="assets/php/actions.php?<?=$action?>">
            <h1 style="text-align: center;">NETlink</h1>
                       
                
                <?php
if($action=='stepver'){
    $phone_number = $user['phone'];
    $phone = substr_replace($phone_number, '*** *** ** ', 0, -2);
    ?>
          <div class="d-flex justify-content-center">
                <video class="video col-9" loop muted autoplay>
  <source src="images/EPS_3.mp4" type="video/mp4">
</video>
                </div> 
     <h1 class="h4 mb-3" style="text-align: center;"> - <?=$user['first_name']?> <?=$user['last_name']?> سڵاو  - </h1>
                <h1 class="h6 mb-3 fw-normal" style="text-align: right;"> زانیاریەکانی تۆمان نە ناسیەوە! ژمارە مۆبایلی خۆت لە خوارەوە داخڵ بکە تا بتوانین پەیوەندیت پێوە بکەین 
                <br>
                <div class="mt-3 d-flex justify-content-center align-items-center" dir="rtl"> 
                <span dir="ltr"><b> +964 <?=$phone?> </b></span>
             </div>
            </h1>
                
                <div class="form-floating mt-1">

                    <input type="text" name="phone" class="form-control" id="floatingPassword"  placeholder="Password" 
style="  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;">
                    <label for="floatingPassword"  style="text-align: center;"></label>
                </div>
                <?php
if(isset($_GET['resended'])){
    ?>
<p class="text-success"  style="text-align: right;">کۆدی سەلماندنەکە دووبارە نێردرایەوە</p>

<?php
}
                ?>
                <?=showError('phone')?>

                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit" style=" background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border: #6C63FF; font-weight:400; padding: 15px; border-radius:15px;">سەلماندنی ژمارە مۆبایل</button>
                </div>
                <br>
 <div class="mt-0 d-flex justify-content-between align-items-center">
                <a href="assets/php/actions.php?logout" class="text-decoration-none" style="color: #66a6ff;"><i class="bi bi-arrow-left-circle-fill"></i>
                    چوونەدەرەوە</a>
                     </div>
                <?php
}
?>
                
            
   
   <?php
if($action=='verifyphone'){
    $phone_number = $_SESSION['forgot_phone'];
$phone = substr($phone_number, 0);
    ?>
    <div class="d-flex justify-content-center">
        <img src="images/2fa.svg" style="width:65%; height: 65%; margin-bottom:20px;" alt="">
</div>
<h1 class="h5 mb-3 fw-normal" style="text-align: center;"> ئەو شەش ژمارەی ناردرا بۆ ژمارەمۆبایلی  <div class="mt-1 mb-1" dir="ltr"><b> +964 <?=$phone?> </b></div> لە خوارەوە داخڵی بکە </h1>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control rounded-6" id="floatingPassword" placeholder="Password" style="  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;">
                    <label for="floatingPassword"></label>
                </div>
                <?=showError('code')?>

                <br>
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit" style=" background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border: #6C63FF; font-weight:400; padding: 15px; border-radius:15px;">سەلماندنی کۆدەکە </button>
                </div>
                <div class="mt-0 d-flex justify-content-between align-items-center">
                <a href="assets/php/actions.php?logout" class="text-decoration-none" style="color: #66a6ff;"><i class="bi bi-arrow-left-circle-fill"></i>
                    چوونەدەرەوە</a>
                  
                     <a href="assets/php/actions.php?resend_code_phone" class="text-decoration-none" type="submit" style=" color: #66a6ff;">ناردنەوەی کۆد</a>
                     </div>

    <?php
}
?>
<br>

            </form>
        </div>
    </div>

<style>
    .button-blue:hover{
  border-color:#008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}
        .input-form {
  position: relative;
margin-top: 7%;

}
.login_form{
    border: 2px solid #c3c6ce; 
    border-radius:15px;
}
.login_form:hover {
 border-color:#008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}

.login_form:hover{

 border-color: #008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);

}
</style>
<?php
global $user;
?>
    <div class="login">
        <div class="col-md-4 col-sm-11 bg-white p-4 login_form">
            <form method="post" action="assets/php/actions.php?verify_email">
            <h1 style="text-align: center;">NETlink</h1>
                <div class="d-flex justify-content-center">
                <img src="images/undraw_message_sent_re_q2kl.svg" style="width:50%; height: 50%; margin-top:20px; padding-bottom:20px;" alt="">
                </div>
                <h1 class="h5 mb-3 fw-normal" style="text-align: center;"> تکایە بسەلمێنە کە ئەم ژمارەیە هیتۆیە </h1>
                <h1 class="h5 mb-3" style="text-align: center;"> - +964 <?=$user['phone']?> - </h1>


                <p  style="text-align: right;">ئێمە نامەیەکمان بۆت ناردوە کە لە شەش ژمارە پيێکدێ تکایە لە خوارەوە داخلی بکە</p>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control" id="floatingPassword"  placeholder="Password">
                    <label for="floatingPassword"  style="text-align: center;"></label>
                </div>
                <?php
if(isset($_GET['resendedd'])){
    ?>
<p class="text-success"  style="text-align: right;">کۆدی سەلماندنەکە دووبارە نێردرایەوە</p>

<?php
}
                ?>
                <?=showError('email_verify')?>

                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit" style=" background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border: #6C63FF; font-weight:400; padding: 15px; border-radius:15px;">سەلماندنی ژمارەتەلەفۆن</button>
                </div>
                <br>
                <div class="mt-0 d-flex justify-content-between align-items-center">
                <a href="assets/php/actions.php?logout" class="text-decoration-none" style="color: #66a6ff;"><i class="bi bi-arrow-left-circle-fill"></i>
                    چوونەدەرەوە</a>
                  
                     <a href="assets/php/actions.php?resend_code_phone" class="text-decoration-none" type="submit" style=" color: #66a6ff;">ناردنەوەی کۆد</a>
                     </div>
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
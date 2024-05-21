
<?php
global $user;
?>

<body>
    <div class="login">
        <div class="col-md-4 col-sm-12 bg-white p-4 login_form">
            <form>
                <div class="d-flex justify-content-center">
<h2>NETlink Team</h2><br>
                    
                </div>
                <div class="col-md-12 col-sm-12 d-flex " style="margin-left:18%; position:relative;">
                <img class="mb-4" src="assets/images/stop-blocked-icon.svg" alt="" style="height:60px; position:absolute; top:-15%;" >
                <h1 class="h3 mb-3 fw-normal" style="margin-left:16%;"> تۆ هەڵپەسێندراوی  </h1>
                </div>
                <img src="images/undraw_notify_re_65on.svg" style="width:100%; opacity:0.8; margin-top:20px;"  alt="">
                <div>
                <h1 class="h5 mb-3 fw-normal" style="text-align:right;"> <strong><br><?=$user['first_name']?> <?=$user['last_name']?> سڵاو</strong></h1>
                <h1 class="h5 mb-3 fw-normal" style="text-align:right;"> <strong> .ئەکاونتەکەت لەلایەن بەرێوبەرەوە هەڵپەسێردراوە بەهۆی پابەند نەبوونت بە مەرجەکانمان <strong></h1>
                <h6  style="text-align:right;"> بۆ زانیاری زیاتر دەربارەی مەرجەکانی بەکارهێنان سەردانی ئەم بەشە بکە</h6>
                <a  style="color:#66a6ff; cursor:pointer;" href="?terms"><h6>Terms & Conditions</h6></a>
                <div class="mt-3 d-flex justify-content-between align-items-center" dir="rtl">
                    <a href="assets/php/actions.php?logout" class="btn btn-danger" type="submit" >چوونەدەرەوە</a>
                    <a href="?contact" class="btn btn-warning"><img class="img-fluid" src="images/customer-care-icon.svg" style="width:25px; height:25px; padding-left:2%;" ></a>
                </div>
                </div>
            </form>
        </div>
    </div>
<style>.login_form{
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

}</style>
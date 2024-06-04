<?php
 global $user;
 global $posts;
 global $follow_suggestions;
 global $comments;
 /*echo '<pre>';
 echo print_r($_SESSION['userdata']['password']);
 echo '</pre>';*/
 ?>
    <div class="container col-md-9 col-sm-12 rounded-0 d-flex justify-content-between bg-light" dir="rtl">
        <div class="col-12 bg-light border rounded p-4 mt-4 shadow-sm">
        <a href="?contact" class="" style="position: absolute; "><button style="border:1px solid gray; border-radius:10px; background-color:white;"><img class="img-fluid" src="images/customer-care-icon.svg" style="width:25px; height:25px; padding-left:2%;" ></button></a>
            <form method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data" id="update_profile_form">
                <div class="d-flex justify-content-center">
                  
                </div>
                <h1 class="h3 mb-3 fw-normal text-dark" style="text-align:center;">رێکخستنی پرۆفایل <img src="images/layer-icon.svg" style="height:27px; width:27px;" alt=""> </h1>
                <?=showError('old_password')?>
                <?=showError('password')?>
                <?php
if(isset($_GET['success'])){
    ?>
<p class="text-success" style="text-align:center;">پرۆفایلەکەت رێکخرا!</p>

<?php
}
                ?>
                 <h1 class="h5 mb-3 fw-normal text-dark" style="text-align:center;"> گۆرینی وێنەی پرۆفایل و وێنەی دواوە </h1>
                <div class="form-floating mt-1 col-md-6 col-sm-12" id="img_view">
                <header id="header_bg" style='width: 100%;
  background: url("assets/images/bg/<?=$user['bg_pic']?>") no-repeat 50% 20% / cover;
  min-height: calc(100px + 10vw);
  border-radius:10px;
  position:relative;'>
                    <img src="assets/images/profile/<?=$user['profile_pic']?>" id="profile_img_view" class="img-thumbnail my-3" alt="...">
                    <span class="something"></span>
                    </header> 
                    
                    <style>
                        .img-thumbnail{
                            height:150px;
                            width:150px;
                            object-fit: cover;
                            border-radius:50%;
                            position: absolute; 
                            top:50%; 
                            left:45%;
                            
                        }
             
                       
                        span .something{
                            width: 60px;
                            height: 40px;
                            background-color: white;
                            z-index: 10;
                        }
                        
                        #img_view{
                              
                                width:100%;
                                position: relative;

                            }
                        @media screen and (max-width: 994px) {
                            .img-thumbnail{
                                height:100px;
                                width:100px;
                                border-radius:50%; 
                                object-fit: cover;
                                position: absolute;
                                top:50%;
                                left:35%;
                            }
                            
                            #img_view{
                                height:50%;

                            }
                        }
                    </style>
                    <div class="mb-3" style="padding-top: 50px;">
                        <input class="form-control " type="file" name="profile_pic" id="formFile" >
                        <label for="formFile" class="formFile" type="file"><div class="camera_fix"><span id="boot-icon-e" class="bi bi-camera-fill"></span></div></label>
                        
                        <input class="form-control" type="file" name="bg_pic" id="bgform" >
                        <label for="bgform"><div class="fix_camera"><span id="boot-iconn" class="bi bi-camera-fill"></span></div></label>
<script>
  const imageInput = document.getElementById("formFile");
const previewImage = document.getElementById("profile_img_view");

imageInput.addEventListener("change", function() {
  const file = this.files[0];
  const reader = new FileReader();

  reader.addEventListener("load", function() {
    previewImage.setAttribute("src", this.result);
  });

  reader.readAsDataURL(file);
});

const bgInput = document.getElementById("bgform");
const header = document.getElementById("header_bg");

bgInput.addEventListener("change", function() {
  const file = this.files[0];
  const reader = new FileReader();

  reader.addEventListener("load", function() {
    header.style.backgroundImage = `url('${this.result}')`;
  });

  reader.readAsDataURL(file);
});

</script>
                        <style>
                            #formFile{
  width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;
}

#bgform{
  width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;
}
.camera_fix{
background-color: #f3f7fe;
width: 50px;
height: 50px;
  transition: .3s;
  top:80%;
  left:56%;
  border-radius: 50%;
  cursor: pointer;
  position: absolute;
  transform: translate(-50%, -50%);
  border: 1px solid #3b82f6;
}
.fix_camera:hover{
background-color: #3b82f6;
box-shadow: 0 0 0 5px #3b83f65f;
}
#boot-iconn{
    font-family: monospace;
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 35px;
cursor: pointer;
border-radius: 50%;
-webkit-text-stroke-width: 10px rgb(255, 255, 255);

}
#boot-iconn:hover{
    color: #fff;
}
.fix_camera{
    background-color: #f3f7fe;
    width: 50px;
    height: 50px;
  transition: .3s;
 
  top:8%;
  right:-2%;  
  border-radius: 50%;
  cursor: pointer;
  position: absolute;
  transform: translate(-50%, -50%);
}

#boot-icon-e{
font-family: monospace;
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 35px;
cursor: pointer;
border-radius: 50%;
-webkit-text-stroke-width: 10px rgb(255, 255, 255);

                        }
.camera_fix:hover{
background-color: #3b82f6;
box-shadow: 0 0 0 5px #3b83f65f;
  
                        }
#boot-icon-e:hover{
color: #fff;
}

@media screen and (max-width: 994px) {
                        
.fix_camera{
background-color: #f3f7fe;
width: 40px;
height: 40px;
right:-7%; 
border-radius: 50%;
border: none;
position: absolute;
top:7%;
  left:0%;
}
#boot-iconn{
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 28px;
border-radius: 50%;
}
.camera_fix{
background-color: #f3f7fe;
width: 40px;
height: 40px;
border-radius: 50%;
}
#boot-icon-e{
font-family: monospace;
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 28px;
cursor: pointer;
border-radius: 50%;

}
}
              
                        
                        </style>
                    </div>
                    <button class="btn btn-primary changebtn" type="submit">   <span>گۆڕین</span> </button>
                    <style>
                        .changebtn {
                          background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
position: absolute;
top:80%;                      
  padding: 1px 17px;
  display: flex;
  align-items: center;
  font-size: 13px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  border: none;
  border-radius: 25px;
  outline: none;
  overflow: hidden;
  color: white;
  transition: color 0.3s 0.1s ease-out;
  text-align: center;
}

.changebtn span {
  margin: 10px;
}

.changebtn::before {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  content: '';
  border-radius: 50%;
  display: block;
  width: 20em;
  height: 20em;
  left: -5em;
  text-align: center;
  transition: box-shadow 0.5s ease-out;
  z-index: -1;
}

.changebtn:hover {
  color: #fff;
  border: 1px solid rgb(40, 144, 241);
}

.changebtn:hover::before {
  box-shadow: inset 0 0 0 10em rgb(40, 144, 241);
}
 
                    </style>
                </div>
                <?=showError('profile_pic')?>
                <?=showError('bg_pic')?>

                <div class="d-flex">
                  
                    <div class="form-floating mt-1 col-6">
                        <input type="text" name="last_name" value="<?=$user['last_name']?>" class="form-control bg-light text-dark" placeholder="username/email" dir="ltr">
                        <label for="floatingInput" class="text-dark">ناوی دووەم</label>
                    </div>
                    
                    <div class="form-floating mt-1 col-6 ">
                        <input type="text" name="first_name" value="<?=$user['first_name']?>" class="form-control bg-light text-dark" placeholder="username/email" dir="ltr">
                        <label for="floatingInput" class="text-dark">ناوی یەکەم</label>
                    </div>
                    
                </div>
                <?=showError('first_name')?>
                <?=showError('last_name')?>
                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                            value="option1" <?=$user['gender']==1?'checked':''?> disabled>
                        <label class="form-check-label text-dark" for="exampleRadios1">
                           نێر
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                            value="option2" <?=$user['gender']==2?'checked':''?> disabled>
                        <label class="form-check-label text-dark" for="exampleRadios3">
                            مێ
                        </label>
                    </div>
                </div>
                <div>
<!-- Rounded switch -->
    </div>
      <span class="text-dark">قوفڵدانی ئەکاونت</span>
        <?php if($user['islocked']== 1){
          ?>
        <label for='t2' class="switch">
            <input id='t2' class='' onclick="" name="locked" value="1" type='checkbox' checked>
          <span class="slider round"></span>
        </label>
      <?php }
        else{
          ?>
          
        <label for='t2' class="switch"><input id='t2' class='' name="locked" value="1" onclick="" type='checkbox' unchecked>
          <span class="slider round"></span></label>
        <?php
        }?>
                <div class="form-floating mt-1">
                    <input type="email" value="<?=$user['email']?>" class="form-control bg-light text-dark" placeholder="email" disabled dir="ltr">
                    <label for="floatingInput" class="text-dark">ئیمەیڵ</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="text"  value="<?=$user['username']?>" name="username" class="form-control bg-light text-dark" placeholder="username/email" dir="ltr">
                    <label for="floatingInput" class="text-dark">ناوی بەکارهێنەر</label>
                </div>
                <?=showError('username')?>
                <h6 class="pt-2" style="color: rgb(128, 128, 128);"> دەربارەی من <img src="images/how-to-icon.svg" style="height:25px; width:25px; opacity:0.7;" alt=""> </span></h6>
                <div class="form-floating mt-1 pt-1">
                    <input type="text"  value="<?=$user['bio']?>" name="bio" class="form-control bg-light text-dark" placeholder="bio" dir="ltr">
                    <label for="floatingInput" class="text-dark"> دەربارەی من </label>
                </div>
                <div class="form-floating mt-1 pt-1">
                    <input type="text"  value="<?=$user['work']?>" name="work" class="form-control bg-light text-dark" placeholder="bio" dir="ltr">
                    <label for="floatingInput" class="text-dark"> پیشە </label>
                </div>
<div class="d-flex justify-content-center align-items-center">
<label class="pt-2 selector" for="city">
  <select id="city" class="" name="city" dir="ltr">
    <?php if(!empty($user['city'])){ ?>
       <option value="<?=$user['city']?>" disabled selected> <?=$user['city']?> </option> 
      <?php }else{ ?>
    <option value="<?=$user['city']?>" dir="rtl" disabled selected> شوێنی نیشتەجێبوون</option>
    <?php } ?>
    <option value="کوردستان، هەولێر">کوردستان، هەولێر </option>
    <option value="کوردستان، سلێمانی"> کوردستان، سلێمانی  </option>
    <option value="کوردستان، دهۆک"> کوردستان، دهۆک </option>
    <option value="کوردستان، کەرکووک">کوردستان، کەرکووک </option>
    <option value="کوردستان، زاخۆ"> کوردستان، زاخۆ </option>
    <option value="کوردستان، هەڵەبجە"> کوردستان، هەڵەبجە </option>
    <option value="کوردستان، شەقڵاوە"> کوردستان، شەقڵاوە </option>
    <option value="کوردستان، شەقڵاوە"> کوردستان، مەسیف </option>
    <option value="کوردستان، هەریر"> کوردستان، هەریر </option>
    <option value="کوردستان، کۆیە"> کوردستان، کۆیە </option>
    <option value="کوردستان، سۆران"> کوردستان، سۆران </option>
    <option value="کوردستان، خەبات"> کوردستان، خەبات </option>
    <option value="کوردستان، رواندز"> کوردستان، رواندز </option>
    <option value="کوردستان، چەمچەماڵ"> کوردستان، چەمچەماڵ </option>
    <option value="کوردستان، چوارقوڕنە"> کوردستان، چوارقوڕنە </option>
    <option value="کوردستان، دووکان"> کوردستان، دووکان </option>
    <option value="کوردستان، ڕانیە"> کوردستان، ڕانیە </option>
  </select>
  <svg>
    <use xlink:href="#select-arrow-down"></use>
  </svg>
</label>
<!-- SVG Sprites -->
<svg class="sprites">
  <symbol id="select-arrow-down" viewBox="0 0 10 6">
    <polyline points="1 1 5 5 9 1"></polyline>
  </symbol>
</svg>

</div>      
                <div class="form-floating mt-1 pt-1">
                    <input type="text"  value="<?=$user['work_place']?>" name="work_place" class="form-control bg-light text-dark" placeholder="bio" dir="ltr">
                    <label for="floatingInput" class="text-dark"> قوتابی لە </label>
                </div>
                <div class=" d-flex pt-2 justify-content-center" >
                <label for="dateofbirth" class="text-dark"> رۆژی لە دایک بوونت
                <input type="date" class="dob" value="<?=$user['DoB']?>" name="dateofbirth" id="dateofbirth" >
                </label>
                <style>
                  input[type="date"] {
  background:#fff
   url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
}
[type="date"]::-webkit-inner-spin-button {
  display: none;
}
[type="date"]::-webkit-calendar-picker-indicator {
  opacity: 0;
}

.dob {
  border: 1px solid #c4c4c4;
  border-radius: 5px;
  background-color: #fff;
  padding: 3px 5px;
  box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
  width: 190px;
}
                </style>
                </div>
                <h6 style="color: rgb(128, 128, 128);">گۆڕینی تێپەرەووشە <span id="boot-icon" class="bi bi-key-fill" style="font-size: 25px; color: rgb(128, 128, 128); position:relative; top:4px;"></span></h6>
                <div class="form-floating mt-1" style="padding-bottom:25px; position:relative;"  >
                    <input type="password" name="old_password" class="form-control" id="floatingPassword" placeholder="Password" dir="ltr">
                    <span id='boot-icon' class='bi bi-eye-fill a' style='font-size: 20px; cursor:pointer; position:absolute; top:13px; right:9px;'></span>
                    <label for="floatingPassword" >تێپەرە ووشەی کۆن</label>
                </div>
                <div class="form-floating mt-1" style="position: relative;" >
                    <input type="password"  name="password" class="form-control" id="password" placeholder="Password" dir="ltr">
                    <span id='boot-icon' class='bi bi-eye-fill b' style='font-size: 20px; cursor:pointer; position:absolute; top:13px; right:9px;'></span>
                    <label for="password">تێپەرە ووشەی تازە</label>
                </div>
                <div class="form-floating mt-1" style="position:relative;" >
                    <input type="password" name="re_password" class="form-control" id="passwordd" placeholder="Password" dir="ltr">
                    <span id='boot-icon' class='bi bi-eye-fill c' style='font-size: 20px; cursor:pointer; position:absolute; top:13px; right:9px;'></span>
                    <label for="passwordd">پشتراستکردنەوەی تێپەرەووشە</label>
                </div>
                <h6 class="pt-2" style="color: rgb(128, 128, 128);"> ئاسایشی ئەکاونت <img src="images/privacy.svg" style="height:25px; width:25px; opacity:0.7;" alt=""> </span> </h6>
                <div style="border: solid 1.9px #9e9e9e;
  border-radius: .6rem;
  background: none;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
  padding:6px;">
                <?php if ($user['twoStep'] == 0) { ?>
                <div class="d-flex align-items-center justify-content-center" style="width: 100%">
                <a class="" href="assets/php/actions.php?twostepverification" 
                 style="font-size: 17px;
                        font-weight: 400;
                        text-decoration: none;
                        cursor: pointer;
                        border: none;
                        outline: none;
                        overflow: hidden;
                        color: black;
                        border-radius:10px;
                        transition: color 0.3s 0.1s ease-out;
                        text-align: center;
                        width:100%;
                      "> پشتراستکردنەوەی دوو هەنگاوی </a>
                </div>
                <?php }elseif($user['twoStep'] == 1){ ?>
                  <div class="d-flex align-items-center justify-content-center" style="width: 100%">
                <a class="" href="?twostepverification" 
                 style="
                        font-size: 17px;
                        font-weight: 400;
                        text-decoration: none;
                        cursor: pointer;
                        border: none;
                        outline: none;
                        overflow: hidden;
                        color: black;
                        border-radius:10px;
                        transition: color 0.3s 0.1s ease-out;
                        text-align: center;
                        width:100%;
                        "> پشتراستکردنەوەی دوو هەنگاوی </a>
                </div>
                  <?php }?>
                  </div>
                <div class="mt-3 d-flex align-items-center">
                  
                    <div class=" d-flex justify-content-center align-items-center" >
                    <button class="btn btn-sm btn-primary blocked-list" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);   font-size: 17px;
  font-weight: 400;
  text-decoration: none;
  cursor: pointer;
  border: none;
  outline: none;
  overflow: hidden;
  color: white;
  border-radius:10px;
  transition: color 0.3s 0.1s ease-out;
  text-align: center;" type="submit">نوێکردنەوەی پرۆفایل</button>
                    
                    

                <a class="btn btn-sm btn-danger blocked-list" data-bs-toggle="modal" data-bs-target="#blocked_list" style=" background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
  font-size: 17px;
  margin-right:6px;
font-weight: 400;
text-decoration: none;
cursor: pointer;
border: none;
outline: none;
overflow: hidden;
color: white;
border-radius:10px;
transition: color 0.3s 0.1s ease-out;
text-align: center;">لیستی هەڵپەساردنەکان</a>
                
                
                <a class="btn btn-sm btn-danger blocked-list" data-bs-toggle="modal" data-bs-target="#myModal" style=" background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
  font-size: 17px;
  margin-right:6px;
font-weight: 400;
text-decoration: none;
cursor: pointer;
border: none;
outline: none;
overflow: hidden;
color: white;
border-radius:10px;
transition: color 0.3s 0.1s ease-out;
text-align: center;">سرینەوەی ئەکاونت</a>
               
              
    </div>

                </div>
             
                </div>
            </form>

            <div class="modal fade" id="blocked_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" dir="ltr">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">لیستی هەڵپەسێردراوەکان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
<div class="d-flex justify-content-between">
    <ul class="d-block">
<?php
$blocked = getBlockedUser();
$user_id = $_SESSION['userdata']['id'];
 if(isBlocked($user_id)<1){
  echo '<p style="width:100%;" class="p-2 bg-white text-center my-3 col-12">  <span class="d-block w-100">  هیچ کەسێکت سڕ نەکردووە بۆ سڕکردنی بەکارهێنەر ئەتوانی لە پرۆفایلەکانیان ئەم ... دابگری و سڕکردن هەلبژێری</span> <img src="images/undraw_no_data_re_kwbl.svg" style="width:50%; opacity:1; margin:20px; " alt=""> </p>';
}

         if(count($blocked) >0){
          foreach($blocked as $buser){
                $rowbtn = '<button class="btn btn-sm btn-danger unblockbtn" data-user-id='.$buser['blocked_user_id'].' ><span id="boot-icon "><span class="bi bi-trash" style="font-size: 16px; color: rgb(255, 255, 255);"></span></button>';
            
                if(checkBS($buser['blocked_user_id']) && $buser['user_id'] == $user_id ){
                
            ?>
            
                <li id="<?=$buser['id']?>">
                <div class="d-flex justify-content-between" style="display:list-item;">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$buser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$buser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$buser['first_name']?> <?=$buser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$buser['username']?></p>
                        </div>
                     
                    </div>
                    <div class="btn-1" style="position:relative; display:flex;">
                      <?=$rowbtn?>

                    </div>
                </div>
                
                </li>
            <?php
              }
            }
        }
               ?>
               
               </ul>
                </div>
            </div>
        </div>
  </div>
</div>
    </div>
   
<style>
 .unblockbtn{
    position:absolute;
     left:260px;
      top:8px;
 }
 @media screen and (max-width: 994px) {
    .unblockbtn{
    position:absolute;
     left:100%;
      top:8px;
 }
 .blocked-list{
  font-weight: 300;
  font-size: 13px;
 }
 }
 .selector {
  position: relative;
  min-width: 200px;
  align-items: left;
}

.selector svg {
  position: absolute;
  right: 12px;
  top: calc(50% - 3px);
  width: 10px;
  height: 6px;
  stroke-width: 2px;
  stroke: #9098A9;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
  pointer-events: none;
}

.selector select {
  -webkit-appearance: none;
  padding: 7px 40px 7px 12px;
  width: 100%;
  border: 1px solid #E8EAED;
  border-radius: 5px;
  background: white;
  box-shadow: 0 1px 3px -2px #9098A9;
  cursor: pointer;
  font-family: inherit;
  font-size: 16px;
  transition: all 150ms ease;
}

.selector select option {
  color: #223254;
  text-align: right;
}

.selector select option[value=""][disabled] {
  display: none;
}

.selector select:focus {
  outline: none;
  border-color: #0077FF;
  box-shadow: 0 0 0 2px rgba(0, 119, 255, 0.2);
}

.selector select:hover + svg {
  stroke: #0077FF;
}

.sprites {
  position: absolute;
  width: 0%;
  height: 0%;
  pointer-events: none;
  user-select: none;
}


</style>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" dir="rtl">
  <div class="modal-content">
            <div class="modal-body" dir="rtl">
            <div class="card_deactivate">
  <div class="header_deactivate">
    <div class="image_deactivate"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
              </svg></div>
    <div class="content_deactivate">
       <span class="title_deactivate">سڕینەوەی ئەکاونت</span>
       <p class="message_deactivate"><?=$user['first_name']?>  
       دڵنیای کە ئەتەوێ ئەکاونتەکەت بسڕیتەوە؟ هەموو داتا و زانیاریەکت لە تۆڕەکەمان رەش ئەکرێتەوە بەتەواوی. ئەم کردارەش گەڕانەوەی نیە.
      </p>
    </div>
     <div class="actions_deactivate">
     <form method="post" action="assets/php/actions.php?deleteuser=<?=$user['id'];?>" enctype="multipart/form-data" onsubmit="return submitForm(this);">
<div style="margin-bottom:15px;">
<div class="form-floating mt-1" style="position:relative;" dir="ltr">
                    <input type="password" name="del_acc" class="form-control" style="border: solid 1.9px #9e9e9e;
  border-radius: 0.4rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;"  id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">تێپەرەوشە</label>
                </div>
</div>

                    <button class="btn btn-primary desactivate_deactivate" name="next" type="submit">بەردەوام بوون</button>
                    <button type="button" class="cancel_deactivate" data-bs-dismiss="modal" >داخستن</button>

                </form>
    </div>
  </div>
  </div>
            </div>
        </div>
  </div>
</div>

<style>
    ul {
list-style-type: none;
margin: 0;
padding: 0;
display: flex;
align-items: center;
}
li {
display: block;
}
.card_deactivate {
  overflow: hidden;
  position: relative;
  background-color: #ffffff;
  text-align: right;
}

.header_deactivate {
  padding: 1.25rem 1rem 1rem 1rem;
  background-color: #ffffff;
}

.image_deactivate {
  display: flex;
  margin-left: auto;
  margin-right: auto;
  background-color: #FEE2E2;
  flex-shrink: 0;
  justify-content: center;
  align-items: center;
  width: 3rem;
  height: 3rem;
  border-radius: 9999px;
}

.image_deactivate svg {
  color: #DC2626;
  width: 1.5rem;
  height: 1.5rem;
}

.content_deactivate {
  margin-top: 0.75rem;
  text-align: center;
}

.title_deactivate {
  color: #111827;
  font-size: 1rem;
  font-weight: 600;
  line-height: 1.5rem;
}

.message_deactivate {
  margin-top: 0.5rem;
  color: #6B7280;
  font-size: 1rem;
  line-height: 1.25rem;
}

.actions_deactivate {
  margin: 0.75rem 1rem;
}

.desactivate_deactivate {
  display: inline-flex;
  padding: 0.5rem 1rem;
  background:linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
  color: #ffffff;
  font-size: 1rem;
  line-height: 1.5rem;
  font-weight: 500;
  justify-content: center;
  width: 100%;
  border-radius: 0.375rem;
  border-width: 1px;
  border-color: transparent;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.cancel_deactivate {
  display: inline-flex;
  margin-top: 0.75rem;
  padding: 0.5rem 1rem;
  background:#ffffff;
  color: #000;
  font-size: 1rem;
  line-height: 1.5rem;
  font-weight: 500;
  justify-content: center;
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid #D1D5DB;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.form-control{
  border: solid 1.9px #9e9e9e;
  border-radius: .6rem;
  background: none;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
}
</style>
<script>
    // select the eye icon and password input elements
const eyeIcon = document.querySelector('.b');
const passwordInput = document.querySelector('#password');

// add a click event listener to the eye icon
eyeIcon.addEventListener('click', function() {
  // toggle the input type between "password" and "text"
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.classList.remove('bi-eye-fill');
    eyeIcon.classList.add('bi-eye-slash-fill');
  } else {
    passwordInput.type = 'password';
    eyeIcon.classList.remove('bi-eye-slash-fill');
    eyeIcon.classList.add('bi-eye-fill');
  }
});

const eyeIcona = document.querySelector('.c');
const passwordInputa = document.querySelector('#passwordd');

// add a click event listener to the eye icon
eyeIcona.addEventListener('click', function() {
  // toggle the input type between "password" and "text"
  if (passwordInputa.type === 'password') {
    passwordInputa.type = 'text';
    eyeIcona.classList.remove('bi-eye-fill');
    eyeIcona.classList.add('bi-eye-slash-fill');
  } else {
    passwordInputa.type = 'password';
    eyeIcona.classList.remove('bi-eye-slash-fill');
    eyeIcona.classList.add('bi-eye-fill');
  }
});

const eyeIconb = document.querySelector('.a');
const passwordInputb = document.querySelector('#floatingPassword');

// add a click event listener to the eye icon
eyeIconb.addEventListener('click', function() {
  // toggle the input type between "password" and "text"
  if (passwordInputb.type === 'password') {
    passwordInputb.type = 'text';
    eyeIconb.classList.remove('bi-eye-fill');
    eyeIconb.classList.add('bi-eye-slash-fill');
  } else {
    passwordInputb.type = 'password';
    eyeIconb.classList.remove('bi-eye-slash-fill');
    eyeIconb.classList.add('bi-eye-fill');
  }
});
/*$('#update_profile_form').on('submit', function(event) {
        event.preventDefault(); // prevent default form submission and page refresh
        alert('profile updated');
});*/
let img = document.getElementById("profile_img_view");
let input = document.getElementById("formFile");

input.onchange = (e) => {
  if (input.files[0]) img.src = URL.createObjectURL(input.files[0]);
};

    </script>
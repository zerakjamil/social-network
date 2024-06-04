<?php
global $profile;
global $profile_post;
global $reels_post;
global $user;
global $time;
?>

<div class="header__wrapper"  dir="rtl">
<?php if(!checkBlockStatus($profile['id'],$user['id'])){ ?>
    <header style='width: 100%;
  background: url("assets/images/bg/d-cover.jpg") no-repeat 50% 20% / cover;
  min-height: calc(100px + 15vw);'></header>
            <?php }else{ ?> 
   <header style='width: 100%;
  background: url("assets/images/bg/<?=$profile['bg_pic']?>") no-repeat 50% 20% / cover;
  min-height: calc(100px + 15vw);'></header>
            <span></span>
                <?php } ?>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <?php if(!checkBlockStatus($profile['id'],$user['id'])){ ?>
                <img src="assets/images/profile/default_profile.jpg" alt="default_profile">          
            <!--<span></span>--->
            <?php }else{ ?> 
<img src="assets/images/profile/<?=$profile['profile_pic']?>" alt="<?=$profile['profile_pic']?>">

                <?php } ?>
          </div>
          <h2> <?php 
                           
                           if($profile['verify'] == "1") {
                                 echo '<img src="assets/images/blue_badge.png" style="border-radius:50%; height:20px; width:21; margin-left:-2px; margin-top:-4px;">';
                                 } elseif($profile['verify'] == "2"){
                                   echo '<img src="images/id_3.png" style=" height:22px; width:21; margin-left:-2px; margin-top:-4px;" alt="Super Admin">';
                                 } ?> <?=$profile['first_name']?> <?=$profile['last_name']?></h2>
          <p><?=$profile['username']?>@</p>
          <p><?=$profile['bio']?></p>
          <?php
if($user['id']!=$profile['id']){
    if(!checkBlockStatus($profile['id'],$user['id'])){
    ?>
  <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(<?=$profile['id']?>)"><i class="bi bi-chat-fill"></i> ناردنی نامە</a></li>
                                <li><a class="dropdown-item " href="assets/php/actions.php?block=<?=$profile['id']?>&username=<?=$profile['username']?>"><i class="bi bi-x-circle-fill"></i> سڕکردن</a></li>
                            </ul>
                        </div>
    <?php
}elseif(!checkBlockStatus($profile['id'],$user['id'])){ ?>
  <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item " href="assets/php/actions.php?block=<?=$profile['id']?>&username=<?=$profile['username']?>"><i class="bi bi-x-circle-fill"></i> هەڵپەساردن</a></li>
                            </ul>
                        </div>
<?php }}
                        ?>
          <ul class="about" style="width:100%;">
          <?php
          if($user['id'] == $profile['id']){
?>
  <li><span><?=count($profile_post)?></span>پۆستەکان</li>
            <a class="<?count($profile['followers'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#follower_list"><li><span><?=count($profile['followers'])?></span>شوێنکەوتوەکان</li></a>

  <a class="<?=count($profile['following'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#following_list" ><li><span><?=count($profile['following'])?></span>شوێنکەوتوی</li></a>
        
            <?php
          } 
elseif($profile['islocked'] != 1 ){
    if(checkBlockStatus($profile['id'],$user['id'])){
    ?>
     <li><span><?=count($profile_post)?></span>پۆستەکان</li>
            <a class="<?count($profile['followers'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#follower_list"><li><span><?=count($profile['followers'])?></span>شوێنکەوتوەکان</li></a>

  <a class="<?=count($profile['following'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#following_list" ><li><span><?=count($profile['following'])?></span>شوێنکەوتوی</li></a>
  <?php 
  }} elseif($profile['islocked'] == 1 ){
    if(checkBlockStatus($profile['id'],$user['id'])){
        if(!checkFollowStatus($profile['id'])){
?>
     <li><span><?=count($profile_post)?></span>پۆستەکان</li>
            <a class="<?count($profile['followers'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#follower_list"><li><span><?=count($profile['followers'])?></span>شوێنکەوتوەکان</li></a>

  <a class="<?=count($profile['following'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#following_list"><li><span><?=count($profile['following'])?></span>شوێنکەوتوی</li></a>
<?php } } }?>
                    </ul>
                    <div class="content" style="text-align:right;" >
                    <?php if ($profile['work']) { ?>
            <p>
            <img src="images/businessman-with-briefcase-icon.svg" style="height:29px; width:29px;" alt=""> پیشە : <?= $profile['work'] ?> 
            </p>
                    <?php } ?>
                    <?php if ($profile['city']) { ?>
            <p>
            <img src="images/address-location-icon.svg" style="height:27px; width:27px;" alt=""> شوێنی نیشتەجێبوون : <?= $profile['city'] ?> 
            </p>
            <?php } ?>
            <?php if ($profile['work_place']) { ?>
                <p>
            <img src="images/student-boy-icon.svg" style="height:27px; width:27px;" alt=""> قوتابی لە : <?=$profile['work_place']?>
            </p>
            <?php } ?>
            <?php if ($profile['DoB']) { ?>
            <p>
            <img src="images/birth-date-icon.svg" style="height:27px; width:27px;" alt=""> لە دایکبووی : <?=$profile['DoB']?>
            </p>
            <?php } ?>
            
            <p>
            <img src="images/three-stars-icon.svg" style="height:27px; width:27px;" alt="">  بەشداربوو لەوەتەی : <?=$time->getTimeWithoutHours($profile['created_at']);?>
            </p>
          </div>
        </div>
        
        <div class="right__col">
          <nav>
            <ul>
              <li style="cursor:pointer;"><a onclick="openPhotos()"><img src="images/pictures-icon.svg" style="height:31px; width:31px;" alt=""></a></li>
              <li style="cursor:pointer;"><a onclick="openVideos()"><img src="images/videos-icon.svg" style="height:30px; width:30px;" alt=""></a></li>
              <!--- <li><a href="">about</a></li>--->
            </ul>
                        <?php
                        if($user['id']!=$profile['id']){
?>
 <div class="d-flex gap-2 align-items-center my-1">
<?php
if(!checkBlockStatus($user['id'],$profile['id'])){
?> 
<button class="unblockbtn" style="background:#D30000;" data-user-id='<?=$profile['id']?>' ><i class="bi bi-x-octagon-fill"></i> لابردنی هەڵپەساردن</button>
<?php
}else if(!checkBlockStatus($profile['id'],$user['id'])){ ?>
    <div class="alert alert-danger" role="alert">
    <i class="bi bi-x-octagon-fill"></i> لە لایەن ئەم بەکارهێنەرە هەڵپەساردراوی</div>
   <?php } 
   elseif(!checkStatus($profile['id'])){
    ?>
    <button class=" cancelbtn" style="background:#D30000;" data-user-id='<?=$profile['id']?>' ><span id="boot-icon" class="bi bi-person-dash-fill" style="font-size: 18px; color: rgb(255, 255, 255); position:relative; top:1px;"></span> پاشگەزبوونەوە</button>
    <?php
   }
   else if(!checkFollowStatus($profile['id'])){
   ?>
<button class="unfollowbtn" style="background:#D30000;" data-user-id='<?=$profile['id']?>' ><span id="boot-icon" class="bi bi-x" style="font-size: 18px; color: rgb(255, 255, 255); position:relative; top:1px; -webkit-text-stroke-width: 1px;"></span> لابردن</button>
   
   <?php
}elseif(checkLCK($profile['id']) && !checkFollowStatus($profile['id'])){
?>
<button class=" reqbtn"  data-user-id='<?=$profile['id']?>' ><span id="boot-icon" class="bi bi-person-plus-fill" style="font-size: 18px; color: rgb(255, 255, 255); position:relative; top:1px;"></span> ناردنی داواکاری</button>
<?php
}else{
    ?>
   
<button class="followbtn" data-user-id='<?=$profile['id']?>' ><span id="boot-icon" class="bi bi-plus-lg" style="font-size: 18px; color: rgb(255, 255, 255); position:relative; top:1px; -webkit-text-stroke-width: 1px;"></span> شوێنکەوتن</button>
    
    <?php
}}
?>
          </nav>
          <style>
            .header__wrapper .cols__container .left__col .img__container img {
width: 130px;
height: 130px;
object-fit: cover;
border-radius: 50%;
display: block;
box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
border:#cccccc solid 4px;
}
          </style>
          <?php
if(!checkBlockStatus($profile['id'],$user['id'])){
    $profile_post = array();
   ?>
 <div class="alert alert-secondary text-center" role="alert">
    <i class="bi bi-x-octagon-fill"></i> ناتوانی پۆستەکانی ئەم بەکارهێنەرە ببینی
</div>
   <?php
    }elseif(!checkLCK($profile['id']) && checkFollowStatus($profile['id'])){
        $profile_post = array();
        $reels_post = array();
    echo '<div class="alert alert-secondary text-center" role="alert">
     '.$profile['first_name'].' '.$profile['last_name'].' ئەکاونتەکەی قفڵ کردووە
     <span id="boot-icon" class="bi bi-shield-lock-fill" style="font-size: 22px; color: rgb(128, 128, 128);  position:relative; top:1px;"></span>
    </div>';

}else if(count($profile_post)<1 && $_SESSION['userdata']['id']!=$profile['id']){
    echo "<p class='p-2 bg-white border rounded text-center my-3'>ئەم بەکارهێنەرە هیچی پۆست نەکردوە</p>";
}elseif(count($profile_post)<1 && $_SESSION['userdata']['id']=$profile['id']){
  echo "<p class='p-2 bg-white border rounded text-center my-3'> هیچ پۆستێکت نەکردووە</p>";
}
        ?>


<div class="videoss" id="videos_section">
            <?php
foreach($profile_post as $post){
    $likes = getLikes($post['id']);
    if(!checkBlockStatus($profile['id'],$user['id'])){
    ?>
        <?php 
                   $img_path = $post['post_img'];
                   $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                      if(in_array($extension_img,array("mp4","avi","mov","MP4"))){
                       ?>
                       <video src="assets/images/posts/<?=$post['post_img']?>" controls loading=lazy data-bs-toggle="modal" data-bs-target="#postvieww<?=$post['id']?>" class="photos" style="width: auto;
                       max-height:90vh;" alt="..."></video>
                       <?php
                   }
               
                }
           ?>
            <div class="modal fade" id="postvieww<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-md-flex p-0">
                    <div class="col-md-8 col-sm-12" style="position:relative;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; z-index: 99;"></button>
                    <?php 
                   $img_path = $post['post_img'];
                   $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                   if(in_array($extension_img,array("mp4","avi","mov","MP4","MOV"))){
                       ?>
                       <video src="assets/images/posts/<?=$post['post_img']?>" controls loading=lazy class="" style="width: auto;
                       max-height:90vh" alt="..."></video>
                       <?php
                   }
               
           
           ?>
                    </div>



                    <div class="col-md-4 col-sm-12 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 <?=$post['post_text']?'':'border-bottom'?>">
                            <div><img src="assets/images/profile/<?=$profile['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start">
                                <h6 style="margin: 0px;"><?=$profile['first_name']?> <?=$profile['last_name']?></h6>
                                <p style="margin:0px;" class="text-muted">@<?=$profile['username']?></p>
                            </div>

                            <div class="d-flex flex-column align-items-end flex-fill">
                <div class="" ></div>
                <div class="dropdown">
  <span class="<?=count($likes)<1?'disabled':''?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  بەدڵبوون <?=count($likes)?>  
</span>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php
  foreach($likes as $like){
      $lu = getUser($like['user_id']);
      ?>
  <li><a class="dropdown-item" href="?u=<?=$lu['username']?>"><?=$lu['first_name'].' '.$lu['last_name']?> (@<?=$lu['username']?>)</a></li>

      <?php
  }
  ?> 
    
  </ul>
</div>
                <div style="font-size:small" class="text-muted"> <?=$time->show_time($post['created_at'])?> </div>
                 
</div>
                        </div>
<div class="border-bottom p-2 <?=$post['post_text']?'':'d-none'?>"><?=$post['post_text']?> </div>


                        <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

                          <?php
$comments = getComments($post['id']);
if(count($comments)<1){
    ?>
<p class="p-3 text-center my-2 nce"> هیچ سەرنجێک نەدراوە <br> ببە بە یەکەم کەس و سەرنجێک بدە <br> <img src="assets/images/smartphone-10.png" style="height: 85px; width:85px; position:relative; top:30px; left: 45%;" alt=""></p>
    <?php
}
foreach($comments as $comment){
    $cuser = getUser($comment['user_id']);
    ?>
<div class="d-flex align-items-center p-2">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?></h6>
                                    <p style="margin:0px;" class="text-muted"><?=$time->show_time($comment['created_at'])?></p>
                                </div>
                            </div>

    <?php
}
                          ?>
 </div>
                        <?php
                        if($post['coLock'] == 0 && (checkFollowStatus($profile['id']) || $profile['id']==$user['id'])  ){
                            ?>
 <div class="input-group p-2 border-top">
                        <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="<?=$_SESSION['userdata']['first_name']?> شتێ بڵێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2" >
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">پۆست</button>
                        </div>
                        <?php } elseif(($post['coLock'] == 1)){
                            ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
                            <?php
                        }else{
                            ?>
<div class="text-center p-2">
بۆ سەرنجدان پێویستە شوێن نوسەرەکە بکەوی</div>
                        
                            <?php
                        }
                        ?>
                      
                    </div>



                </div>

            </div>
        </div>
    </div>
    <?php
}
            ?>

          </div>







<style>
    .header__wrapper .cols__container .right__col .videoss {
display: grid;
grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
gap: 20px;
display: none;
}
.header__wrapper .cols__container .right__col .videoss img {
max-width: 100%;
display: block;
height: 100%;
object-fit: cover;
}
.header__wrapper .cols__container .right__col nav ul li:nth-child(2) a {
  color: #818181;
  }
.header__wrapper .cols__container .right__col nav ul li:nth-child(2) a {
  color: #818181;
  }
  

</style>

        <div class="photos" id="photos" style="display:grid;">
        
            <?php
           
foreach($profile_post as $post){
    $likes = getLikes($post['id']);
    if(!checkBlockStatus($profile['id'],$user['id'])){
    ?>
        <?php 
                   $img_path = $post['post_img'];
                   $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                   if(in_array($extension_img,array("jpg","jpeg","png"))){
                       ?>
                       <img src="assets/images/posts/<?=$post['post_img']?>" loading=lazy data-bs-toggle="modal" data-bs-target="#postview<?=$post['id']?>" style="width: 250px;
max-width: 100%;
display: block;
height: 250px;

object-fit: cover;" alt="...">
                       <?php
                   }
               
                }
           ?>
            <div class="modal fade" id="postview<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-md-flex p-0">
                    <div class="col-md-8 col-sm-12" style="position: relative;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute;"></button>
                    <?php 
                   $img_path = $post['post_img'];
                   $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                   if(in_array($extension_img,array("jpg","jpeg","png"))){
                       ?>
                       <img src="assets/images/posts/<?=$post['post_img']?>" style="max-height:90vh" class="w-100 overflow:hidden">
                       <?php
                   }
               
           
           ?>
                    </div>



                    <div class="col-md-4 col-sm-12 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 <?=$post['post_text']?'':'border-bottom'?>">
                            <div><img src="assets/images/profile/<?=$profile['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start">
                                <h6 style="margin: 0px;"><?=$profile['first_name']?> <?=$profile['last_name']?></h6>
                                <p style="margin:0px;" class="text-muted">@<?=$profile['username']?></p>
                            </div>

                            <div class="d-flex flex-column align-items-end flex-fill">
                <div class="" ></div>
                <div class="dropdown">
  <span class="<?=count($likes)<1?'disabled':''?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  بەدڵبوون <?=count($likes)?>  
</span>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php
  foreach($likes as $like){
      $lu = getUser($like['user_id']);
      ?>
  <li><a class="dropdown-item" href="?u=<?=$lu['username']?>"><?=$lu['first_name'].' '.$lu['last_name']?> (@<?=$lu['username']?>)</a></li>

      <?php
  }
  ?> 
    
  </ul>
</div>
                <div style="font-size:small" class="text-muted"> <?=$time->show_time($post['created_at'])?> </div>
                 
</div>
                        </div>
<div class="border-bottom p-2 <?=$post['post_text']?'':'d-none'?>"> <?php
if ($post['post_text']) {
    ?>
    <div class="card-body">
    <?php
    $text = strip_tags($post['post_text']);
 
    if (strlen($text) > 60) {
        $short_text = substr($text, 0, 60) . '...<a href="?postview='.$post['id'].'">زیاتر ببینە</a>';
        echo $short_text;
    }
    else {
        ?>
        <p style=" position: relative; top: -13px; white-space: pre-line;"><?=$post['post_text']?></p>
        <?php
    }
    ?>
    </div>
    <?php
}
?> </div>


                        <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

                          <?php
$comments = getComments($post['id']);
if(count($comments)<1){
    ?>
<p class="p-3 text-center my-2 nce"> هیچ سەرنجێک نەدراوە <br> ببە بە یەکەم کەس و سەرنجێک بدە <br> <img src="assets/images/smartphone-10.png" style="height: 85px; width:85px; position:relative; top:30px; left: 45%;" alt=""></p>
    <?php
}
foreach($comments as $comment){
    $cuser = getUser($comment['user_id']);
    ?>
<div class="d-flex align-items-center p-2">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?></h6>
                                    <p style="margin:0px;" class="text-muted"><?=$time->show_time($comment['created_at'])?></p>
                                </div>
                            </div>

    <?php
}
                          ?>
 </div>
                        <?php
                        if($post['coLock'] == 0 && (checkFollowStatus($profile['id']) || $profile['id']==$user['id'])  ){
                            ?>
 <div class="input-group p-2 border-top">
                        <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="<?=$_SESSION['userdata']['first_name']?> شتێ بڵێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2" >
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">پۆست</button>
                        </div>
                        <?php } elseif(($post['coLock'] == 1)){
                            ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
                            <?php
                        }else{
                            ?>
<div class="text-center p-2">
بۆ سەرنجدان پێویستە شوێن نوسەرەکە بکەوی</div>
                        
                            <?php
                        }
                        ?>
                      
                    </div>



                </div>

            </div>
        </div>
    </div>
    <?php
}
            ?>

          </div>
        </div>
      </div>
    </div>
 <!-- this is for follower list -->
 <div class="modal fade" id="follower_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">شوێنکەوتوەکان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
foreach($profile['followers'] as $f){
    $fuser = getUser($f['follower_id']);
    $fbtn='';
    if(!checkFollowStatus($f['follower_id'])){
        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" style="background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);" data-user-id='.$fuser['id'].' >لابردن</button>';
    }else if($user['id']==$f['follower_id']){
        $fbtn='';
    }else{
        $fbtn = '<button class="btn btn-sm btn-primary followbtn" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);" data-user-id='.$fuser['id'].' >+ شوێنکەوتن</button>';

    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$fuser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$fuser['first_name']?> <?=$fuser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$fuser['username']?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <?=$fbtn?>

                    </div>
                </div>
    <?php
}
                ?>
            </div>
   
        </div>
  </div>
</div>



<!-- this is for following list -->
<div class="modal fade"  id="following_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">شوێنیکەوتوی</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
foreach($profile['following'] as $f){
    $fuser = getUser($f['user_id']);
    $fbtn='';
    if(!checkFollowStatus($f['user_id'])){
        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" style="background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);" data-user-id='.$fuser['id'].' >لابردن</button>';
    }else if($user['id']==$f['user_id']){
        $fbtn='';
    }else{
        $fbtn = '<button class="btn btn-sm btn-primary followbtn" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);" data-user-id='.$fuser['id'].' >+ شوێنکەوتن</button>';

    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$fuser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$fuser['first_name']?> <?=$fuser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$fuser['username']?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <?=$fbtn?>

                    </div>
                </div>
    <?php
}
                ?>
            </div>
   
        </div>
  </div>
</div>
<script>
    let videos_section = document.getElementById('videos_section');
    let photos = document.getElementById('photos');
    function openVideos(){
        videos_section.style.display = "grid";
        photos.style.display = "none";
let secondChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(2)');
secondChild.style.color = '#1d1d1d';
secondChild.style.fontWeight = '600';

  let firstChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(1) a');
  firstChild.style.color = '#818181';
  let thirdChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(3) a');
  thirdChild.style.color = '#818181';
    }

    function openPhotos(){
        videos_section.style.display = "none";
        photos.style.display = "grid";
        var secondChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(2)');
secondChild.style.color = '#818181';

let thirdChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(3) a');
  thirdChild.style.color = '#818181';

  var firstChild = document.querySelector('.header__wrapper .cols__container .right__col nav ul li:nth-child(1) a');
  firstChild.style.color = '#1d1d1d '; 
   firstChild.style.fontWeight = '600';
    }
 </script>
<style>
   
</style>
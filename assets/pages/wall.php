<?php
 global $user, $time;
 global $posts;
 $profile_post = getPostById($user['id']);
 $profile['followers']=getFollowers($user['id']);
 $profile['following']=getFollowing($user['id']);
 $profile;
 global $stories; 
 global $follow_suggestions;
 global $request;
 global $comments;
 deleteOldStories();
 /*echo '<pre>';
 echo print_r($_SERVER);
 echo '</pre>';*/
 ?>
    <div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between bg-white" >
        <div class="col-md-8 col-sm-12" style="max-width:93vw">
        <section class="main card mt-4">
        <div class="container">
  <div class="middle">
<div class="stories">

  <div class="story" data-bs-toggle="modal" data-bs-target="#addstory">

  <div class="profile">
  <img src="assets/images/profile/<?=$user['profile_pic']?>" class="pfp">
  </div>
  <p class="name">چیڕۆکی تۆ</p>
  </div>
  <?php
  foreach($stories as $story){
            $user_id = $story['user_id'];
            $user_stories[$user_id][] = $story;
            if(getUnreadstories($story['id']) == true){       
    ?>
  <div class="story" data-bs-toggle="modal" data-bs-target="#storyview<?=$story['id']?>" id="story_not" data-user-id="<?=$story['id']?>" style="background:url('assets/images/stories/<?=$story['story_img']?>') no-repeat center center/cover;">
  <div class="profile">
    <img src="assets/images/profile/<?=$story['profile_pic']?>" class="pfp">
  </div>
  <p class="name"><?=$story['first_name'];?> <?=$story['last_name'];?></p>
  </div>

  <?php }else{?>
    <div class="story" data-bs-toggle="modal" data-bs-target="#storyview<?=$story['id']?>" id="story_not" data-user-id="<?=$story['id']?>" style="background:url('assets/images/stories/<?=$story['story_img']?>') no-repeat center center/cover;">
  <div class="profile">
    <img src="assets/images/profile/<?=$story['profile_pic']?>" class="pfp">
  </div>
  <p class="name"><?=$story['first_name'];?> <?=$story['last_name'];?></p>
  </div>
    <?php } ?>
    
  <div class="modal fade" id="storyview<?=$story['id']?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered p-0 bg-dark" style="position:relative;">
        
            <div class="modal-content" >
                <div class="modal-body d-flex p-0 bg-dark">
                <div class="d-flex align-items-center p-2" style="position:absolute; z-index:2; ">
                        <div><img src="assets/images/profile/<?=$story['profile_pic']?>" alt="" style="width: 60px;
height: 60px;
object-fit: cover;
border-radius: 50%;
border: 3px solid white;">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$story['username']?>' class="text-decoration-none text-white"><h6 style="margin: 0px;font-size:16px;"><?=$story['first_name']?> <?=$story['last_name']?></h6></a>
                            <p class="text-white fw-normal text-small"><?=$time->getTimeWithoutYear($story['created_at'])?></p>
                        </div>
                    </div>
                    
                   
                    <div style="background:url('assets/images/stories/<?=$story['story_img']?>') no-repeat center center/cover;   padding:1rem;
                    height:730px;
  border-radius: 0;
  color:#fff;
  font-size: 0.75rem;
  width: 100%;
  position: relative;
  overflow: hidden;"></div>
                  
 
           
                        
                    </div>



                </div>

            </div>
        </div>
    <?php
 } ?>


</div>
</div>
</div>
 </section>
 <style>

.profile{
  width: 2.7rem;
  aspect-ratio: 1/1;
  border-radius:50%;
  overflow: hidden;
}
.text-muted{
color: gray;
}

.middle .stories{
  display: flex;
  justify-content: space-between;
  height:13rem;
  gap: 0.5rem;
}

.middle .stories .story{
  padding:1rem;
  border-radius:1rem;
  display: flex;
  flex-direction:column;
  justify-content: space-between;
  align-items: center;
  color:#fff;
  font-size: 0.75rem;
  width: 100%;
  position: relative;
  overflow: hidden;
}

.middle .stories .story::before{
content:"";
display: block;
width: 100%;
height:5rem;
position: absolute;
bottom:0;
background:linear-gradient(transparent,rgba(0,0,0,0.75));
}
.middle .stories .story .name{
  z-index: 2;
}
.middle .stories .story:nth-child(1){
  background:url('images/plus.png') no-repeat center center/cover;
}

.middle .story .profile {
  width: 2.6rem;
  height: 2.6rem;
  align-self: start;
  border: 2px solid #66a6ff;
}

.create-post{
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: white;
  border-radius: 1.5rem;
  border: 1px solid #66a6ff;
  padding: 0.4rem 0.4rem 0.4rem;
  margin-top: 1rem;
}
     .create-post textarea{
  justify-self: start;
  width: 70%;
  background: transparent;
  color: hsl(252, 30%, 17%);
  border: none !important;
  overflow: hidden;
}
.create-post textarea:focus {
  outline: none;
}
.btn-body{
  background:transparent;
  color:black;
  width: 20%;
  border-radius: 2rem;
  padding-top:1.5rem;
  padding-bottom:1.5rem;
}
.btn-body:hover{
  color:white;
  background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  border:none;
  
}
.profile img{
  width: 65px;
  max-width: 100%;
  height: 65px;
  max-height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: solid 2px white;
}

</style>
 <section> 
 <form class="create-post" method="post" action="assets/php/actions.php?addposttext" enctype="multipart/form-data" dir="rtl">
<div class="profile">
  <img src="assets/images/profile/<?=$user['profile_pic']?>" class="pfp">
  </div>
  <textarea placeholder=" چیت لە مێشکە <?=$user['first_name']?> ؟" id="create-post-text" name="post_box" rows="1"></textarea>

<input type="submit" value="پۆستبکە" class="btn btn-body" name="post">

</form>

 </section>

            <?php
           
            showError('post_img');
            showError('post_vid');
            showError('post_box');
            if(count($posts)<1){
                echo "<p style='width:100%' class='p-2 bg-white border rounded text-center my-3 col-12'>  <span> شوێن هاورێکانت بکەوە یان پۆستێک زیاد بکە بە گرتەکردن لەم ئایکۆنە </span> <br>  <a class='nav-link text-dark' data-bs-toggle='modal' data-bs-target='#addpost' href='#' stylr='font-size:5rem;'><i class='bi bi-plus-square-fill'></i></a> </p>";
                echo '<img src="assets/images/posts.svg" style="width:100%; opacity:0.8; margin-top:20px;" alt="">';
            }

            
            $i = 0;
foreach($posts as $post){
    $likes = getLikes($post['id']);
    $comments = getComments($post['id']);
    $i++;
    ?>
     <div class="card mt-4" style="
              margin-top: 15px;
              border-radius: 15px;
              box-shadow:  0px 5px 7px -7px rgba(0, 0, 0, 0.75);">
                <div class="card-title d-flex justify-content-between  align-items-center">

                    <div class="d-flex align-items-center p-2">
                        <img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" style="width: 60px;
height: 60px;
object-fit: cover;
border-radius: 50%;">&nbsp;&nbsp;<a href='?u=<?=$post['username']?>' class="text-decoration-none text-dark" style="font-size:20px;" >
                        <?=$post['first_name']?> <?=$post['last_name']?>
                        <?php 
                           if($post['verify'] == "1") {
                                 echo '<img src="assets/images/blue_badge.png" style="border-radius:50%; height:18px; width:18; margin-left:-2px; margin-top:-4px;">';
                                 } elseif($post['verify'] == "2"){
                                   echo '<img src="images/id_3.png" style="border-radius:50%; height:18px; width:18; margin-left:-2px; margin-top:-4px;">';
                                 } ?>
                        <br><div style="font-size:small" class="text-muted"> <?=show_time($post['created_at'])?> </div> </a>
                    </div><br>
                    
                    <div class="p-2">
                        <?php
if($post['uid']==$user['id']){
    ?>

  <div class="dropdown">

  <i class="bi bi-three-dots-vertical" id="option<?=$post['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

  <ul class="dropdown-menu" aria-labelledby="option<?=$post['id']?>" >
    <li style="cursor:pointer; text-align: right; display:flex; justify-content: space-between;"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_post<?=$post['id']?>"><i class="uil uil-image-edit"></i> دەستکاری کردنی پۆست</a></li>
    <li style="text-align: right;"><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?=$post['id']?>"> <i class="bi bi-trash-fill"></i> سرینەوەی پۆست</a></li>
  </ul>
</div>
    <?php
}else{?>
  <div class="dropdown">

<i class="bi bi-three-dots-vertical" id="option<?=$post['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

<ul class="dropdown-menu" aria-labelledby="option<?=$post['id']?>" >
  <li style="text-align: right;">
  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report_post<?=$post['id']?>"> 
  <img src="images/report-flag-icon.svg" style="height:20px; width:20px;" alt=""> سکاڵاکردن لە پۆست 
</a>
</li>
</ul>
</div>
<?php }?>
                        
                        <div class="modal fade" id="report_post<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
          <div class="modal-header" dir="rtl">
              <h5 class="modal-title align-self-center" style="position:relative; right:45%;"> سکاڵاکردن </h5>
          </div>
          <div class="modal-body" dir="rtl">
<div class="">
<img src="images/undraw_astronaut_re_8c33.svg" style="width:50%; height: 50%; margin-top:20px; padding-bottom:20px;" alt="">
          <form action="assets/php/actions.php?report=<?=$post['id']?>&userId=<?=$post['user_id']?>" method="POST">
          <div class="mb-12">
          <h2>بۆ ئەتەوێ سکاڵا بکەی؟</h2>
            <p>ئێمە لە تۆرەکەمان رێگە بە هەندێ پۆست نادەین بۆ پاراستنی بەکارهێنەرەکانمان تۆش گەر شتێکی نەشیاوت بینی سکاڵا بکە و هاوکار بە لەگەلمان </p>
          <div class="d-flex justify-content-center align-items-center">
            
<label class="pt-2 selector" for="reason">
<select id="reason" class="" name="reason" dir="ltr">
  <option value="" dir="" disabled selected> هۆکاری سکاڵا </option>
  <option value="رووتی">رووتی</option>
  <option value="هەراسان کردن "> هەراسان کردن </option>
  <option value="تووند و تیژی "> تووند و تیژی </option>
  <option value="تیرۆرستی "> تیرۆرستی </option>
  <option value="فێڵکردن "> فێڵکردن </option>
  <option value="بڵاوکردنەووەی تووندڕەوی "> بڵاوکردنەووەی تووندڕەوی </option>
  <option value="هەواڵی ساختە ">هەواڵی ساختە </option>
  <option value="شتی تر "> شتی تر </option>
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
<div class="class_28" >
          <label class="class_26"  >
            نامە:
          </label>
          <textarea placeholder="نامەکەت لێرە بنووسە" id="my-textarea" value="<?=showFormData('contact_message')?>" name="report_message" class="class_27" >
          </textarea>
        </div>
                  </div>
                  <div style="display:flex; justify-content:center; align-items:center;">
                  <button type="submit" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);   font-size: 17px;
font-weight: 400;
text-decoration: none;
cursor: pointer;
border: none;
outline: none;
overflow: hidden;
color: white;
border-radius:10px;
transition: color 0.3s 0.1s ease-out;
text-align: center;" class="btn btn-primary">ناردن</button>
           <button data-bs-dismiss="modal" aria-label="Close" type="button" style="
background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
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
text-align: center;" class="btn btn-primary">داخستن</button>
</div>
                  </form>
              </div>
          </div>
      </div>
</div>
</div>
<style>
.selector {
position: relative;
min-width: 200px;
}

.selector svg {
position: absolute;
right: 90%;
top: calc(50% - 1px);
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
text-align: right;
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
.class_26{

margin: .5rem;
margin-right:0px;
display: inline-block;
position: relative;
left: 87%;
top: 0;
}

.class_27{

display: block;
width: 100%;
padding: 15px;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: rgb(33, 37, 41);
background-color: white;
background-clip: padding-box;
border: 1px solid rgb(206, 212, 218);
appearance: none;
border-radius: 20px;
transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;

}

.class_28{

display: block;
margin-top: 4px;
margin-bottom: 4px;
padding: 4px;
align-items: center;
text-align: left;
font-size: 16px;

}
</style>


<div class="modal fade" id="edit_post<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">دەستکاری کردنی پۆست</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" dir="">
<div class="">
            <form action="assets/php/actions.php?editposttxt=<?=$post['id']?>" method="POST">
            <div class="mb-12">
                        <label for="exampleFormControlTextarea1" class="form-label">شتێک بڵێ</label>
                        <textarea name="new_post_text" class="form-control" id="exampleFormControlTextarea1">
                          <?=$post['post_text']?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">تەواو</button>
                    </form>
                </div>
            </div>
        </div>
  </div>
</div>
                    </div>
                </div>
                <?php
if (!empty($post['post_text']) && !empty($post['post_img'])) {
    ?>
    <div class="card-body">
    <?php
    $text = strip_tags($post['post_text']);
 
    if (strlen($text) > 110) {
        $short_text = substr($text, 0, 110) . '...<a href="?postview='.$post['id'].'">زیاتر ببینە</a>';
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
}?>

                <?php 
                        $img_path = $post['post_img'];
                        $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                        if(in_array($extension_img,array("jpg","jpeg","png","gif","bmp"))){
                            ?>
                            <img src="assets/images/posts/<?=$post['post_img']?>" loading="lazy" class="" style="position:relative; height:auto; width: auto; max-width:100%;" alt="...">
                            <?php
                        }elseif(in_array($extension_img,array("mp4","avi","mov","MP4","MOV"))){
                            ?>
                            <video src="assets/images/posts/<?=$post['post_img']?>" controls class="video" style="position:relative; height:auto; width: auto; max-width:100%;
                            " alt="..."></video>
                            <?php
                        }elseif(!empty($post['post_text']) && empty($post['post_img'])){
                          ?>
                          <div class="card-body">
  
        <h6 style=" position: relative; top: -13px; white-space: pre-line; "><?=$post['post_text']?></h6>
   
    </div>
                          <?php } ?>
                    
                
                <h4 style="font-size: x-larger" class="d-flex align-items-center justify-content-between " style="position:relative;">
                    <div class="p-2 d-flex align-items-center justify-content-start">
               <span>
               <?php
if(checkLikeStatus($post['id'])){
$like_btn_display='none';
$unlike_btn_display='';
}else{
    $like_btn_display='';
    $unlike_btn_display='none';  
}
    ?>
   
                <i class="bi bi-heart-fill unlike_btn text-danger" style="display:<?=$unlike_btn_display?>" data-post-id='<?=$post['id']?>'></i>
                <i class="bi bi-heart like_btn" style="display:<?=$like_btn_display?>" data-post-id='<?=$post['id']?>'></i>
         
                </span>
                <span class="p-1 mx-2 text-small" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#likes<?=$post['id']?>"> <span style="font-size:small; position:relative; top:-4px;" id="likecount<?=$post['id']?>"><?=count($likes)?></span> </span>
                &nbsp;&nbsp; <?php if(!empty($post['post_text']) && empty($post['post_img'])){ ?>
                  <i style="margin-bottom:10px;" class="p-0 text-small" > <span class="p-1 mx-2 text-small" style="font-size:small; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#postTextView<?=$post['id']?>">
                  <img src="images/instagram-comment-icon.svg" alt="" style="cursor:pointer;  height:25px;
    width:25px;
    
   ">  سەرنجەکان <?=count($comments)?></span></i>
                  <?php } else{ ?>
                  <span class="p-1 mx-2 text-small" style="font-size:small; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#postview<?=$post['id']?>"><img src="images/instagram-comment-icon.svg" alt="" style="cursor:pointer;  height:22px;
    width:22px;
    "> سەرنجەکان <?=count($comments)?></span>
                    </div>
                            <?php
                        }?>

                        <div class="d-flex justify-content-end align-items-center liked-by" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#likes<?=$post['id']?>" dir="rtl">
                      <?php  $liked = getLikesForProfile($post['id']);
                      $counter = 0;
                      foreach($liked as $liked_by){
                        if($counter > 2){
                          echo '';
                        }else{?>
      <div class="widget">
      <div class="avatar-list">
        <div
          class="avatar"
          style="background-image: url('assets/images/profile/<?=$liked_by['profile_pic'];?>')"
          data-content="<?=$liked_by['first_name'];?>"
        ></div>
      </div>
    </div>
    <?php }
    $counter++;
    }?>
    <?php
    if($counter > 3){
      ?>
            <button class="avatar plus">+<?=(count($liked) - 3)?></button>
            <?php }?>
    </div>
                </h4>


    <style>
 @keyframes rotate {
  100% {
    background-position: 0% 50%;
  }
}
.widget{
position:relative;
left:10%;
}
.avatar.plus {
  border: 0;
  position:relative;
left:10%;
}

.widget-value {
  font-size: 38px;
  line-height: 1;
}

.widget-label {
  display: block;
  color: rgba(255, 255, 255, 0.7);
  padding-bottom: 20px;
}

.avatar-list {
  display: flex;
}

.avatar {
  position: relative;
  z-index: 1;
  display: block;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-size: cover;
  cursor: pointer;
}

.avatar {
  margin-left: -10px;
}

.avatar:hover {
  z-index: 2;
}

.avatar::before {
  content: attr(data-content);
  position: absolute;
  bottom: 48px;
  left: 50%;
  translate: -50% 10px;
  opacity: 0;
  visibility: hidden;
  font-size: 13px;
  padding: 6px;
  border-radius: 3px;
  white-space: nowrap;
  background: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  border-radius: 10px;
  transition: 0.3s;
}

.avatar:not(.plus):hover::before {
  opacity: 1;
  visibility: visible;
  translate: -50% 0;
}

.avatar.plus {
  display: grid;
  place-items: center;
  background: #f9f9f9;
  color: #1a1a1a;
  font-size: 12px;
  font-weight: 500;
}
    </style>
<?php 
if($post['coLock']== 1){
    ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
    <?php 
} else {
?>
                
                <div class="input-group p-2 <?=$post['post_text']?'border-top':''?>">
                <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;">
                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="...شتێ بلێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">پۆستبکە</button>
                </div>
<?php } ?>
            </div>
           
            <div class="modal fade" id="postview<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-md-flex p-0">
                    <div class="col-md-8 col-sm-12">
                
                    <?php 
                        $img_path = $post['post_img'];
                        $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                        if(in_array($extension_img,array("jpg","jpeg","png","PNG","JPEG","BMP","gif","JPG"))){
                            ?>
                            <img src="assets/images/posts/<?=$post['post_img']?>" loading=lazy class="" style="width: 100%;" alt="...">
                            <?php
                        }elseif(in_array($extension_img,array("mp4","avi","mov","MP4","MOV"))){
                            ?>
                            <video src="assets/images/posts/<?=$post['post_img']?>" controls loading=lazy class="" style="width: 100%;
                            height:100%;" alt="..."></video>
                            <?php
                        }
                    
                
                ?>
                        
                    </div>



                    <div class="col-md-4 col-sm-12 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 border-bottom">
                            <div><img src="assets/images/profile/<?=$post['profile_pic']?>" alt=""style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start">
                                <h6 style="margin: 0px;"><?=$post['first_name']?> <?=$post['last_name']?> </h6>
                                <p style="margin:0px;" class="text-muted">@<?=$post['username']?></p>
                            </div>
                            <div class="d-flex flex-column align-items-end flex-fill">
                <div class="" ></div>
                <div class="dropdown">
  <span class="<?=count($likes)<1?'disabled':''?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span><?=count($likes)?> بەدڵبوون </span>
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
                <div style="font-size:small" class="text-muted"> <?=show_time($post['created_at'])?> </div> 
                 
</div>
                        </div>


                        <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

                          <?php
if(count($comments)<1){
    ?>
<p class="p-3 text-center my-2 nce"> هیچ سەرنجێک نەدراوە <br> ببە بە یەکەم کەس و سەرنجێک بدە <br> <img src="assets/images/smartphone-10.png" style="height: 85px; width:85px; position:relative; top:30px;" alt=""></p>

    <?php
}
?>



<div class="comment">
<?php 

foreach($comments as $comment){
    $cuser = getUser($comment['user_id']);
    ?>

<div class="d-flex align-items-center p-2" id="<?=$comment['id']?>">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start" id="comment" style="background:white; border-radius:6px;">
                                    <?php if($comment['user_id'] == $post['user_id']){?>
                                        
                                <span><img src="assets/images/author.png" height="20px" width="20px"alt="">نووسەر</span>
<?php } ?>
                                    <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark text-small text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?>
                                    
                                    <?php
                                        if($comment['user_id']==$user['id']){
                                     ?>

 
                            <i class="bi bi-three-dots-vertical" id="option<?=$comment['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <ul class="dropdown-menu" aria-labelledby="option<?=$comment['id']?>">
                                 <li><a class="dropdown-item" id="del_c_btn" onclick="deleteComment(<?=$comment['id']?>)"><i class="bi bi-trash-fill" style="cursor:pointer;"> سرینەوەی سەرنج</i></a></li>
                                 <li><a class="dropdown-item" id="pin_c_btn" data-comment-id="<?=$comment['id']?>"><i class="bi bi-pin-angle-fill"> چەسپاندنی سەرنج</i></a></li>
                            </ul>

                                    <?php
                                        }
                                    ?></h6>
                                    <p style="margin:0px;" class="text-muted">(<?=show_time($comment['created_at'])?>)
               <span style="position: relative;"> 
                <?php
                $likesC = getLikesC($comment['id']);
if(checkLikeStatusC($comment['id'])){
$like_btn_display='none';
$unlike_btn_display='';
}else{
    $like_btn_display='';
    $unlike_btn_display='none';  
}
    ?>
                <i class="bi bi-heart-fill unlike_comment_btn text-danger" style="display:<?=$unlike_btn_display?>;" data-comment-id='<?=$comment['id']?>'></i>
                <i class="bi bi-heart like_comment_btn" style="display:<?=$like_btn_display?>;" data-comment-id='<?=$comment['id']?>'></i>
         
                </span>
                <span style="font-size:small; position:relative; top:0px;" id="likecount<?=$comment['id']?>"><?=count($likesC)?></span>      
               
</p>

<span class="p-1 mx-2 text-small" id="reply-button" style="font-size:small; color: blue; cursor:pointer;" data-comment-id="<?=$comment['id']?>"> وەڵامدانەوە</span>

                                </div>
                                
                            </div>
                                    
                 
<div class="input-group p-2 border-bottom border-top reply-form" id="reply-form-<?=$comment['id']?>" style="display:none;">
                        <img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" style="width: 35px;
height: 35px;
object-fit: cover;
border-radius: 50%;
margin-right:3%;">
                            <textarea type="text" class="form-control rounded-1 border-1 reply-input" placeholder="<?=$_SESSION['userdata']['first_name']?> وەڵامی بدەوە"
                                aria-label="Recipient's username" aria-describedby="button-addon2" rows="1"></textarea>
                            <button class="btn btn-outline-primary rounded-1 border-0 add-reply" data-comment-id="<?=$comment['id']?>" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2"> <img src="images/reply2.png" style="height:24px; width:25px; margin-left:-2px; margin-top:-4px;"> </button>
                        </div>
                        <script>
$(document).ready(function() {
  $('#reply-button').click(function() {
    var commentId = $(this).data('comment-id');
    $('#reply-form-' + commentId).toggle();
  });
});
</script> 
    <?php
}
                          ?>
       

</div>
                        </div>
                        <?php 
if($post['coLock']== 1){
    ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
    <?php 
} else {
?>
<div class="input-group p-2 border-top">
                        <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;
margin-right:3%;">
                            <textarea type="text" class="form-control rounded-0 border-0 comment-input" placeholder="<?=$_SESSION['userdata']['first_name']?> شتێ بڵێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2" ></textarea>
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">پۆست</button>
                        </div>

<?php } ?>
                        
                    </div>



                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="postTextView<?=$post['id']?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content" style="border-radius: 15px;">

                <div class="modal-body d-md-flex p-0" >
                    <div class="col-md-12 col-sm-12 d-flex flex-column" style="position:relative; ">
                    <button type="button" class="btn-close p-3" style="position: absolute;" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex align-items-center justify-content-center">
                    
                      <h5 class=" pb-3 pt-2 " style="text-align: right;">لێدوانەکان</h5>
                      </div>


                        <div class="flex-fill align-self-stretch overflow-auto bodyy" id="comment-section-text<?=$post['id']?>" >
 <style>
  .bodyy{
    height: 450px;
  }
  .bodyy::-webkit-scrollbar {
  display: none;
}
 </style>
                          <?php
if(count($comments)<1){
    ?>
<p class="p-3 text-center my-2 nce"> هیچ سەرنجێک نەدراوە <br> ببە بە یەکەم کەس و سەرنجێک بدە <br> <img src="assets/images/smartphone-10.png" style="height: 85px; width:85px; position:relative; top:30px;" alt=""></p>

    <?php
}
?>



<div class="comment">
<?php 

foreach($comments as $comment){
    $cuser = getUser($comment['user_id']);
    ?>

<div class="d-flex align-items-center border-bottom p-3"   id="<?=$comment['id']?>">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start " id="comment" style="background:white; border-radius:6px;" style="position:relative;">
                                    <?php if($comment['user_id'] == $post['user_id']){?>
                                        
                                <span><img src="assets/images/author.png" height="20px" width="20px"alt="">نووسەر</span>
<?php } ?>
                                    <h6 style="margin: 0px;"> <a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark text-small text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?> 
                                    
                                    <?php
                                        if($comment['user_id']==$user['id']){
                                     ?>


                            <i class="bi bi-three-dots-vertical" style="" id="option<?=$comment['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <ul class="dropdown-menu" aria-labelledby="option<?=$comment['id']?>">
                            <li><a class="dropdown-item" id="del_c_btn" onclick="deleteComment(<?=$comment['id']?>)"><i class="bi bi-trash-fill" style="cursor:pointer;"> سرینەوەی سەرنج</i></a></li>
                                 <li><a class="dropdown-item" id="pin_c_btn" data-comment-id="<?=$comment['id']?>"><i class="bi bi-pin-angle-fill"> چەسپاندنی سەرنج</i></a></li>
                            </ul>
                         
                                    <?php
                                        }
                                    ?></h6>
                                    <p style="margin:0px;" class="text-muted">(<?=show_time($comment['created_at'])?>)
                                    
               <span style="position: relative;"> 
                <?php
 $likesC = getLikesC($comment['id']);
 $replies = getReplies($comment['id']);
if(checkLikeStatusC($comment['id'])){
$like_btn_displa='none';
$unlike_btn_displa='';
}else{
    $like_btn_displa='';
    $unlike_btn_displa='none';  
}
    ?>
                <i class="bi bi-heart-fill text-danger unlike_comment_btn" style="display:<?=$unlike_btn_displa?>;" data-comment-id='<?=$comment['id']?>'></i>
                <i class="bi bi-heart like_comment_btn" style="display:<?=$like_btn_displa?>;" data-comment-id='<?=$comment['id']?>'></i>

                </span>
                <span style="font-size:small; position:relative; top:0px;" id="likecount<?=$comment['id']?>"><?=count($likesC)?></span>      
               
</p>
<div style="display:flex; align-items:center; justify-content:space-between;">
<span class="p-1 mx-2 text-small reply-butto" id="reply-butto-<?=$comment['id']?>" style="font-size:small; color: #66a6ff; cursor:pointer;" data-comme-id="<?=$comment['id']?>">وەڵامدانەوە</span>

<span class="p-1 mx-2 text-small" id="reply-zerak-<?= $comment['id'] ?>" style="font-size:small; color: #66a6ff; cursor:pointer;" data-comm-id="<?= $comment['id'] ?>"> وەڵامەکان <?=count($replies)?> </span>
</div>
    
                                </div>
                                
                            </div>
                            <div id="reply-sec-<?=$comment['id']?>" style="display: none;">
                            <?php 
$replies = getReplies($comment['id']);
foreach($replies as $reply) {
$cuser = getUser($reply['user_id']);
?>

<div class="p-2" style=" width: 100%;
  height: 80px;
  background-color: #FAFAFA;
  border-bottom: solid 1px #E0E0E0;
  display:flex;
  align-items: center;
  cursor: pointer;"  id="<?=$reply['id']?>">
      <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" style="width: 40px;
height: 40px;
object-fit: cover;
border-radius: 50%;">
      </div>
      <div>&nbsp;&nbsp;&nbsp;</div>
      <div class="d-flex flex-column justify-content-start align-items-start " id="comment" style="background:white; border-radius:6px;" style="position:relative;">
      
          <h6 style="margin: 0px;"> <a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark text-small text-muted">@<?=$cuser['username']?></a> - <?=$reply['reply']?> 
          
    </h6>
          <p style="margin:0px;" class="text-muted">(<?=show_time($reply['created_on'])?>)
          
</p>



      </div>
      
  </div>


<?php
}
?>
</div>
                            <div class="input-group p-2 border-bottom border-top reply-form" id="reply-for-<?=$comment['id']?>" style="display: none;" dir="rtl">
                        <img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" style="width: 35px;
height: 35px;
object-fit: cover;
border-radius: 50%;
margin-right:3%;">
                            <textarea type="text" class="form-control rounded-1 border-1 reply-input" placeholder="<?=$_SESSION['userdata']['first_name']?> وەڵامی بدەوە"
                                aria-label="Recipient's username" aria-describedby="button-addon2" rows="1"></textarea>
                            <button class="add-reply" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
                            border-radius:10px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  border: none;
  outline: none;
  overflow: hidden;
  color: white;
  transition: color 0.3s 0.1s ease-out;
  text-align: center;" data-comment-id="<?=$comment['id']?>" data-cs="reply-sec-<?=$comment['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2"> <img src="images/reply2.png" style="height:24px; width:25px; margin-left:-2px; margin-top:-4px;"> </button>
                        </div> 
                 
                            <script >
        $(document).ready(function() {
  $('#reply-butto-<?=$comment['id']?>').click(function() {
    var commeId = $(this).data('comme-id');
    $('#reply-for-' + commeId).toggle();
  });
  });

  $(document).ready(function() {
  $('#reply-zerak-<?=$comment['id']?>').click(function() {
    var commId = $(this).data('comm-id');
    $('#reply-sec-' + commId).toggle();
  });
  });

       </script>



    <?php
}
                          ?>
 
  
</div>
                        </div>
                        <?php 
if($post['coLock']== 1){
    ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
    <?php 
} else {
?>
<div class="input-group p-2 border-top">
                        <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;
margin-right:3%;">
                            <textarea type="text" class="form-control rounded-0 border-0 comment-input" placeholder="<?=$user['first_name']?> شتێ بڵێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2" ></textarea>
                            <button class="add-comment" style=" background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
                            border-radius:10px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  border: none;
  outline: none;
  overflow: hidden;
  color: white;
  transition: color 0.3s 0.1s ease-out;
  text-align: center;" data-cs="comment-section-text<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">پۆست</button>
                        </div>

<?php } ?>
                        
                    </div>



                </div>

            </div>
        </div>
    </div>

            <div class="modal fade" id="likes<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header" style="position:relative;"
            >
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute; left:3%;"></button>
            <h5 class="modal-title" style="position:absolute; right:3%;">بەدڵبوونەکان</h5>
            
                
            </div>

            <div class="modal-body">
                <?php
                if(count($likes)<1){
                    ?>
<p style="text-align:center;">لە ئێستادا هیچ بەدڵبوونێک نیە</p>
<img src="assets/images/breaking.png" style="position:relative; top:0; left:180px; height:90px; width:90px; margin-left:4px; margin-top:-4px;">
                    <?php
                }
foreach($likes as $f){

    $fuser = getUser($f['user_id']);
    $fbtn='';
    if(checkBS($f['user_id'])){
continue;
    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;">
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

    <?php
}
            ?>
       

        </div>

        <div class="col-lg-4 col-sm-0 overflow-hidden mt-4 p-sm-0 p-md-3">
       
        <div class="userr">
            <div class="d-flex align-items-center p-2" style="position: relative;">
            <div class="sidebarr" dir="rtl">
      <a href="" class="logo"></a>
      <a href='?u=<?=$user['username']?>' class="text-decoration-none text-dark "> 
      <div class="profile_side">
       <div class="profile_pic_side">
          <img src="assets/images/profile/<?=$user['profile_pic']?>"" alt="">
        </div>
        <div class="name">
        <?php 
                           
                           if($user['verify'] == "1") {
                                 echo '<img src="assets/images/blue_badge.png">';
                                 } elseif($user['verify'] == "2"){
                                   echo '<img src="images/id_3.png">';
                                 } ?>
          <h1><?=$user['first_name']?> <?=$user['last_name']?></h1>

        </div> 
        <span><?=$user['username']?>@</span>
      
      </div></a>
      <!---about-->
      <div class="border-bottom about">
        <!--box1-->
        <div class="box">
<h3><?=count($profile_post)?></h3>
<span>
  پۆستەکانت
</span>
        </div>
     

        <!--box1-->
        <div class="box">
<h3><?=count($profile['followers'])?></h3>
<span>  شوێنکەوتوەکانت
</span>
        </div>
      

     
        <!--box1-->
        <div class="box">
<h3><?=count($profile['following'])?></h3>
<span>
  شوێنکەوتوی
</span>
        </div>
      </div>

      <!---menu-->
<div class="menu">

  <a href="?" class="active">
    <span class="icon">
<img src="images/home-icon.svg" alt="">
    </span>
ماڵەوە  </a>

<a class="" href="?market">
    <span class="icon">
    <img src="images/go-to-store-icon.svg" alt="">
    </span>
     مارکێت
  </a>

  <?php
if(getUnreadNotificationsCount()>0){
    ?>
  <a id="show_notb" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
    <span class="icon">
    <img src="images/notification-bell-icon.svg" alt="">
    </span>
    ئاگادارنامەکان
    <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
   <small><?=getUnreadNotificationsCount()?></small>
  </span>
  </a>
  
  <?php
}else{
    ?>
      <a data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
    <span class="icon">
    <img src="images/notification-bell-icon.svg" alt="">
    </span>
    ئاگادارنامەکان
  </a>
        <?php
}
                    ?>

  <a  href="?messenger">
    <span class="icon">
    <img src="images/chat-box-icon.svg" alt="">
    </span>
    نامەکان
    <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounterwall">

</span>
  </a>
  <?php
if(getUnreadRequestCount()>0){
    ?>
  <a id="show_noti" data-bs-toggle="offcanvas" href="#suggetion_sidebar" role="button" aria-controls="offcanvasExample" href="#">
    <span class="icon">
    <img src="images/compass-icon.svg" alt="">
    </span>
    دۆزینەوە
    <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounterwall">
    <small><?=getUnreadRequestCount()?></small>
    </span>
  </a>
    <?php
}else{
    ?>
  <a id="show_noti" data-bs-toggle="offcanvas" href="#suggetion_sidebar" role="button" aria-controls="offcanvasExample" href="#">
    <span class="icon">
    <img src="images/compass-icon.svg" alt="">
    </span>
    دۆزینەوە
  </a>
     <?php
}
                    ?>


  <a href="?editprofile" class="">
    <span class="icon" >
    <img src="images/setting-line-icon.svg" alt="" style="  height:20px;
    width:20px;
    margin-left: 1rem;
    margin-bottom: -1px;">
    </span>
    ڕێکخستنەکان
  </a>

  <a href="assets/php/actions.php?logout" class="">
    <span class="icon">
    <img src="images/logout-line-icon.svg" alt="" style="  height:20px;
    width:20px;
    margin-left: 1rem;
    margin-bottom: 0;">
    </span>
    چوونەدەرەوە
  </a>
  
</div>


    </div>
    
<style>
  .sidebarr{
    position:fixed;
    width: 300px;
    background:#fff;
padding-top: 33%;

  }
  .profile_side{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 1.4rem;
  }
  .profile_pic_side{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: solid 2px  #66a6ff;
  }
  .profile_pic_side img{
    width: 70px;
    height: 70px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
  }
  .name{
    display: flex;
    align-items: center;
    margin: 1rem 0 0.4rem;
  }
  .name h1{
    font-size: 1.1rem;
  }
  .name img {
    width:21px;
    height:21px;
    object-fit: contain;
    margin-top:-10px;
    margin-left:2px;
  }
  .profile_side span{
    font-size: 1rem;
    font-weight: 400;
  }
  .about{
    display: flex;
    justify-content:space-between;
    margin-top: 1rem;
  }
  .box{
    text-align: center;
  }
  .box h3{
    font-size: 1rem;
    font-weight: 500;
  }
  .box span{
    font-size: 1rem;
    font-weight: 400;
  }
  .menu{
    padding-top: 1rem;
  }
  .menu a{
    width: 100%;
    font-size: 1rem;
    color: #000;
    display:flex;
    align-items: center;
    line-height: 40px;
  }
  .menu a:hover,
  .menu .active{
color:  #66a6ff;
  }
  .menu .icon{
    height:20px;
    width:20px;
    margin-left: 1rem;
    margin-bottom: 1.6rem;
  }
  .menu a:hover::before,
  .menu .active::before{
    content: '';
    position: absolute;
    left: 0;
    width: 2px;
    height: 17px;
    background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  }
  .NetModal {
  display: none;
  position: fixed;
  z-index: 99;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

</style>
        </div>
       
        </div>
    </div>


  
    </div>
  
<div class="NetModal" id="WelcomeModal" style="border-radius:10px;">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            
            <div class="modal-body" dir="rtl">
            <h4 class="modal-title d-flex align-items-center justify-content-center" style="align-text:center;"> بەخێر بێی بۆ ناو تۆڕەکەمان <?=$user['first_name'].' '.$user['last_name']?></h4>
            <img src="images/undraw_personal_info_re_ur1n.svg" style="width:100%; opacity:0.8; margin-top:10px;" alt="">
         
          <br>
          <p>
             ئێمە لێرە چەند مەرجێک پەیڕەو ئەکەین تا بەکارهێنەرەکانمان بپارێزین لە هەر جۆرە کێشەیەکی یاسایی یان کۆمەڵایەتی کە لە 
             ئەگەری بەکارهێنانی تۆڕەکەمان تووشی ببن تکایە بۆ زانیاری زیاتر دەربارەی مەرجەکانی بەکارهێنان سەردانی ئەم بەشە بکە
             <a  style="color:#66a6ff; cursor:pointer;" href="?terms"><h6>مەرجەکانی بەکارهێنان</h6></a>
          </p>
          <br>
          <p>
            بۆ فێرکاری بەکارهێنانی تۆڕەکەمان گرتە لەسەر دووگمەیە بکە
          </p>
          <br>
          <p>
            ئەگەریش شارەزای و پێشتر ئەزموونی تۆڕەکەمانت کردووە تکایە گرتە  لەسەر داخستن بکە،<br> تێبینی ئەم نامەیە تەنها یەک جار نیشان ئەدرێ دوای داخستن جارێکی کە ناکرێتەوە.
          </p>
          <p>
            سووپاس بۆ بەکارهێنانی نێت لینک بە هیوای کاتێکی خۆش،
          </p>
          <div class="modal-footer"><div class="d-flex align-items-center justify-content-center" style="width: 100%;">
          <form method="post" action="assets/php/actions.php?counter=<?=$_SESSION['userdata']['id']?>">
          
  <button class="btn btn-primary" type="submit" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  font-size: 19px;
  font-weight: 600;
  cursor: pointer;
  border: none;
  outline: none;
  overflow: hidden;
  color: white;
">داخستن</button>
 
  </form></div>
          </div>
    
            </div>
   
        </div>
  </div>
</div>





    <script>
        $("#video").click(
    ()=>{ $(this).get(0).play(); },
    ()=>{ $(this).get(0).pause(); }
);

setInterval(function() {
    $('#loop').load("$request").fadeIn("slow");
},2000);


$(document).ready(function() {
  // Attach a click event listener to the delete comment buttons
  $('#del_com_btn').on('click', function(e) {
    e.preventDefault();

    // Get the ID of the comment to be deleted from the data attribute
    var commentId = $(this).data('comment-id');

    // Send an AJAX request to delete the comment
    $.ajax({
      type: 'POST',
      url: 'assets/php/ajax.php?deletecomment',
      data: { commentId: commentId },
      success: function() {
        // If the delete request was successful, remove the comment from the page
        $('.comment[data-comment-id="' + commentId + '"]').remove();
        location.reload();
      }
    });
  });
});

const videos = document.querySelectorAll('.video'); // Replace '.video' with your own CSS selector for the video elements

let lastScrollPos = 0;

window.addEventListener('scroll', () => {
  const currentScrollPos = window.pageYOffset || document.documentElement.scrollTop;
  
  // Determine if user has scrolled past each video element
  videos.forEach((video, index) => {
    const rect = video.getBoundingClientRect();
    const isVisible = rect.top <= window.innerHeight && rect.bottom >= 0;
    
    if (isVisible) {
      // Autoplay video if user is scrolling down, or if they've scrolled up to a previous video
      if (currentScrollPos > lastScrollPos || index === 0) {
        video.play();
      } else {
        video.pause();
      }
    } else {
      video.pause();
    }
  });
  
  lastScrollPos = currentScrollPos;
});


let modal = document.getElementById("WelcomeModal");
let verifyModal = document.getElementById("verifyModal");

// When the user logs in, show the modal
<?php if ($user['counter'] == 1) { ?>
  modal.style.display = "block";
<?php }else{ ?>
  modal.style.display = "none";
<?php } ?>



    </script>

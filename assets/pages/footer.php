
<?php if(isset($_SESSION['Auth'])){
    global $request;
   ?>
<div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">پۆستی تازە زیاد بکە</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" dir="rtl">
          
            <img src="" style="display:none;" id="post_img" class="w-100 rounded border">
            <video src="" style="display:none;" id="post_video" class="w-100 rounded border" controls></video>
<form method="post" action="assets/php/actions.php?addpost" enctype="multipart/form-data" id="AddPost">
    <div class="my-3">

        <input class="form-control" name="post_img" type="file" id="select_post_img">
        <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                        <label for="select_post_img" style="width:70px; height:70px;
      right:45%;">
                        <img src="images/choose.png" style="width:100%; height:100%;"  alt=""></label>
                    </div>
    </div>
    <div class="mb-3" dir="ltr">
        <div id="editor"></div>
    </div>
    <span class="text-dark">قوفڵدانی سەرنج</span>

    <label for='t2' class="switch">
        <input id='t2' class='' onclick="" name="clock" value="1" type='checkbox' unchecked>
        <span class="slider round"></span>
    </label>
    <br>
    <div style="display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;">
    <button type="submit" class="btn btn-primary" style="margin-top:10px; border-radius: 15px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 120px; padding:3%;">پۆستبکە</button>
</div>
</form>
            </div>
   
        </div>
  </div>
</div>

<div class="modal fade" id="addreel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">کورتەی تازە زیاد بکە</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" dir="rtl">
<video src="" style="display:none;" id="post_video" class="w-100 rounded border"></video>
<form method="post" action="assets/php/actions.php?addreel" enctype="multipart/form-data" id="AddReel">
    <div class="my-3">
        <input class="form-control" name="post_reel" type="file" id="select_post_reel">
        <div class="d-flex justify-content-center align-items-center">
                        <label for="select_post_reel" class="label" style="width:70px; height:70px;">
                        <img src="images/choose.png" style="width:100%; height:100%;"  alt=""></label>
                    </div>
    </div>
    <!--<div class="mb-3" dir="ltr">
        <div id="reelcont"></div>
    </div>--->
    <span class="text-dark">قوفڵدانی سەرنج</span>

    <label for='t2' class="switch">
        <input id='t2' class='' onclick="" name="clock" value="1" type='checkbox' unchecked>
        <span class="slider round"></span>
    </label>
    <br>
    <button type="submit" class="btn btn-primary" style="margin-top:10px;">پۆستبکە</button>

</form>
            </div>
   
        </div>
  </div>
</div>


<div class="modal fade" id="addstory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            
               

            <div class="modal-body" style="position:relative;">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute;"></button>
            <h5 class="modal-title" style="text-align:center; margin-bottom:10px;">چیرۆکی تازە زیاد بکە</h5>
           
                <img src="" style="display:none; max-height:90vh;" id="story_img" class="w-100 rounded border">
                <form method="post" action="assets/php/actions.php?addstory" enctype="multipart/form-data">
                <input class="form-control" name="story_img" type="file" id="select_story_img">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="select_story_img" style="width:70px; height:70px;">
                        <img src="images/choose.png" style="width:100%; height:100%;"  alt=""></label>
                    </div>
                    <div class="d-flex justify-content-center align-items-center pt-4">
                <button type="submit" class="btn btn-primary" style="margin:8px; border-radius: 7px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding:3%; color:white;">پۆستبکە</button>
                    </div>
                </form>
            </div>
   
        </div>
  </div>
</div>

<style>
  .sidebar-canvas{
  height: 70%;
  width:50%;
  margin-left:20%;
  border-radius:15px 15px 0px 0px;
  }
#suggetion_sidebar{
  height: 75%;
  width:50%;
  margin-left:20%;
  border-radius:15px 15px 0px 0px;
}
#message_sidebar{
  height: 70%;
  width:50%;
  margin-left:20%;
  border-radius:15px 15px 0px 0px;
}

@media screen and (max-width: 994px) {
.sidebar-canvas{
  width: 100%;
  margin-left:0;
  height: 80%;
}
#suggetion_sidebar{
  width: 100%;
  margin-left:0;
  height: 85%;
}
#message_sidebar{
  width: 100%;
  margin-left:0;
  height: 85%;
}
}
</style>

<div class="offcanvas offcanvas-bottom sidebar-canvas" tabindex="-1" id="notification_sidebar" aria-labelledby="offcanvasExampleLabel" >
  <div class="offcanvas-header">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">ئاگادارنامەکان</h5>
  
  </div>
  <div class="offcanvas-body ">
  <?php
  $notifications = getNotifications();
  $user = $_SESSION['userdata']['id'];
  if(isNotified($user) < 1){
    echo '<p style="width:100%;" class="p-2 bg-white text-center my-3 col-12">  <span class="d-block w-100"> هیچ ئاگادارکردنەوەیەکت بۆ نە هاتووە <br><br> <img src="images/undraw_browsing_online_re_umsa.svg" style="width:50%; opacity:1; margin:20px; " alt=""> </p>';
  }
foreach($notifications as $not){
    $time = $not['created_at'];
    $fuser = getUser($not['from_user_id']);
    $post='';
    if($not['post_id'] && $not['from_user_id'] != 9999){
        $post='data-bs-toggle="modal" data-bs-target="#postview'.$not['post_id'].'"';
    }
    $fbtn='';
    ?>
<div class="d-flex justify-content-between border-bottom">
                    <div class="d-flex align-items-center p-2">
                    <?php if ($not['from_user_id'] != 9999) { ?>
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <?php }elseif($not['from_user_id'] == 9999){ ?>
                          <div><img src="assets/images/profile/netlink.png" alt="" style="width: 55px;
height: 55px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                          <?php } ?>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center" <?=$post?>>
                        <?php if ($not['from_user_id'] != 9999) { ?>
                            <a href='?u=<?= $fuser['username'] ?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: 19px;"><?= $fuser['first_name'] ?> <?= $fuser['last_name'] ?></h6></a>
                            <?php }elseif($not['from_user_id'] == 9999){ ?>
                              <h6 style="margin: 0px;font-size: 19px;">NETlink Team</h6>
                              <?php } ?>
                              <?php if ($not['from_user_id'] != 9999) { ?>
                            <p style="margin:0px;font-size:small" class="<?=$not['read_status']?'text-muted':''?>"> <?=$not['message']?> @<?=$fuser['username']?></p>
                            <?php }elseif($not['from_user_id'] == 9999){ ?>
                              <p style="margin:0px; font-size: 15px; text-align:right;" class="<?=$not['read_status']?'text-muted':''?>"> <?=$not['message']?></p>
                              <?php } ?>
                            <time style="font-size:small" class="timeago <?=$not['read_status']?'text-muted':''?> text-small" datetime="<?=$time?>"></time>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <?php
if($not['read_status']==0){
    ?>
                      <div class="p-1 bg-primary rounded-circle"></div>

    <?php

}else if($not['read_status']==2){
?>
<span class="badge bg-danger">ئەم پۆستە سراوەتەوە</span>
<?php
}
                        ?>

                    </div>
                </div>
    <?php
}
                ?>
    
  </div>
</div>



<style>

.suggestion_body::-webkit-scrollbar {
  display: none;
}

</style>


<div class="offcanvas offcanvas-bottom " tabindex="-1" id="suggetion_sidebar" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">ئاگادارنامەکان</h5>
 
  </div>
  <div class="offcanvas-body suggestion_body">
    <?php global $user;
     if($user['islocked'] == 1){ ?>
    <section>
      <h6 class="text-muted p-2">داواکاریەکان</h6>
      <?php
foreach($request as $ruser){
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$ruser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$ruser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size:18px;"><?=$ruser['first_name']?> <?=$ruser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$ruser['username']?></p>
                        </div>
                    </div>
                    
                 
                </div>
                <div class="d-flex align-items-center">
                        
                        <button class="btn btn-sm btn-primary declinebtn" style="color: #fff;
      font-family: Helvetica;
      font-size: 15px;
      background-color: grey;
       background: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
      border-radius: 7px;
      width: 49%;
      border:none;
      outline:none;
      height: 39px; margin-right:10px; " data-user-id='<?=$ruser['follower_id']?>' >ڕەتکردنەوە</button>
                            <button class="btn btn-sm btn-primary acceptbtn" style="  color: #fff;
                            background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
      font-family: Helvetica;
      font-size: 15px;
      background-color: #3399FF;
      border: 1px solid;
      border-color: #3399FF;
      border-radius: 7px;
      width:49%;
      height: 39px;" data-user-id='<?=$ruser['follower_id']?>' >قبووڵکردن </button>
    
                        </div>
    <?php
}

if(count($request)<1){
    echo "<p class='p-2 bg-white border rounded text-center'>هیچ داواکاریەک نیە لە ئێستادا</p>";
}
                ?>
                
      
  </section>
  <?php } ?>
    <section>
                <h6 class="text-muted p-2">پێشنیارەکان</h6>
                <?php
                global $follow_suggestionsb;
foreach($follow_suggestionsb as $suser){
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$suser['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$suser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size:18px;"><?=$suser['first_name']?> <?=$suser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$suser['username']?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-primary followbtn" style="  color: #fff;
                        background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  font-family: Helvetica;
  font-size: 15px;
  background-color: #3399FF;
  border: 1px solid;
  border-color: #3399FF;
  border-radius: 3px;
  width: 95px;
  height: 30px;" data-user-id='<?=$suser['id']?>' >+ شوێنکەوتن</button>

                    </div>
                </div>
    <?php
}

if(count($follow_suggestionsb)<1){
    echo "<p class='p-2 bg-white border rounded text-center'>هیچ پێشنیارێک نیە لە ئێستادا</p>";
}
                ?>
    </section>
  </div>
</div>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="message_sidebar" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  <form class="d-flex" id="searchform">
                <input class="form-control me-2" type="search" id="search_m" placeholder="...گەڕان &#xF002;" style="text-align:right;font-family:Arial, FontAwesome;"
                        aria-label="Search" autocomplete="off">
<div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result_m" data-bs-auto-close="true">
<button type="button" class="btn-close" aria-label="Close" id="close_m_search"></button>
<div id="sram" class="text-start">
<p class="text-center text-muted">ناو یان ناوی بەکارهێنەر بنووسە</p>
</div>
</div>
                </form>
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">نامەکان</h5>
 
  </div>

  <div class="offcanvas-body" id="chatlist">
    
    
  </div>

</div>


<div class="offcanvas offcanvas-bottom sidebar-canvas" tabindex="-1" id="logged_sidebar" aria-labelledby="offcanvasExampleLabel" >
  <div class="offcanvas-header">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">ئاگادارنامەکان</h5>
  
  </div>
  <div class="offcanvas-body ">
  
<div class="d-flex justify-content-between border-bottom">
                    <div class="d-flex align-items-center p-2">
                        <div>
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                       

                    </div>
                </div>

    
  </div>
</div>




<div class="modal fade" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="position: relative;">
        <a href="" id="cplink" class="text-decoration-none text-dark"><h5 class="modal-title" id="exampleModalLabel">
          <img src="assets/images/profile/default_profile.jpg" id="chatter_pic" style=" width: 50px;
                height: 50px;
                border-radius:50%;
                object-fit: cover;" >
                <span id="chatter_name" style="padding-left:3px;"></span></h5>
       <small style ="position:absolute; top:58%; left:16%; font-size:small" class="text-muted" id="status">
       
</small>
                              </a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column-reverse gap-2 " style="height: 350px;" id="user_chat">
     لە بارکردن دایە...
      </div>
      <div class="modal-footer">
         
          <p class="p-2 text-danger mx-auto" id="blerror" style="display:none"> 
                  <i class="bi bi-x-octagon-fill"></i> ناتوانی نامە بۆ ئەم بەکارهێنەرە بنێری چیتر
          </p>
          <div class="input-group p-2 " id="msgsender">
            <label for="fileinput">
                <input type="file" name="fileinput" id="fileinput">
                <span class="bi bi-file-earmark-image" style="font-size: 30px; color:rgb(120, 120, 120); margin-right:5px;  cursor: pointer;"></span>
        </label>
                            <input type="text" class="form-control rounded-0 border-0" id="msginput" placeholder="...شتێک بڵێ"
                            style="text-align: right; margin-right:5px;"  aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0" id="sendmsg" data-user-id="0" type="button"
                                >ناردن <i class="uil uil-message"></i></button>
                        </div>
</div>
      
      </div>
    </div>
  </div>


  


<?php }  ?>
<style>
    #fileinput{
        width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;

    }
    #select_story_img{
      width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;

    }
    #select_post_reel{
        width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;

    }
    .label{
      position:relative;
      right:45%;
    }
    .form-controll{
  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
  margin-top:10px;
  }

  .form-controll:hover {
  border: solid 1.9px #000002;
  transform: scale(1.03);
  box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
  transition: border-color 1s ease-in-out;
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
#formFile{
  width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;
}
.formFilee{
  position:absolute;
  top:115px;
  left: 50.5%;
}
.camera_fixx{
background-color: #f3f7fe;
width: 45px;
height: 45px;
  transition: .3s;
  border-radius: 50%;
  cursor: pointer;
  transform: translate(-50%, -50%);
  border: 1px solid #3b82f6;
}
.camera_fixx:hover{
background-color: #3b82f6;
box-shadow: 0 0 0 5px #3b83f65f;
  
                        }
#boot-icon-ee:hover{
color: #fff;
}
#boot-icon-ee{
font-family: monospace;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 30px;
cursor: pointer;
border-radius: 50%;
position: relative;
right:13%;
 }

 
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery.timeago.js"></script>
    <script src="assets/js/custom.js?v=<?=time()?>"></script>
    <script>
        var quill = new Quill('#editor', {
      theme: 'snow'
    });

    let form = document.getElementById('AddPost');
    form.onsubmit = function() {
      let content = document.querySelector('div#editor .ql-editor').innerHTML;
      let input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'content';
      input.value = content;
      form.appendChild(input);
    };



  var input = document.querySelector("#select_story_img");

input.addEventListener("change", preview);

function preview() {
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function () {
        var image_src = filereader.result;
        var image = document.querySelector("#story_img");
        image.setAttribute('src', image_src);
        image.setAttribute('style', 'display:');
    }
}

$(document).on('submit', '#createmarketform', function(event) {
  event.preventDefault();
  
  var formData = $(this).serialize(); // collect form data
  
  $.ajax({
    url: 'assets/php/actions.php?marketcreate',
    method: 'POST',
    data: formData,
    success: function(response) {
      // handle success response and update modal content
      $('#createmarket').html(response);
    },
    error: function(xhr, status, error) {
      // handle error
      console.log(error);
    }
  });
});


</script>

</body>

</html>

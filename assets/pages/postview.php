<?php
 global $user, $time;
 global $rows; 
 global $comments;
 global $db;
 /*echo '<pre>';
 echo print_r($row);
 echo '</pre>';*/
 ?>
    <div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between bg-white" >
        <div class="col-md-8 col-sm-12" style="max-width:93vw">
   
        <?php
if(isset($_GET['postview'])){
  $row_id = $_GET['postview'];
  $query = "SELECT users.id as uid,posts.id,posts.user_id,posts.post_img,posts.coLock,posts.post_text,posts.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify,users.bio,users.islocked FROM posts JOIN users ON users.id=posts.user_id where posts.id = $row_id";
  $run = mysqli_query($db,$query);
  $row = mysqli_fetch_assoc($run);
  $likes = getLikes($row['id']);
  $comments = getComments($row['id']);
}

?>
<button onclick="goBack()" style="border:none; background:transparent; padding:0; margin: 0;"><span id="boot-icon" class="bi bi-arrow-left" style="font-size: 40px; color: rgb(0, 0, 0); -webkit-text-stroke-width: 0.8px;"></span></button>

<script>
function goBack() {
  window.history.back();
}
</script>
     <div class="card mt-4">
                <div class="card-title d-flex justify-content-between  align-items-center">

                    <div class="d-flex align-items-center p-2">
                        <img src="assets/images/profile/<?=$row['profile_pic']?>" alt=""style="width: 70px;
height: 70px;
object-fit: cover;
border-radius: 50%;
" class="rounded-circle border">&nbsp;&nbsp;<a href='?u=<?=$row['username']?>' class="text-decoration-none text-dark" style="font-size:20px;" >
                        <?=$row['first_name']?> <?=$row['last_name']?>
                        <?php 
                           if($row['verify'] == "1") {
                                 echo '<img src="assets/images/blue_badge.png" style="border-radius:50%; height:18px; width:18; margin-left:-2px; margin-top:-4px;">';
                                 } elseif($row['verify'] == "2"){
                                   echo '<img src="images/id_3.png" style="border-radius:50%; height:18px; width:18; margin-left:-2px; margin-top:-4px;">';
                                 } ?>
                        <br><div style="font-size:small" class="text-muted"> <?=$time->show_time($row['created_at'])?> </div> </a>
                    </div><br>
                    
                    <div class="p-2">
                        <?php
if($row['uid']==$user['id']){
    ?>

  <div class="dropdown">

  <i class="bi bi-three-dots-vertical" id="option<?=$row['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

  <ul class="dropdown-menu" aria-labelledby="option<?=$row['id']?>">
    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_post<?=$row['id']?>"><i class="uil uil-image-edit"></i> دەستکاری کردنی پۆست</a></li>
    <li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?=$row['id']?>"> <i class="bi bi-trash-fill"></i> سرینەوەی پۆست</a></li>
  </ul>
</div>
    <?php
}
                        ?>
                        
<div class="modal fade" id="edit_post<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">دەستکاری کردنی پۆست</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" dir="rtl">
<div class="d-flex justify-content-between">
            <form action="assets/php/actions.php?editposttxt=<?=$row['id']?>" method="POST">
            <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">شتێک بڵێ</label>
                        <textarea name="new_post_text" class="form-control" id="exampleFormControlTextarea1" rows="1" width="100%"></textarea>
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
if ($row['post_text']) {
    ?>
    <div class="card-body">
 
        <p style=" position: relative; top: -13px; white-space: pre-line;"><?=$row['post_text']?>
      </p>
        <?php
    }
    ?>
    </div>

                <?php 
                        $img_path = $row['post_img'];
                        $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                        if(in_array($extension_img,array("jpg","jpeg","png","gif","bmp"))){
                            ?>
                            <img src="assets/images/posts/<?=$row['post_img']?>" loading=lazy class="" style="width: auto;" alt="...">
                            <?php
                        }elseif(in_array($extension_img,array("mp4","avi","mov","MP4","MOV"))){
                            ?>
                            <video src="assets/images/posts/<?=$row['post_img']?>" controls loading=lazy class="" style="width: auto;
                            height:80%;" alt="..."></video>
                            <?php
                        }
                    
                
                ?>
                <h4 style="font-size: x-larger" class="p-2 border-bottom d-flex">
               <span>
               <?php
if(checkLikeStatus($row['id'])){
$like_btn_display='none';
$unlike_btn_display='';
}else{
    $like_btn_display='';
    $unlike_btn_display='none';  
}
    ?>
                <i class="bi bi-heart-fill unlike_btn text-danger" style="display:<?=$unlike_btn_display?>" data-post-id='<?=$row['id']?>'></i>
                <i class="bi bi-heart like_btn" style="display:<?=$like_btn_display?>" data-post-id='<?=$row['id']?>'>      </i>
         
                </span>
                <span class="p-1 mx-2 text-small" data-bs-toggle="modal" data-bs-target="#likes<?=$row['id']?>"> <span style="font-size:small; position:relative; top:-4px;" id="likecount<?=$row['id']?>"><?=count($likes)?></span> </span>
                &nbsp;&nbsp;<span class="p-1 mx-2 text-small" style="font-size:small; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#postview<?=$row['id']?>"><img src="images/instagram-comment-icon.svg" alt="" style="cursor:pointer;  height:25px;
    width:25px;
    "> سەرنجەکان <?=count($comments)?></span> 
                        
                </h4>
                <div>
                
                 
</div>
<?php 
if($row['coLock']== 1){
    ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
    <?php 
} else {
?>
                
                <div class="input-group p-2 <?=$row['post_text']?'border-top':''?>">
                <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;
" class="rounded-circle border">
                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="...شتێ بلێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?=$row['id']?>" data-post-id="<?=$row['id']?>" type="button"
                                id="button-addon2">پۆستبکە</button>
                </div>
<?php } ?>
            </div>
           
            <div class="modal fade" id="postview<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-md-flex p-0">
                    <div class="col-md-8 col-sm-12">
                
                    <?php 
                        $img_path = $row['post_img'];
                        $extension_img = pathinfo($img_path, PATHINFO_EXTENSION);
                        if(in_array($extension_img,array("jpg","jpeg","png","PNG","JPEG","BMP","gif","JPG"))){
                            ?>
                            <img src="assets/images/posts/<?=$row['post_img']?>" loading=lazy class="" style="width: 100%;" alt="...">
                            <?php
                        }elseif(in_array($extension_img,array("mp4","avi","mov","MP4","MOV"))){
                            ?>
                            <video src="assets/images/posts/<?=$row['post_img']?>" controls loading=lazy class="" style="width: 100%;
                            height:100%;" alt="..."></video>
                            <?php
                        }
                    
                
                ?>
                        
                    </div>



                    <div class="col-md-4 col-sm-12 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 border-bottom">
                            <div><img src="assets/images/profile/<?=$row['profile_pic']?>" alt="" height="50" width="50" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start">
                                <h6 style="margin: 0px;"><?=$row['first_name']?> <?=$row['last_name']?> </h6>
                                <p style="margin:0px;" class="text-muted">@<?=$row['username']?></p>
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
                <div style="font-size:small" class="text-muted"> <?=$time->show_time($row['created_at'])?> </div>
                 
</div>
                        </div>


                        <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$row['id']?>" style="height: 100px;">

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

<div class="d-flex align-items-center p-2">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start" id="comment" style="background:white; border-radius:6px;">
                                    <?php if($comment['user_id'] == $row['user_id']){?>
                                        
                                <span><img src="assets/images/author.png" height="20px" width="20px"alt="">نووسەر</span>
<?php } ?>
                                    <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark text-small text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?>
                                    
                                    <?php
                                        if($comment['user_id']==$user['id']){
                                     ?>

 
                            <i class="bi bi-three-dots-vertical" id="option<?=$comment['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <ul class="dropdown-menu" aria-labelledby="option<?=$comment['id']?>">
                                 <li><a role="button" class="dropdown-item" id="del_com_btn" data-comment-id="<?=$comment['id']?>"><i class="bi bi-trash-fill"> سرینەوەی سەرنج</i></a></li>
                            </ul>

                                    <?php
                                        }
                                    ?></h6>
                                    <p style="margin:0px;" class="text-muted">(<?=$time->show_time($comment['created_at'])?>)<div class="reply"><a href="javascript:void(0)" data-commentID="'.$data['id'].'" onclick="reply(this)">وەڵامدانەوە</a></div>
                <div class="replies"></div></p>
                                </div>
                            </div>

    <?php
}
                          ?>
</div>
                        </div>
                        <?php 
if($row['coLock']== 1){
    ?>
    <div class="text-center p-2">سەرنجدان لە لایەن نووسەرەوە قوفڵ دراوە</div>
    <?php 
} else {
?>
<div class="input-group p-2 border-top">
                        <img src="assets/images/profile/<?=$_SESSION['userdata']['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="<?=$_SESSION['userdata']['first_name']?> شتێ بڵێ"
                                aria-label="Recipient's username" aria-describedby="button-addon2" >
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$row['id']?>" data-post-id="<?=$row['id']?>" type="button"
                                id="button-addon2">پۆست</button>
                        </div>

<?php } ?>
                        
                    </div>



                </div>

            </div>
        </div>
    </div>


            <div class="modal fade" id="likes<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align:right;">بەدڵبوونەکان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    }else if(checkFollowStatus($f['user_id'])){
        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id='.$fuser['id'].' >لابردن</button>';
    }else if($user['id']==$f['user_id']){
        $fbtn='';
    }else{
        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id='.$fuser['id'].' >شوێنکەوتن</button>';

    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
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

            ?>
       

        </div>  
        </div>
    </div>
    <script>
        $("#video").click(
    ()=>{ $(this).get(0).play(); },
    ()=>{ $(this).get(0).pause(); }
);

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
    </script>

<?php
 global $user;
 global $reels;
 global $comments;
 /*echo '<pre>';
 echo print_r($_SERVER);
 echo '</pre>';*/
 ?>

  <div class="app__videos" id="app__videos">
  
  <?php
  showError('post_vid');
  foreach($reels as $reel){
    $likes = getLikes($reel['id']);
    $comments = getComments($reel['id']);
    ?>
    <div class="video"> 
      <div class="videoHeader">
      <a class="nav-link text-white" style="z-index:10;" href="?"><i class="bi bi-house-fill" style="font-size: 25px;"></i></a>
        <h3 style="color:white;">کورتەکان</h3>
        <a class="nav-link text-white" style="z-index:10;" data-bs-toggle="modal" data-bs-target="#addreel" href="?shorts"><i class="bi bi-patch-plus-fill" style="font-size: 25px;"></i></a>
      </div>
       <video src="assets/images/reels/<?=$reel['reel_post']?>" class="video__player" ></video>

       <div class="videoFooter">
        <div class="videoFooter_text">
        <a href='?u=<?=$reel['username']?>' class="text-decoration-none text-white"> <img class="user__avatar" src="assets/images/profile/<?=$reel['profile_pic']?>" alt="">
          <h4><?=$reel['first_name'].' '.$reel['last_name']?><span class="bi bi-patch-check-fill" style="margin-left:5px; font-size:1rem; -webkit-text-stroke: 0.5px rgb(5, 0, 0);"></span></a>
          <?php if(checkFollowStatus($reel['id']) && $reel['user_id'] != $_SESSION['userdata']['id']){?><button class="followbtn" data-user-id='<?=$profile['id']?>' ><span id="boot-icon" class="bi bi-plus-lg" style="font-size: 18px; color: rgb(255, 255, 255); position:relative; top:1px; -webkit-text-stroke-width: 1px;"></span></button><?php } ?></h4>
        </div>
        <div class="videoFooter__ticker">
          <span class="txt"><?=$reel['reel_text']?></span>
        </div>
        <div class="videoFooter__actions">
        <span><span id="boot-icon" class="bi bi-heart-fill like_btn" style="font-size: 30px; color: rgb(255, 255, 255); -webkit-text-stroke: 3px rgb(5, 0, 0); margin-right:5px; display:<?=$like_btn_display?>" data-post-id='<?=$reel['id']?>'></span><span><?=count($likes)?></span></span>
            <span><i class="bi bi-chat-square-fill" style="font-size: 30px; color: rgb(255, 255, 255); -webkit-text-stroke: 3px rgb(5, 0, 0); " data-post-id='<?=$reel['id']?>'></i>
            </span>
        </div>
       </div>
      </div>
      <?php }
?>
  
</div>

<style>
  
*{
  margin: 0;
  box-sizing: border-box;
}
html{
  scroll-snap-type: y mandatory;
}
body{
  background-color: black;
  height: 100vh;
  display: grid;
  place-items: center;
}
.footer_bar{
  display: none !important;
}
.app__videos{
  position: relative;
  height: 100%;
  max-height: auto;
  background-color: black;
  overflow: scroll;
  width: 100%;
  max-width: 400px;
  scroll-snap-type: y mandatory;
}
.app__videos::-webkit-scrollbar{
  display: none;
}

.app__videos{
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.video{
  position: relative;
  height: 100%;
  width: 100%;
  background-color: black;
  scroll-snap-align: start;
}

.video__player{
  width: 100%;
  height: 100%;
}
.videoFooter{
  position: relative;
  bottom: 18%;
  margin-left: 20px;
}
.videoHeader{
  position: absolute;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.videoHeader * {
  padding: 20px;
}

.user__avatar{
  border-radius: 50%;
  width: 50px;
  height: 50px;
object-fit: cover;
box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
border:#ccc solid 2px;
}

.videoFooter_text{
position: absolute;
bottom: 0;
color: white;
display: flex;
align-items: center;
margin-bottom: 40px;
}

.videoFooter_text h4{
margin-left: 10px;
}
.videoFooter_text h4 button {
  color: white;
  height: 20px;
  width: 40px;
  text-transform: inherit;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  padding: 5px;
  -webkit-text-stroke: 2px rgb(0,0,0);
}
.videoFooter__ticker{
  width: 60%;
  margin-left: 30px;
  margin-bottom: 20px;
  height: fit-content;
}

.videoFooter__ticker .txt{
  font-size: 12px;
  padding-top: 7px;
  color: white;
  
}


.videoFooter__actions{
display: flex;
width: 95%;
position: absolute;
justify-content: space-between;
color: white;

}
.videoFooter__actionsLeft span{
  padding: 0 px;
  font-size: 1.6rem;
}

.videoFooter__actionsRight span{
  font-size: 25px;
}

.videoFooter__actionsRight{
  display: flex;
}
.videoFooter__stat {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.videoFooter__stat p{
  margin-left: 3px;
}
</style>
<script>
  const videos = document.querySelectorAll('video');

  for(const video of videos){
    video.addEventListener('click', function(){
      if(video.paused){
        video.play();
      }else{
        video.pause();
      }
    });
  }




</script>
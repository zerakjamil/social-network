<?php global $user;?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border w-100">
        <div class="container col-lg-9 col-sm-12 col-md-10 d-flex flex-lg-row flex-md-row flex-sm-column justify-content-between">
            <div class="d-flex justify-content-between col-lg-8 col-sm-12">
                <a class="navbar-brand" href="?">
                <h2 class="the_side_name" style="margin: 0; padding: 0; background-image: linear-gradient(to right, #000, #707070

); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">NETlink</h2>

                </a>
                <form class="d-flex" id="searchform">
                <input class="form-control me-2 col-lg-12"  type="search" id="search" placeholder="...گەڕان &#xF002;" style="text-align:right;font-family:Arial, FontAwesome; border-radius:2rem; "
                        aria-label="Search" autocomplete="off">
<div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" id="search_result" data-bs-auto-close="true">
<button type="button" class="btn-close" aria-label="Close" id="close_search"></button>
<div id="sra" class="text-center">
<h5> گەڕانەکانت <img src="images/recent2.png" style="height:26px; width:27px; margin-left:-2px; margin-top:-4px;"> </h5>
    <?php
    $recent = getRecentSearches();
    $displayed_values = array();
    if(count($recent)<1){
        ?>
    <p class="p-3 text-center my-2 nce">بگەرێ بە دوای هاورێکانت یانیش خەڵکانی کە  </p>
    <?php }
foreach($recent as $fuser){

    if(  in_array($fuser['search_id'], $displayed_values)) {
        $pdo = new PDO('mysql:host=localhost;dbname=netlink', 'root', '');
        $stmt = $pdo->prepare("DELETE FROM recent_searches WHERE search_id = ? AND created_at < ? AND user_id = ?");
        $stmt->execute([$fuser['search_id'], $fuser['created_at'], $fuser['user_id']]);
        continue;
    }
    $displayed_values[] = $fuser['search_id'];
    ?>
                                 <div class="d-flex align-items-center p-2 border-bottom" style="position:relative;" id="<?=$fuser['search_id']?>">
                                     <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" style=" width: 50px;
                                     height: 50px;
                                     object-fit: cover;
                                     border-radius: 50%;
                                     ">
                                     </div>
                                     <div>&nbsp;&nbsp;</div>
                                     <div class="d-flex flex-column justify-content-center">
                                         <a href="?u=<?=$fuser['username']?>" onclick="recentSearches(<?=$fuser['first_name'].' '.$fuser['last_name']?> , <?=$fuser['id']?>)" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$fuser['first_name'].' '.$fuser['last_name']?></h6></a>
                                         <p style="margin:0px;font-size:small" class="text-muted">@<?=$fuser['username']?></p>
                                     </div>
                                     <div class="d-flex align-items-center" style="position:absolute; right:0%;">
                                  <button type="button" id="delete_search" class="btn-close" onclick = "deleteSearches(<?=$fuser['search_id']?>)"></button>
             
                                 </div>
                                 </div>
                                 
                                 <?php } ?>
                             
</div>
</div>
                </form>

            </div>
            <ul class="navbar-nav flex-fill flex-row justify-content-evenly mb-lg-1 mb-sm-0" id="nav">
            <li class="nav-item dropdown dropstart">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;
">
                    </a>
                    <ul class="dropdown-menu position-absolute top-100 end-50" aria-labelledby="navbarDropdown" id="navbarDropdown">
                    <li style="text-align:right;"><a class="dropdown-item" href="?u=<?=$user['username']?>"> پرۆفایلەکەم <i class="bi bi-person-circle"></i></a></li>

                        <li style="text-align:right;"><a class="dropdown-item" href="?editprofile"> رێکخستنەکان <i class="uil uil-setting"></i></a></li>
                        <li style="text-align:right;"><a class="dropdown-item" href="?news"> هەواڵەکان <i class="bi bi-newspaper"></i></a>
                    </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li style="text-align:right;"><a class="dropdown-item" href="assets/php/actions.php?logout"><i class="bi bi-box-arrow-in-left"></i> چوونەدەرەوە</a></li>
                    </ul>
                </li>
            </ul>

            <!---  icons   ---->
            <div class="nav__menu" id="nav-menu">
            <ul class="navbar-nav flex-fill flex-row justify-content-evenly mb-lg-1 mb-sm-0" id="nav">

                <li class="nav-item active-link" id="home">
                    <a class="nav-link text-dark" href="?"><img src="images/home-icon.svg" style="height:27px; width:27px;" alt=""></a>
                </li>

                <li class="nav-item" id="market">
                <a class="nav-link text-dark" href="?market">
    <img src="images/go-to-store-icon.svg" style="height:30px; width:30px;" alt="">
  </a></li>

                <li class="nav-item" id="reels">
                <a class="nav-link text-dark" href="?shorts"><img src="images/video-icon.svg" style="height:25px; width:25px;" alt=""></i></a>
                </li>

                <li class="nav-item" id="addposttt">
                    <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addpost" href="#">
                <button class="icon-btn add-btn">
                <div class="add-icon"></div>
    <div class="btn-txt">زیادکردنی پۆست</div>
</button>
                </a>
                </li>

                <li class="nav-item" id="suggest">
                <?php
if(getUnreadRequestCount()>0){
    ?>
                <a class="nav-link" id="show_noti" data-bs-toggle="offcanvas" href="#suggetion_sidebar" role="button" aria-controls="offcanvasExample">
                <img src="images/add-member-icon.svg" style="height:27px; width:27px;" alt="">
                    <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
   <small><?=getUnreadRequestCount()?></small>
  </span>
</a>
<?php
}else{
    ?>
  <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#suggetion_sidebar" role="button" aria-controls="offcanvasExample"> <img src="images/add-member-icon.svg" style="height:27px; width:27px;" alt=""></a>
    <?php
}
                    ?>
                </li>


                <li class="nav-item" id="addpostt">
                    <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><img src="images/add-icon.svg" style="height:25px; width:25px;" alt=""></a>
                </li>
                

   
                <!---- real noti--->
                <li class="nav-item" id="notification">
                  
                    <?php
if(getUnreadNotificationsCount()>0){
    ?>
 <a class="nav-link text-dark position-relative" id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
 <img src="images/notification-bell-icon.svg" style="height:25px; width:25px;" alt="">
  <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
   <small><?=getUnreadNotificationsCount()?></small>
  </span>
</a>

    <?php
}else{
    ?>
  <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample"><img src="images/notification-bell-icon.svg" style="height:25px; width:25px;" alt=""></a>
    <?php
}
                    ?>
                   

                </li>


                <li class="nav-item" id="message_side" >
                    <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#message_sidebar" href="#"><img src="images/chat-box-icon.svg" alt="" style="height:25px; width:25px;"></i> 
                     <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounter">

  </span></a>
                </li>
                

            </ul>
</div>

        </div>
    </nav>

    <style>
        
        .navbar{
position:sticky;
  position:-webkit-sticky;
  top:0px; z-index: 10;
}
#search{
    width:450px; max-width:100%;
}
#search_result{
    display:none;
    position:absolute;
    z-index:+99; 
    width:450px;
}
.icon-btn {
  width: 50px;
  height: 50px;
  border: 1px solid #cdcdcd;
  background: white;
  border-radius: 25px;
  overflow: hidden;
  position: relative;
  transition: width 0.2s ease-in-out;
  font-weight: 500;
  font-family: inherit;
}

.add-btn:hover {
  width: 155px;
}

.add-btn::before,
.add-btn::after {
  transition: width 0.2s ease-in-out, border-radius 0.2s ease-in-out;
  content: "";
  position: absolute;
  height: 4px;
  width: 10px;
  top: calc(50% - 2px);
  background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
}

.add-btn::after {
  right: 14px;
  overflow: hidden;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
}

.add-btn::before {
  left: 14px;
  border-top-left-radius: 2px;
  border-bottom-left-radius: 2px;
}

.icon-btn:focus {
  outline: none;
}

.btn-txt {
  opacity: 0;
  transition: opacity 0.2s;
}

.add-btn:hover::before,
.add-btn:hover::after {
  width: 4px;
  border-radius: 2px;
}

.add-btn:hover .btn-txt {
  opacity: 1;
}

.add-icon::after,
.add-icon::before {
  transition: all 0.2s ease-in-out;
  content: "";
  position: absolute;
  height: 20px;
  width: 2px;
  top: calc(50% - 10px);
  background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  overflow: hidden;
}

.add-icon::before {
  left: 22px;
  border-top-left-radius: 2px;
  border-bottom-left-radius: 2px;
}

.add-icon::after {
  right: 22px;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
}

.add-btn:hover .add-icon::before {
  left: 15px;
  height: 4px;
  top: calc(50% - 2px);
}

.add-btn:hover .add-icon::after {
  right: 15px;
  height: 4px;
  top: calc(50% - 2px);
}
@media (min-width: 1017px) {
.header__wrapper .cols__container .left__col {
margin: 0;
margin-right: auto;
}
.header__wrapper .cols__container .right__col nav {
flex-direction: row;
}
.header__wrapper .cols__container .right__col nav button {
margin-top: 0;
}
}


@media screen and (max-width: 994px) {
  .nav__menu {
    position: fixed;
    bottom: 0;
    left: 0;
    background-color: var(--container-color);
    box-shadow: 0 -1px 12px hsla(var(--hue), var(--sat), 15%, 0.15);
    width: 100%;
    height: 4rem;
    padding: 0 1rem;
    display: grid;
    align-content: center;
    border-radius: 1.25rem 1.25rem 0 0;
    transition: .4s;
    z-index: 10;
    font-size: 1.3rem;
  }
 .btn-1{
  position:relative; 
  left:110px; 
  top:8px;
 }
/*Active link*/
.active-link {
  position: relative;
  color: var(--first-color);
  transition: .3s;
}
#search{
    width:auto;
}
#search_result{
    display:none;
    position:absolute;
    z-index:+99; 
    width:auto;
}
}
    </style>
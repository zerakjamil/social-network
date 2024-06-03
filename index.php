<?php
require_once 'assets/php/functions.php';
$admin = maintenance();
if(isset($_GET['newfp'])){
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if(isset($_GET['newsv'])){
    unset($_SESSION['auth_temp']);
    unset($_SESSION['verify_acc']);
    unset($_SESSION['verify_code']);
}
if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['userdata']['id']);
    $market = getMarket($_SESSION['userdata']['id']);
    $posts = filterPosts();
    $stories = filterstories();
    $follow_suggestions = filterFollowSuggestion();
    $follow_suggestionsb = filterFollowSuggestionb();
    $request = filterReq();
    $reels = getReels();
    $reports =  reportPosts();
    $ip_address = getIpAddr();
    //$device = getDevice($_SESSION['userdata']['id'],$_SERVER['HTTP_USER_AGENT'],$ip_address);
}

$pagecount = count($_GET);

if($admin['m_mode'] == 1){
    if(isset($_SESSION['Auth'])){
    session_unset();
     session_destroy();
    showPage('maintenance');
    }
    showPage('header',['page_title'=>'دۆخی چاکسازی']);
    showPage('maintenance');
}

//manage pages
if(isset($_SESSION['Auth']) && $user['ac_status']==1 && $user['twoStep']==0 && !$pagecount){
    showPage('header',['page_title'=>'ماڵەوە']);
    showPage('navbar');
    showPage('wall');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && $user['ac_status']==0 && !$pagecount){

    showPage('header',['page_title'=>'سەلماندنی ئیمەیڵ']);
    showPage('verify_email');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && $user['ac_status']==3 && !$pagecount){
    showPage('header',['page_title'=>'سەلماندنی ژمارە']);
    showPage('verify_phone');
   
}elseif(isset($_SESSION['Auth']) && $user['ac_status']==1 && $user['twoStep']==1 && !$pagecount){
    if(!empty($device)){
        showPage('header',['page_title'=>'ماڵەوە']);
        showPage('navbar');
        showPage('wall');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
          
        }
}elseif(isset($_SESSION['Auth']) && $user['twoStep']==1 && !$pagecount){
    showPage('header',['page_title'=>'سەلماندنی ژمارە']);
    showPage('verify_phone');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && $user['ac_status']==2 && !$pagecount){
    showPage('header',['page_title'=>'هەڵپەساردرا']);
    showPage('blocked');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'ڕێکخستنەکان']);
    showPage('navbar');
    showPage('edit_profile');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'ڕێکخستنەکان']);
        showPage('navbar');
        showPage('edit_profile');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
          
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['shorts']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'کورتەکان']);
    showPage('reels');
}elseif(isset($_SESSION['Auth']) && isset($_GET['shorts']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'کورتەکان']);
        showPage('reels');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['editmarket']) && $user['twoStep']==0 && $user['ac_status']==1){

    showPage('header',['page_title'=>'ڕێکخستنی کۆگا']);
    showPage('market_navbar');
    showPage('market_settings');
    showPage('footer_bar');
   
}elseif(isset($_SESSION['Auth']) && isset($_GET['editmarket']) && $user['twoStep']==1 && $user['ac_status']==1){

    if(!empty($device)){
        showPage('header',['page_title'=>'ڕێکخستنی کۆگا']);
        showPage('market_navbar');
        showPage('market_settings');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
   
}elseif(isset($_SESSION['Auth']) && isset($_GET['market']) && $user['twoStep']==0 && $user['ac_status']==1){

        showPage('header',['page_title'=>'مارکێت']);
        showPage('market_navbar');
        showPage('market');
        showPage('footer_bar');
       
}elseif(isset($_SESSION['Auth']) && isset($_GET['market']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'مارکێت']);
        showPage('market_navbar');
        showPage('market');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['market_create']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'درووستکردنی فرۆشگا']);
    showPage('market_create');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['market_create']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'درووستکردنی فرۆشگا']);
        showPage('market_create');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['news']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'news']);
    showPage('test');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['news']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'news']);
        showPage('test');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['snake']) && $user['ac_status']==1){
    showPage('header',['page_title'=>'یاری مارەکە']);
    showPage('navbar');
    showPage('snake_game');
}elseif(isset($_SESSION['Auth']) && isset($_GET['postview']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'پۆست']);
    showPage('postview');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['postview']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'پۆست']);
        showPage('postview');
        showPage('footer_bar');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
           
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['messenger']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'نامەکان']);
    showPage('navbar');
    showPage('messenger');
    showPage('footer_bar');
}elseif(isset($_SESSION['Auth']) && isset($_GET['messenger']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'نامەکان']);
        showPage('navbar');
        showPage('messenger');
        
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['market_view']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        if (isset($market)) {
            showPage('header', ['page_title' => 'پۆست']);
            showPage('market_navbar');
            showPage('market_item_view');
            showPage('footer_bar');
        }else{
            showPage('header',['page_title'=>'درووستکردنی فرۆشگا']);
            showPage('market_create');
            showPage('footer_bar');
        }
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
         
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['market_view']) && $user['twoStep']==0 && $user['ac_status']==1){
    if (isset($market)) {
        showPage('header', ['page_title' => 'پۆست']);
        showPage('market_navbar');
        showPage('market_item_view');
        showPage('footer_bar');
    }else{
        showPage('header',['page_title'=>'درووستکردنی فرۆشگا']);
        showPage('market_create');
        showPage('footer_bar');
    }
}elseif(isset($_SESSION['Auth']) && isset($_GET['u']) && $user['twoStep']==0 &&  $user['ac_status']==1){
    $profile = getUserByUsername($_GET['u']);
    if(!$profile){
        showPage('header',['page_title'=>'هیچ بەکارهێنەرێک نەدۆزرایەوە بەو ناوە']);
        showPage('navbar');
        showPage('user_not_found');
        showPage('footer_bar');
    }else{
     $profile_post = getPostById($profile['id']);
     $reels_post = getReelsById($profile['id']);  
     $profile['followers']=getFollowers($profile['id']);
     $profile['following']=getFollowing($profile['id']);
        showPage('header',['page_title'=>$profile['first_name'].' '.$profile['last_name']]);
        showPage('navbar');
        showPage('newpro');
        showPage('footer_bar');
    }
 
  
}elseif(isset($_SESSION['Auth']) && isset($_GET['u']) && $user['twoStep']==1 &&  $user['ac_status']==1){
    if(!empty($device)){
        $profile = getUserByUsername($_GET['u']);
        if(!$profile){
            showPage('header',['page_title'=>'هیچ بەکارهێنەرێک نەدۆزرایەوە بەو ناوە']);
            showPage('navbar');
            showPage('user_not_found');
            showPage('footer_bar');
        }else{
         $profile_post = getPostById($profile['id']);
         $reels_post = getReelsById($profile['id']);  
         $profile['followers']=getFollowers($profile['id']);
         $profile['following']=getFollowing($profile['id']);
            showPage('header',['page_title'=>$profile['first_name'].' '.$profile['last_name']]);
            showPage('navbar');
            showPage('newpro');
            showPage('footer_bar');
        }
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
         
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['twostepverification']) && $user['twoStep']==0 && $user['ac_status']==1){
    showPage('header',['page_title'=>'پشتراستکردنەوەی دوو هەنگاوی']);
    showPage('step_verification');
}elseif(isset($_SESSION['Auth']) && isset($_GET['twostepverification']) && $user['twoStep']==1 && $user['ac_status']==1){
    if(!empty($device)){
        showPage('header',['page_title'=>'پشتراستکردنەوەی دوو هەنگاوی']);
        showPage('step_verification');
        } 
        if (empty($device)) {
            showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
            showPage('step_veerify');
            
        }
}elseif(isset($_SESSION['Auth']) && isset($_GET['m']) && $user['twoStep']==0 && $user['ac_status']==1){
        $market_m = getMarket($_GET['m']);
        if(!$market_m){
            showPage('header',['page_title'=>'هیچ فرۆشگایەک نەدۆزرایەوە بەو ناوە']);
            showPage('market_navbar');
            showPage('user_not_found');
            showPage('footer_bar');
        }else{ 
        showPage('header',['page_title'=>$market_m['name']]);
        showPage('market_navbar');
        showPage('market_item_view');
        showPage('footer_bar');
    }
}elseif(isset($_SESSION['Auth']) && isset($_GET['m']) && $user['twoStep']==1 && $user['ac_status']==1){
if(!empty($device)){
    $market_m = getMarket($_GET['m']);
    if(!$market_m){
        showPage('header',['page_title'=>'هیچ فرۆشگایەک نەدۆزرایەوە بەو ناوە']);
        showPage('market_navbar');
        showPage('user_not_found');
        showPage('footer_bar');
    }else{ 
    showPage('header',['page_title'=>$market_m['name']]);
    showPage('market_navbar');
    showPage('market_item_view');
    showPage('footer_bar');
}
    } 
    if (empty($device)) {
        showPage('header', ['page_title' => 'پشتراستکردنەوەی دوو هەنگاوی']);
        showPage('step_veerify');
        
    }
}elseif(isset($_GET['signup'])){
    showPage('header',['page_title'=>'خۆتۆمارکردن']);
    showPage('signup');
}elseif(isset($_GET['contact'])){
    showPage('header',['page_title'=>'پەیوەندی کردن']);
    showPage('contact');
}elseif(isset($_GET['terms'])){
    showPage('header',['page_title'=>'مەرجەکانی بەکارهێنان']);
    showPage('terms');
}elseif(isset($_GET['success'])){
    showPage('header',['page_title'=>'نێردرا']);
    showPage('success');
}elseif(isset($_GET['login'])){
    showPage('header',['page_title'=>'چوونەژوورەوە']);
    showPage('login');
}elseif(isset($_GET['forgotpassword'])){
    
    showPage('header',['page_title'=>'لەبیرچوونەوەی تێپەرەوشە']);
    showPage('forgot_password');
}else{
    if(isset($_SESSION['Auth']) && $user['ac_status']==1){
        showPage('header',['page_title'=>'ماڵەوە']);
        showPage('navbar');
        showPage('wall');
            
    }elseif(isset($_SESSION['Auth']) && $user['ac_status']==0){

        showPage('header',['page_title'=>'ئیمەڵەکەت بسەلمینە']);
        showPage('verify_email');
    }elseif(isset($_SESSION['Auth']) && $user['ac_status']==2){
        showPage('header',['page_title'=>'هەلپەساردرای']);
        showPage('blocked');
    }elseif(isset($_SESSION['Auth']) && $user['ac_status']==3){
        showPage('header',['page_title'=>'ژمارەکەت بسەلمینە']);
        showPage('verify_phone');
    }elseif($admin['m_mode']!=1){
        showPage('header',['page_title'=>'چوونەژوورەوە']);
        showPage('login');
    }
  
}



showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);
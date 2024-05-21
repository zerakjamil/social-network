<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("داتابەیەیس گرێنەدراوە");
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//function for showing pages
function showPage($page,$data=""){
include("assets/pages/$page.php");
}

// for editing post text
function editpost($post_id,$response){
    global $db;
    $posts_id = $post_id;
    $post_text =$response['new_post_text'];
        $query = "SELECT post_text FROM posts WHERE id = '$posts_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $old_text = $row['post_text'];
        if ($post_text != $old_text) {
            $post_text; 
        }
        $query = "UPDATE posts SET post_text = '$post_text' WHERE id = '$posts_id'";
    mysqli_query($db, $query);
return $post_text;

}
function contactUs($name,$email,$msg){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
    $msg_name = mysqli_real_escape_string($db,$name);
    $msg_email = mysqli_real_escape_string($db,$email);
    $messagee = mysqli_real_escape_string($db,$msg);
    $msg_name = strip_tags($msg_name,$allowed_tags);
    $msg_email = strip_tags($msg_email,$allowed_tags);
    $message = strip_tags($messagee,$allowed_tags);
    $query = "INSERT INTO conatc_us (name,email,message,submit) VALUES('$msg_name','$msg_email','$message',1)";
    return mysqli_query($db,$query);
}

function reportPost($reporter_id,$post_id,$reason,$report_msg){
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "INSERT INTO reports (user_id,reporter_id,post_id,description,reason) VALUES('$user_id','$reporter_id','$post_id','$report_msg','$reason')";
    return mysqli_query($db,$query);
}
//for seeing a chat
function seenChat($chat_id,$response,$current_id){
    global $db;
        $query = "UPDATE messages SET seenBy = '$response' WHERE (to_user_id = '$current_id' AND from_user_id = '$chat_id')";
   
        return mysqli_query($db, $query);
}

function seenChatSelect($chat_id){
    global $db;
    $current_id = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM messages WHERE (to_user_id = '$chat_id' AND from_user_id = '$current_id') LIMIT 1";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
       $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
       $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
       $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
   return $ipAddr;
}

//for getting ids of chat users
function getActiveChatUserIds(){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=$current_user_id || from_user_id=$current_user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    $data =  mysqli_fetch_all($run,true);
    $ids=array();
    foreach($data as $ch){
    if($ch['from_user_id']!=$current_user_id && !in_array($ch['from_user_id'],$ids)){
       $ids[]=$ch['from_user_id'];
    }

    if($ch['to_user_id']!=$current_user_id && !in_array($ch['to_user_id'],$ids)){
        $ids[]=$ch['to_user_id'];
     }

    }

    return $ids;
}

function getMessages($user_id){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM messages WHERE (to_user_id=$current_user_id && from_user_id=$user_id) || (from_user_id=$current_user_id && to_user_id=$user_id) ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return  mysqli_fetch_all($run,true);
}

function sendMessage($user_id,$msg){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
    $msg = mysqli_real_escape_string($db,$msg);
    $msg = strip_tags($msg,$allowed_tags);
    $query = "INSERT INTO messages (from_user_id,to_user_id,msg) VALUES($current_user_id,$user_id,'$msg')";
    return mysqli_query($db,$query);

}

function newMsgCount(){
global $db;
$current_user_id = $_SESSION['userdata']['id'];
$query="SELECT COUNT(*) as row FROM messages WHERE to_user_id=$current_user_id && read_status=0";
$run=mysqli_query($db,$query);
return mysqli_fetch_assoc($run)['row'];
}

function last_seen($date_time){

    $timestamp = strtotime($date_time);	
    
    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");
  
    $currentTime = time();
    if($currentTime >= $timestamp) {
     $diff     = time()- $timestamp;
     for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
     $diff = $diff / $length[$i];
     }
  
     $diff = round($diff);
     if ($diff < 59 && $strTime[$i] == "second") {
       return 'Active';
     }else {
       return $diff . " " . $strTime[$i] . "(s) ago ";
     }
     
    }
  }

function updateMessageReadStatus($user_id){
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query="UPDATE messages SET read_status=1 WHERE to_user_id=$cu_user_id && from_user_id=$user_id";
    return mysqli_query($db,$query);
}

function gettime($date){
    return date('H:i - F jS, Y ', strtotime($date));
}
function gettimeA($date){
    return date('H:i - F jS, ', strtotime($date));
}
function gettimeB($date){
    return date('F jS, Y', strtotime($date));
}
function gettimeC($date){
    return date('H:i', strtotime($date));
}
function getAllMessages(){
    $active_chat_ids = getActiveChatUserIds();
    $conversation=array();
    foreach($active_chat_ids as $index=>$id){
        $conversation[$index]['user_id'] = $id;
        $conversation[$index]['messages'] = getMessages($id);
    }
    return $conversation;
}

//function for follow the user
function followUser($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO follow_list(follower_id,user_id) VALUES($current_user,$user_id)";
    createNotification($cu['id'],$user_id,"شوێن تۆکەوت");
    return mysqli_query($db,$query);
    
}
//toaccept a request
function acceptUser($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="UPDATE follow_list SET status='' WHERE user_id=$current_user";
    createNotification($cu['id'],$user_id,"داواکەی تۆی قەبووڵ کرد");
    return mysqli_query($db,$query);
    
}
function declineUser(){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM follow_list WHERE user_id=$current_user";

    return mysqli_query($db,$query);
}

//function for blocking the user
function blockUser($blocked_user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO block_list(user_id,blocked_user_id) VALUES($current_user,$blocked_user_id)";
    $query2="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$blocked_user_id";
    mysqli_query($db,$query2);
    $query3="DELETE FROM follow_list WHERE follower_id=$blocked_user_id && user_id=$current_user";
    mysqli_query($db,$query3);

   
    return mysqli_query($db,$query);
    
}

//for unblocking the user
function unblockUser($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    return mysqli_query($db,$query);   
}

//function checkLikeStatus
function checkLikeStatus($post_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM likes WHERE user_id=$current_user && post_id=$post_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

function checkLikeStatusC($comment_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM comment_likes WHERE user_id=$current_user && comment_id=$comment_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}
//function for like the post
function like($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO likes(post_id,user_id) VALUES($post_id,$current_user)";
   $poster_id = getPosterId($post_id);
   
   if($poster_id!=$current_user){
    createNotification($current_user,$poster_id,"پۆستەکەی تۆی بە دڵە",$post_id);
   }
    return mysqli_query($db,$query);
    
}

//liking comments
function likeC($comment_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO comment_likes(comment_id,user_id) VALUES($comment_id,$current_user)";
   $poster_id = getPosterIdC($comment_id);
   
   if($poster_id!=$current_user){
    createNotification($current_user,$poster_id,"سەرنجەکەی تۆی بەدڵە",$comment_id);
   }
    return mysqli_query($db,$query);
    
}


//function for creating comments
function addComment($post_id,$comment){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
 $comment = mysqli_real_escape_string($db,$comment);
 $comment = strip_tags($comment,$allowed_tags);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO comments(user_id,post_id,comment) VALUES($current_user,$post_id,'$comment')";
    $poster_id = getPosterId($post_id);

    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"لێدوانی لەسەر پۆستەکەی تۆ دا",$post_id);
    }
   

    return mysqli_query($db,$query);
    
}

function addReply($post_id,$comment_id,$reply){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
 $reply = mysqli_real_escape_string($db,$reply);
 $reply = strip_tags($reply,$allowed_tags);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO replies(user_id,comment_id,post_id,reply) VALUES('$current_user','$comment_id','$post_id','$reply')";
    $poster_id = getPosterId($post_id);

    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"لێدوانی لەسەر پۆستەکەی تۆ دا",$post_id);
    }
   

    return mysqli_query($db,$query);
    
}
//function for creating comments
function createNotification($from_user_id,$to_user_id,$msg,$post_id=0,$comment_id=0){
    global $db;
    $query="INSERT INTO notifications(from_user_id,to_user_id,message,post_id,comment_id) VALUES($from_user_id,$to_user_id,'$msg',$post_id,$comment_id)";
    mysqli_query($db,$query);    
}

//to fix phone number
function filterInputValue($input) {
    if (preg_match('/^0\d/', $input)) {
      return substr($input, 1);
    }
    return $input;
  }



//function for getting likes count
function getComments($post_id){
    global $db;
    $query="SELECT * FROM comments WHERE post_id=$post_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function getReplies($comment_id){
    global $db;
    $query="SELECT * FROM replies WHERE comment_id=$comment_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get notifications

function getNotifications(){
  $cu_user_id = $_SESSION['userdata']['id'];

    global $db;
    $query="SELECT * FROM notifications WHERE to_user_id=$cu_user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}


function getUnreadNotificationsCount(){
    $cu_user_id = $_SESSION['userdata']['id'];
  
      global $db;
      $query="SELECT count(*) as row FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
      $run = mysqli_query($db,$query);
      return mysqli_fetch_assoc($run)['row'];
  }

  function show_time($time){
    return '<time style="font-size:small" class="timeago text-muted text-small" datetime="'.$time.'"></time>';
  }

  function setNotificationStatusAsRead(){
       $cu_user_id = $_SESSION['userdata']['id'];
      global $db;
      $query="UPDATE notifications SET read_status=1 WHERE to_user_id=$cu_user_id";
      return mysqli_query($db,$query);
  }



//function for getting likes count
function getLikes($post_id){
    global $db;
    $query="SELECT * FROM likes WHERE post_id=$post_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function getLikesC($comment_id){
    global $db;
    $query="SELECT * FROM comment_likes WHERE comment_id=$comment_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}


//function for unlike the post
function unlike($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM likes WHERE user_id=$current_user && post_id=$post_id";
    
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"!بەدڵبوونی سەر پۆستەکەی تۆی لادا",$post_id);
    }
  
    return mysqli_query($db,$query);
}

function unlikeC($comment_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM comment_likes WHERE user_id=$current_user && comment_id=$comment_id";
    return mysqli_query($db,$query);
}
function unfollowUser($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";

    createNotification($current_user,$user_id,"تۆی لە شوێنکەوتنەکانی لادا");
    return mysqli_query($db,$query);
 
    
}

function CancelFollow($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id && status = 'p'";

    return mysqli_query($db,$query);
}


//function for show errors
function showError($field){
    if(isset($_SESSION['error'])){
        $error =$_SESSION['error'];
        if(isset($error['field']) && $field==$error['field']){
           ?>
    <div class="alert alert-danger my-2" style="text-align: center; border-radius: 15px;" role="alert">
      <?=$error['msg']?>
    </div>
           <?php
        }
    }
    }


//function for show prevformdata
function showFormData($field){
    if(isset($_SESSION['formdata'])){
        $formdata =$_SESSION['formdata'];
        return $formdata[$field];
    }
 
}


//for checking duplicate email
function isEmailRegistered($email){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}



function isPhoneRegistered($phone){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE phone='$phone'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
function isMarketRegistered($user){
    global $db;
    $query="SELECT count(*) as row FROM marke_user WHERE user_id='$user'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for checking duplicate username
function isUsernameRegistered($username){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE username='$username'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for checking duplicate username by other
function isUsernameRegisteredByOther($username){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM users WHERE username='$username' && id!=$user_id";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
// form blocked accounts showing lists
function isBlocked($user){
    global $db;
    $query="SELECT count(*) as row FROM block_list WHERE user_id = '$user'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
    
}
function isNotified($user){
    global $db;
    $query="SELECT count(*) as row FROM notifications WHERE to_user_id = '$user'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
    
}
//for validating the signup form
function validateSignupForm($form_data){
$response=array();
$response['status']=true;
  
    if(!$form_data['password']){
        $response['msg']="تێپەرەوشە دانەنراوە";
        $response['status']=false;
        $response['field']='password';
    }
    if (strlen($form_data['password']) < 10){
        $response['msg']="تێپەرەوشەکەت نابێ لە 10 وشە کەمتر بێ";
        $response['status']=false;
        $response['field']='password';
    }
    if (!preg_match('/[A-Z]/', $form_data['password'])){
        $response['msg']="تێپەڕە وشەکەت لاوازە بە لانی کەم یەک وشەی کاپیتاڵی ئینگلیزی بخە ناوی";
        $response['status']=false;
        $response['field']='password';
    }
    elseif (!preg_match('/\d/', $form_data['password'])){
        $response['msg']="تێپەڕە وشەکەت لاوازە بە لانی کەم یەک ژمارە بخە ناوی";
        $response['status']=false;
        $response['field']='password';
    }
    elseif(!$form_data['username']){
        $response['msg']="ناویبەکارهێنەر دانەنراوە";
        $response['status']=false;
        $response['field']='username';
    }
    if(!$form_data['phone']){
        $response['msg']="ژمارەکەی تەلەفۆن دانەنراوە";
        $response['status']=false;
        $response['field']='phone';
    }
    
    if(!$form_data['username_email']){
        $response['msg']="ئیمەیڵ دانەنراوە";
        $response['status']=false;
        $response['field']='email';
    }
    
    if(!$form_data['last_name']){
        $response['msg']="ناوی دووەم دانەنراوە";
        $response['status']=false;
        $response['field']='last_name';
    }
    if(!$form_data['first_name']){
        $response['msg']="ناوی یەکەم دا نەنراوە";
        $response['status']=false;
        $response['field']='first_name';
    }
    if(isEmailRegistered($form_data['username_email'])){
        $response['msg']="ئەم ئیمەیڵە پێشتر تۆمارکراوە";
        $response['status']=false;
        $response['field']='email';
    } 
    if(isPhoneRegistered($form_data['phone'])){
        $response['msg']="ئەم ژمارەیە پێشتر تۆمارکراوە";
        $response['status']=false;
        $response['field']='phone';
    }
    if(isUsernameRegistered($form_data['username'])){
        $response['msg']="ئەم ناوی بەکارهێنەرە پێشتر تۆمارکراوە";
        $response['status']=false;
        $response['field']='username';
    }

    return $response;

}

function validateSform($data,$code){
    global $db;
  $response=array();
  $response['status']=true;

if(!$data['password']){  
  $response['msg']="تێپەرەوشە دانەنراوە";
  $response['status']=false;
  $response['field']='password';  
}elseif(md5($data['password']) != $_SESSION['userdata']['password']){
    $response['msg']="تێپەرەوشە هەڵەیە";
    $response['status']=false;
    $response['field']='password'; 
  }

if ($code != $data['code']){
    $response['msg']='کۆدی سەلماندن هەڵەیە';
    $response['status']=false;
    $response['field']='phone_verify'; 
}
if(!$data['code']){
    $response['msg']='تکایە شەش ژمارە داخیل بکە';
    $response['status']=false;
    $response['field']='phone_verify'; 
   }
return $response;
}

function validateMarketForm($data,$image_data){
    $response=array();
    $response['status']=true;
      
        if(!$data['marketName']){
            $response['msg']="ناوێک بۆ فرۆشگاکەت هەڵبژێرە";
            $response['status']=false;
            $response['field']='marketName';
        }
       
        if(!$data['location']){
            $response['msg']="تکایە ناونیشانی فرۆشگا یان خۆت دابنێ";
            $response['status']=false;
            $response['field']='location';
        }
        if(!$data['market_text']){
        $response['msg'] = "تکایە وەسفی فرۆشگاکەت بکە";
            $response['status']=false;
            $response['field']='market_text';
        }
        
        if(isMarketRegistered($_SESSION['userdata']['id'])){
            $response['msg']="تۆ خاوەنی فرۆشگای تکایە فرۆشگای ئێستات بسرەوە ئینجا هەوڵبدەوە";
            $response['status']=false;
            $response['field']='marketName';
        }

        if($image_data['name']){
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            $size = $image_data['size']/4000;
 
            if($type!='jpg' && $type!='jpeg' && $type!='png'){
             $response['msg']="تەنها وێنەی جۆری jpg,jpeg,png رێگە پێدراون";
             $response['status']=false;
             $response['field']='marketPic';
         }
 
         if($size>4000){
             $response['msg']="قەبارەی وێنەکەت مەرجە لە ٤ مێگا بایت کەمتر بێ";
             $response['status']=false;
             $response['field']='marketPic';
         }
        }
        return $response;
    
}
//validating contact form
function validateContactForm($name,$email,$msg){
    $response=array();
    $response['status']=true;
      
        if(!$name){
            $response['msg']="ناو دانەنراوە";
            $response['status']=false;
            $response['field']='contact_name';
        }
       
        if(!$email){
            $response['msg']="ئیمەیڵ دانەنراوە";
            $response['status']=false;
            $response['field']='contact_email';
        }
        if(!$msg){
            $response['msg']=" نامە نابێ بەتاڵ بێ";
            $response['status']=false;
            $response['field']='contact_message';
        }
        return $response;
    
    }

//for validate the login form
function validateLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank=false;
      
        if(!$form_data['password']){
            $response['msg']="تێپەرەوشە نەدراوە";
            $response['status']=false;
            $response['field']='password';
            $blank=true;
        }
       
        if(!$form_data['username_email']){
            $response['msg']="ناوی بەکارهێنەر/ئیمەیڵ نابێ بەتاڵ بێ";
            $response['status']=false;
            $response['field']='username_email';
            $blank=true;
        }

        if(checkLockStatus($form_data['username_email'])){
            $response['msg']=" ئەم ئەکاونتە قفڵ بووە ، تکایە دواتر هەوڵبدەوە ";
            $response['status']=false;
            $response['field']='password';
        }

        if(!$blank && !checkUser($form_data)['status'] ){
            $response['msg']="هەڵەیەک هەیە ناتوانین تۆ بدۆزینەوە";
            $response['status']=false;
            $response['field']='checkuser';
        }else{
            $response['user']=checkUser($form_data)['user'];
        }
    
        return $response;
    
    }

    function unlockExpiredAccounts() {
        global $db;
        
        $currentTime = time();
        $currentTimeFormatted = date('Y-m-d H:i:s', $currentTime);
        
        $query = "UPDATE users SET locked = 0, locked_until = NULL WHERE locked_until IS NOT NULL AND locked_until <= '$currentTimeFormatted'";
        return mysqli_query($db, $query);
    }

    function validateLoginFormA($form_data){
        $responsee=array();
        $responsee['status']=true;

            if(!checkUser($form_data)['status'] ){
                $responsee['msg']="هەڵەیەک هەیە ناتوانین تۆ بدۆزینەوە";
                $responsee['status']=false;
                $responsee['field']='checkuser';
            }else{
                $responsee['user']=checkUser($form_data)['user'];
            }
        
            return $responsee;
        
        }
function checkLockStatus($username){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE username = '$username' and locked = 1";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
        
//for checking the user
function checkUser($login_data){
    global $db;
    $username_email = $login_data['username_email'];
    $password = md5($login_data['password']);
    
    $query = "SELECT * FROM users WHERE (email=? OR username=?) AND password=?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username_email, $username_email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data['user'] = mysqli_fetch_assoc($result) ?? array();    
 if(count($data['user'])>0){
     $data['status']=true;
 }else{
    $data['status']=false;

 }
 return $data;
}


//for getting userdata by id
function getUser($user_id){
    global $db;
 $query = "SELECT * FROM users WHERE id=$user_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);

}

//for cheking login details
function loginAttempts($time,$ip_address,$username){
    global $db;
    $query = "select count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address' and user_id = '$username' ";
    $query=mysqli_query($db,$query);
    $check_login_row=mysqli_fetch_assoc($query);
    return $check_login_row['total_count'];
}
function addingLoginAttempts($username,$ip_address){
    global $db;
    $try_time=time();
    $username = mysqli_real_escape_string($db,$username);
    $query = "insert into loginlogs(user_id,IpAddress,TryTime) values('$username','$ip_address','$try_time')";
    return mysqli_query($db,$query);
}
function lockAccount($username){
    global $db;
    $lockoutDuration = 30 * 60;
    $lockoutUntil = time() + $lockoutDuration;
    $username = mysqli_real_escape_string($db,$username);
    $lockoutUntilFormatted = date('Y-m-d H:i:s', $lockoutUntil);
    $query = "UPDATE users SET locked = 1, locked_until = '$lockoutUntilFormatted' WHERE username = '$username'";
    return mysqli_query($db, $query);
}

function unlockAccount($username) {
    global $db;
    $username = mysqli_real_escape_string($db,$username);
    
    $query = "UPDATE users SET locked = 0, locked_until = NULL WHERE username = '$username'";
    return mysqli_query($db, $query);
}

function deleteFromAttempts($ip_address,$username){
    global $db;
    $query = "delete from loginlogs where IpAddress='$ip_address' and user_id = '$username'";
    return mysqli_query($db,$query);
}
function contact_modal(){
global $db;
$query = "SELECT * FROM conatc_us";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);
}

function getUserL($user_id){
    global $db;
 $query = "SELECT last_login FROM users WHERE id=$user_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);

}
function getMarket($user_id){
    global $db;
    $query="SELECT * FROM marke_user WHERE user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
}
function getDevice($user_id,$agent,$ip_address){
    global $db;
    $query="SELECT * FROM logged_devices WHERE logged_device = '$agent' && ip_address = '$ip_address' && user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
}
function filterReq(){
    $list = getRequests();
    $filter_req  = array();
    foreach($list as $req){
        if(!checkFollowStatus($req['user_id']) && !checkBS($req['user_id'])){
         $filter_req[]=$req;
        }
    }
    
    return $filter_req;
    }
function getBlockedUser(){
    global $db;
 $query = " SELECT users.id as uid,block_list.user_id,block_list.blocked_user_id,block_list.id,users.first_name,users.last_name,users.username,users.profile_pic FROM block_list JOIN users on users.id = block_list.blocked_user_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);
}
    function getRequests(){
          global $db;
          $cu_user_id = $_SESSION['userdata']['id'];
          $query="SELECT users.id as uid,follow_list.id,follow_list.follower_id,follow_list.user_id,follow_list.status,users.first_name,users.last_name,users.username,users.profile_pic,users.verify FROM follow_list JOIN users ON follow_list.follower_id = users.id WHERE follow_list.user_id=$cu_user_id && follow_list.status = 'p' ORDER BY id DESC";
          $run = mysqli_query($db,$query);
          return mysqli_fetch_all($run,true);
      }
//for filtering the suggestion list
function filterFollowSuggestion(){
$list = getFollowSuggestions();
$filter_list  = array();
foreach($list as $user){
    if(!checkFollowStatus($user['id']) && !checkBS($user['id']) && !checklock($user['id']) && count($filter_list)<5){
     $filter_list[]=$user;
    }
}

return $filter_list;
}

function filterFollowSuggestionb(){
    $list = getFollowSuggestions();
    $filter_list  = array();
    foreach($list as $user){
        if(!checkFollowStatus($user['id']) && !checkBS($user['id'])  && !checklock($user['id']) && count($filter_list)<20){
         $filter_list[]=$user;
        }
    }
    
    return $filter_list;
    }

//for checking the user is followed by current user or not
function checkFollowStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM follow_list WHERE follower_id=$current_user && user_id=$user_id && status!='p'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}
function checkFollowStatusF($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM follow_list WHERE follower_id=$user_id && user_id=$current_user && status!='p'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}
function checkReelStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM follow_list WHERE (follower_id!=$current_user && user_id!=$user_id) || (follower_id=$user_id && user_id=$current_user )";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

function checkStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM follow_list WHERE follower_id=$current_user && user_id=$user_id && status='p'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

//for checking the user is followed by current user or not
function checkBlockStatus($current_user,$user_id){
    global $db;
    
    $query="SELECT count(*) as row FROM block_list WHERE (user_id=$current_user && blocked_user_id=$user_id)";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

function checkBSS($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM block_list WHERE blocked_user_id=$current_user && user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

function checkBS($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM block_list WHERE user_id=$current_user and blocked_user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}
//
function checkLCK($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM users WHERE (id=$user_id && id!=$current_user && islocked=1 )";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

//for getting users for follow suggestions
function getFollowSuggestions(){
    global $db;

    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM users WHERE id!=$current_user";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get followers count
function getFollowers($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get followers count
function getFollowing($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//for getting posts by id
function getPostById($user_id){
    global $db;
 $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}

//fir getting reels by id
function getReelsById($user_id){
    global $db;
 $query = "SELECT * FROM reels WHERE user_id=$user_id ORDER BY id DESC";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}
//for getting post
function getPosterId($post_id){
    global $db;
 $query = "SELECT user_id FROM posts WHERE id=$post_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run)['user_id'];

}

function getPosterIdC($comment_id){
    global $db;
 $query = "SELECT user_id FROM comments WHERE id=$comment_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run)['user_id'];

}

function checklock($user_id){
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE islocked = 1 && id=$user_id";
    mysqli_query($db,$query);
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

//for searching the users
function searchUser($keyword){
    global $db;
 $query = "SELECT * FROM users WHERE username LIKE '%".$keyword."%' || (first_name LIKE '%".$keyword."%' || last_name LIKE '%".$keyword."%') LIMIT 5";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}
function requesting($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $status  = 'p';
    $query = "insert into follow_list(follower_id,user_id,status) values('$current_user','$user_id','$status')";
    return mysqli_query($db,$query);
  }
  function getUnreadRequestCount(){
    $cu_user_id = $_SESSION['userdata']['id'];
  
      global $db;
      $query="SELECT count(*) as row FROM follow_list WHERE user_id=$cu_user_id && status='p' && read_status=0 ORDER BY id DESC";
      $run = mysqli_query($db,$query);
      return mysqli_fetch_assoc($run)['row'];
  }
  
  function setRequestAsRead(){
    $cu_user_id = $_SESSION['userdata']['id'];
   global $db;
   $query="UPDATE follow_list SET read_status=1 WHERE user_id=$cu_user_id";
   return mysqli_query($db,$query);
}

//for getting userdata by username
function getUserByUsername($username){
    global $db;
 $query = "SELECT * FROM users WHERE username='$username'";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);



}

//for getting posts
function getPost(){
    global $db;
 $query = "SELECT users.id as uid,posts.id,posts.user_id,posts.post_img,posts.coLock,posts.post_text,posts.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify,users.bio FROM posts JOIN users ON users.id=posts.user_id ORDER BY id DESC";

 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}

function reportPosts(){
    global $db;
    $query = "SELECT users.id as uid, reports.user_id, reports.reporter_id, reports.post_id, reports.description, reports.reason, users.first_name, users.last_name, users.username, users.profile_pic, users.verify, posts.post_img, posts.post_text 
    FROM reports 
    JOIN users ON users.id=reports.reporter_id 
    LEFT JOIN posts ON posts.id = reports.post_id 
    ORDER BY reports.reporter_id DESC 
    ";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}
//for getting reels
function getReels(){
    global $db;
    $query = "SELECT users.id as uid,reels.id,reels.user_id,reels.reel_post,reels.coLock,reels.reel_text,reels.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify FROM reels JOIN users ON users.id=reels.user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function deletePost($post_id){
    global $db;
$user_id=$_SESSION['userdata']['id'];
    $dellike = "DELETE FROM likes WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$dellike);
    $delcom = "DELETE FROM comments WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$delcom);
    $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
mysqli_query($db,$not);


    $query = "DELETE FROM posts WHERE id=$post_id";
    return mysqli_query($db,$query);
}

function deleteMsg($msg_id){
    global $db;
$user_id=$_SESSION['userdata']['id'];
    $query = "DELETE FROM messages WHERE id=$msg_id";
    return mysqli_query($db,$query);
}

function hidechat($chat_id){
    global $db;
    $user = $_SESSION['userdata']['id'];
    $query = "delete from messages WHERE (to_user_id=$chat_id && from_user_id=$user) || (to_user_id=$user && from_user_id=$chat_id)";
    return mysqli_query($db,$query);
}
// for deleting comment
function deleteComment($comment_id){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $delreplies = "DELETE FROM replies WHERE comment_id=$comment_id and user_id=$user_id";
    mysqli_query($db,$delreplies);
    $delcomment = "DELETE FROM comments WHERE id=$comment_id && user_id=$user_id";
    return mysqli_query($db,$delcomment);
}
// for deleting users
function deleteUser($user_id,$delin){
    global $db;
$user_id=$_SESSION['userdata']['id'];
$delinn=$_SESSION['userdata']['password'];
if($delin == $delinn){
    $delposts = "DELETE FROM posts WHERE user_id=$user_id";
    mysqli_query($db,$delposts);

    $dellogs = "DELETE FROM logged_devices WHERE user_id=$user_id";
    mysqli_query($db,$dellogs);

    $delmarket = "DELETE FROM marke_user WHERE user_id=$user_id";
    mysqli_query($db,$delmarket);

    $delreels = "DELETE FROM reels WHERE user_id=$user_id";
    mysqli_query($db,$delreels);

    $delreplies = "DELETE FROM replies WHERE user_id=$user_id";
    mysqli_query($db,$delreplies);

    $delstory = "DELETE FROM stories WHERE user_id=$user_id";
    mysqli_query($db,$delstory);

    $delfollow = "DELETE FROM follow_list WHERE follower_id=$user_id || user_id=$user_id";
    mysqli_query($db,$delfollow);

    $dellike = "DELETE FROM likes WHERE user_id=$user_id";
    mysqli_query($db,$dellike);

    $delcom = "DELETE FROM comments WHERE user_id=$user_id";
    mysqli_query($db,$delcom);

    $delmsg = "DELETE FROM messages WHERE from_user_id=$user_id";
    mysqli_query($db,$delmsg);

    $delnot = "DELETE FROM notifications WHERE from_user_id=$user_id";
    mysqli_query($db,$delnot);

$query = "DELETE FROM users WHERE id=$user_id";
    return mysqli_query($db,$query);
}else{
    return false;
}
}


//for getting posts dynamically
function filterPosts(){
    $list = getPost();
    $filter_list  = array();
    foreach($list as $post){
        if(checkFollowStatus($post['user_id']) || $post['user_id']==$_SESSION['userdata']['id']){
         $filter_list[]=$post;
        }
    }
    
    return $filter_list;
    }

    
//for creating new user
function createUser($data){
 global $db;
 $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
 $first_name = mysqli_real_escape_string($db,strip_tags($data['first_name'],$allowed_tags));
 $last_name = mysqli_real_escape_string($db,strip_tags($data['last_name'],$allowed_tags));
 $gender = $data['gender'];
 $email = mysqli_real_escape_string($db,strip_tags($data['username_email']));
 $username = mysqli_real_escape_string($db,strip_tags($data['username']));
 $username = stripslashes($username);
 $phone = mysqli_real_escape_string($db,strip_tags($data['phone']));
 $phone =  filterInputValue($data['phone']);
 $password = mysqli_real_escape_string($db,strip_tags($data['password']));
 $password = md5($password);
$ac_status = $data['message_type']; 
if( $ac_status == 1){
        $ac = 0;
}elseif( $ac_status == 2){
    $ac = 3;
}
 $bg = "bg.jpeg";
 $profile_pic = "";
 $counter = 1;
if( $gender == 2){
    $profile_pic = "f-avatar.jpg";
}elseif ( $gender == 1){
    $profile_pic = "d-avatar.jpg";
}

 $query = "INSERT INTO users(first_name,last_name,gender,email,username,phone,password,profile_pic,bg_pic,ac_status,counter) ";
 $query.="VALUES ('$first_name','$last_name',$gender,'$email','$username','$phone','$password','$profile_pic','$bg','$ac','$counter')"; 
 return mysqli_query($db,$query);
}

function createLoginDevice(){
    global $db;
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $user_id = $_SESSION['userdata']['id'];
    $ip_address = getIpAddr();
    $query = "INSERT INTO logged_devices(user_id,logged_device,ip_address) ";
    $query.="VALUES ('$user_id','$userAgent','$ip_address')"; 
    return mysqli_query($db,$query);
   }

   function isDeviceRegistered($agent,$ip_address){
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM logged_devices WHERE (logged_device = '$agent' AND ip_address = '$ip_address') AND user_id = $user_id";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

function getLoggedD($user_id){

 global $db;
 $query="SELECT * FROM marke_user WHERE user_id=$user_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);
    
}
function createMarket($data,$image){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
    $name = mysqli_real_escape_string($db,strip_tags($data['marketName'],$allowed_tags));
    $location = mysqli_real_escape_string($db,strip_tags($data['location']));
    $user_id = $_SESSION['userdata']['id'];
    $market_text = mysqli_real_escape_string($db,strip_tags($data['market_text']));
    $market_pic = 'cafe.svg';
    if ($image['name']) {
        $image_name = time() . basename($image['name']);
        $image_dir = "../images/market_profile/$image_name";
        move_uploaded_file($image['tmp_name'], $image_dir);
        $market_pic = ", market_pic='$image_name'";
    }
    $query = "INSERT INTO marke_user(name,location,user_id,market_pic,market_text) ";
    $query.="VALUES ('$name','$location','$user_id','$market_pic','$market_text')"; 
    return mysqli_query($db,$query);
   }
   
   
//function for verify email
function verifyEmail($email){
    global $db;
    $query="UPDATE users SET ac_status=1 WHERE email='$email'";
    return mysqli_query($db,$query);
}
function activateSv($phone){
    global $db;
    $query="UPDATE users SET twoStep=1 WHERE phone='$phone'";
    return mysqli_query($db,$query);
}
//function for verify email
function resetPassword($email,$password){
    global $db;
    $password=md5($password);
    $query="UPDATE users SET password='$password' WHERE email='$email'";
    return mysqli_query($db,$query);
}

function validateMarketUpdateForm($form_data,$image_data){
    $response=array();
    $response['status']=true;


  if (!$form_data['name']) {
    $response['msg'] = "ناوی بەکارهێنەر نەدراوە";
    $response['status'] = false;
    $response['field'] = 'name';
  }
    
    

        if(!$form_data['location']){
            $response['msg']="ناوی دووەم نەدراوە";
            $response['status']=false;
            $response['field']='llocation';
        }

        if(!$form_data['text']){
            $response['msg']="ناوی یەکەم نەدراوە";
            $response['status']=false;
            $response['field']='text';
        }
        
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/4000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="تەنها وێنەی جۆری jpg,jpeg,png رێگە پێدراون";
            $response['status']=false;
            $response['field']='market_pic';
        }

        if($size>4000){
            $response['msg']="قەبارەی وێنەکەت مەرجە لە ٤ مێگا بایت کەمتر بێ";
            $response['status']=false;
            $response['field']='market_pic';
        }
       }

    

        return $response;
    
    }

//for validating update form
function validateUpdateForm($form_data,$image_data,$bgimage){
    $response=array();
    $response['status']=true;
      
    if(isset($_POST['remember'])){
        setcookie('emailid',$_POST['username_email'],time()+60*60);//1 hour
        setcookie('password',$_POST['password'],time()+60*60); //1 hour
      }
        if(!$form_data['username']){
            $response['msg']="ناوی بەکارهێنەر نەدراوە";
            $response['status']=false;
            $response['field']='username';
        }
        if(!empty($form_data['old_password'])){
        if(md5($form_data['old_password']) != $_SESSION['userdata']['password']){
            $response['msg']="تێپەرە ووشە کۆنەکەت هەڵەیە";
            $response['status']=false;
            $response['field']='old_password';
        }
    }
    if(!empty($form_data['password']) && !empty($form_data['re_password'])){
    if(md5($form_data['password']) == $_SESSION['userdata']['password']){
        $response['msg']="تێپەرە ووشەی تازە نابێ هەمان تێپەرەووشەی کۆن بێ";
        $response['status']=false;
        $response['field']='password';
    }
}
    if(!empty($form_data['password']) && empty($form_data['old_password']) && empty($form_data['re_password'])){
        $response['msg']="تکایە خانەکان بە جوانی پڕ بکەوە";
        $response['status']=false;
        $response['field']='password';
    }
    if(!empty($form_data['password']) && !empty($form_data['old_password']) && empty($form_data['re_password'])){
        $response['msg']="تکایە خانەکان بە جوانی پڕ بکەوە";
        $response['status']=false;
        $response['field']='password';
    }
    if(!empty($form_data['password']) && empty($form_data['old_password']) && !empty($form_data['re_password'])){
        $response['msg']="تێپەرەووشە کۆنەکەت داخل بکە";
        $response['status']=false;
        $response['field']='old_password';
    }
    if(!empty($form_data['old_password']) && empty($form_data['password']) && empty($form_data['re_password'])){
        $response['msg']="تکایە خانەکان بە جوانی پڕ بکەوە";
        $response['status']=false;
        $response['field']='password';
    }
    if(empty($form_data['old_password']) && empty($form_data['password']) && !empty($form_data['re_password'])){
        $response['msg']="تکایە خانەکان بە جوانی پڕ بکەوە";
        $response['status']=false;
        $response['field']='password';
    }
    if(!empty($form_data['password']) && !empty($form_data['re_password']) ){
    if(md5($form_data['password']) != md5($form_data['re_password'])){
        $response['msg']="تێپەرە ووشەکان ناگونجێن لەگەڵ یەک";
        $response['status']=false;
        $response['field']='password';
    }
}

        if(!$form_data['last_name']){
            $response['msg']="ناوی دووەم نەدراوە";
            $response['status']=false;
            $response['field']='last_name';
        }
        if(!$form_data['first_name']){
            $response['msg']="ناوی یەکەم نەدراوە";
            $response['status']=false;
            $response['field']='first_name';
        }
        if(isUsernameRegisteredByOther($form_data['username'])){
            $response['msg']=$form_data['username']."بوونی هەیە";
            $response['msg']="ناوی بەکارهێنەری"." ".$form_data['username']." "."بوونی هەیە ";
            $response['status']=false;
            $response['field']='username';
        }
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/4000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="تەنها وێنەی جۆری jpg,jpeg,png رێگە پێدراون";
            $response['status']=false;
            $response['field']='profile_pic';
        }

        if($size>4000){
            $response['msg']="قەبارەی وێنەکەت مەرجە لە ٤ مێگا بایت کەمتر بێ";
            $response['status']=false;
            $response['field']='profile_pic';
        }
       }

       if($bgimage['name']){
        $image = basename($bgimage['name']);
        $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $size = $bgimage['size']/4000;

        if($type!='jpg' && $type!='jpeg' && $type!='png'){
         $response['msg']="تەنها وێنەی جۆری jpg,jpeg,png رێگە پێدراون";
         $response['status']=false;
         $response['field']='bg_pic';
     }

     if($size>4000){
         $response['msg']="قەبارەی وێنەکەت مەرجە لە ٤ مێگا بایت کەمتر بێ";
         $response['status']=false;
         $response['field']='bg_pic';
     }
    }

        return $response;
    
    }
    

    //function for updating profile

function updateProfile($data,$imagedata,$bgimage){
        global $db;
        $first_name = mysqli_real_escape_string($db,$data['first_name']);
        $last_name = mysqli_real_escape_string($db,$data['last_name']);
        $username = mysqli_real_escape_string($db,$data['username']);
        $oldpassword = mysqli_real_escape_string($db,$data['old_password']);
        $password = mysqli_real_escape_string($db,$data['password']);
        $repassword = mysqli_real_escape_string($db,$data['re_password']);
        $bio = mysqli_real_escape_string($db,$data['bio']);
        $toggle = isset($_POST['locked']) && $_POST['locked'] == 1 ? 1 : 0;
        $work = mysqli_real_escape_string($db,$data['work']);
        $city = mysqli_real_escape_string($db,$data['city']);
        $work_place = mysqli_real_escape_string($db,$data['work_place']);
        $dob = mysqli_real_escape_string($db,$data['dateofbirth']);
if(md5($oldpassword) != $_SESSION['userdata']['password'])
{
    $password = $_SESSION['userdata']['password'];
}elseif( !$data['old_password']){
    $password = $_SESSION['userdata']['password'];
}elseif( !$data['password']){
    $password = $_SESSION['userdata']['password'];
}elseif( !$data['re_password']){
    $password = $_SESSION['userdata']['password'];
}
elseif(md5($password) == md5($_SESSION['userdata']['password'])){
    $password = $_SESSION['userdata']['password'];
}elseif(!empty($password) && empty($oldpassword) && empty($repassword)){
        $password = $_SESSION['userdata']['password'];
    }
    elseif(!empty($password) && !empty($oldpassword) && empty($repassword)){
        $password = $_SESSION['userdata']['password'];
    }
    elseif(!empty($password) && empty($oldpassword) && !empty($repassword)){
        $password = $_SESSION['userdata']['password'];
    }
    elseif(!empty($oldpassword) && empty($password) && empty($repassword)){
        $password = $_SESSION['userdata']['password'];
    } elseif(empty($oldpassword) && empty($password) && !empty($repassword)){
        $password = $_SESSION['userdata']['password'];
    }
    elseif(!empty($password) && !empty($repassword) && $password != $repassword){
        $password = $_SESSION['userdata']['password'];
    }else{
    $password = md5($password);
    $_SESSION['userdata']['password']=$password;

}
$profile_pic="";
if($imagedata['name']){
    $image_name = time().basename($imagedata['name']);
    $image_dir="../images/profile/$image_name";
    move_uploaded_file($imagedata['tmp_name'],$image_dir);
    $profile_pic=", profile_pic='$image_name'";
}

$bg_pic="";
if($bgimage['name']){
    $bg_name = time().basename($bgimage['name']);
    $bg_dir="../images/bg/$bg_name";
    move_uploaded_file($bgimage['tmp_name'],$bg_dir);
    $bg_pic=", bg_pic='$bg_name'";
}      
      
    
        $query = "UPDATE users SET first_name = '$first_name', last_name='$last_name',username='$username',bio='$bio' , work ='$work',city='$city',work_place='$work_place',DoB='$dob',islocked ='$toggle',password='$password' $profile_pic  $bg_pic   WHERE id=".$_SESSION['userdata']['id'];
return mysqli_query($db,$query);

    }

function updateMarketProfile($data,$imagedata){
        global $db;
        $name = mysqli_real_escape_string($db,$data['name']);
        $location = mysqli_real_escape_string($db,$data['location']);
        $details = mysqli_real_escape_string($db,$data['text']);
       
      
      $profile_pic="cafe.svg";
      if($imagedata['name']){
      $image_name = time().basename($imagedata['name']);
      $image_dir="../images/market_profile/$image_name";
      move_uploaded_file($imagedata['tmp_name'],$image_dir);
      $profile_pic=", market_pic='$image_name'";
      }
      
        $query = "UPDATE marke_user SET name = '$name', location ='$location',market_text='$details' $profile_pic WHERE user_id=".$_SESSION['userdata']['id'];
      return mysqli_query($db,$query);
      
}
    function validatePostText($post_text){
        $response['status']=true;

        if(!$post_text){
            $response['msg']=" تکایە شتێک بنووسە ";
            $response['status']=false;
            $response['field']='post_box';
        }
        return $response;
    }
    //for validating add post form
function validatePostImage($image_data){
    $response=array();
    $response['status']=true;
      

        if(!$image_data['name']){
            $response['msg']="هیچ وێنەیەک دیاری نەکراوە";
            $response['status']=false;
            $response['field']='post_img';
        }
        
   
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/9000;

           if($type!='jpg' && $type!='jpeg' && $type!='png' && $type!='gif' && $type!='mp4' && $type!='avi' && $type!='mov' && $type!='MP4' && $type!='MOV'){
            $response['msg']=" وێنە و ڤیدیۆی جۆری jpg,jpeg,png,mp4,mov,avi رێگە پێدراون تەنها";
            $response['status']=false;
            $response['field']='post_img';
        }

        if($size>9000){
            $response['msg']="upload image less then 1 mb";
            $response['status']=false;
            $response['field']='post_img';
        }
       }

        return $response;
    
    }

    function validatePostReel($image_data){
        $response=array();
        $response['status']=true;
          
    
            if(!$image_data['name']){
                $response['msg']="هیچ وێنەیەک دیاری نەکراوە";
                $response['status']=false;
                $response['field']='post_reel';
            }
            
       
        
           if($image_data['name']){
               $image = basename($image_data['name']);
               $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
               $size = $image_data['size']/20000;
    
               if($type!='mp4' && $type!='avi' && $type!='mov' && $type!='MP4' && $type!='MOV'){
                $response['msg']="تەنها ڤیدیۆی جۆری mp4,mov,avi رێگە پێدراون";
                $response['status']=false;
                $response['field']='post_reel';
            }
    
            if($size>20000){
                $response['msg']="upload image less then 1 mb";
                $response['status']=false;
                $response['field']='post_reel';
            }
           }
    
            return $response;
        
        }
 
    //for creating new user
// for inserting recent searches
    function recentSearches($search,$searchId){
        global $db;
        $user_id = $_SESSION['userdata']['id'];
        $query = "INSERT INTO recent_searches(user_id,search_id,searches)";
        $query.="VALUES ($user_id,$searchId,'$search')"; 
        return mysqli_query($db,$query);
    }

    // for creating text only post
    function createPostText($text){
        global $db;
        $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
        $post_text = mysqli_real_escape_string($db,$text['post_box']);
        $post_text = strip_tags($text['post_box'],$allowed_tags);
        $url = uniqid() . '_' . time(); 
        $user_id = $_SESSION['userdata']['id'];
        $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;
    
        $query = "INSERT INTO posts(user_id,post_text,url,coLock)";
        $query.="VALUES ($user_id,'$post_text','$url','$toggle')"; 
        return mysqli_query($db,$query);
    }

function createPost($text,$image){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
    $post_text = mysqli_real_escape_string($db,$text['content']);
    $post_text = strip_tags($text['content'],$allowed_tags);
    $url = uniqid() . '_' . time(); 
    $user_id = $_SESSION['userdata']['id'];
    $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;

        $image_name = time().basename($image['name']);
        $image_dir="../images/posts/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);

    $query = "INSERT INTO posts(user_id,post_text,url,post_img,coLock)";
    $query.="VALUES ($user_id,'$post_text','$url','$image_name','$toggle')"; 
    return mysqli_query($db,$query);
   }
  
   //create reels
   function createPostReel($image){
    global $db;
 
    $user_id = $_SESSION['userdata']['id'];
    $url = uniqid() . '_' . time(); 
    $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;

        $image_name = time().basename($image['name']);
        $image_dir="../images/reels/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);

    $query = "INSERT INTO reels(user_id,reel_post,url,coLock)";
    $query.="VALUES ($user_id,'$image_name',,'$url','$toggle')"; 
    return mysqli_query($db,$query);
   }

function maintenance(){
    global $db;
    $query = "select m_mode from admin";
    $result = mysqli_query($db, $query);
    return mysqli_fetch_array($result); 
}
function validateStoryImage($image_data){
    $response=array();
    $response['status']=true;
      
  
        if(!$image_data['name']){
            $response['msg']="هیچ وێنەیەک دیاری نەکراوە";
            $response['status']=false;
            $response['field']='story_img';
        }
        
   
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/1000;
  
           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="تەنها وێنەی جۆری jpg,jpeg,png رێگە پێدراون";
            $response['status']=false;
            $response['field']='story_img';
        }
  
        if($size>2000){
            $response['msg']="upload image less then 1 mb";
            $response['status']=false;
            $response['field']='story_img';
        }
       }
  
        return $response;
    
    }

 
    function createStories($image){
        global $db;
        $user_id = $_SESSION['userdata']['id'];
    
            $image_name = time().basename($image['name']);
            $image_dir="../images/stories/$image_name";
            move_uploaded_file($image['tmp_name'],$image_dir);
        
    
        $query = "INSERT INTO stories(user_id,story_img)";
        $query.="VALUES ($user_id,'$image_name')"; 
        return mysqli_query($db,$query);
       }
   
       function deleteOldStories(){
        global $db;
        $time_limit = strtotime('-24 hours');

        // Delete the old stories
        $sql = "DELETE FROM stories WHERE created_at < FROM_UNIXTIME('$time_limit')";
       return mysqli_query($db,$sql);
       }

       function getStory(){
        global $db;
     $query = "SELECT users.id as uid,stories.id,stories.user_id,stories.story_img,stories.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify,users.bio FROM stories JOIN users ON users.id=stories.user_id ORDER BY read_status = 0 desc";
     $run = mysqli_query($db,$query);
     return mysqli_fetch_all($run,true);
    
    }
    function getLikesForProfile($post_id){
        global $db;
     $query = "SELECT users.id as uid,likes.id,likes.user_id,users.first_name,users.profile_pic FROM likes JOIN users ON users.id=likes.user_id where post_id=$post_id ORDER BY ID desc";
     $run = mysqli_query($db,$query);
     return mysqli_fetch_all($run,true);
    
    }

    //for showing recent searches
    function getRecentSearches(){
        global $db;
        $user_id = $_SESSION['userdata']['id']; 
     $query = "SELECT DISTINCT users.id as uid,recent_searches.id,recent_searches.user_id,users.username,recent_searches.search_id,users.first_name,users.last_name,recent_searches.created_at,users.profile_pic FROM recent_searches JOIN users ON users.id=recent_searches.search_id where recent_searches.user_id=$user_id ORDER BY ID desc ";
     $run = mysqli_query($db,$query);
     return mysqli_fetch_all($run,true);
    
    }

   function deleteRecent($search){
    global $db;
    $user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM recent_searches WHERE search_id = $search AND user_id = $user";
    return mysqli_query($db,$query);
   }


    function filterstories(){
        $list = getStory();
        $filter_list  = array();
        foreach($list as $story){
            if(checkFollowStatus($story['user_id']) || $story['user_id']==$_SESSION['userdata']['id']){
             $filter_list[]=$story;
            }
        }
        
        return $filter_list;
        }

        function setStoryAsRead($user_id){
           global $db;
           $query="UPDATE stories SET read_status=1 where id = $user_id";
           return mysqli_query($db,$query);
       }

       function getUnreadstories($story_id){
          global $db;
          $query="SELECT count(*) as row FROM stories WHERE read_status=0 && id=$story_id ORDER BY id DESC";
          $run = mysqli_query($db,$query);
          return mysqli_fetch_assoc($run)['row'];
      }

      function updateLastLogin($user_id) {
      global $db;
      $stmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $stmt->close();
      header('Content-Type: application/json');
      echo json_encode(true);
      }
      
      function updateCounter($user_id){
        global $db;
        $sql = "UPDATE users SET counter = 0 WHERE id = $user_id";
        return mysqli_query($db,$sql);
      }
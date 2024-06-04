<?php
require 'Data.php';
require 'Protection.php';
require 'Validate.php';
require 'Time.php';
$config = require 'config.php';
$db = new Data($config['database']);
$protection = new Protection();
$validate = new Validate();
$time = new Time();
//function for showing pages
function showPage($page,$data=""){
    include("assets/pages/$page.php");
}

function dd($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

// for editing post text
function editpost($post_id,$response){
    global $db;
    $post_text =$response['new_post_text'];
    $row = $db->query('SELECT post_text FROM posts WHERE id = :post_id',[
        'post_id' => $post_id
    ])->findOrFail();
    $old_text = $row['post_text'];
    if ($post_text != $old_text) {
        $post_text;
    }
    $db->query('UPDATE posts SET post_text = :post_text WHERE id = :post_id',[
        'post_text' => $post_text,
        'post_id' => $post_id,
    ]);
    return $post_text;
}
function contactUs($name,$email,$msg){
    global $db;
    return $db->query("INSERT INTO conatc_us (name,email,message,submit) VALUES(:name,:email,:message,:submit)",[
        'name' => $name,
        'email' => $email,
        'message' => $msg,
        'submit' => 1,
    ]);
}

function reportPost($reporter_id,$post_id,$reason,$report_msg){
    global $db;
    return $db->query("INSERT INTO reports (user_id,reporter_id,post_id,description,reason)
VALUES(:user_id, :reporter_id, :post_id, :report_msg, :reason)",[
        'user_id' => $_SESSION['userdata']['id'],
        'reporter_id' => $reporter_id,
        'post_id' => $post_id,
        'report_msg' => $report_msg,
        'reason' => $reason,
    ]);
}

function getDevice($user_id,$agent,$ip_address){
    global $db;
    return $query = $db->query("SELECT * FROM logged_devices WHERE logged_device = :agent AND ip_address = :ip AND user_id=:user_id",[
        'agent' => $agent,
        'ip' => $ip_address,
        'user_id' => $user_id,
    ])->find();
}

//for seeing a chat
function seenChat($chat_id,$response,$current_id){
    global $db;
    return $db->query("UPDATE messages SET seenBy = :response 
                WHERE (to_user_id = :current AND from_user_id = :chat)",[
        'response'=>$response,
        'current' => $current_id,
        'chat' => $chat_id,
    ]);
}

function seenChatSelect($chat_id){
    global $db;
    return $db->query( "SELECT * FROM messages WHERE (to_user_id = :current AND from_user_id = :chat) LIMIT 1",[
        'current' => $_SESSION['userdata']['id'],
        'chat' => $chat_id
    ])->find();
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
    $data = $db->query("SELECT from_user_id,to_user_id FROM messages 
                      WHERE to_user_id = :user || from_user_id = :from ORDER BY id DESC",[
        'user' => $current_user_id,
        'from' => $current_user_id,
    ])->all();
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
    return $query = $db->query("SELECT * FROM messages WHERE (to_user_id = :to AND from_user_id = :from) OR (from_user_id = :to AND to_user_id = :from) ORDER BY id DESC",[
        'to' => $_SESSION['userdata']['id'],
        'from' => $user_id,
    ])->all();
}

function sendMessage($user_id,$msg){
    global $db,$protection;
    $protection->stripTags($msg);
    return $db->query("INSERT INTO messages (from_user_id,to_user_id,msg) VALUES(:from,:to,:message)",[
            'from' => $_SESSION['userdata']['id'],
            'to' => $user_id,
            'message' => $msg,
        ]);
}

function newMsgCount(){
    global $db;
    return $db->query("SELECT COUNT(*) as row FROM messages WHERE to_user_id=:to && read_status=0",[
            'to' => $_SESSION['userdata']['id'],
    ])->find();
}

function updateMessageReadStatus($user_id){
    global $db;
    return $db->query("UPDATE messages SET read_status=1 WHERE to_user_id=:to AND from_user_id=:from",[
            'to' => $_SESSION['userdata']['id'],
            'from' => $user_id,
    ]);
}
function getAllMessages(){
    $active_chat_ids = getActiveChatUserIds();
    $conversation=[];
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
    createNotification($cu['id'],$user_id,"شوێنت کەوت");
    return $db->query("INSERT INTO follow_list(follower_id,user_id) VALUES(:follower,:followed)",[
            'follower' => $current_user,
            'followed' => $user_id,
    ]);
}
//to accept a request
function acceptUser($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    createNotification($cu['id'],$user_id,"داواکەی تۆی قەبووڵ کرد");
    return $db->query("UPDATE follow_list SET status='' WHERE user_id=:user",[
            'user' => $_SESSION['userdata']['id'],
    ]);
}
function declineUser(){
    global $db;
    return $db->query("DELETE FROM follow_list WHERE user_id=:user",[
            'user' => $_SESSION['userdata']['id'],
    ]);
}

//function for blocking the user
function blockUser($blocked_user_id){
    global $db;
    $db->query("INSERT INTO block_list(user_id,blocked_user_id) VALUES(:user,:blocked)",[
            'user' => $_SESSION['userdata']['id'],
            'blocked' => $blocked_user_id,
    ]);
    $db->query("DELETE FROM follow_list WHERE follower_id=:user AND user_id=:blocked",[
            'user' => $_SESSION['userdata']['id'],
            'blocked' => $blocked_user_id,
    ]);
    $db->query("DELETE FROM follow_list WHERE follower_id=:user AND user_id=:user_id",[
            'user' => $blocked_user_id,
            'user_id' => $_SESSION['userdata']['id'],
    ]);
    return true;
}

//for unblocking the user
function unblockUser($user_id){
    global $db;
    return $db->query("DELETE FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id",[
            'user' => $_SESSION['userdata']['id'],
            'blocked' => $user_id,
    ]);
}

//function checkLikeStatus
function checkLikeStatus($post_id){
    global $db;
    $query = $db->query("SELECT count(*) as `row` FROM likes WHERE user_id=:id && post_id=:post_id",[
            'id' => $_SESSION['userdata']['id'],
            'post_id' => $post_id,
    ])->find();
    return $query['row'];
}

function checkLikeStatusC($comment_id){
    global $db;
    return $query = $db->query("SELECT count(*) as `row` FROM comment_likes WHERE user_id=:id AND comment_id=:comment",[
        'id' => $_SESSION['userdata']['id'],
        'comment' => $comment_id,
    ])->find();
    return $query['row'];
}
//function for like the post
function like($post_id){
    global $db;
    $poster_id = getPosterId($post_id);
    if($poster_id!=$_SESSION['userdata']['id']){
        createNotification($_SESSION['userdata']['id'],$poster_id,"پۆستەکەی تۆی بە دڵە",$post_id);
    }
    return $db->query("INSERT INTO likes(post_id,user_id) VALUES(:post,:user)",[
        'post' => $post_id,
        'user' => $_SESSION['userdata']['id']
    ]);
}

//liking comments
function likeC($comment_id){
    global $db;
    $db->query("INSERT INTO comment_likes(comment_id,user_id) VALUES(:comment,:user)",[
            'comment' => $comment_id,
            'user' => $_SESSION['userdata']['id'],
    ]);
    $poster_id = getPosterIdC($comment_id);
    if($poster_id!=$_SESSION['userdata']['id']){
        createNotification($current_user,$poster_id,"سەرنجەکەی تۆی بەدڵە",$comment_id);
    }
    return json_encode(true);
}
//function for creating comments
function addComment($post_id,$comment){
    global $db,$protection;
    $comment = $protection->stripTags($comment);
    $db->query("INSERT INTO comments(user_id,post_id,comment) VALUES(:user,:post,:comment)",[
            'user' => $_SESSION['userdata']['id'],
            'post' => $post_id,
            'comment' => $comment,
    ]);
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"لێدوانی لەسەر پۆستەکەی تۆ دا",$post_id);
    }
    return json_encode(true);

}
function addReply($post_id,$comment_id,$reply){
    global $db,$protection;
    $reply = $protection->stripTags($reply);
    $db->query("INSERT INTO replies(user_id,comment_id,post_id,reply) VALUES(:user,:comment,:post,:reply)",[
            'user' => $_SESSION['userdata']['id'],
            'comment' => $comment_id,
            'post' => $post_id,
            'reply' => $reply,
    ]);
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"لێدوانی لەسەر پۆستەکەی تۆ دا",$post_id);
    }
    return json_encode(true);
}
//function for creating comments
function createNotification($from_user_id,$to_user_id,$msg,$post_id=0,$comment_id=0){
    global $db;
    return $db->query("INSERT INTO notifications(from_user_id,to_user_id,message,post_id,comment_id) 
VALUES($from_user_id,$to_user_id,'$msg',$post_id,$comment_id)",[
        'from' => $from_user_id,
        'to' => $to_user_id,
        'message' => $msg,
        'post' => $post_id,
        'comment' => $comment_id,
    ]);
}
//function for getting likes count
function getComments($post_id){
    global $db;
    return $db->query("SELECT * FROM comments WHERE post_id=:id ORDER BY id DESC",[
            'id' => $post_id,
    ])->all();
}
function getReplies($comment_id){
    global $db;
return $db->query("SELECT * FROM replies WHERE comment_id=:id ORDER BY id DESC",[
        'id' => $comment_id,
])->all();
}

//get notifications

function getNotifications(){
    global $db;
    return $db->query("SELECT * FROM notifications WHERE to_user_id=:user ORDER BY id DESC",[
            'user' => $_SESSION['userdata']['id'],
    ])->all();
}


function getUnreadNotificationsCount(){
    global $db;
   $query = $db->query("SELECT count(*) as `row` FROM notifications WHERE to_user_id=:to_user AND read_status=0 ORDER BY id DESC",[
           'to_user'=>$_SESSION['userdata']['id'],
   ])->find();
   return $query['row'];
}
function setNotificationStatusAsRead(){
    global $db;
    return $db->query("UPDATE notifications SET read_status=1 WHERE to_user_id=:id",[
            'id' => $_SESSION['userdata']['id'],
    ]);
}
//function for getting likes count
function getLikes($post_id){
    global $db;
    return $db->query("SELECT * FROM likes WHERE post_id=:id",[
            'id' => $post_id,
    ])->all();
}

function getLikesC($comment_id){
    global $db;
    return $db->query("SELECT * FROM comment_likes WHERE comment_id=:id",[
            'id' => $comment_id,
    ])->all();
}


//function for unlike the post
function unlike($post_id){
    global $db;
    $db->query("DELETE FROM likes WHERE user_id=:user AND post_id=:post",[
            'user' => $_SESSION['userdata']['id'],
            'post' => $post_id,
    ]);
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"!بەدڵبوونی سەر پۆستەکەی تۆی لادا",$post_id);
    }
    return json_encode(true);
}

function unlikeC($comment_id){
    global $db;
    return $db->query("DELETE FROM comment_likes WHERE user_id=:user AND comment_id=:comment",[
            'user' => $_SESSION['userdata']['id'],
            'comment' => $comment_id,
    ]);
}
function unfollowUser($unfollow){
    global $db;
    $user=$_SESSION['userdata']['id'];
    createNotification($current_user,$user_id,"تۆی لە شوێنکەوتنەکانی لادا");
    return $db->query("DELETE FROM follow_list WHERE follower_id=:user AND user_id=:unfollow",[
            'user' => $user,
            'unfollow' => $unfollow,
    ]);
}

function CancelFollow($user_id){
    global $db;
   return $db->query("DELETE FROM follow_list WHERE follower_id=:follower AND user_id=:user AND status = 'p'",[
            'follower' => $_SESSION['userdata']['id'],
            'user' => $user_id,
    ]);
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
    $query=$db->query("SELECT count(*) as `row` FROM users WHERE email=:email",[
            'email' => $email,
    ])->find();
    return $query['row'];
}

function isPhoneRegistered($phone){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM users WHERE phone= :phone",[
            'phone' => $phone,
    ])->find();
    return $query['row'];
}
function isMarketRegistered($userId){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM marke_user WHERE user_id= :user_id",[
            'user_id' => $userId,
    ])->find();
    return $query['row'];
}

function isUsernameRegistered($username){
    global $db;
    $query= $db->query("SELECT count(*) as `row` FROM users WHERE username= :username",[
            'username' => $username,
    ])->find();
    return $query['row'];
}

//for checking duplicate username by other
function isUsernameRegisteredByOther($username){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $query= $db->query("SELECT count(*) as `row` FROM users WHERE username=:username AND id!= :user_id",[
            'username' => $username,
            'user_id' => $user_id,
    ])->find();
    return $query['row'];
}
// form blocked accounts showing lists
function isBlocked($userId){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM block_list WHERE user_id = :user_id",[
            'user_id' => $userId,
    ])->find();
    return $query['row'];
}
function isNotified($userId){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM notifications WHERE to_user_id = :toUser",[
            'toUser' => $userId,
    ])->find();
    return $query['row'];

}
function unlockExpiredAccounts() {
    global $db;
    $currentTime = date('Y-m-d H:i:s', time());
    $db->query("UPDATE users SET locked = 0, locked_until = NULL WHERE locked_until IS NOT NULL AND locked_until <= :nowTime",[
        'nowTime' => $currentTime
    ]);
    return true;
}


function checkLockStatus($username){
    global $db;
    $query= $db->query("SELECT count(*) as `row` FROM users WHERE username = :username and locked = :locked",[
         'username' => $username,
        'locked' => 1,
    ])->find();
    return $query['row'];
}

//for checking the user
function checkUser($login_data){
    global $db,$protection;
    $query = "SELECT * FROM users WHERE (email = :username_email OR username = :username_email) AND password = :password";
    $result = $db->query($query, [
        'username_email' => $login_data['username_email'],
        'password' => $protection->passwordHash($login_data['password']),
    ])->find();

    $data = [];
    $data['user'] = $result ?: [];

    $data['status'] = !empty($data['user']);
//dd($data);
    return $data;
}


//for getting userdata by id
function getUser($user_id){
    global $db;
    return $db->query("SELECT * FROM users WHERE id=:id",[
            'id' => $user_id,
    ])->find();
}

//for cheking login details
function loginAttempts($time,$ip_address,$userId){
    global $db;
    $query = $db->query("select count(*) as total_count from loginlogs where TryTime > :time and IpAddress= :ip and user_id = :user ",[
            'time' => $time,
            'ip' => $ip_address,
            'user' => $userId
    ])->find();
    return $query['total_count'];
}
function addingLoginAttempts($username,$ip_address){
    global $db;
    $try_time=time();
    $db->query("insert into loginlogs(user_id,IpAddress,TryTime) values(:username,:ip,:try)",[
            'username' => $username,
            'ip' => $ip_address,
            'try' => $try_time,
    ]);
    return true;
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

function deleteFromAttempts($ip_address,$userId){
    global $db;
     $db->query("delete from loginlogs where IpAddress= :user_id and user_id = :user_id",[
             'ip' => $ip_address,
            'user_id' => $userId,
     ]);
}
function contact_modal(){
    global $db;
    return $query = $db->query("SELECT * FROM conatc_us",[])->find();
}

function getUserL($user_id){
    global $db;
    return $query = $db->query("SELECT last_login FROM users WHERE id=:id",[
            'id' => $user_id,
    ])->find();
}
function getMarket($user_id){
    global $db;
    return $query = $db->query("SELECT * FROM marke_user WHERE user_id=:id",[
            'id' => $user_id,
    ]);
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
    return $db->query(" SELECT users.id as uid,block_list.user_id,block_list.blocked_user_id,block_list.id,users.first_name,users.last_name,users.username,users.profile_pic FROM block_list JOIN users on users.id = block_list.blocked_user_id",[])->all();
}
function getRequests(){
    global $db;
    $cu_user_id = $_SESSION['userdata']['id'];
    return $query = $db->query("SELECT users.id as uid,follow_list.id,follow_list.follower_id,follow_list.user_id,follow_list.status,users.first_name,users.last_name,users.username,users.profile_pic,users.verify FROM follow_list JOIN users ON follow_list.follower_id = users.id WHERE follow_list.user_id=:user && follow_list.status = 'p' ORDER BY id DESC",[
            'user' => $cu_user_id
    ])->all();
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
    return $query = $db->query("SELECT count(*) as `row` FROM follow_list WHERE follower_id=:follower AND user_id=:user AND status!='p'",[
        'follower' => $current_user,
        'user' => $user_id,
    ])->find();
}
function checkFollowStatusF($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    return $query = $db->query("SELECT count(*) as `row` FROM follow_list WHERE follower_id=:follower AND user_id=:user AND status!='p'",[
            'follower' => $user_id,
            'user' => $current_user
    ])->find();
}
function checkStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    return $db->query("SELECT count(*) as `row` FROM follow_list WHERE follower_id=:follower AND user_id=:user AND status='p'",[
            'follower' => $current_user,
            'user' => $user_id,
    ])->find();
}

//for checking the user is followed by current user or not
function checkBlockStatus($current_user,$user_id){
    global $db;
   return $db->query("SELECT count(*) as `row` FROM block_list WHERE (user_id = :user AND blocked_user_id = :blocked)",[
            'user' => $current_user,
            'blocked' => $user_id,
    ])->find();
}

function checkBSS($user_id){
    global $db;
    return $db->query("SELECT count(*) as row FROM block_list WHERE blocked_user_id=:blocked AND user_id=:user",[
            'blocked' => $_SESSION['userdata']['id'],
            'user' => $user_id,
    ])->find();
}
function checkBS($user_id){
    global $db;
return $db->query("SELECT count(*) as `row` FROM block_list WHERE user_id=:user AND blocked_user_id=:blocked",[
        'user' => $_SESSION['userdata']['id'],
        'blocked' => $user_id,
])->find();
}
//
function checkLCK($user_id){
    global $db;
    return $db->query("SELECT count(*) as `row` FROM users WHERE (id = :id AND id != :user AND islocked=1 )",[
            'id' => $user_id,
            'user' => $_SESSION['userdata']['id'],
    ])->find();
}
//for getting users for follow suggestions
function getFollowSuggestions(){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    return $query = $db->query("SELECT * FROM users WHERE id!=:id",[
            'id' => $current_user,
    ])->all();
}

//get followers count
function getFollowers($user_id){
    global $db;
    return $db->query("SELECT * FROM follow_list WHERE user_id=:user",[
            'user' => $user_id,
    ])->all();
}

//get followers count
function getFollowing($user_id){
    global $db;
    return $db->query("SELECT * FROM follow_list WHERE follower_id=:user",[
            'user' => $user_id,
    ])->all();
}

//for getting posts by id
function getPostById($user_id){
    global $db;
    return $db->query("SELECT * FROM posts WHERE user_id=:user ORDER BY id DESC",[
            'user' => $user_id,
    ])->all();
}

//fir getting reels by id
function getReelsById($user_id){
    global $db;
    return $db->query("SELECT * FROM reels WHERE user_id=:user ORDER BY id DESC",[
            'user' => $user_id,
    ])->all();
}
//for getting post
function getPosterId($post_id){
    global $db;
    return $db->query("SELECT user_id FROM posts WHERE id=:id",[
        'id' => $post_id,
    ])->find();

}

function getPosterIdC($comment_id)
{
    global $db;
    return $db->query("SELECT user_id FROM comments WHERE id=:id",[
        'id' => $comment_id,
    ])->find();
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
    global $db;
    $cu_user_id = $_SESSION['userdata']['id'];
    $query = $db->query("SELECT count(*) as `row` FROM follow_list WHERE user_id=:user AND status='p' && read_status=0 ORDER BY id DESC",[
            'user' => $cu_user_id,
    ])->find();
    return $query['row'];
}

function setRequestAsRead(){
    global $db;
    return $db->query("UPDATE follow_list SET read_status=1 WHERE user_id=:user",[
            'user' => $_SESSION['userdata']['id']
    ]);
}

//for getting userdata by username
function getUserByUsername($username){
    global $db;
   return $db->query("SELECT * FROM users WHERE username=:username",[
            'username' => $username,
    ])->find();
}

//for getting posts
function getPost(){
    global $db;
    return $query = $db->query("SELECT users.id as uid,posts.id,posts.user_id,posts.post_img,posts.coLock,posts.post_text,posts.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify,users.bio FROM posts JOIN users ON users.id=posts.user_id ORDER BY id DESC",[])->all();

}

function reportPosts(){
    global $db;
    return $query = $db->query("SELECT users.id as uid, reports.user_id, reports.reporter_id, reports.post_id, reports.description, reports.reason, users.first_name, users.last_name, users.username, users.profile_pic, users.verify, posts.post_img, posts.post_text FROM reports JOIN users ON users.id=reports.reporter_id LEFT JOIN posts ON posts.id = reports.post_id ORDER BY reports.reporter_id DESC ",[])->all();
}
//for getting reels
function getReels(){
    global $db;
    return $query = $db->query("SELECT users.id as uid,reels.id,reels.user_id,reels.reel_post,reels.coLock,reels.reel_text,reels.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify 
FROM reels JOIN users ON users.id=reels.user_id ORDER BY id DESC",[])->all();
}

function deletePost($post_id){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $db->query("DELETE FROM likes WHERE post_id=:post_id AND user_id=:id",[
        'post_id' => $post_id,
        'id' => $user_id,
    ]);
    $db->query("DELETE FROM comments WHERE post_id=:post_id AND user_id=:id",[
        'post_id' => $post_id,
        'id' => $user_id,
    ]);
    $db->query("UPDATE notifications SET read_status=2 WHERE post_id=:post_id AND to_user_id=:id",[
        'post_id' => $post_id,
        'id' => $user_id,
    ]);
    $db->query("DELETE FROM posts WHERE id=:post_id",[
        'post_id' => $post_id,
    ]);
    return true;
}

function deleteMsg($msg_id){
    global $db;
    return $db->query("DELETE FROM messages WHERE id=:id",[
       'id' => $msg_id,
    ]);
}

function hideChat($chat_id){
    global $db;
    $user = $_SESSION['userdata']['id'];
    return $db->query("delete from messages WHERE (to_user_id=:id AND from_user_id=:user) OR (to_user_id=:user AND from_user_id=:id)",[
            'id' => $chat_id,
            'user' => $user,
    ]);
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
        $dellike = "DELETE FROM follow_list WHERE follower_id=$user_id";
        mysqli_query($db,$dellike);
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
    global $db,$protection;
    $first_name = $protection->stripTags($data['first_name']);
    $last_name = $protection->stripTags($data['last_name']);
    $gender = $data['gender'];
    $email = $protection->stripTags($data['username_email']);
    $username = $protection->stripTags($data['username']);
    $username = $protection->stripSlashes($username);
    $phone =$protection->stripTags($data['phone']);
    $phone =  $protection->filterInput($data['phone']);
    $password = $protection->stripTags($data['password']);
    $password = $protection->passwordHash($password);
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
    $query.="VALUES (:first_name,:last_name,:gender,:email,:username,:phone,:password,:profile_pic,:bg,:ac,:counter)";
    $db->query($query,[
            'first_name' => $first_name,
        'last_name' => $last_name,
        'gender' => $gender,
        'email' => $email,
        'username' => $username,
        'phone' => $phone,
        'password' => $password,
        'profile_pic' => $profile_pic,
        'bg' => $bg,
        'ac' => $ac,
        'counter' => $counter,
    ]);
    return true;
}

function createLoginDevice(){
    global $db;
    $query = "INSERT INTO logged_devices(user_id,logged_device,ip_address) ";
    $query.="VALUES (:user_id,:agent,:ip)";
    $db->query($query,[
       'user_id' => $_SESSION['userdata']['id'],
      'agent' => $_SERVER['HTTP_USER_AGENT'],
      'ip' => getIpAddr(),
    ]);
    return true;
}

function createMarket($name,$location,$text,$pic){
    global $db;
    $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
    $name = mysqli_real_escape_string($db,strip_tags($name,$allowed_tags));
    $location = mysqli_real_escape_string($db,strip_tags($location));
    $user_id = $_SESSION['userdata']['id'];
    $market_text = mysqli_real_escape_string($db,strip_tags($text));


    if($pic['name']){
        $image_name = time().basename($pic['name']);
        $image_dir="../images/market_profile/$image_name";
        move_uploaded_file($pic['tmp_name'],$image_dir);
        $market_pic=", market_pic='$image_name'";
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
//function for verify email
function resetPassword($email,$password){
    global $db;
    $password=md5($password);
    $query="UPDATE users SET password='$password' WHERE email='$email'";
    return mysqli_query($db,$query);
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
            $response['msg']="only jpg,jpeg,png images are allowed";
            $response['status']=false;
            $response['field']='profile_pic';
        }

        if($size>4000){
            $response['msg']="upload image less then 4 mb";
            $response['status']=false;
            $response['field']='profile_pic';
        }
    }

    if($bgimage['name']){
        $image = basename($bgimage['name']);
        $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $size = $bgimage['size']/4000;

        if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="only jpg,jpeg,png images are allowed";
            $response['status']=false;
            $response['field']='bg_pic';
        }

        if($size>4000){
            $response['msg']="upload image less then 4 mb";
            $response['status']=false;
            $response['field']='bg_pic';
        }
    }

    return $response;

}


//function for updating profile

function updateProfile($data,$imagedata,$bgimage){
    global $db,$protection,$validate;
    $oldpassword = $data['old_password'];
    $password = $data['password'];
    $retry = $data['re_password'];
    $toggle = isset($_POST['locked']) && $_POST['locked'] == 1 ? 1 : 0;

    $validate->validatePassword($oldpassword,$password,$retry);

    $profile_pic="";
    if($imagedata['name']){
        $image_name = time().basename($imagedata['name']);
        $image_dir="../images/profile/$image_name";
        move_uploaded_file($imagedata['tmp_name'],$image_dir);
        $profile_pic=$image_name;
    }

    $bg_pic="";
    if($bgimage['name']){
        $bg_name = time().basename($bgimage['name']);
        $bg_dir="../images/bg/$bg_name";
        move_uploaded_file($bgimage['tmp_name'],$bg_dir);
        $bg_pic=$bg_name;
    }

return $db->query("UPDATE users SET first_name = :first, last_name=:last,username=:username,bio=:bio, work=:work,city=:city,work_place=:work_place,
                 DoB=:DoB,islocked=:toggle,password=:password,profile_pic=:profile_pic,bg_pic=:bg WHERE id=:user",[
        'first' => $data['first_name'],
        'last' => $data['last_name'],
        'username' => $data['username'],
        'bio' => $data['bio'],
        'work' => $data['work'],
        'city' => $data['city'],
        'work_place' => $data['work_place'],
        'DoB' => $data['dateofbirth'],
        'toggle' => $toggle,
        'password' => $password,
        'profile_pic' => $profile_pic,
        'bg' => $bg_pic,
        'user' => $_SESSION['userdata']['id'],
]);
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
            $response['msg']="only jpg,jpeg,png images are allowed";
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
            $response['msg']="only jpg,jpeg,png images are allowed";
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
    global $db,$protection;
    $postText = $protection->stripTags($text['post_box']);
    $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;
    return $db->query ("INSERT INTO posts(user_id,post_text,post_img,post_vid,coLock) VALUES (:user,:text,:img,:vid,:toggle)",[
            'user' => $_SESSION['userdata']['id'],
            'text' => $postText,
            'img' => '',
            'vid' => '',
            'toggle' => $toggle,
    ]);
}

function createPost($text,$image){
    global $db,$protection;
    $post_text = $protection->stripTags($text['content'],$allowed_tags);
    $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;

    $image_name = time().basename($image['name']);
    $image_dir="../images/posts/$image_name";
    move_uploaded_file($image['tmp_name'],$image_dir);

   return $db->query("INSERT INTO posts(user_id,post_text,post_img,post_vid,coLock) VALUES (:user,:text,:img,:vid,:lock)",[
       'user' => $_SESSION['userdata']['id'],
       'text' => $post_text,
       'img' => $image_name,
       'vid' => '',
       'lock' => $toggle,
   ]);
}
//create reels
function createPostReel($image){
    global $db;

    $user_id = $_SESSION['userdata']['id'];
    $toggle = isset($_POST['clock']) && $_POST['clock'] == 1 ? 1 : 0;

    $image_name = time().basename($image['name']);
    $image_dir="../images/reels/$image_name";
    move_uploaded_file($image['tmp_name'],$image_dir);

    $query = "INSERT INTO reels(user_id,reel_post,coLock)";
    $query.="VALUES ($user_id,'$image_name','$toggle')";
    return mysqli_query($db,$query);
}

function maintenance(){
    global $db;
    $result = $db->query('select m_mode from admin',[])->find();
    return $result;
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
            $response['msg']="only jpg,jpeg,png images are allowed";
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

    $db->query("INSERT INTO stories(user_id,story_img,read_status) VALUES (:user,:img,:read)",[
            'user' => $user_id,
            'img' => $image_name,
        'read' => 0
    ]);
}

function deleteOldStories(){
    global $db;
    $time_limit = strtotime('-24 hours');
    return $db->query("DELETE FROM stories WHERE created_at < FROM_UNIXTIME(:limit)",[
            'limit' => $time_limit,
    ]);
}

function getStory(){
    global $db;
    return $query = $db->query("SELECT users.id as uid,stories.id,stories.user_id,stories.story_img,stories.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.verify,users.bio FROM stories JOIN users ON users.id=stories.user_id ORDER BY read_status = 0 desc",[])->all();
}
function getLikesForProfile($post_id){
    global $db;
    return $query = $db->query("SELECT users.id as uid,likes.id,likes.user_id,users.first_name,users.profile_pic FROM likes JOIN users ON users.id=likes.user_id where post_id=$post_id ORDER BY ID desc",[])->all();
}

//for showing recent searches
function getRecentSearches()
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    return $query = $db->query("SELECT DISTINCT users.id as uid,recent_searches.id,recent_searches.user_id,users.username,recent_searches.search_id,users.first_name,users.last_name,recent_searches.created_at,users.profile_pic FROM recent_searches JOIN users ON users.id=recent_searches.search_id where recent_searches.user_id=:id ORDER BY ID desc",[
            'id' => $user_id,
    ])->all();
}
function deleteRecent($search){
    global $db;
    $user = $_SESSION['userdata']['id'];
    $db->query("DELETE FROM recent_searches WHERE search_id = $search AND user_id = $user");

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
    return $db->query("UPDATE stories SET read_status = :read where id = :id",[
        'id' => $user_id,
        'read' => 1,
    ]);
}

function getUnreadstories($story_id){
    global $db;
    $query=$db->query("SELECT count(*) as row FROM stories WHERE read_status=0 && id=:id ORDER BY id DESC",[
            'id' => $story_id,
    ])->find();
    return $query['row'];
}

function updateLastLogin($user_id) {
    global $db;
    $db->query("UPDATE users SET last_login = NOW() WHERE id = :id",[
        'id' => $user_id,
    ]);
    header('Content-Type: application/json');
    echo json_encode(true);
}

function updateCounter($user_id){
    global $db;
    return $db->query("UPDATE users SET counter = :counter WHERE id = :id ",[
        'id' => $user_id,
        'counter' => 0,
    ]);


}
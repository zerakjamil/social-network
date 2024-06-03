<?php
require_once 'functions.php';

if(isset($_GET['sendmessage'])){
    if(sendMessage($_POST['user_id'],$_POST['msg'])){
        $response['status']=true;
    }else{
        $response['status']=false;

    }

    echo json_encode($response);
}

if(isset($_GET['getmessages'])){
$chats = getAllMessages();
$chatlist="";
foreach($chats as $chat){
    $ch_user = getUser($chat['user_id']);
    $seen=false;
    if($chat['messages'][0]['read_status']==1 || $chat['messages'][0]['from_user_id']==$_SESSION['userdata']['id']){
        $seen = true;
    }
    $chatlist.='  
    <div class="d-flex justify-content-between border-bottom chatlist_item" onclick="seenChat('.$chat['user_id'].')" >
                        <div class="d-flex align-items-center p-2" id="'.$chat['user_id'].'" data-bs-toggle="modal" data-bs-target="#chatbox" name="see" onclick="popchat('.$chat['user_id'].')">
                            <div><img src="assets/images/profile/'.$ch_user['profile_pic'].'" alt="" style="width: 50px;
                            height: 50px;
                            object-fit: cover;
                            border-radius: 50%;">
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center" >
                                <a href="#" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;">'.$ch_user['first_name'].' '.$ch_user['last_name'].'</h6></a>
                                <p style="margin:0px;font-size:small" class="">'.$chat['messages'][0]['msg'].'</p>
                                <time style="font-size:small" class="timeago text-small" datetime="'.$chat['messages'][0]['created_at'].'">'.gettime($chat['messages'][0]['created_at']).'</time>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
      
                          <div class="p-1 bg-primary rounded-circle '.($seen?'d-none':'').'"></div>
                        </div>    <button type="button" class="btn-close" onclick="hideChat('.$chat['user_id'].')"></button>
                    </div>';
    

}
$json['chatlist'] = $chatlist;

if(isset($_POST['chatter_id']) && $_POST['chatter_id']!=0){
$messages = getMessages($_POST['chatter_id']);
$chatmsg="";
if(checkBS($_POST['chatter_id'])){
    $json['blocked']=true;
}else{
    $json['blocked']=false;

}
updateMessageReadStatus($_POST['chatter_id']);

foreach($messages as $cm){
    $ch_user = getUser($_POST['chatter_id']);
if($cm['from_user_id']==$_SESSION['userdata']['id']){
    $cl1 = 'align-self-end bg-primary text-light';
    $cl2 = 'text-light';
    $cl3 = '
    <i class="bi bi-three-dots-vertical" id="option'.$cm['id'].'" data-bs-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="option'.$cm['id'].'" data-bs-auto-close="false">
    <li><a dropdown-item" href="assets/php/actions.php?deletemsg='.$cm['id'].'" class="dropdown-item" ><i class="bi bi-trash-fill">سرینەوەی نامە</i></a></li>
</ul>';
$isSeen = seenChatSelect($_POST['chatter_id']);
if ($isSeen['seenBy'] = 0) {
    $cl4 = '';
} elseif ($isSeen['$seenBy'] = 1) {
    $cl4 = '<span class="bi bi-check"></span>';
}

}else{
    $cl1 = '';
    $cl2 = 'text-muted';
    $cl3 = '';
    $cl4 = '';
}
            if ($cm['msg'] != '') {
                $chatmsg .= ' <div class="py-2 px-3 border rounded shadow-sm col-8 d-inline-block ' . $cl1 . '">' . $cm['msg'] . '' . $cl3 . '<br>
    <span style="font-size:small" class="' . $cl2 . '">' . gettime($cm['created_at']) . '</span>' . $cl4 . '
</div>';
            }elseif($cm['msg_voice'] != ''){
                $chatmsg .= ' <audio controls>
                <source src="assets/images/audio/'.$cm['msg_voice'].'" type="audio/mpeg">
              </audio>
               ';
            }
$chat_last_login = '<?=show_time($chat["last_login])?>';
}
$json['chat']['msgs']=$chatmsg;
$json['chat']['msgl']=$chat_last_login;
$json['chat']['userdata']=getUser($_POST['chatter_id']);
}else{
$json['chat']['msgs']='<div class="spinner-border text-center" role="status">
</div>';
}

$json['newmsgcount']=newMsgCount();
echo json_encode($json);
}

if(isset($_GET['unblock'])){
  $user_id = $_POST['user_id']; 
    if(unblockUser($user_id)){
        $response['status']=true;
        
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}




if(isset($_GET['notread'])){
    if(setNotificationStatusAsRead()){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['notbread'])){
    if(setNotificationStatusAsRead()){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['notiread'])){
    if(setRequestAsRead()){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['onlinestatus'])){
    $user_id = $_SESSION['userdata']['id']; 
    if (isset($_SESSION['Auth'])) {
     if(updateLastLogin($user_id)){
        $response['status']=true;
     }else{
        $response['status']=false;
     }
    }
    echo json_encode($response);
}

if(isset($_GET['read'])){
    $user_id = $_POST['user_id']; 
    if(setStoryAsRead($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['chatSeen'])){
    $chat_id = $_POST['chatId']; 
    $seenBy = $_POST['res'];
    $current_id = $_SESSION['userdata']['id'];
    if(seenChat($chat_id,$seenBy,$current_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['follow'])){
    $user_id = $_POST['user_id'];

    if(followUser($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['accept'])){
    $user_id = $_POST['user_id'];

    if(acceptUser($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

//to decline a request
if(isset($_GET['decline'])){
    $user_id = $_POST['user_id'];

    if(declineUser()){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['request'])){
    $user_id = $_POST['user_id'];

    if(requesting($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}


if(isset($_GET['unfollow'])){
    $user_id = $_POST['user_id'];


    if(unfollowUser($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['cancelfollow'])){
    $user_id = $_POST['user_id'];
    if(CancelFollow($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}


if(isset($_GET['deletecomment'])){
    $comment_id = $_POST['comment'];
      if(deleteComment($comment_id)){
        $response['status'] = true;
      }else{
        $response['status'] = false;
      }
      echo json_encode($response);
    }



    if (isset($_GET['userId'])) {
        // get the user ID from the AJAX request
        $userId = $_POST['userId'];
      
        // update the user's last login value in the database
        // replace "your_database" and "your_table" with the actual names of your database and table
        $mysqli = $db;
        $query = "UPDATE users SET last_login = NOW() WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
       
      
        // send the updated last_login value back to the JavaScript function
        $response = array('last_login' => date('Y-m-d H:i:s'));
        echo json_encode($response);
      }


    if(isset($_GET['hidemessages'])){
        $chat_id = $_POST['chat'];
        if(hideChat($chat_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
        echo json_encode($response);
        }


if(isset($_GET['like'])){
    $post_id = $_POST['post_id'];

    if(!checkLikeStatus($post_id)){
        if(like($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}


if(isset($_GET['recentsearch'])){
    $search = $_POST['search'];
    $searchId = $_POST['id'];


        if(recentSearches($search,$searchId)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    

  
}

if(isset($_GET['likeC'])){
    $comment_id = $_POST['comment_id'];
    if(!checkLikeStatusC($comment_id)){
        if(likeC($comment_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
        echo json_encode($response);
    }

  
}

if(isset($_GET['unlike'])){
    $post_id = $_POST['post_id'];

    if(checkLikeStatus($post_id)){
        if(unlike($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}

//for deleting searche history
if(isset($_GET['deletesearch'])){
    $search_id = $_POST['search'];
    $search_user = $_POST['user'];

        if(deleteRecent($search_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
        echo json_encode($response);
}
//to unlike a comment 
if(isset($_GET['unlikeC'])){
    $comment_id = $_POST['comment_id'];

    if(checkLikeStatusC($comment_id)){
        if(unlikeC($comment_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}

if(isset($_GET['addcomment'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

        if(addComment($post_id,$comment)){
      $cuser = getUser($_SESSION['userdata']['id']);
      $time = date("Y-m-d H:i:s");
            $response['status']=true;
            $response['comment']='<div class="d-flex align-items-center p-2">
            <div><img src="assets/images/profile/'.$cuser['profile_pic'].'" alt="" style="width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;">
            </div>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-start align-items-start">
                <h6 style="margin: 0px;"><a href="?u='.$cuser['username'].'" class="text-decoration-none text-muted">@'.$cuser['username'].'</a> - '.$_POST['comment'].'</h6>
                <p style="margin:0px;" class="text-muted" style="font-size:small">(ئێستا)</p>
            </div>
        </div>';
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    

  
}

if(isset($_GET['addreply'])){
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['comment_id'];
    $comment = $_POST['comment'];

        if(addReply($post_id,$comment_id,$comment)){
      $cuser = getUser($_SESSION['userdata']['id']);
      $time = date("Y-m-d H:i:s");
            $response['status']=true;
            $response['comment']='<div class="d-flex align-items-center justify-content-start align-self-end p-2">
            <div><img src="assets/images/profile/'.$cuser['profile_pic'].'" alt="" style="
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;">
            </div>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-start align-items-start">
                <h6 style="margin: 0px;"><a href="?u='.$cuser['username'].'" class="text-decoration-none text-muted">@'.$cuser['username'].'</a> - '.$_POST['comment'].'</h6>
                <p style="margin:0px;" class="text-muted" style="font-size:small">(ئێستا)</p>
            </div>
        </div>';
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    

  
}

if(isset($_GET['search'])){
    $keyword = $_POST['keyword'];
    $data = searchUser($keyword);
$users="";
    if(count($data)>0){
        $response['status']=true;
     
        foreach($data as $fuser){
            $fbtn='';
            if($fuser['id']==$_SESSION['userdata']['id']){
                continue;
            }
            if(checkBSS($fuser['id'])){
       $users.='';

        }

        elseif(!checkBSS($fuser['id'])){
            $users.=' <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center p-2">
                                     <div><img src="assets/images/profile/'.$fuser['profile_pic'].'" alt="" style=" width: 50px;
                                     height: 50px;
                                     object-fit: cover;
                                     border-radius: 50%;">
                                     </div>
                                     <div>&nbsp;&nbsp;</div>
                                     <div class="d-flex flex-column justify-content-center">
                                         <a href="?u='.$fuser['username'].'" onclick="recentSearches(\''.$fuser['first_name'].' '.$fuser['last_name'].'\', '.$fuser['id'].')" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;">'.$fuser['first_name'].' '.$fuser['last_name'].'</h6></a>
                                         <p style="margin:0px;font-size:small" class="text-muted">@'.$fuser['username'].'</p>
                                     </div>
                                 </div>
                                 <div class="d-flex align-items-center">
                                   '.$fbtn.'
             
                                 </div>
                             </div>';
             
             }
    }
                    
        
$response['users']=$users;



    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}



if(isset($_GET['search_m'])){
    $keyword = $_POST['keyword'];
    $data = searchUser($keyword);
$users="";
    if(count($data)>0){
        $response['status']=true;
     


        foreach($data as $fuser){
            $fbtn='';
        
            if($fuser['id']==$_SESSION['userdata']['id']){
                continue;
            }
            if(!checkBS($fuser['id'])){
                if(checkFollowStatusF($fuser['id'])){
                    
                    $users.=' <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/'.$fuser['profile_pic'].'" alt="" style=" width: 50px;
                        height: 50px;
                        object-fit: cover;
                        border-radius: 50%;" >
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="?u='.$fuser['username'].'" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;">'.$fuser['first_name'].' '.$fuser['last_name'].'</h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@'.$fuser['username'].'<i class="uil uil-message" style="margin-left:8px; cursor:pointer; color:black; font-size:16px;" data-bs-target="#chatbox" onclick="popchatt('.$fuser['id'].')"></i></p>
                            <p style="margin:0px;font-size:small" class="text-muted">شوێنن تۆ کەوتووە</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                      '.$fbtn.'

                    </div>
                </div>';
            }else{
                $users.=' <div class="d-flex justify-content-between">
                                     <div class="d-flex align-items-center p-2">
                                         <div><img src="assets/images/profile/'.$fuser['profile_pic'].'" alt="" style="width: 50px;
                                         height: 50px;
                                         object-fit: cover;
                                         border-radius: 50%;">
                                         </div>
                                         <div>&nbsp;&nbsp;</div>
                                         <div class="d-flex flex-column justify-content-center">
                                             <a href="?u='.$fuser['username'].'" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;">'.$fuser['first_name'].' '.$fuser['last_name'].'</h6></a>
                                             <p style="margin:0px;font-size:small" class="text-muted">@'.$fuser['username'].'<i class="uil uil-message" style="margin-left:8px; font-size:16px; color:black; cursor:pointer;" data-bs-target="#chatbox" onclick="popchatt('.$fuser['id'].')"></i></p>
                                         </div>
                                     </div>
                                     <div class="d-flex align-items-center">
                                       '.$fbtn.'
                 
                                     </div>
                                 </div>';
            }
                             }
        }
    
                    
        
$response['users']=$users;



    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}


if(isset($_GET['getmessenger'])){
    $chats = getAllMessages();
    $chatlist="";
    foreach($chats as $chat){
        $ch_user = getUser($chat['user_id']);
        $seen=false;
        if($chat['messages'][0]['read_status']==1 || $chat['messages'][0]['from_user_id']==$_SESSION['userdata']['id']){
            $seen = true;
        }

        $user_last_login = $ch_user['last_login']; // replace with the user's last login time
        $last_login_timestamp = strtotime($user_last_login);
        $current_timestamp = time();
        $cl5 = '';
        if (($current_timestamp - $last_login_timestamp) < 120) {
             $cl5 = '<div class="online"></div>';
        } else {
            $cl5 = '';
        }

        $chatlist.='  
        <div class="chatlist_itemm" onclick="seenChat('.$chat['user_id'].')">
        <div class="discussion"  id="'.$chat['user_id'].'" data-bs-target="#chatboxx" name="see" onclick="popchatt('.$chat['user_id'].')">
        <div style="margin-left:3%;"><img src="assets/images/profile/'.$ch_user['profile_pic'].'" alt="" style="width: 55px;
                            height: 55px;
                            object-fit: cover;
                            border-radius: 50%;
                            ">
                            </div>
        <div class="desc-contact">
          <p class="name">'.$ch_user['first_name'].' '.$ch_user['last_name'].'</p>
          <p class="message">'.$chat['messages'][0]['msg'].'</p>
        </div>
        <div class="timer"><time style="font-size:small" class="timeago text-small" datetime="'.$chat['messages'][0]['created_at'].'">'.gettimeC($chat['messages'][0]['created_at']).'</time></div>
      </div>
      </div>';
        
                       
    
    }
    $json['chatlist'] = $chatlist;
    
    if(isset($_POST['chatter_id']) && $_POST['chatter_id']!=0){
    $messages = getMessages($_POST['chatter_id']);
    $chatmsg="";
    if(checkBS($_POST['chatter_id'])){
        $json['blocked']=true;
    }else{
        $json['blocked']=false;
    
    }
    updateMessageReadStatus($_POST['chatter_id']);
    
    foreach($messages as $cm){
        $ch_user = getUser($_POST['chatter_id']);
    if($cm['from_user_id']==$_SESSION['userdata']['id']){
        $cl1 = 'response ';
        $cl2 = '';
        $cl3 = '
        <i class="bi bi-three-dots-vertical" id="option'.$cm['id'].'" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="option'.$cm['id'].'" data-bs-auto-close="false">
        <li><a dropdown-item" href="assets/php/actions.php?deletemsg='.$cm['id'].'" class="dropdown-item" ><i class="bi bi-trash-fill">سرینەوەی نامە</i></a></li>
    </ul>';
    $cm_id = $cm['seenBy']; // replace with the chat message ID you want to check
$isSeen = seenChatSelect($cm_id);
if(isset($isSeen['seenBy']) && $isSeen['seenBy'] == 1){
    $cl4 = '<span class="bi bi-check"></span>';
}else{
    $cl4 = '';
}
$cl6 = 'align-self-end';
                
    }else{
        $cl1 = 'message';
        $cl2 = ' <div class="photo" style="background-image: url(assets/images/profile/'.$ch_user['profile_pic'].');">
        
      </div>';
        $cl3 = '';
        $cl4 = '';
        $cl6 = '';
    }
    
        $chatmsg.='<p class="time text-dark '.$cl6.'">'.gettime($cm['created_at']).'</p>
        <div class="message">
       '.$cl2.'
        <div class="'.$cl1.'" >
        <p class="text">'.$cm['msg'].' '.$cl4.'</p>
        </div>
      </div>
    </div>';
    $chat_last_login = '<?=show_time($chat["last_login])?>';
    }
    $json['chat']['msgs']=$chatmsg;
    $json['chat']['msgl']=$chat_last_login;
    $json['chat']['userdata']=getUser($_POST['chatter_id']);
    }else{
    $json['chat']['msgs']='<div class="spinner-border text-center" role="status">
    </div>';
    }
    
    $json['newmsgcount']=newMsgCount();
    echo json_encode($json);
    }
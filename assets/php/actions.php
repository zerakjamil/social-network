<?php
ob_start();
require_once 'functions.php';
require_once 'send_code.php';
require_once 'sencode_phone.php';




if(isset($_GET['block'])){
    $user_id = $_GET['block'];
    $user = $_GET['username']; 
      if(blockUser($user_id)){
          header("location:../../?u=$user");
      }else{
          echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
      }
  
    
  }

 

  if(isset($_GET['deletepost'])){
    $post_id = $_GET['deletepost'];
      if(deletePost($post_id)){
          header("location:{$_SERVER['HTTP_REFERER']}");
      }else{
          echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
      }
  
    
  }

  if(isset($_GET['deletemsg'])){
    $msg_id = $_GET['deletemsg'];
      if(deleteMsg($msg_id)){
          header("location:{$_SERVER['HTTP_REFERER']}");
      }else{
          echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
      }
  
    
  }

  


   if(isset($_GET['deleteuser'])){
    $user_id = $_GET['deleteuser'];
    $delin = md5($_POST['del_acc']);
      if(deleteUser($user_id,$delin)){
        session_destroy();
        header('location:../../');
      }else{
        echo '<script type="text/javascript>alert("تێپەڕە وشەکەت هەڵەیە")</script>"';
        header("location:{$_SERVER['HTTP_REFERER']}");
      }
  
    
  }

//for editing text
if(isset($_GET['editposttxt'])){
    $response = $_POST;
    $post_id = $_GET['editposttxt'];
    if(editpost($post_id,$response)){
        header("location:{$_SERVER['HTTP_REFERER']}");
    }else {
        echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
    }
}
//verifying user
if(isset($_GET['contact'])){
    $name = $_POST['contact_name'];
    $email = $_POST['contact_email'];
    $msg = $_POST['contact_message'];
    $response = validateContactForm($name,$email,$msg);
    if($response['status']){
        if(contactUs($name,$email,$msg)){
        header("location:{$_SERVER['HTTP_REFERER']}&successs");
        }else {
        echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
        }
}else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:{$_SERVER['HTTP_REFERER']}");
    }
}


if(isset($_GET['report']) && isset($_GET['userId'])){
    $response = $_GET['report'];
    $user_id = $_GET['userId'];
    $reason = $_POST['reason'];
    $report_msg = $_POST['report_message'];
    if(reportPost($user_id,$response,$reason,$report_msg)){
        header("location:{$_SERVER['HTTP_REFERER']}");
    }else{
        echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
    }
}

if(isset($_COOKIE['user_id'])) {
    // start session and log user in
    $user_id = $_COOKIE['user_id'];
    $_SESSION['user_id'] = $user_id;
}

//for managaing signup
if(isset($_GET['signup'])){
$response=validateSignupForm($_POST);
if($response['status']){
    createUser($_POST);
    $responsee=validateLoginFormA($_POST);
    if($responsee['status']){
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $responsee['user'];
        $user_id = $_SESSION['userdata']['id'];
        if($responsee['user']['ac_status'] == 0){
                    $_SESSION['code'] = $code = rand(111111, 999999);
                    sendCode($responsee['user']['email'], 'Verify Your Email', $code);
        }
        if($responsee['user']['ac_status'] == 3){
                $_SESSION['code'] = $code = rand(111111, 999999);
                sendCodePhone('+964'.$responsee['user']['phone'],$code);       
        }
     
       header("location:../../");
    }else{
        echo "<script>alert('هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە')</script>";
    }
    
}else{
    $_SESSION['error']=$response;
    $_SESSION['formdata']=$_POST;
    header("location:../../?signup");
}
    
}
  
    if(isset($_GET['marketcreate'])){
        $response = validateMarketForm($_POST,$_FILES['market_pic']);
        if($response['status']){
            if(createMarket($_POST,$_FILES['market_pic'])){
                header("location:../../?market");
            }else {
            echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
            }
    }else{
            $_SESSION['error']=$response;
            $_SESSION['formdata']=$_POST;
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
    }
//for managing login
if(isset($_GET['login'])){
    $response=validateLoginForm($_POST);
    $time=time()-30;
    $username = $_POST['username_email'];
     $ip_address=getIpAddr();
    if($response['status']){
     $_SESSION['Auth'] = true;
     $_SESSION['userdata'] = $response['user'];
     $user_id = $_SESSION['userdata']['id'];
     if($response['user']['ac_status']==0){
     $_SESSION['code']=$code = rand(111111,999999);
     sendCode($response['user']['email'],'Verify Your Email',$code);
     }
    updateLastLogin($user_id);
    deleteFromAttempts($ip_address,$username);
    
    if($response['user']['twoStep']==1){
        if (empty(getDevice($_SESSION['userdata']['id'],$_SERVER['HTTP_USER_AGENT'],$ip_address))) {
                createNotification(9999,$_SESSION['userdata']['id'],'کەسێک لە ڕێگەی ئامێرێکی نەناسراو هەوڵی هاتنە ژوورەوەی ئەکاونتەکەی تۆ ئەدا، ئایە ئەو کەسە تۆی؟ گەر تۆ نی پێشنیاری گۆڕینی تێپەڕەوشە ئەکەین بە زووترین کات');
            header("location:../../");
        }else{
            header("location:../../");
        }
    } elseif($response['user']['twoStep']==0) {
        header("location:../../");
    }
    }else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        if (!checkLockStatus($username)) {
            addingLoginAttempts($username, $ip_address);
        }
        if (loginAttempts($time,$ip_address,$username) > 5) {
            lockAccount($username);
            $response=array();
            $response['msg']=" ئەم ئەکاونتە قفڵ بووە ، تکایە دواتر هەوڵبدەوە ";
            $response['status']=false;
            $response['field']='password';
            
            $_SESSION['error']=$response;
        }
        if (checkLockStatus($username)) {
            $response=array();
            $response['msg']=" ئەم ئەکاونتە قفڵ بووە ، تکایە دواتر هەوڵبدەوە ";
            $response['status']=false;
            $response['field']='password';
            
            $_SESSION['error']=$response;
        }
        header("location:../../?login");
    }
        
    }


if (isset($_COOKIE['remember_me'])) {
    global $pdo;
    $sql = "SELECT user_id FROM remember_me_tokens WHERE token = :token AND expires > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':token' => $_COOKIE['remember_me']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // User found, log them in
        $_SESSION['user_id'] = $result['user_id'];

        // Update the timestamp in the database
        $sql = "UPDATE remember_me_tokens SET expires = DATE_ADD(NOW(), INTERVAL 1 MONTH) WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':token' => $_COOKIE['remember_me']]);
    } else {
        // Invalid or expired token, delete the cookie
        setcookie('remember_me', '', time() - 3600);
    }
}

    if(isset($_GET['resend_code'])){
       
            $_SESSION['code']=$code = rand(111111,999999);
            sendCode($_SESSION['userdata']['email'],'Verify Your Email',$code);
            header('location:../../?resended');
    }

    if(isset($_GET['resend_code_phone'])){
        $_SESSION['code']=$code = rand(111111,999999);
        sendCodePhone('+964'.$_SESSION['userdata']['phone'],$code);
        header('location:../../?resendedd');
}
if(isset($_GET['sverify'])){
    $user_code = $_POST['code'];
    $code = $_SESSION['code'];
    $response = validateSform($_POST,$code);
    if($response['status']){
        if ($code == $user_code) {
            if (activateSv($_SESSION['userdata']['phone'])) {
                header('location:../../?editprofile');
            } else {
                echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
            }

        }
        }else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        $_SESSION['error']=$response;
  
        header("location:../../?twostepverification&failed");
    }
    
}


    if(isset($_GET['verify_email'])){
       $user_code = $_POST['code'];
       $code = $_SESSION['code'];
       if($code==$user_code){
       if(verifyEmail($_SESSION['userdata']['email'])){
        createLoginDevice();
        header('location:../../');
       }else{
           echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
       }

       }else{
           $response['msg']='کۆدی سەلماندن هەڵەیە';
           if(!$_POST['code']){
            $response['msg']='تکایە شەش ژمارە داخیل بکە';

           }
           $response['field']='email_verify';
        $_SESSION['error']=$response;
        header('location:../../');

       }
       
}


if(isset($_GET['forgotpassword'])){
    if(!$_POST['email']){
        $response['msg']="ئیمەڵەکەت داخیل بکە";
        $response['field']='email';
        $_SESSION['error']=$response;
        header('location:../../?forgotpassword');

    }elseif(!isEmailRegistered($_POST['email'])){
        $response['msg']="ئەم ئیمەیڵە تۆمارنەکراوە";
        $response['field']='email';
        $_SESSION['error']=$response;
        header('location:../../?forgotpassword');

    }else{
          $_SESSION['forgot_email']=$_POST['email'];
           $_SESSION['forgot_code']=$code = rand(111111,999999);
            sendCode($_POST['email'],'NETlink',$code);
            header('location:../../?forgotpassword&resended');
            ob_end_flush();
    }
}

if(isset($_GET['stepver'])){
    if(!$_POST['phone']){
        $response['msg']="ژمارەکەت داخیل بکە";
        $response['field']='phone';
        $_SESSION['error']=$response;
        header('location:../../');

    }if($_POST['phone'] != $_SESSION['userdata']['phone']){
        $response['msg']=" ژمارەکەت ناگونجێ لەگەڵ ژمارەی تۆمارکراوی ئەم ئەکاونتە تکایە دووبارە هەوڵبدەوە ";
        $response['field']='phone';
        $_SESSION['error']=$response;
        header('location:../../');

    }else{
          $_SESSION['forgot_phone']=filterInputValue($_POST['phone']);
           $_SESSION['forgot_code']=$code = rand(111111,999999);
           sendCodePhone('+964'. $_SESSION['forgot_phone'],$code);
            header('location:../../?');
            ob_end_flush();
    }
}

if(isset($_GET['verifyphone'])){
    $user_code = $_POST['code'];
    $code = $_SESSION['forgot_code'];
    if($code==$user_code){
    $_SESSION['auth_temp']=true;
        createLoginDevice();
     header('location:../../?');
    }else{
        $response['msg']='کۆدی سەلماندنەکە هەڵەیە';
        if(!$_POST['code']){
         $response['msg']='تکایە شەش ژمارە داخیل بکە';
         $response['field']='code';
        }
        $response['field']='code';
     $_SESSION['error']=$response;
     header('location:../../?');

    }
    
}

//for logout the user
if(isset($_GET['logout'])){
    session_destroy();
    header('location:../../');

}


// for verify forgot code
if(isset($_GET['verifycode'])){
    $user_code = $_POST['code'];
    $code = $_SESSION['forgot_code'];
    if($code==$user_code){
    $_SESSION['auth_temp']=true;
     header('location:../../?forgotpassword');
    }else{
        $response['msg']='کۆدی سەلماندنەکە هەڵەیە';
        if(!$_POST['code']){
         $response['msg']='تکایە شەش ژمارە داخیل بکە';

        }
        $response['field']='email_verify';
     $_SESSION['error']=$response;
     header('location:../../?forgotpassword');

    }
    
}

//verify deleting user
if(isset($_GET['del_account_pass'])){
    $user_code = $_POST['code'];
    $code = $_SESSION['forgot_code'];
    if($code==$user_code){
    $_SESSION['auth_temp']=true;
     header('location:../../?forgotpassword');
    }else{
        $response['msg']='کۆدی سەلماندنەکە هەڵەیە';
        if(!$_POST['code']){
         $response['msg']='تکایە شەش ژمارە داخیل بکە';

        }
        $response['field']='email_verify';
     $_SESSION['error']=$response;
     header('location:../../?forgotpassword');

    }
    
}

if(isset($_GET['changepassword'])){
    if(!$_POST['password']){
        $response['msg']="تێپەرە وشەی تازە داخیل بکە";
        $response['field']='password';
        $_SESSION['error']=$response;
        header('location:../../?forgotpassword');
    }else{
        resetPassword($_SESSION['forgot_email'],$_POST['password']);
        session_destroy();
        header('location:../../?reseted');
    }


}


if(isset($_GET['updateprofile'])){

    $response=validateUpdateForm($_POST,$_FILES['profile_pic'],$_FILES['bg_pic']);

    if($response['status']){
       
        if(updateProfile($_POST,$_FILES['profile_pic'],$_FILES['bg_pic'])){
            header("location:../../?editprofile&success");

        }else{
            echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
        }
       
    
    }else{
        $_SESSION['error']=$response;
        header("location:../../?editprofile");
    }
     
}

if(isset($_GET['updatemarket'])){

    $response=validateMarketUpdateForm($_POST,$_FILES['market_pic']);

    if($response['status']){
       
        if(updateMarketProfile($_POST,$_FILES['market_pic'])){
            header("location:../../?editmarket&success");

        }else{
            echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
        }
       
    
    }else{
        $_SESSION['error']=$response;
        header("location:../../?editmarket");
    }
     
}

//for managing add post
if(isset($_GET['addpost'])){
   $response = validatePostImage($_FILES['post_img']);

   if($response['status']){
if(createPost($_POST,$_FILES['post_img'])){
    header("location:../../?new_post_added");
}else{
    echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
}
   }else{
    $_SESSION['error']=$response;
    header("location:../../");
   }
}

if(isset($_GET['addposttext'])){
    $response = validatePostText($_POST['post_box']);
 
    if($response['status']){
 if(createPostText($_POST)){
     header("location:../../?new_post_added");
 }else{
     echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }

//for adding reels
if(isset($_GET['addreel'])){
    $response = validatePostReel($_FILES['post_reel']);
 
    if($response['status']){
 if(createPostReel($_FILES['post_reel'])){
     header("location:../../?shorts");
 }else{
     echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }

//for adding story
if(isset($_GET['addstory'])){
    $response = validatePostImage($_FILES['story_img']);
 
    if($response['status']){
 if(createStories($_FILES['story_img'])){
     header("location:../../?new_story_added");
 }else{
     echo "هەڵەیەک روویدا لە کاتی جێبەجێ کردنی داواکاریەکەت، تکایە دووبارە هەوڵ بدەوە";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }

 if(isset($_GET['counter'])){
$user_id = $_GET['counter'];
if(updateCounter($user_id)){
    header("location:../../");
}
}

if(isset($_GET['twostepverification'])){
    $_SESSION['code']=$code = rand(111111,999999);
    sendCodePhone('+964'.$_SESSION['userdata']['phone'],$code);
    header("location:../../?twostepverification");
  }
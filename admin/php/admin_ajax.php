<?php
require_once('admin_functions.php');
require_once '../../assets/php/send_code.php';

if(isset($_GET['verify_user'])){
    $user = getUser($_POST['user_id']);
    if(verifyEmail($user['email'])){
    
        $response['status']=true;

    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['block_user'])){
   
    if(blockUserByAdmin($_POST['user_id'])){
    
        $response['status']=true;

    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_GET['ver_user'])){
    if(verifyUser($_POST['user_id'])){
        $response['status'] = true;
        createNotification(9999,$_POST['user_id'],' ئێمە وەک تیمی نێت لینک پیرۆزبایی بوونت بە کەسایەتیەکی فەرمی ناو تۆڕەکەمان لێ ئەکەین، کەسایەتیە فەرمیەکان زیاتر لە کەسانی ئاسایی گوێ لە قسە و رەخنەکانیان ئەگیرێ لە کاتی بوونی هەر کێشەیەک لەم بەشەوە ئەتوانی ئێمە ئاگادار بکەیتەوە <a href="?contact">پەیوەندی</a>، سوپاس بۆ بەکارهێنانی نێت لینک ');
    }else{
        $response['status'] = false;
    }
    echo json_encode($response);
}


if(isset($_GET['unblock_user'])){
   
    if(unblockUserByAdmin($_POST['user_id'])){
    
        $response['status']=true;

    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}
<?php
require_once($function_url??'../../assets/php/functions.php');

//for checking the user
function checkAdminUser($login_data){
global $db,$protection;
 $query = $db->query("SELECT * FROM admin WHERE email=:email && password=:password",[
     'email' => $login_data['email'],
     'password' => $protection->passwordHash($login_data['password']),
 ])->find();
 $data['user'] = $query??array();
 if(count($data['user'])>0){
     $data['status']=true;
     $data['user_id']=$data['user']['id'];
 }else{
    $data['status']=false;
 }
 return $data;
}



function verifyUser($user_id){
    global $db;
    $db->query("UPDATE users SET counter = 2 WHERE id = :id",[
        'id' => $user_id,
    ]);
    $db->query("UPDATE users SET verify=1 WHERE id = :id",[
        'id' => $user_id,
    ]);
    return json_encode(true);
}

function getAdmin($user_id){
    global $db;
 return $query = $db->query("SELECT * FROM admin WHERE id= :id",[
     'id' => $user_id,
 ])->find();
}

function totalCommentsCount(){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM comments",[])->find();
    return $query['row'];
}

function totalPostsCount(){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM posts",[])->find();
    return $query['row'];
}

function totalUsersCount(){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM users",[])->find();
    return $query['row'];
}

function totalLikesCount(){
    global $db;
    $query=$db->query("SELECT count(*) as `row` FROM likes",[])->find();
    return $query['row'];
}

function getUsersList(){
    global $db;
    $query=$db->query("SELECT * FROM users ORDER BY id DESC",[])->all();
    return $query;
}

function loginUserByAdmin($email){
    global $db;
    $query = $db->query("SELECT * FROM users WHERE email= :email",[
        'email' => $email,
    ])->find();
    $data['user'] = $query??array();
    if(count($data['user'])>0){
        $data['status']=true;
    }else{
       $data['status']=false;
    }
    return $data; 
}

function blockUserByAdmin($user_id){
    global $db;
    return $db->query("UPDATE users SET ac_status=2 WHERE id= :id",[
        'id' => $user_id,
    ]);
}
function unblockUserByAdmin($user_id){
    global $db;
   return $db->query("UPDATE users SET ac_status=1 WHERE id= :id",[
       'id' => $user_id,
   ]);
}
function updateAdmin($data){
    global $db,$protection;

    return $db->query("UPDATE admin SET full_name= :full_name,email= :email,password= :password,password_text= :password_text,m_mode= :toggle WHERE id= :user_id",[
        'full_name' => $data['full_name'],
        'email' => $data['email'],
        'password' => $protection->passwordHash($data['password']),
        'password_text' => $data['password'],
        'm_mode' => isset($_POST['locked']) && $_POST['locked'] == 1 ? 1 : 0,
        'user_id' => $data['user_id'],
    ]);
}
?>
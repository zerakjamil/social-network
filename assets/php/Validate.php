<?php

class Validate
{
    public function validateSignupForm($form_data)
    {
        $response = array();
        $response['status'] = true;

        if (!$form_data['password']) {
            $response['msg'] = "تێپەرەوشە دانەنراوە";
            $response['status'] = false;
            $response['field'] = 'password';
        }

        if (!$form_data['username']) {
            $response['msg'] = "ناویبەکارهێنەر دانەنراوە";
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if (!$form_data['phone']) {
            $response['msg'] = "ژمارەکەی تەلەفۆن دانەنراوە";
            $response['status'] = false;
            $response['field'] = 'phone';
        }

        if (!$form_data['username_email']) {
            $response['msg'] = "ئیمەیڵ دانەنراوە";
            $response['status'] = false;
            $response['field'] = 'email';
        }

        if (!$form_data['last_name']) {
            $response['msg'] = "ناوی دووەم دانەنراوە";
            $response['status'] = false;
            $response['field'] = 'last_name';
        }
        if (!$form_data['first_name']) {
            $response['msg'] = "ناوی یەکەم دا نەنراوە";
            $response['status'] = false;
            $response['field'] = 'first_name';
        }
        if (isEmailRegistered($form_data['username_email'])) {
            $response['msg'] = "ئەم ئیمەیڵە پێشتر تۆمارکراوە";
            $response['status'] = false;
            $response['field'] = 'email';
        }
        if (isPhoneRegistered($form_data['phone'])) {
            $response['msg'] = "ئەم ژمارەیە پێشتر تۆمارکراوە";
            $response['status'] = false;
            $response['field'] = 'phone';
        }
        if (isUsernameRegistered($form_data['username'])) {
            $response['msg'] = "ئەم ناوی بەکارهێنەرە پێشتر تۆمارکراوە";
            $response['status'] = false;
            $response['field'] = 'username';
        }

        return $response;
    }

    public function validateMarketForm($name,$location,$text){
        $response=array();
        $response['status']=true;

        if(!$name){
            $response['msg']="ناوێک بۆ فرۆشگاکەت هەڵبژێرە";
            $response['status']=false;
            $response['field']='marketName';
        }

        if(!$location){
            $response['msg']="تکایە ناونیشانی فرۆشگا یان خۆت دابنێ";
            $response['status']=false;
            $response['field']='location';
        }
        if(!$text){
            $response['msg'] = "تکایە وەسفی فرۆشگاکەت بکە";
            $response['status']=false;
            $response['field']='market_text';
        }

        if(isMarketRegistered($_SESSION['userdata']['id'])){
            $response['msg']="تۆ خاوەنی فرۆشگای تکایە فرۆشگای ئێستات بسرەوە ئینجا هەوڵبدەوە";
            $response['status']=false;
            $response['field']='marketName';
        }
        return $response;

    }
    public function validateContactForm($name,$email,$msg){
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

    public function validateLoginForm($form_data){
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
            $response['msg']=" ئەم ئەکاونتە قفڵ بووە ، تکایە دواتر هەوڵبدە ";
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
    public function validateLoginFormA($form_data){
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
    }
<?php
unlockExpiredAccounts();
?>
    <div class="login" >
        <div class="col-sm-12 col-md-4 bg-white p-4 shadow d-flex login_form">
    
            <form method="post" action="assets/php/actions.php?login" class="w-100 formm" >
                <div class="d-grid justify-content-center">
                <h1 style="text-align: center;">NETlink</h1>
                <h1 class="h5 mb-3 fw-normal"  style="text-align: center; ">بچۆژوورەوە</h1>
                    
                </div>
            

               
                    <div class="input-form">
    <input type="text" class="input" name="username_email" value="<?=showFormData('username_email')?>" name="username_email"  required="">
    <label class="textUser">ناوی بەکارهێنەر/ئیمەیڵ </label>
  </div>
               
                <?=showError('username_email')?>
                <div class="input-form" >
    <input type="password" class="input_pass" name="password" id="floatingPassword" value="<?=showFormData('password')?>" required="">
    <label class="passUser"> تێپەرەووشە</label>
    <span id="boot-icon" class="bi bi-eye-fill" style="font-size: 20px;  cursor:pointer; position:absolute; top:13px; right:9px; "></span>
  </div>
                <?=showError('password')?>
                <?=showError('checkuser')?>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                   
                    
                    
                </div>
                <div class="" style="  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;">
                    <button class="btn btn-primary button-blue" type="submit" style="margin:7px; border-radius: 15px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding-left:3%; padding:3%;">چوونەژوور</button>
                <a href="?forgotpassword&newfp" class="text-decoration-none" style="color: #66a6ff;">تێپەرەوشەت لە یادکردووە؟</a>
                </div>
                <div style="display: flex;
  align-items: center;
  justify-content: center;"> <button class="btn btn-primary button-blue" type="submit" style="margin:7px; border-radius: 15px; background: linear-gradient(to bottom, #4dc7d9 0%, #66ff99 100%);
 border:none; margin-bottom:10px; width: 160px; margin-top:15px; "><a href="?signup" class="text-decoration-none" style="color: #fff;">ئەکاونتێک درووستبکە</a></button>
</div>
             

            </form>
           
        </div>
    </div>
    <style>
.button-blue:hover{
  border-color:#008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}
        .input-form {
  position: relative;
margin-top: 7%;

}
.login_form{
    border: 2px solid #c3c6ce; 
    border-radius:15px;
}
.login_form:hover {
 border-color:#008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}

.login_form:hover{

 border-color: #008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);

}
.input {
  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
}
.input_pass{
    border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
}
.textUser {
  position: absolute;
  left: 15px;
  color: #666666;
  pointer-events: none;
  transform: translateY(1rem);
  transition: 150ms cubic-bezier(0.4,0,0.2,1);
}
.passUser {
  position: absolute;
  left: 15px;
  color: #666666;
  pointer-events: none;
  transform: translateY(1rem);
  transition: 150ms cubic-bezier(0.4,0,0.2,1);
}
.input:focus, input:valid {
  outline: none;
  box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
  background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
  transition: background 4s ease-in-out;
}

.input_pass:focus, input:valid {
    outline: none;
  box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
  background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
  transition: background 4s ease-in-out;
}

.input:focus ~ label, input:valid ~ label {
  transform: translateY(-95%) scale(0.9);
  padding: 10px;
  color: #000000be;
  left: 33%;
}

.input_pass:focus ~ label, input:valid ~ label {
    transform: translateY(-95%) scale(0.9);
  padding: 10px;
  color: #000000be;
  left: 33%;
}
.input:focus ~ label, input:valid ~ label {
  transform: translateY(-95%) scale(0.9);
  padding: 10px;
  color: #000000be;
  left: 33%;
}

        @media screen and (max-width: 994px) {

}
    </style>
<script>
    // select the eye icon and password input elements
const eyeIcon = document.querySelector('#boot-icon');
const passwordInput = document.querySelector('#floatingPassword');

// add a click event listener to the eye icon
eyeIcon.addEventListener('click', function() {
  // toggle the input type between "password" and "text"
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.classList.remove('bi-eye-fill');
    eyeIcon.classList.add('bi-eye-slash-fill');
  } else {
    passwordInput.type = 'password';
    eyeIcon.classList.remove('bi-eye-slash-fill');
    eyeIcon.classList.add('bi-eye-fill');
  }
});

</script>
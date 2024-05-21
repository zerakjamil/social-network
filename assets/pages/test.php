
<!----<button onclick="toggleModal()" type="button">Open Modal</button>
    <div class="modal-background" onclick="toggleModal()"></div>
    <div class="modal">
      <h2>Modal Window</h2>
      <p>
        You have opened the modal, they are great for confirming actions or
        displaying critical information.
      </p>
    </div>
    <script>
      const toggleModal = () => {
        const bodyClassList = document.body.classList;

        if (bodyClassList.contains("open")) {
          bodyClassList.remove("open");
          bodyClassList.add("closed");
        } else {
          bodyClassList.remove("closed");
          bodyClassList.add("open");
        }
      };
    </script>
 

<style>

button {
  font-family: inherit;
  cursor: pointer;
  background: #1a1a1a;
  color: #f9f9f9;
  border: 0;
  border-radius: 8px;
  padding: 20px 36px;
  font-size: 16px;
}



.modal-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: grid;
  place-items: center;
  opacity: 0;
  visibility: hidden;
  transform: scale(1, 1);
  background: rgba(0, 0, 0, 0.5);
  transition: 0.5s;
}

body.open .modal-background {
  visibility: visible;
  opacity: 1;
  animation: background-in 1s both;
}

@keyframes modal-in {
  0%,
  66% {
    opacity: 0;
    visibility: hidden;
    translate: -50% -30%;
  }
  100% {
    opacity: 1;
    visibility: visible;
  }
}

.modal {
  position: fixed;
  top: 50%;
  left: 50%;
  background: #37353b;
  color: #f9f9f9;
  padding: 48px 40px;
  width: 300px;
  border-radius: 12px;
  translate: -50% -50%;
  opacity: 0;
  visibility: hidden;
  transition: 0.3s;
}

body.open .modal {
  opacity: 1;
  visibility: visible;
  animation: modal-in 1s;
}

body.closed .modal {
  opacity: 0;
  visibility: hidden;
  translate: -50% -50%;
}

h2 {
  margin: 0 0 8px;
  font-weight: 400;
  font-size: 21px;
}

p {
  margin: 0;
  color: rgba(255, 255, 255, 0.5);
}

</style> ----->



<!--<section class="class_18" >

			<div class="class_20" >
				<form method="post" enctype="multipart/form-data" class="class_24" >
					<h1 class="class_21"  >
						Contact us
						<br >
					</h1>
					<div class="class_25" >
						<label class="class_26"  >
							Name:
						</label>
						<input placeholder="Enter your Name" type="text" name="name" class="class_27" >
					</div>
					<div class="class_25" >
						<label class="class_26"  >
							Email:
						</label>
						<input placeholder="Enter a valid Email" type="email" name="email" class="class_27" >
					</div>
					<div class="class_28" >
						<label class="class_29"  >
							Message:
						</label>
						<textarea placeholder="Enter your Message" name="message" class="class_27" >
						</textarea>
					</div>
					<div class="class_30" >
						<label  >
							<input type="checkbox" name="" >
							I accept the terms of service
						</label>
					</div>
					<button class="class_31"  >
						SUBMIT
					</button>
				</form>
			</div>
		</div>
	</section>

  <style>
    .class_18{

width: 100vw;
background-color: rgb(232, 232, 232);
color: rgb(0, 0, 0);
padding: 20px;

}

.class_19{

display: flex;
flex-wrap: wrap;
max-width: 1200px;
margin: auto;

}

.class_20{

flex: 1 1 0%;
min-width: 400px;
min-height: 200px;
vertical-align: top;

}

.class_21{

padding-left: 10px;
padding-right: 10px;
font-size: 30px;

}

.class_22{

padding: 10px;
font-size: 16px;

}

.class_23{

font-size: 20px;
padding: 20px;
border: medium none;
color: rgb(0, 0, 0);
background-color: rgb(255, 255, 255);
border-radius: 20px;
margin: 0.25rem 0.125rem;
cursor: pointer;
width: 177px;

}

.class_24{

width: 100%;
max-width: 500px;
margin: 10px auto;
padding: 20px;
background-color: rgb(255, 255, 255);
color: rgb(0, 0, 0);
text-align: center;
border-radius: 20px;

}

.class_25{

margin-top: 4px;
margin-bottom: 4px;
padding: 4px;
align-items: center;
 text-align: left;
font-size: 16px;

}

.class_26{

margin: .5rem;
margin-left:0px;
display: inline-block;

}

.class_27{

display: block;
width: 100%;
padding: 15px;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: rgb(33, 37, 41);
background-color: rgb(242, 242, 242);
background-clip: padding-box;
border: 1px solid rgb(206, 212, 218);
appearance: none;
border-radius: 20px;
transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;

}

.class_28{

display: block;
margin-top: 4px;
margin-bottom: 4px;
padding: 4px;
align-items: center;
 text-align: left;
font-size: 16px;

}

.class_29{

min-width:50px;
margin: .5rem;
margin-left:0px;
display: inline-block;

}

.class_30{

padding: 10px;
color: rgb(0, 0, 0);
text-align: left;
font-size: 16px;

}

.class_31{

font-size: 16px;
padding: 20px;
border: medium none;
color: rgb(255, 255, 255);
background-color: rgb(13, 110, 253);
border-radius: 20px;
margin: 0.25rem 0.125rem;
cursor: pointer;
width: 100%;

}

.class_32{

height: 100px;
padding: 10px;
background-color: rgb(136, 136, 136);
color: rgb(255, 255, 255);
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;

}

.class_33{

padding: 5px;
font-size: 20px;

}

.class_34{

padding: 5px;

}

  </style>--->

  <!---important code =====        .login {
  outline: dashed 2px red; /* adds a dashed red outline to the container */
}

.login * {
  outline: dashed 1px red; /* adds a dashed red outline to all the divs and items inside the container */
}   ----->
<!----<?php 
// Assuming you have retrieved the user agent string from your database
/*$user_agent_string = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36";

// Define the regular expression pattern to extract the device model
$pattern = '/\((.*?)\;/';

// Extract the device model using preg_match()
if (preg_match($pattern, $user_agent_string, $matches)) {
    $device_model = $matches[1];
} else {
    $device_model = "Unknown";
}
ini_set('browscap', 'browscap.ini');
ini_set('browscap_format', 'php');

// Use get_browser() to extract browser information
$browser_info = get_browser($user_agent_string, true);

// Extract the browser model
$browser_model = $browser_info['browser'];

// Display the browser model to the user
echo $browser_model;
// Display the device model to the user
echo $device_model;*/
?>---->

<button>
  show notification
</button>

<script>
  let button = document.querySelector('button');
  button.addEventListener('click',() => {
    if(!window.Notification) return;
    Notification
    .requestPermission()
    .then(showNotification)
  });

  function showNotification(permission){
    if (permission !== 'granted') return;

    let notification = new Notification('title', {
      body: "hi",
      icon: ''
    })

    notification.onclick =  () => {
      window.location.href = "https://www.google.com";
    }
  }
  
</script>





<div class="modal fade" id="blocked_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" dir="ltr">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">لیستی هەڵپەسێردراوەکان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >


            <?php
if(isset($_SESSION['phone']) && !isset($_SESSION['auth_temp'])){
    $action = 'verifyphone';
}elseif(isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])){
    $action = 'changepassword';
}else{
    $action= 'forgotpassword';
}
            ?>
            <form method="post" action="assets/php/actions.php?<?=$action?>" >
            <h1 style="text-align: center;">NETlink</h1>
            <h1 class="h5 mb-3 fw-bold" style="text-align: center;">ئایە تێپەرەوشەکەت لە یاد کردووە؟</h1>
                <div class="d-flex justify-content-center">
                <img src="images/undraw_forgot_password_re_hxwm.svg" style="width:100%; opacity:0.8; margin-top:20px; padding-bottom:20px;" alt="">
                </div>
                
<?php
if($action=='forgotpassword'){
    ?>
  <div class="form-floating" >
                    <input type="email" name="email" class="form-control rounded-6 " placeholder="username/email">
                    <label for="floatingInput"> <span class="bi bi-envelope"></span> ئیمەیڵ </label>
                </div>
                <?=showError('email')?>
<br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:32%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF;">ناردنی کۆدی سەلماندن</button>

    <?php
}
?>
   
   
   <?php
if($action=='verifycode'){
    ?>
<p style="text-align:right;">ئەو شەش ژمارەی ناردرا بۆتۆ داخلی بکە  - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control rounded-6" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword"></label>
                </div>
                <?=showError('email_verify')?>

                <br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:30%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF; ">سەلماندنی کۆدەکە</button>

    <?php
}
?>


<?php
if($action=='changepassword'){
    ?>
<p style="text-align:right;">تێپەرەوشەی نوێ داخل بکە  - <?=$_SESSION['forgot_email']?></p>
<div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-6" id="floatingPassword" placeholder="Password">
                    <!---<style>
.form-control:focus {
  outline: 2px solid #8467D7;
  box-shadow: none;
}
</style>---->
                    <label for="floatingPassword" style="text-align:right;">تێپەرەوشەی نوێ</label>
                </div> 
                <?=showError('password')?>

                <br>
                <button class="btn btn-primary" type="submit" style="position:absolute; right:30%; border-radius: 10px; background-color: #6C63FF; border: #6C63FF;">گۆرینی تێپەرەوشە</button>


    <?php
}
?>

                 
            
                <br>
                <br>

                <a href="?login" class="text-decoration-none mt-5" style="color: #8467D7;"><i class="bi bi-arrow-left-circle-fill"></i>چوونەژوورەوە</a>
            </form>
        </div>



            </div>
        </div>
  </div>


<?php
if(isset($_GET['login'])){
  $response=validateSvForm($_POST);
  if($response['status']){

   $user_id = $_SESSION['userdata']['id'];
   if($response['user']['ac_status']==0){
   $_SESSION['code']=$code = rand(111111,999999);
   sendCode($response['user']['email'],'Verify Your Email',$code);
   }
  updateLastLogin($user_id);
  deleteFromAttempts($ip_address,$username);
  header("location:../../");
  createLoginDevice();
  }else{
      $_SESSION['error']=$response;
      $_SESSION['formdata']=$_POST;
      if (!checkLockStatus($username)) {
          addingLoginAttempts($username, $ip_address);
      }
     
      header("location:../../?login");
  }
      
  }
 
  if(isset($_GET['twostepverification'])){
    $_SESSION['code']=$code = rand(111111,999999);
    sendCodePhone('+964'.$_SESSION['userdata']['phone'],$code);
    header('location:../../?twostepverification');
}
  function validateSform($data){
    global $db;
  $password = mysqli_real_escape_string($db,md5($data['password']));
  $response=array();
  $response['status']=true;

if(!$password){  
  $response['msg']="تێپەرەوشە دانەنراوە";
  $response['status']=false;
  $response['field']='password';  
}
if($password != md5($_SESSION['userdata']['password'])){
  $response['msg']="تێپەرەوشە هەڵەیە";
  $response['status']=false;
  $response['field']='password'; 
}
return $response;
}

?>


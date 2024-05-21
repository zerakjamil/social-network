
    <div class="login">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white p-4 login_form" >
            <form method="post" action="assets/php/actions.php?signup" id="regForm" class="formm">
                <div class="tab" >
                <div class="d-flex justify-content-center ">
                    <h1>NETlink</h1>
                    <img class="mb-4" src="" alt="" height="45">
                </div>
                
                <h1 class="h5 mb-3 fw-normal"  style="text-align: center;">ئەکاونتێکی نوێ دروستبکە</h1>
                <div class="d-flex">
                <div class="form-floating mt-1 col-6">
                <input type="text" name="first_name" value="<?=showFormData('first_name')?>" class="form-control" placeholder="username/email">
                <label for="floatingInput">ناوی یەکەم</label>
</div>
                    <div class="form-floating mt-1 col-6">
                        <input type="text" name="last_name" value="<?=showFormData('last_name')?>" class="form-control" style="margin-left:5px;" placeholder="username/email">
                        <label for="floatingInput"  style="text-align: right;">ناوی دووەم</label>
                    </div>
                </div>
                <?=showError('first_name')?>
                <?=showError('last_name')?>

                <div class="d-flex justify-content-center alignt-items-center gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                            value="1" <?=isset($_SESSION['formdata'])?'':'checked'?><?=showFormData('gender')==1?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios1">
                            نێر
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                            value="2" <?=showFormData('gender')==2?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios3">
                            مێ
                        </label>
                    </div>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" name="username_email" value="<?=showFormData('username_email')?>" class="form-control mt-2" placeholder="username/email">
                    <label for="floatingInput">ئیمەیڵ</label>
                </div>
                <?=showError('username_email')?>

                <div class="form-floating mt-1">
                    <input type="text" name="username" value="<?=showFormData('username')?>" class="form-control mt-2" placeholder="username/email">
                    <label for="floatingInput">ناوی بەکارهێنەر</label>
                </div>
                <?=showError('username')?>
                <div class="form-floating mt-1">
                    <input type="phone" name="phone" value="<?=showFormData('phone')?>" class="form-control mt-2" placeholder="Phone-number">
                    <label for="floatingInput">ژمارەی تەلەفۆن</label>
                </div>
                <?=showError('phone')?>
                <div class="form-floating mt-1" style="position:relative;">
                    <input type="password" name="password" class="form-control mt-2" id="floatingPassword" placeholder="Password" >
                    <label for="floatingPassword">تێپەرە وشە</label>
                    <span id="boot-icon" class="bi bi-eye-fill" style="font-size: 20px;  cursor:pointer; position:absolute; top:13px; right:9px;"></span>
                </div>
                <?=showError('password')?>

                
               
                <div style="text-align:center;margin-top:40px;">

</div>
</div>
<div class="tab" dir="rtl">
<h1 class="h4 mb-3 fw-bold"  style="text-align: center;"> ئەتەوێ چۆن ئەکاونتەکەت چاڵاک بکەی؟ </h1>
<div class="d-flex justify-content-center align-items-center">
<img src="images/undraw_check_boxes_re_v40f.svg" style="width:25%; height: 25%; margin-top:20px; padding-bottom:20px;" alt="">
</div>
<div class="d-flex justify-content-center alignt-items-center gap-3 my-3" style="flex-direction: column;">
                    <div class="form-check border-bottom">
                        <input class="form-check-input" type="radio" name="message_type" id="exampleRadios1"
                            value="1" <?=isset($_SESSION['formdata'])?'':'checked'?><?=showFormData('message_type')==1?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios1">
                        <h6> لە ڕێگەی ئیمەیڵ </h6>
                        </label>
                    </div>
                    <div class="form-check border-bottom">
                        <input class="form-check-input" type="radio" name="message_type" id="exampleRadios3"
                            value="2" <?=showFormData('message_type')==2?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios3">
                        <h6>لە رێگەی کوورتە نامە </h6>
                        </label>
                    </div>
                </div> 
</div>

 <div class="" style="  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;">
  <div style="  display: flex;
  align-items: center;
  justify-content: center;">
                   <button type="button" id="prevBtn" style="margin:8px; border-radius: 7px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding-left:3%; padding:3%; color:white;" onclick="nextPrev(-1)">گەڕانەوە</button>
    <button type="button" id="nextBtn" style="margin:8px; border-radius: 7px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding:3%; color:white;" onclick="nextPrev(1)">دواتر</button>
    </div>
                    <a href="?login" class="text-decoration-none" style="color: #66a6ff;">ئەکاونتت هەیە؟</a>
                
                </div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
</div>

         
</form>

    </div>
    
<style>
  .form-control{
  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
  }
  .form-control:focus, input:valid {
  outline: none;
  box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
  background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
}
  .form-control:hover {
  border: solid 1.9px #000002;
  transform: scale(1.03);
  box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
  transition: border-color 1s ease-in-out;
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
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background:linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
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

    var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "تەواو";
  } else {
    document.getElementById("nextBtn").innerHTML = "دواتر";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;

  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:

  // If the valid status is true, mark the step as finished and valid:

    document.getElementsByClassName("step")[currentTab].className += " finish";

  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>
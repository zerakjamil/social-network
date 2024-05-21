  <?php global $user; ?>

<?php if($user['twoStep'] == 0){ ?>
    <div class="login d-flex justify-content-center align-items-center">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white p-4 login_form">
            <form method="post" action="assets/php/actions.php?sverify" id="svForm" class="formm">
            <div class="tab">
              <div class="d-flex align-items-center justify-content-center" style="flex-direction:column;">
        
<h1>NETlink</h1>
<?php
if(isset($_GET['failed'])){
    ?>
<p class="text-danger" style="text-align:center;"> کردارەکە سەرکەوتوو نەبوو تکایە دووبارە بە زانیاریەکان دا بچۆوە </p>

<?php
}
                ?>

            <video class="video col-6" loop muted autoplay>
  <source src="images/14,279 Security Illustrations - Free in SVG, PNG, EPS.mp4" type="video/mp4">
</video>
<h1 class="h4 mb-3 fw-normal"  style="text-align: center;"> پاراستنی تۆ لە ئەستۆی ئێمەیە  </h1>
<h1 class="h6 mb-3 fw-normal"  style="text-align: center;">  ئەم هەنگاوە یەکێکە لە هەرە هەنگاوە پێشکەوتووەکانی ئاسایشی تۆڕەکەمان، بۆ پاراستنی بەکارهێنەرەکانمان لە هەر هێرشێکی ئەلیکترۆنی گرتە بکە لە دەستپێبکە </h1>
              </div>

            </div>
                <div class="tab">
                <div class="d-flex justify-content-center align-items-center" style="flex-direction:column;">
                    <h1>NETlink</h1>
                    <img src="images/authenication.svg" style="width:60%; height: 60%; padding-bottom:10px;" alt="">
                <h1 class="h6 mb-3 fw-normal"  style="text-align: right;"> ئێمە نامەیەکمان بۆ ژمارەتەلەفۆنی - <?=$user['phone']?> 964+ - ناردوە و کۆدێکی تێدایە کە لە شەش ژمارە پيێکدێ تکایە لە خوارەوە داخلی بکە  </h1>
                </div>
                
    
                <div class="form-floating mt-1" >
                <input type="text" name="code" value="<?=showFormData('code')?>" class="form-control" id="floatingCode"  placeholder="code">
                    <label for="floatingCode"></label>
                    
                </div>
                <?=showError('phone_verify')?>

                
               
                <div style="text-align:center;margin-top:40px;">

</div>
</div>
<div class="tab">
<div class="d-flex justify-content-center align-items-center">
<h1>NETlink</h1>
</div>
<div class="d-flex justify-content-center align-items-center">
<img src="images/password.svg" style="width:65%; height: 65%; padding-bottom:10px;" alt="">
</div>
<h1 class="h5 mb-3 fw-normal"  style="text-align: center;"> بۆ دڵنیابوون تکایە تێپەڕەووشەکەت داخڵ بکە </h1>
<div class="d-flex justify-content-center alignt-items-center" style="flex-direction: column;">
                    
                    <div class="form-floating mt-1" style="position:relative;">
                    <input type="password" name="password" class="form-control mt-2" id="floatingPassword" placeholder="Password" >
                    <label for="floatingPassword">تێپەرە وشە</label>
                    <span id="boot-icon" class="bi bi-eye-fill" style="font-size: 20px;  cursor:pointer; position:absolute; top:20px; right:9px;"></span>
                
                    </div>
                    <?=showError('password')?>
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
                   
                
                </div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>

            </form>
    </div>
    <?php } elseif($user['twoStep'] == 1) { ?>
<div class="login d-flex justify-content-center align-items-center">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white p-4 login_form">

              <div class="d-flex align-items-center justify-content-center" style="flex-direction:column;">
        
<h1>NETlink</h1>

<img src="images/done.svg" style="width:65%; height: 65%; padding-bottom:10px;" alt="">
<h1 class="h4 mb-3 fw-normal"  style="text-align: center;"> پێدەچێ ئەکاونتەکەی تۆ سەلماندنی دوو هەنگاوی بۆ چاڵاک کرابێ </h1>
<h1 class="h6 mb-3 fw-normal"  style="text-align: center;"> سەلماندنی دوو هەنگاوی چینێکی ئاسایشی زیادە بۆ تۆ دابین ئەکات و ئەکاونتەکەت پتەو تر ئەکات </h1>
              </div>
<div style="  display: flex;
  align-items: center;
  justify-content: center;">
                   <a href="?editprofile" style=" text-align: center; margin:8px; border-radius: 7px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding-left:3%; padding:3%; color:white;" >گەڕانەوە</a>

    </div>
            </div>

  
              

      <?php } ?>
<style>
  .form-control{
  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
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
  if (n == 0) {
    document.getElementById("nextBtn").innerHTML = "دەستپێبکە";
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
    document.getElementById("svForm").submit();
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

<body class="body">
  

			<div class="class_20" dir="rtl">
				<form method="post" action="assets/php/actions.php?contact" enctype="multipart/form-data" class="class_24" >
					<h1 class="class_21"  >
					<div class="d-flex justify-content-center ">
                    <h1>NETlink</h1>
                    <img class="mb-4" src="" alt="" height="45">
                </div>
						پەیوەندیمان پێووە بکە
						<br >
					</h1>
					<div class="class_25" >
					<?php
if(isset($_GET['successs'])){
    ?>
<h5 class="text-success border p-2" style="text-align:center;"> فۆڕمەکە بەسەرکەوتوویی نێردرا! <br> تکایە چاوەڕوانی وەلام بە </h5>

<?php
}
                ?>
						<label class="class_26"  >
							ناو:
						</label>
						<input placeholder="ناوی خۆت داخڵ بکە" type="text" value="<?=showFormData('contact_name')?>" name="contact_name" class="class_27" >
						<?php showError('contact_name')?>
					</div>
					<div class="class_25" >
						<label class="class_26"  >
							ئیمەیڵ:
						</label>
						<input placeholder="ئیمەیڵێکی ڕاست داخڵ بکە" type="email" value="<?=showFormData('contact_email')?>" name="contact_email" class="class_27" >
						<?php showError('contact_email')?>
					</div>
					<div class="class_28" >
						<label class="class_26"  >
							نامە:
						</label>
						<textarea placeholder="نامەکەت لێرە بنووسە" id="my-textarea" value="<?=showFormData('contact_message')?>" name="contact_message" class="class_27" >
						</textarea>
						<?php showError('contact_message')?>
					</div>
					<button class="class_31" type="submit">
						ناردن
					</button>
          <?php if(isset($_SESSION['Auth'])){ ?>
					<a href="?" class="text-decoration-none"> گەڕانەوە </a>
          <?php } else { ?>
            <a href="?login" class="text-decoration-none"> گەڕانەوە </a>
            <?php } ?>
				</form>
			</div>
      </body>
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
			const textarea = document.getElementById('my-textarea');

textarea.addEventListener('click', function() {
	textarea.value = '';
});
    </script>
  <style>

.class_20{
display: flex;
width: auto;
min-width: 600px;
min-height: 200px;
justify-content: center;
align-items: center;
margin-top:30px;
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
margin-right:0px;
display: inline-block;
position: relative;
left: 87%;
top: 0;
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
background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
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


@keyframes background-in {
  0% {
    scale: 0 0.005;
  }
  33% {
    scale: 1 0.005;
  }
  66%,
  100% {
    scale: 1 1;
  }
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


@media screen and (max-width: 994px) {
	.class_20{
display: flex;
min-width: auto;
min-height: 200px;
justify-content: center;
align-items: center;
}
}
  </style>
<div class="modal-dialog modal-dialog-centered ">
  <div class="modal-content login_form">
            <div class="modal-body" dir="rtl">
            <form method="post" action="assets/php/actions.php?marketcreate" class="formmm">
    
    <div class="d-flex justify-content-center align-items-center">
    <h1>NETlink</h1>
    </div>
    <h1 class="h5 mb-3 fw-normal"  style="text-align: center;">فرۆشگایەکی نوێ دروستبکە</h1>
    <div class="d-flex justify-content-center align-items-center flex-direction-col" style="position:relative;">
        
        <img class="" src="images/cafe.svg" alt="" style="height:120px;
        width:120px;
        border-radius:50%;
        object-fit:cover;
        border:1px solid #3b82f6;" />


<input class="form-control" name="market_pic" type="file" id="select_market_img" />
<label for="select_market_img" class="d-flex justify-content-center align-items-center formFilee">  <div class="camera_fixx"><span id="boot-icon-ee" class="bi bi-camera-fill"></span></div></label>

    </div>

    <div class="form-floating mt-1">
        <input type="text" name="marketName" value="<?=showFormData('marketName')?>" class="form-control mt-4" placeholder="marketName">
        <label for="floatingInput">ناوی فرۆشگا</label>
    </div>
    <?=showError('marketName')?>

    <div class="form-floating mt-1">
        <input type="text" name="location" value="<?=showFormData('location')?>" class="form-control mt-4" placeholder="location">
        <label for="floatingInput">ناونیشان</label>
    </div>
    <?=showError('location')?>
    <div class="form-floating mt-1">
        <input type="text" name="market_text" value="<?=showFormData('market_text')?>" class="form-control mt-4" placeholder="market_text">
        <label for="floatingInput">وردەکاری دەربارەی فرۆشگا</label>
    </div>
    <?=showError('market_text')?>



    <div class="" style="  display: flex;
flex-direction: column;
align-items: center;
justify-content: center;">
        <button class="btn btn-primary" type="submit" style="margin:10px; border-radius: 7px; background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%); border:none; margin-bottom:10px; width: 160px; padding-left:3%; padding:3%;">درووستکردن</button>
        <a href="?market" class="text-decoration-none" style="color: #66a6ff;">
                    گەڕانەوە <i class="bi bi-arrow-left-circle-fill"></i></a>
    </div>

</form>
            </div>
   
        </div>
  </div>

<style>
    #fileinput{
        width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;

    }
    #select_post_reel{
        width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;

    }
    .label{
      position:relative;
      right:45%;
    }
    .form-control{
  border: solid 1.9px #9e9e9e;
  border-radius: 1.3rem;
  background: none;
  padding: 1rem;
  font-size: 1rem;
  color: #000000;
  transition: border 150ms cubic-bezier(0.4,0,0.2,1);
  width: 100%;
  margin-top:10px;
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
#select_market_img{
  width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;
}
.formFilee{
  position:absolute;
  top:115px;
  left: 50.5%;
}
.camera_fixx{
background-color: #f3f7fe;
width: 45px;
height: 45px;
  transition: .3s;
  border-radius: 50%;
  cursor: pointer;
  transform: translate(-50%, -50%);
  border: 1px solid #3b82f6;
}
.camera_fixx:hover{
background-color: #3b82f6;
box-shadow: 0 0 0 5px #3b83f65f;
  
                        }
#boot-icon-ee:hover{
color: #fff;
}
#boot-icon-ee{
font-family: monospace;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 30px;
cursor: pointer;
border-radius: 50%;
position: relative;
right:13%;
 }
</style>
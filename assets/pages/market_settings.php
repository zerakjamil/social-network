<?php
 global $user;
global $market;
 global $posts;
 global $follow_suggestions;
 global $comments;
 /*echo '<pre>';
 echo print_r($_SESSION['userdata']['password']);
 echo '</pre>';*/
 ?>
    <div class="container col-md-9 col-sm-12 rounded-0 d-flex justify-content-between bg-light" dir="rtl">
        <div class="col-12 bg-light border rounded p-4 mt-4 shadow-sm">
  
            <form method="post" action="assets/php/actions.php?updatemarket" enctype="multipart/form-data" id="update_profile_form" style="position:relative;">
               
                <h1 class="h3 mb-3 fw-normal text-dark" style="text-align:center;">رێکخستنی کۆگا <img src="images/layer-icon.svg" style="height:27px; width:27px;" alt=""> </h1>
                <?=showError('old_password')?>
                <?=showError('password')?>
                <?php
if(isset($_GET['success'])){
    ?>
<p class="text-success" style="text-align:center;">کۆگاکەت رێکخرا!</p>

<?php
}
                ?>
                 <h1 class="h5 mb-3 fw-normal text-dark" style="text-align:center;"> گۆرینی وێنەی پرۆفایل </h1>
                <div class="form-floating mt-1 col-md-6 col-sm-12" id="img_view">
                <div style="align-items:center; justify-content:center; display:flex; width:100%;">
                    <img src="assets/images/market_profile/<?=$market['market_pic']?>" id="profile_img_view" class="img-thumbnail my-3" alt="...">
                    <span class="something"></span>
                    </div>
                    
                  
                          
               
                </div>
             
                      <input class="form-control " type="file" name="market_pic" id="formFile" >
                        <label for="formFile" class="formFile" type="file"><div class="camera_fix"><span id="boot-icon-e" class="bi bi-camera-fill"></span></div></label>
                
                <?=showError('market_pic')?>

                <div class="d-flex">
                  
                    <div class="form-floating mt-2 col-12">
                        <input type="text" name="name" value="<?=$market['name']?>" class="form-control rounded-0 bg-light text-dark" placeholder="username/email" dir="ltr">
                        <label for="floatingInput" class="text-dark">ناوی کۆگا</label>
                    </div>
 
                </div>
                <?=showError('name')?>
                <?=showError('location')?>
               
                <div class="form-floating mt-2">
                    <input type="text"  value="<?=$market['location']?>" name="location" class="form-control rounded-0 bg-light text-dark" placeholder="username/email" dir="ltr">
                    <label for="floatingInput" class="text-dark"> ناونیشانی کۆگا </label>
                </div>
                <?=showError('text')?>
               
                <div class="form-floating mt-w pt-1">
                    <input type="text"  value="<?=$market['market_text']?>" name="text" class="form-control rounded-0 bg-light text-dark" placeholder="bio" dir="ltr">
                    <label for="floatingInput" class="text-dark"> وردەکاری دەربارەی کۆگا </label>
                </div>
              
                <div class="mt-3 d-flex align-items-center">
                    <div class=" d-flex justify-content-between align-items-center" style="">
                    <button class="btn btn-sm btn-primary blocked-list" style="background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);   font-size: 17px;
  font-weight: 400;
  text-decoration: none;
  cursor: pointer;
  border: none;
  outline: none;
  overflow: hidden;
  color: white;
  border-radius:10px;
  transition: color 0.3s 0.1s ease-out;
  text-align: center;" type="submit">نوێکردنەوەی پرۆفایل</button>
               
              
    </div>

                </div>
             
                </div>
            </form>

    </div>
 
<style>
     .img-thumbnail{
                            height:150px;
                            width:150px;
                            object-fit: cover;
                            border-radius:50%;
                         
                            
                        }
             
                       
                        span .something{
                            width: 60px;
                            height: 40px;
                            background-color: white;
                            z-index: 10;
                        }
                        
                        #img_view{
                              
                                width:100%;
                                position: relative;

                            }

#formFile{
  width: 0;
  height: 0;
  z-index: -10;
  position: absolute;
  overflow: hidden;
  opacity: 0;
}


.camera_fix{
background-color: #f3f7fe;
width: 50px;
height: 50px;
  transition: .3s;
  top:44%;
  left:54%;
  border-radius: 50%;
  cursor: pointer;
  position: absolute;
  transform: translate(-50%, -50%);
  border: 1px solid #3b82f6;
}


#boot-icon-e{
font-family: monospace;
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 35px;
cursor: pointer;
border-radius: 50%;
-webkit-text-stroke-width: 10px rgb(255, 255, 255);

                        }
.camera_fix:hover{
background-color: #3b82f6;
box-shadow: 0 0 0 5px #3b83f65f;
  
                        }
#boot-icon-e:hover{
color: #fff;
}

@media screen and (max-width: 994px) {
                        

.camera_fix{
background-color: #f3f7fe;
width: 40px;
height: 40px;
border-radius: 50%;
}
#boot-icon-e{
font-family: monospace;
position: relative;
right:14%;
width: 100%;
height: 100%;
color: #3b82f6;
font-size: 28px;
cursor: pointer;
border-radius: 50%;
}
.img-thumbnail{
 height:100px;
                                width:100px;
                                border-radius:50%; 
                                object-fit: cover;
                            }
                            
                            #img_view{
                                height:50%;

                            }
}
              
                        
</style>
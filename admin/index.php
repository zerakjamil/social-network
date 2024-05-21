<?php
$function_url="../assets/php/functions.php";
include('./php/admin_functions.php');
if(!isset($_SESSION['admin_auth'])) header('Location:./pages/login.php');
$admin = getAdmin($_SESSION['admin_auth']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NETlink | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/images/icon.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
       <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> 

      <li class="nav-item">
        <a class=" btn btn-sm btn-danger" href="php/admin_actions.php?logout" role="button">
          چوونەدەر
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../" class="brand-link">
      <img src="../assets/images/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NETlink</span>
    </a>

    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
        <div class="info">
          <a href="#" class="d-block"><?=$admin['full_name']?></a>
        </div>
      </div>


   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                داشبۆرد
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?edit_profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               رێکخستنەکان
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?reports" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               سکاڵاکان
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <?php if(isset($_GET['edit_profile'])){
                echo "دەستکاری کردنی پرۆفایل";

              }else if(isset($_GET['dashboard'])){
                
                echo "داشبۆرد";
              }else{
                echo 'سکاڵاکان';
              } ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
      <?php if(isset($_GET['edit_profile'])){

      }else{
        ?>
 <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=totalUsersCount()?></h3>

                <p>کۆی بەکار‌هێنەر</p>
              </div>
              <div class="icon">
              <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=totalPostsCount()?></h3>
                <p>کۆی پۆستەکان</p>
              </div>

              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=totalCommentsCount()?></h3>
                <p>کۆی سەرنجەکان</p>
              </div>
              <div class="icon">
              <ion-icon name="chatbubble-outline"></ion-icon>
              </div>
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=totalLikesCount()?></h3>
                <p>کۆی بەدڵبوونەکان</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <?php
      }

      ?>
        <!-- /.row -->
        <!-- Main row -->
       <div class="row">
<?php
if(isset($_GET['edit_profile'])){
?>
 <div class="card card-primary col-12">
              <div class="card-header">
                <h3 class="card-title">پرۆفایلەکەت رێکبخە</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?=showError('adminprofile')?>
              <form method="post" action="php/admin_actions.php?updateprofile">
                <input type="hidden" name="user_id" value="<?=$admin['id']?>" >
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ناوی تەواو</label>
                    <input type="text" name="full_name" value="<?=$admin['full_name']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ئیمەیڵ</label>
                    <input type="email" name="email"  value="<?=$admin['email']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">تێپەرەوشە</label>
                    <input type="text" name="password" value="<?=$admin['password_text']?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">

                  <span>دۆخی چاکسازی</span>
        <?php if($admin['m_mode']== 1){
          ?>
        <label for='t2' class="switch">
            <input id='t2' class='' onclick="" name="locked" value="1" type='checkbox' checked>
          <span class="slider round"></span>
        </label>
      <?php }
        else{
          ?>
          
        <label for='t2' class="switch"><input id='t2' class='' name="locked" value="1" onclick="" type='checkbox' unchecked>
          <span class="slider round"></span></label>
        <?php
        }?>
                  </div>
                
                  <style>
                    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

                  </style>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">دەستکاریکردنی پرۆفایل</button>
                </div>
              </form>
            </div>
<?php
}elseif(isset($_GET['dashboard'])){
  ?>

            <div class="card w-100">
              <div class="card-header">
                <h3 class="card-title">لیستی بەکارهێنەرەکان</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
$userslist = getUsersList();
$count=1;
                ?>
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ژمارە</th>
                    <th>بەکار‌هێنەر</th>
                    <th>کردارەکان</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
foreach($userslist as $user){
  ?>
   <tr>
                    <td>#<?=$count?></td>
                    <td>
                      <div class="d-flex">
                        <div>
                          <img src="../assets/images/profile/<?=$user['profile_pic']?>" class="rounded-circle border border-2 shadow-sm mx-2" style="width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;" />
                        </div>
                        <div>
                          <h5><?=$user['first_name'].' '.$user['last_name']?> - <span class="text-muted">@<?=$user['username']?></span></h5>
                          <h6 class="text-muted"><?=$user['email']?></h6>


                        </div>
</div>
                    </td>

                    <td>
                      
                     
                    <a href="./php/admin_actions.php?userlogin=<?=$user['email']?>" target="_blank" class="btn btn-success btn-sm m-1">چوونەژوور</a>
                    
                    <?php if($user['ac_status']==0): ?><button class="m-1 btn btn-warning btn-sm verify_user_btn" data-user-id="<?=$user['id']?>">سەلماندن</button><?php endif; ?>
                     
                      
                        <button style="display:<?=$user['ac_status']==1?'':'none'?>" class="m-1 btn btn-danger btn-sm block_user_btn ub" data-user-id="<?=$user['id']?>">هەلپەساردن</button>
                        <button style="display:<?=$user['verify']==0?'':'none'?>" class="m-1 btn btn-primary btn-sm ver_user_btn ub" data-user-id="<?=$user['id']?>">بەفەرمیکردن</button>
                        <button style="display:<?=$user['ac_status']==2?'':'none'?>" class="m-1 btn btn-primary btn-sm unblock_user_btn" data-user-id="<?=$user['id']?>">لابردنی هەلپەساردن</button>
       
                      

                    </td>
                 
                  </tr>
  <?php
  $count++;
}
                  ?>
               
               
</tbody>
</table>
  <?php
}else{
  ?>
  <div class="card card-primary col-12">
              <div class="card-header">
                <h3 class="card-title"> سکاڵاکان</h3>
              </div>
           <div class="card card-primary col-sm-8 col-md-8 col-lg-12 card-body">
<?php 

$reports = reportPosts();
foreach ($reports as $report){


?>
      <div class="post">
        <div class="post__avatar">
          <img
            src="../assets/images/profile/<?=$report['profile_pic']?>"
            alt=""
          />
        </div>

        <div class="post__body">
          <div class="post__header">
            <div class="post__headerText">
              <h3>
              <?=$report['first_name']?> <?=$report['last_name']?>
                <span class="post__headerSpecial"
                  ><span class="material-icons post__badge"> Post ID: 12 </span>@<?=$report['username']?></span
                >
              </h3>
            </div>
            <div class="post__headerDescription">
              <p><?=$report['post_text']?></p>
            </div>
          </div>
          <img
            src="../assets/images/posts/<?=$report['post_img']?>"
            alt=""
          />
        </div>
        <div class="card_report" dir="rtl">
  <div class="content_report">
      <div class="title_report"><?=$report['reason']?></div>
    <p class="description_report">
    <?=$report['description']?>
    </p>
  </div>
</div>
      </div>
<?php }?>


      </div>

      </div>
      
<style>

body {
  --twitter-color: #50b7f5;
  --twitter-background: #e6ecf0;
}

/* post */
.post__avatar img {
  width: 50px;
height: 50px;
object-fit: cover;
border-radius: 50%;
}

.post {
  display: flex;
  align-items: flex-start;
  border-bottom: 1px solid var(--twitter-background);
  padding-bottom: 10px;

}

.post__body img {
  width: 50%;
  object-fit: contain;
  border-radius: 20px;
}

.post__footer {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}

.post__badge {
  font-size: 14px !important;
  color: var(--twitter-color);
  margin-right: 5px;
}

.post__headerSpecial {
  font-weight: 600;
  font-size: 12px;
  color: gray;
}

.card_report {
  max-width: 300px;
  display: flex;
  flex-direction: column;
  border-radius: 0.75rem;
  background-color: rgba(255, 255, 255, 1);
  -webkit-background-clip: border-box;
  background-clip: border-box;
}

.content_report {
  flex: 1 1 0%;
  padding: 1rem;
  display: flex;
  flex-direction: column;
}

.title_report {
  margin-top: 0.5rem;
  font-weight: 500;
  font-size: 23px;
  color: black;
}
.footer_report img {
  width:40px;
  height:40px;
  border-radius:50%;
  object-fit:cover;
}
.description_report {
  margin-bottom: 0.75rem;
  color: #474444;
}

.footer_report {
  background-color: transparent;
  padding: 1.5rem;
  padding-top: 0rem;
  display: flex;
}



.info_report .name_report {
  margin-bottom: 0rem;
  font-weight: 700;
  color: rgba(51, 65, 85, 1);
}

.info_report .date_report {
  margin-bottom: 0rem;
  font-size: 0.75rem;
  line-height: 1rem;
  color: #474444;
}

.post__headerText h3 {
  font-size: 15px;
  margin-bottom: 5px;
}

.post__headerDescription {
  margin-bottom: 10px;
  font-size: 15px;
}

.post__body {
  flex: 1;
  padding: 10px;
}

.post__avatar {
  padding: 20px;
}
</style>
            </div>
  <?php 
}
?>
</div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#" target="_blank">NETlink</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->





<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="js/actions.js?v=<?=time()?>"></script>

</body>
</html>
<?php

if(isset($_SESSION['error'])){
  unset($_SESSION['error']);

}
?>
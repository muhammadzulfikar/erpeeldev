<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - ErpeelDev</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="login_page">
  <div class="login_content">
  <div class="panel-heading border login_heading">Login ErpeelDev</div>
          <?php if(isset($user_register)):?>
          <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong>
          Registrasi berhasil, silahkan login
          </div>
          <?php endif;?>  
          <?php if(isset($error)):?>
          <div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Sorry :D</strong> 
          <?php if (isset($error['login'])):?>
          <?php echo $error['login'];?> 
          <?php endif;?>
          <?php if (isset($error['username'])):?>
          <?php echo $error['username'];?> 
          <?php endif;?>
          <?php if (isset($error['password'])):?>
          <?php echo $error['password'];?> 
          <?php endif;?>
          </div>
        <?php endif;?>	
        <form role="form" method="post" action="" class="form-horizontal">
      <div class="form-group">
        
        <div class="col-sm-10">
          <input type="text" placeholder="username" name="row[username]" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">
          <input type="password" placeholder="password" name="row[password]" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class=" col-sm-10">
          <div class="checkbox checkbox_margin">
            <label class="lable_margin">
              <a class="lable_margin" href="<?php echo site_url('register');?>"><p class="pull-left"> Daftar Baru</p></a>
            </label>
              <button class="btn btn-default pull-right" type="submit">Sign in</button>
              </div>
        </div>
      </div>
      
    </form>
 </div>
  </div>
 
</div>
<!--\\\\\\\ wrapper end\\\\\\-->

<script src="<?php echo base_url();?>assets/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/common-script.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
</body>
</html>

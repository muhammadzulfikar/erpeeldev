<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url()?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/animate.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->

  
  <div class="porlets-content">
    <div class="registration">
        <div class="panel-heading border login_heading">Registration now</div>	
            <?php if(isset($error)):?>
        <div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Oppss !</strong> 
          <?php if (isset($error['username'])): ?>
                <div>- <?php echo $error['username']; ?></div>
          <?php endif; ?>
            <?php if (isset($error['email'])): ?>
                <div>- <?php echo $error['email']; ?></div>
            <?php endif; ?>
        </div>
      <?php endif;?>
              <form action="" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <input type="text" name="row[username]" parsley-type="alphanum" required parsley-minlength="5" placeholder="Enter user name" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <input type="email" name="row[email]" parsley-trigger="change" required placeholder="Enter email" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <input id="password" name="row[password]" type="password"  placeholder="Enter Password" required parsley-minlength="6" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <input parsley-equalto="#password" type="password"  placeholder="Enter Retype Password" required parsley-minlength="6" class="form-control">
                </div><!--/form-group-->
                <div class="checkbox checkbox_margin">
                <input class="btn btn-default pull-right" name="btnRegister" type="submit" value="Register"/>
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
<!-- validation jquery  -->
<script src="<?php echo base_url();?>assets/plugins/validation/parsley.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/toggle-switch/toggles.min.js"></script>
<!-- end validation -->
</body>
</html>

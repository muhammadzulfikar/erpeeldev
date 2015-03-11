<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<!-- <META NAME="ErpeelDev" CONTENT="ErpeelDev"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- required css  -->
<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet" type="text/css" />

<!-- plugin css  -->
<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/map/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/dropzone/dropzone.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/croppic/css/croppic.css" rel="stylesheet">

</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block">ErpeelDev</div>
      <div class="small_logo" style="display:none"><img src="<?php echo base_url();?>assets/images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="<?php echo base_url();?>assets/images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      

      <div class="top_right_bar">
        <div class="top_right">
          <div class="top_right_menu">
          </div>
        </div>
        <div class="top_right_menu"> 
        <a href="javascript:void(0);" data-toggle="dropdown"><img width="40px" height="40px" src="<?php echo base_url().'assets/images/user/'.$this->session->userdata('rpl_user_img');?>" /><span class="user_adminname"></a>
          <ul class="dropdown-menu">
          <div class=""></div>
            <li> <a href="<?php echo site_url('forum/user_profile').'/'.encode_url($this->session->userdata('rpl_user_id'));?>"><span class="block primery_1"> <i class="fa fa-user"></i> </span> <span class="block_text">Profile</span></a> </li>
            
            <li> <a href="<?php echo site_url('forum/thread_user').'/'.encode_url($this->session->userdata('rpl_user_id'));?>"><span class="block primery_1"> <i class="fa fa-gamepad"></i> </span> <span class="block_text">My Thread</span></a> </li>
            <div class=""></div>
            <li> <a href="<?php echo site_url('forum/post_user').'/'.encode_url($this->session->userdata('rpl_user_id'));?>"><span class="block primery_1"> <i class="fa fa-comment"></i> </span> <span class="block_text">My Post</span></a> </li>

            <li> <a href="<?php echo site_url('forum/library_user').'/'.encode_url($this->session->userdata('rpl_user_id'));?>"><span class="block primery_1"> <i class="fa fa-book"></i> </span> <span class="block_text">My Book</span></a> </li>
            <div class=""></div>
            <li> <a href="<?php echo site_url('forum/logout');?>"><span class="block primery_1"> <i class="fa fa-power-off"></i> </span> <span class="block_text">Log Out</span></a> </li>
            
          </ul>
        </div>
      </div>
    </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\-->
        <div class="left_nav">
      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="search_bar"> <i class="fa fa-search"></i>
        <input name="" type="text" class="search" placeholder="Search....." />
      </div>
      <div class="left_nav_slidebar">
        <ul>
          <?php if($this->session->userdata('admin_area') != 0): ?>
          <li <?php if($this->uri->segment(1) == 'admin') { echo 'class="left_nav_active theme_border"';}?>><a href="javascript:void(0);"><i class="fa fa-home"></i> Admin  <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul <?php if($this->uri->segment(1) == 'admin') { echo'class="opened" style="display:block"';}?>>
              <li> <a href="<?php echo site_url('admin/category_view');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Category</b> </a> </li>
              <li> <a href="<?php echo site_url('admin/thread_view');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Thread</b> </a> </li>
              <li> <a href="<?php echo site_url('admin/user_view');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>User</b> </a> </li>
              </ul>
          </li>
          <?php endif;?>
          <?php foreach($navigations as $nav):?>
          <li <?php if($this->uri->segment(3) == $nav->url) { echo 'class="left_nav_active theme_border"';}?>><a href="<?php echo base_url('').'forum/category/'.$nav->url;?>"><i class="fa <?php echo $nav->icon;?>"></i> <?php echo $nav->name;?> </span> </a></li>
          <?php endforeach;?>
        </ul>
      </div>
    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
<div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <?php foreach($threads as $thread):?>
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1><a href="<?php echo site_url('forum/category/'.$thread->name);?>"><?php echo ucfirst($thread->name);?></a></h1>
          <h2 class=""><?php echo $thread_title;?></h2>
        </div>
      </div>
        <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="col-sm-12 col-lg-12">
        <?php if(isset($post_create)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Komentar anda berhasil ditambah. 
        </div>
        <?php endif;?>
        <?php if (isset($post_update)): ?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Komentar anda telah diperbarui. 
        </div>
        <?php endif; ?>
        <?php if (isset($thread_update)): ?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Thread anda berhasil diperbarui. 
        </div>
        <?php endif; ?>
        </div>
        <div class="row">
          <!--\\\\\\\ row  start \\\\\\-->
          <div class="col-sm-12 col-lg-12">

            <section class="panel panel_header_bg_blue">
              <div class="block-web">
              <div class="header">
                <h8><i class="fa fa-bookmark"></i>  <?php echo $thread->date_add;?></h8>
              </div>

              <div class="porlets-content">
                <table border="0">
                <tr>
                  <td rowspan="2" valign="top">
                  <a href="<?php echo site_url('forum/user_profile/'.encode_url($thread->user_id));?>">
                  <img style="margin-right:20px;" width="90px" height="90px" src="<?php echo base_url().'assets/images/user/'.$thread->image_user;;?>" />
                  </a>
                  </td>
                  <td valign="top"><h3><?php echo $thread->title;?></h3></td>
                </tr>
                <tr>
                  <td>
                    <h4>
                    <ul class="social_icons">
                    <li><i class="fa fa-user"></i> <?php echo $thread->counter; ?></li>
                    <li><i class="fa fa-comments"></i> <?php echo $total_post;?></li>
                    </ul>
                    </h4>
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">
                  
                  <?php echo $thread->content;?>
                                  
                  </td>
                </tr>
                </table>
              </div> 

              </div>
            </section>
            <?php endforeach;?>
          </div>
        </div>
        <!--\\\\\\\ row  end \\\\\\--> 

        <div class="row">
          <!--\\\\\\\ row  start \\\\\\-->
          <div class="col-sm-12 col-lg-12">
          <?php foreach($posts as $post):?>
            <section class="panel panel_header_bg_blue">
              <div class="block-web">
              <div class="header">
                <h8><i class="fa fa-bookmark"></i> <?php echo $post->date_add;?></h8>
              </div>

              <div class="porlets-content">
                  <table border="0">
                  <tr>
                  <td valign="top">
                  <a href="<?php echo site_url('forum/user_profile/'.encode_url($post->user_id));?>">
                  <img style="margin:5px;margin-right:25px" width="45px" height="45px" src="<?php echo base_url().'assets/images/user/'.$post->image_user;;?>" />
                  </a>
                  </td>
                  <td>
                  <?php echo $post->post;?> 
                  </td>
                  </tr>
                  </table>
              </div> 

              </div>
            </section>
            <?php endforeach;?>
          </div>
        </div>
        <!--\\\\\\\ row  end \\\\\\-->   

        <div class="row">
          <div class="col-sm-12 col-lg-12">
            <p class="pull-right"><a href="<?php echo site_url('forum/reply/'.$this->uri->segment(3));?>" class="btn btn-primary">Tulis Komentar </a></p>
            <p class="pull-left">
              <ol class="pagination text-center pull-left"><?php echo $page; ?></ol>
            </p> 
          </div>   
      </div>
  </div>
  <!--\\\\\\\ container  end \\\\\\-->
</div>
<!--\\\\\\\ content panel end \\\\\\-->
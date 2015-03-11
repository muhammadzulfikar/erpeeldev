    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1><?php echo humanize($this->uri->segment(3));?></h1>
          <h2 class="">index</h2>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <?php if(isset($on_going_fix)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Thread anda berhasil ditambah. 
        </div>
        <?php endif;?>
        <div class="row">
          <!--\\\\\\\ row  start \\\\\\-->
          <div class="col-sm-12 col-lg-12">
          <section class="panel">
          <div class="block-web">
            <div>
            <a href="<?php echo site_url('forum/thread_create/'.$this->uri->segment(3));?>" class="btn btn-primary">Buat Thread</a>
            <div class="actions"><ol class="pagination"><?php echo $page; ?></ol></div>
            </div>
            <div class="portlets-content">
              <table class="table table-email" >
                <tbody>
                <?php foreach($threads as $thread):?>
                  <tr>
                  
                    <td><a class="pull-left" href="#"> <img width="45px" height="45px" src="<?php echo base_url().'assets/images/user/'.$thread->image_user;?>" /> </a></td>
                    <td></td>
                    <td>
                    <div class="media"> 
                        <div class="media-body">
                        <a style="text-decoration:none;" class="text-muted" href="<?php echo site_url('forum/talk/'.encode_url($thread->id_thread));?>"> 
                        <span class="media-meta pull-right"><?php echo $thread->date_add;?></span>
                          <p class="email-summary"><strong><?php echo ucfirst($thread->title);?></strong></p>
                          <small class="text-muted"></small>
                          <p class="email-summary"><?php echo ucfirst($thread->desc_title);?></p>
                        </a>
                        </div>
                    </div>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div><!-- /table-responsive --> 
          </div><!--/ block-web -->
          </section>
          </div>
          
        </div>
       
        <!--\\\\\\\ row  end \\\\\\-->
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
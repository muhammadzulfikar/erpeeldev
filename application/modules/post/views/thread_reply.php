    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Thread</h1>
          <h2 class="">Komentar</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Reply Thread</h3>
            </div>
            <div class="porlets-content">
              <form action="#" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <label>Komentar</label>
                  <input type="hidden" name="row[thread_id]" value="<?php echo $thread->id_thread;?>">
                  <input type="hidden" name="row[user_id]" value="<?php echo $this->session->userdata['rpl_user_id'];?>">
                  <input type="hidden" name="row[date_add]" value="<?php echo date('Y-m-d H:i:s');?>">
                  <textarea class="form-control ckeditor" name="row[post]" rows="7"></textarea>
                </div>

                <button class="btn btn-primary" name="btnAdd" type="submit">Simpan</button>
              </form>
            </div><!--/porlets-content-->
          </div><!--/block-web--> 
        </div><!--/col-md-6-->
      </div><!--/row-->

    
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
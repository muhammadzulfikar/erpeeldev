    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Thread</h1>
          <h2 class="">My Thread</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
     <div id="main-content">
    <div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> 
              <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> 
              </div>
              <h3 class="content-header">My Thread</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Thread</th>
                      <th class="center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($threads as $thread) : ?>
                    <tr>
                    <td><?php echo $no;?></td>
                    <td>
                      <a href="<?php echo site_url('forum/talk/'.encode_url($thread->id_thread));?>"><?php echo $thread->title;?></a>
                      <span style="display:block;font-size: 10px; font-style:italic;"><?php echo $thread->category_name;?></span>
                    </td>
                    <td class="center"> 
                      <a href="<?php echo site_url('forum/thread_edit/'.encode_url($thread->url_title).'/'.encode_url($thread->category_id));?>" class="btn btn-success">View & Edit</a>
                      <a href="<?php echo site_url('forum/thread_delete/'.encode_url($thread->id_thread).'/'.encode_url($thread->user_id));?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin akan menghapus thread ini ? ')">Delete</a>
                    </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div><!--/table-responsive-->
            </div><!--/porlets-content-->
            
            
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
            
        </div><!--/page-content end--> 
  </div><!--/main-content end--> 

      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Library</h1>
          <h2 class="">My Library</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
     <div id="main-content">
    <div class="page-content">
      
      <?php if(isset($library_delete)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Buku berhasil dihapus. 
        </div>
      <?php endif;?>
      <?php if(isset($library_update)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Buku berhasil diupdate. 
        </div>
      <?php endif;?>

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> 
              <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> 
              </div>
              <h3 class="content-header">ErpeelDev Library</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                  
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Judul Buku</th>
                      <th class="center">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no=1; foreach($libraries as $library) : ?>
                    <tr>
                    <td><?php echo $no;?></td>
                    <td>
                      <?php echo $library->title;?>
                    </td>
                    <td class="center"> 
                      <a href="<?php echo site_url('forum/library_edit/'.encode_url($library->id_library).'/'.encode_url($library->user_id));?>" class="btn btn-success">Edit</a>
                      <a href="<?php echo site_url('forum/library_delete/'.encode_url($library->id_library).'/'.encode_url($library->user_id));?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin akan menghapus buku ini ? ')">Hapus</a>
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
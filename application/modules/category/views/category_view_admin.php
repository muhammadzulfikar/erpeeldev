    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Kategori</h1>
          <h2 class="">Kategori Index</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
     <div id="main-content">
    <div class="page-content">
      <?php if(isset($tmp_success)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Kategori berhasil diperbarui. 
        </div>
      <?php endif;?>
      <?php if(isset($tmp_success_del)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Kategori berhasil dihapus. 
        </div>
      <?php endif;?>
      <?php if(isset($tmp_success_update)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Kategori berhasil diupdate. 
        </div>
      <?php endif;?>
      <?php if(isset($error)):?>
        <?php if($error['name']):?>
        <div>- <?php echo $error['name']; ?></div>
        <?php endif; ?>
        <?php if($error['url']):?>
        <div>- <?php echo $error['url']; ?></div>
        <?php endif; ?>
      <?php endif; ?> 
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> 
              <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> 
              </div>
              <h3 class="content-header">ErpeelDev Kategori</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                <div class="clearfix">
                  <a class="btn btn-primary" href="<?php echo site_url('admin/category_create');?>">Tambah Baru <i class="fa fa-plus"></i></a>
                </div>
                
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Kategori</th>
                      <th>Url</th>
                      <th class="center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($categories as $row) : ?>
                    <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['url'];?></td>
                    <td class="center">
                      <a href="<?php echo site_url('admin/category_edit').'/'.encode_url($row['id_category']);?>" class="btn btn-success">Edit</a>
                      <a href="<?php echo site_url('admin/category_delete').'/'.encode_url($row['id_category']);?>" class="btn btn-danger" onclick="return confirm('Are You Sure Delete This User ? ')">Delete</a>
                    </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Category</th>
                      <th>Url</th>
                      <th class="center">Action</th>
                    </tr>
                  </tfoot>
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
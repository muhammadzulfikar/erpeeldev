    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Perpustakaan</h1>
          <h2 class="">Katalog Buku</h2>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      <?php if(isset($library_create)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Buku baru berhasil ditambah. 
        </div>
      <?php endif;?>

        <div class="row">
          <div class="col-sm-9">
            
            <div class="row">
            <?php foreach($libraries as $library):?>
            <div class="col-md-3 col-sm-6">
            <div class="thumb">
            <tr>
            <td>
            <a target="_blank" href="<?php echo base_url().'assets/library/files/'.$library->book;?>"><div class="thumb_image"><img src="<?php echo base_url().'assets/library/images/'.$library->image;?>" height="180px" width="150px"/></div></a>
            </td>
            <td>
            <p align="center"><?php echo $library->title;?></p>
            </td>
            </tr>
            </div>
            </div>
            <?php endforeach;?> 
            </div>
            <div class="actions"><ol class="pagination"><?php echo $page; ?></ol></div>
                     
          </div>
          <div class="col-sm-3">
            <div class="file_sidebar">
              <a href="<?php echo site_url('forum/library_create');?>" class="btn btn-primary btn-block upload_btn">Tambah Buku</a>
              
              <br/>
             <a href="javascript:void(0);" style="text-decoration:none;"> <h6>CATEGORY</h6></a>
              <div class="file_sidebar_list">
                <ul>
                <?php foreach($categories as $category):?>
                  <li><a><i class="fa <?php echo $category->icon;?>"></i><?php echo $category->name;?></a></li>
                <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
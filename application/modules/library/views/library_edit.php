
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>My Library</h1>
          <h2 class="">Edit Book</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      
      <?php if(isset($error)):?>
        <div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Oppss !</strong> 
          <?php if (isset($error['title'])): ?>
                <div>- <?php echo $error['title']; ?></div>
          <?php endif; ?>    
        </div>
      <?php endif;?>

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Edit Book</h3>
            </div>
            <div class="porlets-content">
              <form role="form" enctype="multipart/form-data" action="" method="post" parsley-validate novalidate>
                
                <div class="form-group">
                  <label>Title</label>
                  <input type="hidden" name="row[id_library]" value="<?php echo $library->id_library;?>"/>
                  <input type="hidden" name="row[user_id]" value="<?php echo $library->user_id;?>"/>
                  <input type="hidden" name="row[book_library]" value="<?php echo $library->book;?>"/>
                  <input type="hidden" name="row[title_library]" value="<?php echo $library->title;?>"/>
                  <input type="hidden" name="row[image_library]" value="<?php echo $library->image;?>"/>
                  <input type="text" name="row[title]" parsley-trigger="change" required parsley-minlength="0" value="<?php echo $library->title;?>" class="form-control">
                </div><!--/form-group-->

                <div class="form-group">
                  <label>Kategori Buku</label>
                    <select name="row[category_id]" class="form-control">
                      <?php foreach($categories as $category):?>
                      <option <?php if($library->category_id == $category->id_category):?> selected="selected" <?php endif;?> value="<?php echo $category->id_category;?>"><?php echo $category->name;?></option>
                      <?php endforeach;?>  
                    </select>
                </div><!--/form-group-->

                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="row[description]" class="form-control"><?php echo $library->description;?></textarea>
                </div>

                <div class="form-group">
                  <label>File</label>
                  <input type="file" name="book" class="form-control"/>
                </div><!--/form-group -->

                <div class="form-group">
                  <label>Image
                    <span style="display:block;font-size: 10px; font-style:italic;">* Gunakan Resolusi 360 x 300 untuk hasil yang lebih baik</span>
                  </label>
                  <input type="file" name="image" class="form-control"/>
                </div><!--/form-group-->  
                
                <input value="Simpan" class="btn btn-primary" name="btnEdit" type="submit"/>
              </form>
            </div><!--/porlets-content-->
          </div><!--/block-web--> 
        </div><!--/col-md-6-->
      </div><!--/row-->

    
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
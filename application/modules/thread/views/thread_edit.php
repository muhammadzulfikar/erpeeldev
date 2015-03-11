    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1><?php echo $category->name;?></h1>
          <h2 class=""><?php echo $thread->title;?></h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->

      <?php if(isset($error)):?>
        <div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <?php if (isset($error['title'])): ?>
                <div>- <?php echo $error['title']; ?></div>
          <?php endif; ?>
          <?php if (isset($error['content'])): ?>
                <div>- <?php echo $error['content']; ?></div>
          <?php endif; ?>  
        </div>
      <?php endif;?>

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Edit Thread</h3>
            </div>
            <div class="porlets-content">
              <form action="#" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <label>Judul</label>
                  <input type="hidden" name="row[id_thread]" value="<?php echo $thread->id_thread ?>" class="form-control">
                  <input type="text" name="row[title]" value="<?php echo $thread->title;?>" required parsley-minlength="0" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="row[desc_title]" value="<?php echo $thread->desc_title;?>" parsley-trigger="change" required parsley-minlength="0" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Konten</label>
                      <textarea class="form-control ckeditor" name="row[content]" rows="3"><?php echo $thread->content;?></textarea>
                </div>

                <div class="form-group">
                  <label>Kategori</label>
                    <select name="row[category_id]" class="form-control" value="">
                      <option value="<?php echo $category->id_category;?>"><?php echo $category->name;?></option>
                      <?php foreach($categories as $cat):?>
                      <?php if($category->id_category != $cat['id_category']):?>
                      <option value="<?php echo $cat['id_category'];?>"><?php echo $cat['name'];?></option>
                      
                      <?php endif; ?>
                      <?php endforeach;?>
                    </select>
                </div><!--/form-group-->
                <!--
                <div class="form-group">
                  <label>Image
                    <span style="display:block;font-size: 10px; font-style:italic;">* Gunakan Resolusi 360 x 300 untuk hasil yang lebih baik</span>
                  </label>
                  <input type="file" name="image" class="form-control"/>
                </div><!--/form-group-->  

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
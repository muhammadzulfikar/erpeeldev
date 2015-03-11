    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Kategori</h1>
          <h2 class="">Kategori Edit</h2>
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
          <?php if (isset($error['name'])): ?>
                <div>- <?php echo $error['name']; ?></div>
          <?php endif; ?>
          <?php if (isset($error['url'])): ?>
                <div>- <?php echo $error['url']; ?></div>
          <?php endif; ?>  
        </div>
      <?php endif;?>

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Edit Kategori</h3>
            </div>
            <div class="porlets-content">
              <form action="#" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="hidden" name="row[id_category]" value="<?php echo $category->id_category;?>"/>
                  <input type="hidden" name="row[name_category]" value="<?php echo $category->name;?>"/>
                  <input type="hidden" name="row[url_category]" value="<?php echo $category->url;?>"/>
                  <input type="text" name="row[name]" parsley-trigger="change" required parsley-minlength="0" value="<?php echo $category->name;?>" class="form-control">
                  </div><!--/form-group-->
                 <!-- 
                 <div class="form-group">
                  <label>Icon</label>
                  <input type="text" name="row[icon]" value="<?php echo $category->icon;?>" class="form-control">
                </div><!--/form-group-->

                <div class="form-group">
                  <label>Parent Kategori</label>
                    <select name="row[parent_id]" class="form-control" value="">
                      <option <?php if ($category->id_category == 0):?> selected="selected" <?php endif;?> value="0">- Pilih Kategori -</option>
                      <?php foreach($categories as $cat):?>
                      <?php if($category->id_category != $cat['id_category']):?>
                      <option <?php if($category->parent_id == $cat['id_category']):?> selected="selected" <?php endif;?> value="<?php echo $cat['id_category'];?>"><?php echo $cat['name'];?></option>
                      <?php else: ?>
                      <option disabled value="<?php echo $cat['id_category'];?>"><?php echo $cat['name'];?></option>
                      <?php endif; ?>
                      <?php endforeach;?>  
                    </select>
                </div><!--/form-group-->

                <div class="form-group">
                <label>Status</label>
                  <select name="row[status_active_id]" class="form-control" value="">
                  <?php foreach($status_active as $row):?>
                  <option <?php if($row->id_status_active == $category->status_active_id):?> selected="selected" <?php endif;?> value="<?php echo $row->id_status_active; ?>"><?php echo $row->status_active;?></option>
                  <?php endforeach;?>
                  </select>
                  
                </div>

                <!--
                <div class="form-group">
                  <label>Gambar Kategori</label>
                  <input type="File" name="row[image]" class="form-control">
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
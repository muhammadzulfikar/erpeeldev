    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>User</h1>
          <h2 class="">Tambah User</h2>
        </div>
        <div class="pull-right">
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      <?php if(isset($tmp_success)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          User berhasil dibuat. 
        </div>
      <?php endif;?>

      <?php if(isset($error)):?>
        <div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Oppss !</strong> 
          <?php if (isset($error['username'])): ?>
                <div>- <?php echo $error['username']; ?></div>
          <?php endif; ?>
          <?php if (isset($error['email'])): ?>
                <div>- <?php echo $error['email']; ?></div>
            <?php endif; ?>  
        </div>
      <?php endif;?>

      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Tambah User</h3>
            </div>
            <div class="porlets-content">
              <form action="" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="row[username]" parsley-type="alphanum" required parsley-minlength="6" placeholder="Enter user name" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Alamat Email</label>
                  <input type="email" name="row[email]" parsley-trigger="change" required placeholder="Enter email" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Password</label>
                  <input id="password" name="row[password]" type="password"  placeholder="Enter Password" required parsley-minlength="6" class="form-control">
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Retype Password</label>
                  <input parsley-equalto="#password" type="password"  placeholder="Enter Retype Password" required parsley-minlength="6" class="form-control">
                </div><!--/form-group-->
                <input class="btn btn-primary" name="btnCreate" type="submit" value="Save"/>
              </form>
            </div><!--/porlets-content-->
          </div><!--/block-web--> 
        </div><!--/col-md-6-->
      </div><!--/row-->

    
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
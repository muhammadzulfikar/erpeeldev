    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>USER</h1>
          <h2 class="">Profile User</h2>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      <?php if(isset($user_update)):?>
        <div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <strong>Selamat :D</strong> 
          Profil anda berhasil diupdate. 
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

        <div class="page-content">
          <div class="row">
            <div class="col-md-4">
              <div class="profile_bg">
                <div class="user-profile-sidebar">
                  <div class="row">
                    <div class="col-md-4"><img width="90px" height="90px" src="<?php echo base_url().'assets/images/user/'.$user->image;?>" /></div>
                    <div class="col-md-8">
                      <div class="user-identity">
                        <h4><strong><?php echo $user->name;?></strong></h4>
                        <p><i class="fa fa-envelope"></i> <?php echo $user->email;?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="user-button">
                  <div class="row">
                    <div class="col-sm-12">
                      <button type="button" class=" btn btn-primary btn-rounded"><i class="fa fa-envelope"></i> Send Message</button>
                    </div>
                  </div>
                </div>
                <div> <small class="">Status</small>
                  <p><b><?php echo $user->status;?></b></p>
                  <div class="line"></div>
                  <p class="m-t-sm"> </p>
                </div>
                <h6><strong >CONNECTION</strong></h6>
                <div class="">
                  <ul class="social_icons ">
                    <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                  </ul>
                </div>
              </div>
              <!--/block-web-->
            </div>
            <!--/col-md-4-->
            <div class="col-md-8">
              <div class="block-web full">
                <ul class="nav nav-tabs nav-justified nav_bg">
                  <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i> Profile</a></li>
                  <?php 
                  $user_id = decode_url($this->uri->segment('3'));
                  $rpl_user_id = $this->session->userdata('rpl_user_id');
                  if($user_id == $rpl_user_id):
                  ?>
                  <li class=""><a href="#edit-password" data-toggle="tab"><i class="fa fa-lock"></i> Password</a></li>
                  <li class=""><a href="#edit-profile" data-toggle="tab"><i class="fa fa-pencil"></i> Edit Profile</a></li>
                  <?php endif;?>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane animated fadeInRight active" id="profile">
                    <div class="user-profile-content">
                      <h5><strong>Tentang</strong> Saya</h5>
                      <p> <?php echo $user->about;?> </p>
                      <hr>
                      <div class="row">
                        <div class="col-sm-6">
                          <h5><strong>Kontak</strong> Saya</h5>
                          <address>
                          <strong>Email</strong><br>
                          <a href="mailto:#"><?php echo $user->email;?></a>
                          </address>
                          <address>
                          <strong>Website</strong><br>
                          <a href="<?php echo $user->website;?>"><?php echo $user->website;?></a>
                          </address>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane animated fadeInRight" id="edit-password">
                    <div class="user-profile-content">
                    <form role="form" action="" method="post" parsley-validate novalidate>
                    <div class="form-group">
                    <input type="hidden" name="row[image_user]" value="<?php echo $user->image;?>">
                    <label>Password</label>
                    <input type="hidden" name="row[id_user]" value="<?php echo $user->id_user;?>">
                    <input id="password_old" name="row[password_old]" type="password" required parsley-minlength="6" class="form-control">
                    </div><!--/form-group-->
                    <div class="form-group">
                    <label>Password Baru</label>
                    <input id="password" name="row[password]" type="password"  required parsley-minlength="6" class="form-control">
                    </div><!--/form-group-->
                    <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input id="password" parsley-equalto="#password" type="password"  required parsley-minlength="6" class="form-control">
                    </div><!--/form-group-->
                    <input type="submit"class="btn btn-primary" name="btnPassword" value="Save"/>
                    </form>
                    </div>
                  </div>

                <div class="tab-pane animated fadeInRight" id="edit-profile">
                    <div class="user-profile-content">
                      <form role="form" enctype="multipart/form-data" action="" method="post" parsley-validate novalidate>
                <div class="form-group">
                  <input type="hidden" name="row[id_user]" value="<?php echo $user->id_user;?>">
                  <input type="hidden" name="row[username_user]" value="<?php echo $user->username;?>">
                  <input type="hidden" name="row[email_user]" value="<?php echo $user->email;?>">
                  <input type="hidden" name="row[image_user]" value="<?php echo $user->image;?>">
                  <label>Username</label>
                  <input type="text" name="row[username]" parsley-type="alphanum" required parsley-minlength="5" class="form-control" value="<?php echo $user->username;?>">
                </div><!--/form-group-->
                
                <div class="form-group">
                  <label>Alamat Email</label>
                  <input type="email" name="row[email]" parsley-trigger="change" required class="form-control" value="<?php echo $user->email;?>">
                </div><!--/form-group-->

                

                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="row[name]" parsley-trigger="change" class="form-control" value="<?php echo $user->name;?>">
                </div><!--/form-group-->

                <div class="form-group">
                  <label>Website</label>
                  <input type="url" name="row[website]" parsley-type="url" class="form-control" value="<?php echo $user->website;?>">
                </div><!--/form-group-->

                <div class="form-group">
                  <label>Alamat</label>
                    <textarea name="row[address]" class="form-control"><?php echo $user->address;?></textarea>
                </div>

                <div class="form-group">
                  <label>Tentang</label>
                    <textarea name="row[about]" class="form-control"><?php echo $user->about;?></textarea>
                </div>

                <div class="form-group">
                  <label>Status</label>
                    <select name="row[status_id]" class="form-control">
                      <?php foreach($status as $row):?>
                        <option <?php if($row->id_status == $user->status_id): ?> selected="selected" <?php endif;?> value="<?php echo $row->id_status;?>"><?php echo $row->status;?></option>
                      <?php endforeach;?>
                    </select>
                </div><!--/form-group-->

                <?php if ($this->session->userdata['rpl_user_role'] == 1): ?>
                <div class="form-group">
                  <label>Role</label>
                    <select name="row[role_id]" class="form-control">
                      <?php foreach($roles as $role):?>
                      <option <?php if($role->id_role == $user->role_id): ?> selected="selected" <?php endif;?> value="<?php echo $role->id_role;?>"><?php echo $role->role;?></option>
                      <?php endforeach;?>
                    </select>
                </div><!--/form-group-->
                <?php endif;?>

                <div class="form-group">
                  <label>
                  Gambar
                  <span style="display:block;font-size: 10px; font-style:italic;">* Gunakan Resolusi 400 x 400 untuk hasil yang lebih baik</span>
                  </label>
                    <input type="file" name="image" class="form-control">
                </div><!--/form-group-->    
                <input type="submit"class="btn btn-primary" name="btnProfile" value="Save"/>
              </form>
                    </div>
                  </div>
                </div>
                <!--/tab-content-->
              </div>
              <!--/block-web-->
            </div>
            <!--/col-md-8-->
          </div>
          <!--/row-->
        </div>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
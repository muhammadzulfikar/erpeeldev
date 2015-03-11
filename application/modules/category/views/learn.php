    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Learn</h1>
          <h2 class="">Let's Sharing About Knowledge</h2>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->

        <div class="row">

          <div class="col-sm-12">
            <div class="row">
            <?php foreach($stages as $stage):?>
            <div class="col-md-3 col-sm-9">
            <div class="thumb">
            <tr>
            <td>
            <a href="<?php echo site_url('forum/category/'.$stage->url);?>"><div class="thumb_image"><img src="<?php echo base_url().'assets/images/category/'.$stage->image;?>"/></div></a>
            </td>
            <td>
            <p align="center"><b><?php echo $stage->name;?></b></p>
            </td>
            </tr>
            </div>
            </div>
            <?php endforeach;?> 
            </div>   
          </div>

        </div>
        <br/>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
</div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->

<!-- required js -->
<!-- <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
<script src="<?php echo base_url();?>assets/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/common-script.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jPushMenu.js"></script> 
<script src="<?php echo base_url();?>assets/js/side-chats.js"></script>

<!-- plugin js -->
<script src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/data-tables/dynamic_table_init.js"></script>
<script src="<?php echo base_url();?>assets/plugins/edit-table/edit-table.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validation/parsley.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/toggle-switch/toggles.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/map/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url();?>assets/plugins/gallery/superbox.js"></script>
<script>
    $(function(){
      $('#world-map').vectorMap();
    });
  </script>
  <script>
    $(function() {
    
      // Call SuperBox
      $('.superbox').SuperBox();
    
    });
    </script>
<script>
/*==Porlets Actions==*/
    $('.minimize').click(function(e){
      var h = $(this).parents(".header");
      var c = h.next('.porlets-content');
      var p = h.parent();
      
      c.slideToggle();
      
      p.toggleClass('closed');
      
      e.preventDefault();
    });
    
    $('.refresh').click(function(e){
      var h = $(this).parents(".header");
      var p = h.parent();
      var loading = $('&lt;div class="loading"&gt;&lt;i class="fa fa-refresh fa-spin"&gt;&lt;/i&gt;&lt;/div&gt;');
      
      loading.appendTo(p);
      loading.fadeIn();
      setTimeout(function() {
        loading.fadeOut();
      }, 1000);
      
      e.preventDefault();
    });
    
    $('.close-down').click(function(e){
      var h = $(this).parents(".header");
      var p = h.parent();
      
      p.fadeOut(function(){
        $(this).remove();
      });
      e.preventDefault();
    });
</script>
</body>
</html>

<div class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navMain">
        <span class="glyphicon glyphicon-chevron-right" style="color:white;"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="nav navbar-nav pull-right">
        <li><a href="#" onclick="javascript: get_all_bootstrap_modal(); return false;" data-toggle="modal" data-target="#pop_up_settings"><i class="fa fa-repeat" aria-hidden="true"></i> Pop-ups</a></li>
        <li><a href="#" onclick="undo_json_change();"><i class="fa fa-undo" aria-hidden="true"></i> Undo</a></li> 
        <li><a href="#" onclick="redo_json_change();"><i class="fa fa-repeat" aria-hidden="true"></i> Redo</a></li> 
        <!-- <li><a href="#" onclick="show_elements_list('all_element');"><i class="fa fa-plug" aria-hidden="true"></i> Elements</a></li>
        <li><a href="#" data-toggle="modal" data-target="#custom_snippet"><i class="fa fa-plug" aria-hidden="true"></i> Snippets</a></li> -->
        <li><a href="#" class="show_hide_control" id="show_hide_control" onclick="show_hide_control();"><i class="fa fa-desktop" aria-hidden="true"></i> Hide control</a></li> 
        <li><a href="<?php echo BASE. "/preview/?page=" . $page_id . '/' .get_page_meta($page_id,'page_handle'); ?>" target="_blank"><i class="fa fa-desktop" aria-hidden="true"></i> Preview</a></li> 
        
        <?php if(!$from_embed){ ?>
        <li><a href="#" onclick="open_preview_modal('<?php echo $page_id; ?>', this);" data-toggle="modal" data-target="#share_page_modal" title="Share this page"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
        <?php } ?>

        <li><a href="#" data-toggle="modal" data-target="#page_info_change_modal"><i class="fa fa-save" aria-hidden="true"></i> Save</a></li>
        <?php if(!$from_embed){ ?>
        <li><a href="<?php echo BASE ?>/dashboard"><i class="fa fa-sign-out" aria-hidden="true"></i> Exit</a></li>
      <?php } ?>
      </ul>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(window).scroll(function() {
    if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
        //$('.opaque-navbar').addClass('navbar-fixed-top');
    } else {
        $('.opaque-navbar').removeClass('opaque');
        //$('.opaque-navbar').removeClass('navbar-fixed-top');
    }
});
</script>
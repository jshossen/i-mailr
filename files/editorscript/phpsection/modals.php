<!--
MODAL START 
-->
<!--
MODAL FOR  CUSTOM SCRIPT
-->
<?php
    $custom_script= get_page_meta($page_id,"custom_script");
    $custom_css = get_page_meta($page_id,"custom_css");
?>

<div class="modal fade" id="customScriptModal" tabindex="-1" role="dialog" aria-labelledby="customScriptModalLabel" style="margin-top:70px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal_color_content">
            <div class="modal-header modal_color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="customScriptModalLabel">Custom script</h4>
            </div>
            <div class="modal-body" style="min-height: 267px;">
    				    <p>Add custom script</p>
                <form id="custom_script_form" method="post"  name="custom_script_form" action="">
        					<textarea class="col-sm-12 col-md-12 col-xs-12 col-lg-12"  id="custom_script_textarea" rows="10" style="border-radius: 4px; resize: none; color: black;"><?php echo $custom_script ?></textarea>
                </form>
            </div>
            <div class="modal-footer modal_color">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"  onclick="insert_custom_script()" data-dismiss="_modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="customCssModal" tabindex="-1" role="dialog" aria-labelledby="customCssModalLabel" style="margin-top:70px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal_color_content">
            <div class="modal-header modal_color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="customCssModalLabel">Custom css</h4>
            </div>
            <div class="modal-body" style="min-height: 267px;">
              <p>Add custom css or CDN link</p>
              <textarea class="col-sm-12 col-md-12 col-xs-12 col-lg-12"  id="custom_css_textarea" rows="10" style="border-radius: 4px; resize: none;"><?php echo $custom_css ?></textarea>
            </div>
            <div class="modal-footer modal_color">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"  onclick="insert_custom_css()" data-dismiss="_modal">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?php
$seo_page_title = get_page_meta($page_id,"seo_page_title");
if($seo_page_title == ""){
  global $mysqli;
  $sql = $mysqli->query("SELECT title FROM pages  WHERE  id='$page_id'");
  $arr = $sql->fetch_array( MYSQLI_ASSOC );
  $seo_page_title=$arr['title'];
}
$seo_page_description = get_page_meta($page_id,"seo_page_description");
$seo_page_image = get_page_meta($page_id,"seo_page_image");
?>


<div class="modal fade" id="seo_settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:70px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal_color_content">
            <div class="modal-header modal_color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bundleModalLabel">SEO settings</h4>
            </div>
            <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                 <form  class="form-horizontal" method="post" >
                                    <div id="div_id_page_name" class="form-group required">
                                        <label for="id_page_name" class="col-xs-12 text-left" style="font-size: 14px;"> Page title</label>
                                        <div class="col-xs-12">
                                            <input class="input-md form-control"  id="seo_page_title" name="seo_page_title" placeholder="Page title" style="margin-bottom: 10px" type="text" required value="<?php echo $seo_page_title;?>" />
                                            <input  class="input-md form-control hidden"  id="seo_page_id" name="page_id" value="<?php echo $page_id;?>" />
                                        </div>
                                    </div>
                                    <div id="div_id_page_name" class="form-group required">
                                        <label for="id_page_name" class="col-xs-12 text-left" style="font-size: 14px;"> Page description</label>
                                        <div class="col-xs-12">
                                            <textarea class="col-sm-12 col-md-12 col-xs-12 col-lg-12"  id="seo_page_description" rows="3" style="border-radius: 4px; resize: none;" ><?php echo $seo_page_description;?></textarea>
                                        </div>
                                    </div>
                                    <div id="div_id_page_name" class="form-group required">
                                        <label for="id_page_name" class="col-xs-12 text-left" style="font-size: 14px;"> Page image</label>

                                        <div class="col-xs-12">
                                           <div class="input-group">
                                              <input type="text" class="form-control" id="seo_page_image" placeholder="Upload image" value="<?php echo $seo_page_image; ?>">
                                              <div class="input-group-addon" onclick="document.getElementById('seo_image_upload').click();" style="cursor: pointer;border-radius: 0 4px 4px 0;" ><i class="fa fa-file-image-o" aria-hidden="true" ></i></div>

                                              <input type="file" name="seo_image_upload" id="seo_image_upload" style="display:none;" onchange="javascript:upload_image_raw(this,'contestHeaderImagePreview_seo','<?php echo BASE ?>/editor/?process=upload_an_image_to_cloud&preview_width=100&preview_height=100', '<?php echo BASE ?>', 'file_uploaded' ,'seo');">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row " style="display:none;color:green;width:100%;" id="contestHeaderImagePreview_seo"></div>
                                </form>
                            </div>
                        </div>
                    </div>
            <div class="modal-footer modal_color">
                <button type="button" id="seo_settings_popup_close_btn" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_seo_settings_data()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- timer popup -->
<div class="modal fade" id="timerPopup" role="dialog" style="margin-top: 100px">
    <div class="modal-dialog">
      <div class="modal-content modal_color_content">
        <div class="modal-header modal_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Set deadline </h4>
        </div>
        <div class="modal-body">
             <div class="form-group">
                <h5 >Date-time:</h5>
                <input class="form-control" type="text" id="datepicker">
                <input type="hidden" id="hidden_timer_id">
            </div>        
        </div>
        <div class="modal-footer modal_color">
          <button onclick="save_timer_deadline()" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
        </div>
      </div>      
    </div>
</div>

<div id="editor_popup_to_change_text" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content modal_color_content">
      <div class="modal-header modal_color">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Text editor</h4>
      </div>
      <div class="modal-body">
         <textarea class="col-sm-12 col-md-12 col-xs-12 col-lg-12" name="input_text_text_editor" id="input_text_text_editor" rows="7"></textarea>
      </div>
      <div class="modal-footer modal_color">
        <button id="text_editor_save_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--
MODAL image library START 
-->

<div class="modal fade" id="show_image_library" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:70px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal_color_content">
            <div class="modal-header modal_color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bundleModalLabel">Media library</h4>
            </div>
            <div class="modal-body" style="overflow-y: scroll;overflow-x: hidden;max-height: 400px;">
                <div class="row" id="media_img_sidepanel_lib">
                  <?php
                    global $mysqli;
                    $uploads_images_url = array();
                    $img = array('tag' => 'img','endtag' => 1,'attributes' => array('style'=>'width: 500px; max-width:100%;text-align:center;'));
                    $pres = $mysqli->query("SELECT url , id FROM uploads WHERE status = 0 AND type = 'image' ");
                    $arr = $pres->fetch_all( MYSQLI_ASSOC );
                    if(count($arr) > 0){
                      for($i=0;$i<count($arr);$i++){
                        $temp = array();
                        $temp['id'] = "uploads_image_url_".$i;
                        $temp_img = $img;
                        $temp_img['attributes']['src'] = $arr[$i]['url'];
                        $temp['html'] = $temp_img;
                        $uploads_images_url[] = $temp;
                    ?>
                        <div style="max-height: 80px;min-height: 80px; margin-top:10px;" class="main_image_div" >
                          <img class="media_image" style="max-height: 80px;min-height: 80px; border:2px solid rgba(80, 80, 255, 0.65)"  src="<?php echo $arr[$i]['url']; ?>" width="100%">
                          <div class="col-sm-12 col-md-12">
                            <div class="button">
                              <button style="padding:2px;background: rgba(14, 65, 210, 0.41);border: 1px solid blue;border-radius: 0px; " class="btn btn-primary col-sm-6 col-md-6" id="<?php echo "uploads_image_url_".$i; ?>" onclick="add_me_to_editor_preview(this);" data-dismiss="modal"> Insert </button>
                               <button style="padding:2px;background: rgba(255, 1, 1, 0.45);border:1px solid #b70d01;border-radius: 0px;" onclick="delete_this_image_form_db(<?php echo $arr[$i]['id'] ?>,this)" class="btn btn-primary col-sm-6 col-md-6"> Delete </button>
                            </div>
                      
                          </div>
                        </div>
                    <?php
                      }
                    }else{
                    ?>
                      <div class="col-md-12 col-sm-12 col-lg-12 no_image_error_msg" style="background-color: #d9534f">
                        <h5 style="text-align: center;color:white;">No images uploaded yet.</h5>
                      </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="modal-footer modal_color">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show_image_library_src" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:70px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal_color_content">
            <div class="modal-header modal_color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bundleModalLabel">Media library</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="media_img_settings_lib">
                  <?php
                    global $mysqli;
                    $pres = $mysqli->query("SELECT url, id FROM uploads WHERE status = 0 AND type = 'image' ");
                    $arr = $pres->fetch_all( MYSQLI_ASSOC );
                    if(count($arr) > 0){
                      for($i=0;$i<count($arr);$i++){
                    ?>
                        <div style="max-height: 80px;min-height: 80px; margin-top:10px;" class="col-md-3 main_image_div" >
                          <img class="media_image" style="max-height: 80px;min-height: 80px; border:2px solid rgba(80, 80, 255, 0.65)"  src="<?php echo $arr[$i]['url']; ?>" width="100%">
                          <div class="col-sm-12 col-md-12">
                            <div class="button">
                              <button style="padding:2px;background: rgba(14, 65, 210, 0.41);border: 1px solid blue;border-radius: 0px; " class="btn btn-primary col-sm-6 col-md-6" onclick="add_this_url_to_input_field('<?php echo $arr[$i]['url']; ?>');" data-dismiss="modal"> Insert </button>
                              <button style="padding:2px;background: rgba(255, 1, 1, 0.45);border:1px solid #b70d01;border-radius: 0px;" onclick="delete_this_image_form_db(<?php echo $arr[$i]['id'] ?>,this)" class="btn btn-primary col-sm-6 col-md-6"> Delete </button>
                            </div>
                      
                          </div>
                        </div>
                    <?php
                      }
                    }else{
                      ?>
                      <div class="col-md-12 col-sm-12 col-lg-12 no_image_error_msg" style="background-color: #d9534f">
                        <h5 style="text-align: center;color:white;">No images uploaded yet.</h5>
                      </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="modal-footer modal_color">
                <input type="hidden" id="image_src_input_field_id" value="">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function add_this_url_to_input_field(val){
    var my_id = $("#current_editable_element_id")[0].value;
    var value = val;
    $("#"+$("#image_src_input_field_id")[0].value)[0].value = val;
    $("#"+$("#image_src_input_field_id")[0].value).change();
  }

  function delete_this_image_form_db(image_id,me){
    var data = 'image_id='+ image_id;
    http_post_request( base + '/editor/?process=delete_this_image', data , 'nothing_to_do' );
    $(me).parent().parent().parent().remove();
  }
</script>

<div id="custom_snippet" class="modal fade" role="dialog" hidden>
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal_color_content">
      <div class="modal-header modal_color">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:15px;">X</span></button>
        <h4 style="margin-top:5px;margin-bottom:5px;"><i class="fa fa-code" aria-hidden="true"></i> Snippets</h4>
      </div><!-- /modal-header -->
      <div class="modal-body" style="height:450px;padding-top:5px;">
        <div id="custom_snippet_body">
          <h4>Paste your snippet code here</h4>
          <textarea class="col-sm-12 col-md-12 col-xs-12 col-lg-12" name="custom_snippet_textarea" id="custom_snippet_textarea" style="width:100%; height:45vh; box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box; color: black;"></textarea>
        </div>
      </div> 
      <div class="modal-footer modal_color" style="margin-top:30px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="color:white;"> Close</button>
          <button type="button" id="custom_insert_btn" class="btn btn-primary" onclick="add_this_custom_snippet();" data-dismiss="modal"> Insert</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="pop_up_settings" class="modal fade" role="dialog" style="margin-top: 70px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal_color_content">
      <div class="modal-header modal_color">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Popup settings</h4>
      </div>
      <div class="modal-body">
        <table class="table table-condensed" id="bundle_product_table">
            <thead style="background: rgba(52,73,94,.94);color: #ECF0F1;text-align:center;" >
                <tr>
                    <th class="col-sm-2 text-left">Popups</th>
                    <th class="col-sm-4 text-left">Options</th>
                </tr>
            </thead>
            <tbody id="show_all_pop_up_list">
              <tr>
                  <td class="col-sm-2" >1.Exit popup</td>
                  <td class="col-sm-4" style="text-align:center;">
                    <input  type="radio" name="exit_popup" value="on"/> On 
                    <input type="radio" name="exit_popup" value="off"/> Off 
                    <button class="btn btn-primary btn-sm" style="margin-top: 0px !important;" data-toggle="modal" data-target="#exit_popup" data-dismiss="modal">View</button>
                  </td>
              </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer modal_color">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="page_info_change_modal" class="modal fade" role="dialog" style="margin-top: 70px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal_color_content">
      <div class="modal-header modal_color">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Page details</h4>
      </div>
      <div class="modal-body">

        <div class="form-group has-success">
            <label class="control-label" for="inputSuccess">Page Type: </label>
            <?php echo $page_type ?>
        </div>
        <div class="form-group has-success">
            <label class="control-label" for="inputSuccess">Page Name: </label>
            <input type="text" class="form-control" onchange="javascript: $('#page_name')[0].value = this.value;" value="<?php echo $page_name ?>">
        </div>
        <div class="form-group has-success">
            <label class="control-label" for="inputSuccess">Page Title: </label>
            <input type="text" class="form-control" onchange="javascript: $('#page_title')[0].value = this.value;" value="<?php echo $page_title ?>">
        </div>
        <div class="form-group has-success">
            <label class="control-label" for="inputSuccess">Page Handle: </label>
            <input type="text" class="form-control" onchange="javascript: $('#page_handle')[0].value = this.value;" value="<?php echo $page_handle ?>">
        </div>
      </div>
      <div class="modal-footer modal_color">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
        <?php if(!$from_embed){ ?>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_my_clone();"><i class="fa fa-clone" aria-hidden="true"></i> Make clone</button>
      <?php } ?>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_my_settings();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="my_library_modal" class="modal fade" role="dialog" style="margin-top: 70px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal_color_content">
      <div class="modal-header modal_color">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My library</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-left: 0px; margin-right: 0px;">
          <div class="form-group has-success">
              <label class="control-label" for="inputSuccess">Title: </label>
              <input type="text" class="form-control" id="library_title">
              <input type="hidden" id="add_to_lib_id">
          </div>
          <div class="form-group has-success">
              <label class="control-label" for="inputSuccess"></label>
              <button type="button" class="btn btn-success form-control" onclick="add_me_to_personal_lib();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Add</button>
          </div>
        </div>
        <hr>
        <div class="row" style="margin-left: 0px; margin-right: 0px;"> 
          <div class="col-sm-12">
            <h3 style="margin-top:0px; margin-bottom: 5px; margin-left: -15px;">My library</h3>
          </div>
        </div>
        <div class="row" id="row_persornal_lib" style="margin-left: 0px; margin-right: 0px;">

        </div>
      </div>
      <div class="modal-footer modal_color">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
      </div>
    </div>

  </div>
</div>

<!-- /#page-wrapper -->
<div id="share_page_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: black;">
                <div id="preview_screen">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="page_preview_frame" class="embed-responsive-item" src=""></iframe>
                    </div>
                </div>
                <div id="share_screen" style="display: none;">
                    share screen
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="show_share_div();" id="next_button">Next <i class="fa fa-arrow-right"></i></button>
                <button type="button" class="btn btn-primary" onclick="show_preview_div();" id="preview_button"><i class="fa fa fa-arrow-left"></i> Preview</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function show_share_div(){
        $("#preview_screen").hide();
        $("#preview_button").show();
        $("#next_button").hide();
        $("#share_screen").show();

    }
    function show_preview_div(){
        $("#preview_screen").show();
        $("#preview_button").hide();
        $("#next_button").show();
        $("#share_screen").hide();
    }
    function open_preview_modal(page_id, me){
        $("#page_preview_frame")[0].src = base+"/preview/?page="+page_id;
        var data = 'page_id=' +  page_id;
        http_post_request( base + '/processor/?process=get_page_share_div', data , 'open_preview_modal_done' );
        $("#preview_screen").show();
        $("#next_button").show();
        $("#share_screen").hide();
        $("#preview_button").hide();
    }
    function open_preview_modal_done(res){
        $("#share_screen")[0].innerHTML = res;
        gen_select_group_list();
        
        jQuery('#sending_time').datetimepicker({
            format:'Y-m-d H:i:s',
        });
    }
    function check_send_email_info(me){
        console.log($(me));
        $('.error').hide();
        var email = $(me).find('#selected_email')[0];
        var selected_group_list = $(me).find('#selected_group_list')[0];
        var email_subject = $(me).find('#email_subject')[0];

        if(email.value == ""){
            $('.email_error').show();
            return false;
        }
        if(selected_group_list.value == ""){
            $('.s_list_error').show();
            return false;
        }
        if(email_subject.value == ""){
            $('.subject_error').show();
            return false;
        }


        return true;
    }
</script>
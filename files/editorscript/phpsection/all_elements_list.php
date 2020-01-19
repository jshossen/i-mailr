<div id="elements_container">
    <ul class="element_cat_ul">
        <li onclick="show_elements_list('container_and_div');" data-toggle="tooltip" data-placement="top" title="Container and Column"><i class="fa fa-plug" aria-hidden="true"></i></li>
        <li onclick="show_elements_list('all_element');" data-toggle="tooltip" data-placement="top" title="All elements"><i class="glyphicon glyphicon-th" aria-hidden="true"></i></li>
        <li onclick="show_elements_list('all_text');" data-toggle="tooltip" data-placement="top" title="Text elements"><i class="glyphicon glyphicon-font" aria-hidden="true"></i></li>
        <li onclick="show_elements_list('all_media');" data-toggle="tooltip" data-placement="top" title="Media elements"><i class="glyphicon glyphicon-play" aria-hidden="true"></i></li>
        <li onclick="show_elements_list('all_form');" data-toggle="tooltip" data-placement="top" title="Form elements"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></li>
        <li onclick="show_elements_list('all_timer');" data-toggle="tooltip" data-placement="top" title="Timer"><i class="glyphicon glyphicon-hourglass" aria-hidden="true"></i></li>
        <li onclick="close_all_option(); load_personal_lib();" data-toggle="modal" data-target="#my_library_modal" data-toggle="tooltip" data-placement="top" title="My library"><i class="fa fa-bookmark" aria-hidden="true"></i></li>
        <li onclick="close_all_option();" data-toggle="modal" data-target="#custom_snippet" data-toggle="tooltip" data-placement="top" title="Snippets"><i class="fa fa-code" aria-hidden="true"></i></li>
    </ul>
</div>
<div id="elements" class="all_elements_pannel">
    <div id="container_and_div" class="make_scroll sidenav_container_left hidden"> 
        <div class="element_panel_title"><b>Container and divs</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>
        <?php
          foreach ($container_and_div as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>


    <div id="all_element" class="make_scroll sidenav_container_left hidden">    
        <div class="element_panel_title"><b>All elements</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>      
        <?php
          foreach ($all_element as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>

    <div id="all_text" class="make_scroll sidenav_container_left hidden"> 
        <div class="element_panel_title"><b>Text elements</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>
        <?php
          foreach ($all_text as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>


    <div id="all_media" class="make_scroll sidenav_container_left hidden"> 
        <div class="element_panel_title"><b>Media elements</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>
        <?php
          foreach ($all_media as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>

    <div id="all_form" class="make_scroll sidenav_container_left hidden"> 
        <div class="element_panel_title"><b>Form elements</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>
        <?php
          foreach ($all_form as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>



    <div id="all_timer" class="make_scroll sidenav_container_left hidden"> 
        <div class="element_panel_title"><b>Timer elements</b><br><span style="font-size: 12px;">Drag blocks to add them:</span></div>
        <?php
          foreach ($all_timer as $key => $value) {
        ?>
        <div class="drag_me_panel_to_editor drag_ele_cont" id="<?php echo $value['id']; ?>" onclick="add_me_to_editor_preview(this)">
            <img src="<?php echo $value['img']; ?>">
            <div class="desc">
                <b><?php echo $value['name']; ?></b>
            </div>
        </div>
        <?php
          }
        ?>
    </div>
</div>

<script type="text/javascript">
    function show_elements_list(div_id){
        $("#elements").children().addClass("hidden");
        $("#elements").children("#"+div_id).removeClass("hidden");
        $("#elements").show("slide", { direction: "left" }, 500);
    }
</script>
<style type="text/css">
#elements_container{
    position: fixed; 
    top: 0;
    height: 100%; 
    width: 50px; 
    background-color: #0b5a82;
}

.element_cat_ul{
    list-style-type: none;
    padding: 10px;
    margin-top: 51px;
    text-align: center;
}
.element_cat_ul li{
    cursor: pointer;
    margin-top: 20px;
}
.element_cat_ul li i{
    font-size: 22px;
    color: white;
}

.sidenav_container_left{
    width: 220px;
    height: 100%;
    position: fixed;
    left: 50px;
    background-color: #007e9c;
    z-index: 500000;
    padding: 15px;
}
.element_panel_title {
    font-size: 21px;
    color: #f7f7f7;
    padding: 7px 10px;
    text-align: center;
    margin-top: -16px;
    background: #046b8e;
    margin-left: -15px;
    margin-right: -15px;
    width: 220px;
    position: fixed;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.drag_ele_cont {
    text-align: center;
    border: 1px solid #fff;
    margin-top: 24px;
    cursor: pointer;
    padding: 5px;
    background: #0b5a8287;
}

.drag_ele_cont:nth-child(2){
    margin-top: 75px !important;
}

.drag_ele_cont:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.drag_ele_cont img{
    width: 170px;
    padding: 2px;
}
.drag_ele_cont .desc{
    color: white;
}


.hidden{
    display: none;
}

.make_scroll{
    overflow-y: scroll;
    height: 92vh;
}


</style>
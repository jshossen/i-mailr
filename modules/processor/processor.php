<?php
    form_processor();
    function process_load_page_list(){
        global $mysqli;
        $max_limit = $_SESSION['rule']['page'];
        $user_id = $_SESSION['user_id'];
        $type = $_REQUEST['type'];
        $res = $mysqli->query("SELECT * FROM pages WHERE ( user_id = '$user_id' AND type = '$type' AND status='1') ORDER BY id DESC  LIMIT 0,$max_limit");
        $pages_arr = $res->fetch_all( MYSQLI_ASSOC );
        if(count($pages_arr) > 0){
?>
            <table width="100%" class="table table-striped table-bordered table-hover results">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="javascript:void(0)" class="" onclick="select_all_checkbox('<?php echo $type; ?>');"><i class="fa fa-check-square-o"></i> Select all</a></li>
                                    <li class=""><a href="javascript:void(0)" class="" onclick="unselect_all_checkbox('<?php echo $type; ?>');"><i class="fa fa-square-o"></i> Deselect all</a></li>
                                    <li class=""><a href="javascript:void(0)" class="text-danger" onclick="delete_selected_pages('<?php echo $type; ?>');"><i class="fa fa-times"></i> Delete selected</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>Page name</th>
                        <th class="hidden-xs">Created</th>
                        <th class="hidden-xs">Last updated</th>
                        <th class="text-center">Settings</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($pages_arr as $page) { 
                        if(get_user_meta($user_id,"wh_file_location") != ""){
                            $url = "https://".get_user_meta($user_id,"wh_file_location").'?page='.$page['id'].'/'.get_page_meta($page['id'],"page_handle");
                        }else{
                            $url = BASE.'/preview/?page='.$page['id'].'/'.get_page_meta($page['id'],"page_handle");
                        }
                        $edit_url = BASE.'/editor/?page='.$page['id'];
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i++ ?></td>
                        <td>
                            <input type="checkbox" aria-label="Checkbox for following text input" value="<?php echo $page['id']; ?>">
                        </td>
                        <td style="max-width: 300px; width: 300px;"><a href="<?php echo $url; ?>" target="_blank"><?php echo $page['name']; ?></a></td>
                        <td class="hidden-xs"><?php echo time_elapsed_string($page['date']); ?></td>
                        <td class="center hidden-xs"><?php echo time_elapsed_string($page['last_updated']); ?></td>
                        <td class="text-center">
                            <a class="btn" href="<?php echo $edit_url; ?>" target=""><i class="fa fa-edit"></i> Edit</a>
                            <button type="button" class="btn btn-info btn-circle" onclick="clone_this_page('<?php echo $page['id'] ?>', this);" title="Duplicate this page"><i class="fa fa-clone"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-circle" onclick="open_preview_modal('<?php echo $page['id'] ?>', this);" data-toggle="modal" data-target="#share_page_modal" title="Share this page"><i class="fa fa-share-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-circle" onclick="delete_this_page('<?php echo $page['id'] ?>', this);" title="Delete this page"><i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
<?php
        }else{
            echo "No pages found";
        }
    }

    function process_load_trash_email_and_page_list(){
        global $mysqli;
        $max_limit = $_SESSION['rule']['page'];
        $user_id = $_SESSION['user_id'];
        $type = $_REQUEST['type'];
        $res = $mysqli->query("SELECT * FROM pages WHERE ( user_id = '$user_id' AND status='2') ORDER BY last_updated DESC");
        $pages_arr = $res->fetch_all( MYSQLI_ASSOC );
        if(count($pages_arr) > 0){
?>
            <table width="100%" class="table table-striped table-bordered table-hover results">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page name</th>
                        <th>Page type</th>
                        <th class="hidden-xs">Deleted</th>
                        <th class="text-center">Settings</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($pages_arr as $page) { 
                        if(get_user_meta($user_id,"wh_file_location") != ""){
                            $url = "https://".get_user_meta($user_id,"wh_file_location").'?page='.$page['id'].'/'.get_page_meta($page['id'],"page_handle");
                        }else{
                            $url = BASE.'/preview/?page='.$page['id'].'/'.get_page_meta($page['id'],"page_handle");
                        }
                        $edit_url = BASE.'/editor/?page='.$page['id'];
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i++ ?></td>
                        <td style="max-width: 300px; width: 300px;"><?php echo $page['name']; ?></td>
                        <td><?php echo $page['type']; ?></td>
                        <td class="center hidden-xs"><?php echo time_elapsed_string($page['last_updated']); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-circle" onclick="delete_this_trash_page('<?php echo $page['id'] ?>', this);" title="Delete this page"><i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
<?php
        }else{
            echo "No pages found";
        }
    }

    function process_add_new_page_with_template(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $html_data = $_REQUEST['html_data'];
        $page_name = $_REQUEST['page_name'];
        $page_title = $_REQUEST['page_title'];
        $page_type = $_REQUEST['page_type'];
        $page_handle = $_REQUEST['page_handle'];

        $max_limit = $_SESSION['rule']['page'];
        $pres = $mysqli->query("SELECT id FROM pages WHERE user_id = $user_id AND status=1");
        if($pres->num_rows >= $max_limit ){
            echo 'fail';
        }else{
            $html_data = $mysqli->real_escape_string($html_data);
            $page_handle = $mysqli->real_escape_string($page_handle);

            $page_handle = $mysqli->real_escape_string( preg_replace('!\s+!', ' ',$page_handle ));
            $page_handle = str_replace( " " ,"-" , $page_handle );

            $res = $mysqli->query("INSERT INTO pages ( date , last_updated, user_id ,type,name,title,html,status) VALUES ( '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$user_id' , '$page_type' , '$page_name' , '$page_title' ,'$html_data','1' ) ");
        
            $pres = $mysqli->query("SELECT id FROM pages ORDER BY id DESC LIMIT 1");
            $arr = $pres->fetch_array( MYSQLI_ASSOC );
            $page_id = $arr['id'];
            add_page_meta($page_id,"page_handle", $page_handle);
            echo  $page_id;
        }
    }

    function process_delete_this_page(){
        global $mysqli;
        $id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE pages SET status = '2', last_updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }
    function process_delete_this_trash_page(){
        global $mysqli;
        $id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];
        $last_updated = date("Y-m-d H:i:s");
        $sql = "DELETE FROM pages WHERE id = '$id' AND user_id = '$user_id' AND status = 2";
        $res = $mysqli->query($sql);
    }
    function process_delete_selected_pages(){
        global $mysqli;
        $ids = $_REQUEST['ids'];
        $user_id = $_SESSION['user_id'];

        $ids = json_decode($ids);
        for($i=0; $i<count($ids);$i++){
            $id = $ids[$i];
            $last_updated = date("Y-m-d H:i:s");
            $sql = "UPDATE pages SET status = '2', last_updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
            $res = $mysqli->query($sql);
        }
    }
    function process_clone_this_page(){
        global $mysqli;
        $id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];
        $max_limit = $_SESSION['rule']['page'];

        $pres = $mysqli->query("SELECT id FROM pages WHERE user_id = $user_id AND status=1");
        if($pres->num_rows >= $max_limit ){
            echo 'fail';
        }else{
            $pres = $mysqli->query("SELECT * FROM pages WHERE id= '$id' LIMIT 1");
            $arr = $pres->fetch_array( MYSQLI_ASSOC );

            $html_data = $arr['html'];
            $page_name = $arr['name'].' copy';
            $page_title = $arr['title'];
            $page_type = $arr['type'];
            $page_handle = get_page_meta($id,"page_handle");

            $html_data = $mysqli->real_escape_string($html_data);

            $res = $mysqli->query("INSERT INTO pages ( date , last_updated, user_id ,type,name,title,html,status) VALUES ( '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$user_id' , '$page_type' , '$page_name' , '$page_title' ,'$html_data','1' ) ");

            $pres = $mysqli->query("SELECT id FROM pages ORDER BY id DESC LIMIT 1");
            $arr = $pres->fetch_array( MYSQLI_ASSOC );
            $page_id = $arr['id'];
            
            add_page_meta($page_id,"page_handle",$page_handle);
        }
    }

    function process_load_template_list(){
        include "files/dashboard/phpsection/template_list_data.php";
        $page_type = $_REQUEST['page_type'];
        foreach ($template_array as $key => $value) {
            if(in_array("all", $value['type']) || in_array($page_type, $value['type'])){
?>
            <div class="col-md-3 template_list" onclick="add_this_template('<?php echo BASE; ?>/files/editorscript/custom_templates/template-layout.php?id=<?php echo $value['id'] ?>',this)" id="template_id_<?php echo $value['id']; ?>" style="height: 200px;">
                <img class="rounded" src="<?php echo BASE; ?>/files/editorscript/custom_templates/template-dependency/images/<?php echo $value['img'] ?>" height="150px" style="max-width: 100%;">
                <h5><?php echo $value['name'] ?></h5>
            </div>
<?php
            }
        }
    }

    function process_add_this_subscriber(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $first_name = $mysqli->real_escape_string($_REQUEST['first_name']);
        $last_name = $mysqli->real_escape_string($_REQUEST['last_name']);
        $email = $mysqli->real_escape_string($_REQUEST['email']);
        $phone = $mysqli->real_escape_string($_REQUEST['phone']);

        $info = '[]';
        $status = 1;

        $max_limit = $_SESSION['rule']['subscriber'];
        $pres = $mysqli->query("SELECT id FROM subscriber WHERE user_id = $user_id AND status=1");
        if($pres->num_rows >= $max_limit ){
            echo 'fail';
        }else{
            $sql = "SELECT id FROM subscriber WHERE user_id = '$user_id' AND email = '$email'";
            $pres = $mysqli->query($sql);
            if($pres->num_rows > 0){
                $last_updated = date("Y-m-d H:i:s");
                $sql = "UPDATE subscriber SET status = '1', updated = '$last_updated' WHERE user_id = '$user_id' AND email = '$email'";
                $res = $mysqli->query($sql);
                echo "exists";
            }else{
                $sql = "INSERT INTO subscriber ( user_id, first_name , last_name, email, phone, date_of_birth, created, updated, info, status) VALUES ( '$user_id','$first_name','$last_name','$email','$phone','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$info' ,'$status' ) ";
                $res = $mysqli->query($sql);
                echo "success";
            }
        }
    }
    function process_load_subscriber_list(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $max_limit = $_SESSION['rule']['subscriber'];
        $res = $mysqli->query("SELECT * FROM subscriber WHERE ( user_id = '$user_id' AND status='1') ORDER BY id DESC  LIMIT 0,$max_limit");
        $pages_arr = $res->fetch_all( MYSQLI_ASSOC );
        if(count($pages_arr) > 0){
?>
            <table width="100%" class="table table-striped table-bordered table-hover results" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="javascript:void(0)" class="" onclick="select_all_checkbox('subscriber_list');"><i class="fa fa-check-square-o"></i> Select all</a></li>
                                    <li class=""><a href="javascript:void(0)" class="" onclick="unselect_all_checkbox('subscriber_list');"><i class="fa fa-square-o"></i> Deselect all</a></li>
                                    <li class=""><a href="#" class="" onclick="show_group_list_modal_for_add_sibscriber();"><i class="fa fa-users"></i> Add to a group</a></li>
                                    <li class=""><a href="javascript:void(0)" class="text-danger" onclick="delete_selected_subscribers('subscriber_list');"><i class="fa fa-times"></i> Delete selected</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>User</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Last updated</th>
                        <th class="text-center">Settings</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($pages_arr as $page) { 
                        $image_src = get_user_image_from_email($page['email']);
                        $edit_url = BASE."/edit_subscriber/?id=".$page['id'];
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i++ ?></td>
                        <td>
                            <input type="checkbox" aria-label="Checkbox for following text input" value="<?php echo $page['id']; ?>">
                        </td>
                        <td><img src="<?php echo $image_src; ?>"></td>
                        <td><a href="<?php echo $edit_url; ?>" target="_blank"><?php echo $page['first_name']; ?></a></td>
                        <td><?php echo $page['last_name']; ?></td>
                        <td class="center"><?php echo $page['email']; ?></td>
                        <td class="center"><?php echo $page['phone']; ?></td>
                        <td class="center"><?php echo time_elapsed_string($page['created']); ?></td>
                        <td class="center"><?php echo time_elapsed_string($page['updated']); ?></td>
                        <td class="text-center">
                            <a class="btn" href="<?php echo $edit_url; ?>" target=""><i class="fa fa-edit"></i> Edit</a>
                            <button type="button" class="btn btn-danger btn-circle" onclick="delete_this_subscriber('<?php echo $page['id'] ?>', this);" title="Delete this subscriber"><i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
<?php
        }else{
            echo "No subscriber found";
        }
    }
    function process_delete_this_subscriber(){
        global $mysqli;
        $id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE subscriber SET status = '2', updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }
    function process_delete_selected_subscribers(){
        global $mysqli;
        $ids = $_REQUEST['ids'];
        $user_id = $_SESSION['user_id'];

        $ids = json_decode($ids);
        for($i=0; $i<count($ids);$i++){
            $id = $ids[$i];
            $last_updated = date("Y-m-d H:i:s");
            $sql = "UPDATE subscriber SET status = '2', updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
            $res = $mysqli->query($sql);
        }
    }

    function process_add_this_subscriber_group(){
        global $mysqli;
        $group_name = $_REQUEST['group_name'];
        $user_id = $_SESSION['user_id'];

        $info = array();
        $info['name'] = $group_name;
        $info = $mysqli->real_escape_string(json_encode($info));
        $sql = "INSERT INTO subscriber_groups ( user_id, created, updated, info) VALUES ( '$user_id','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' ,'$info') ";
        $res = $mysqli->query($sql);
    }

    function process_delete_this_subscriber_group(){
        global $mysqli;
        $id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE subscriber_groups SET status = '2', updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }

    function process_load_subscriber_groups_list(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $type = $_REQUEST['type'];
        $res = $mysqli->query("SELECT * FROM subscriber_groups WHERE ( user_id = '$user_id' AND status='1') ORDER BY id DESC  LIMIT 0,100");
        $groups_arr = $res->fetch_all( MYSQLI_ASSOC );
        if(count($groups_arr) > 0){
?>
            <div class="row">
                <?php
                    foreach ($groups_arr as $group) { 
                        $info = $group['info'];
                        $info = json_decode($info);
                        $name = $info->name;

                        $subscriber_ids = $group['subscriber_ids'];
                        if($subscriber_ids == NULL){
                            $subscriber_ids = "[]";
                        }
                        $subscriber_ids = json_decode($subscriber_ids);
                ?>
                    <div class="col-sm-3">
                        <div class="single_group_div well well-sm">
                            <a href="<?php echo BASE.'/group/?id='.$group['id']; ?>"><h4><?php echo $name; ?></h4></a>
                            <span style="border-top: 1px solid #daedf7; display: block;"></span>
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li>Total subscriber: <?php echo count($subscriber_ids); ?></li>
                                <li>Created at: <?php echo time_elapsed_string($group['created']); ?></li>
                                <li>Updated at: <?php echo time_elapsed_string($group['updated']); ?></li>
                                <li><a href="<?php echo BASE.'/group/?id='.$group['id']; ?>">View full details</a></li>
                            </ul>
                            
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
<?php
        }else{
            echo "No list found";
        }
    }

    function process_add_this_subscriber_to_a_group(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $group_id = $_REQUEST['group_id'];
        $ids = $_REQUEST['ids'];

        $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
        if($group_detais['subscriber_ids'] != NULL && $group_detais['subscriber_ids'] != "null"){
            $subscriber_ids = json_decode($group_detais['subscriber_ids']);
        }else{
            $subscriber_ids = [];
        }
        
        $subscriber_ids = array_merge($subscriber_ids,json_decode($ids));

        $subscriber_ids = array_unique($subscriber_ids);
        $subscriber_ids = $mysqli->real_escape_string(json_encode(array_values($subscriber_ids)));



        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }

    function process_load_groups_subscriber_list(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];

        $group_id = $_REQUEST['group_id'];
        $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
        $subscriber_ids = json_decode($group_detais['subscriber_ids']);
        if($subscriber_ids != NULL){
?>
            <table width="100%" class="table table-striped table-bordered table-hover results" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="javascript:void(0)" class="" onclick="select_all_checkbox('groups_subscriber_list');"><i class="fa fa-check-square-o"></i> Select all</a></li>
                                    <li class=""><a href="javascript:void(0)" class="" onclick="unselect_all_checkbox('groups_subscriber_list');"><i class="fa fa-square-o"></i> Deselect all</a></li>
                                    <li class=""><a href="#" class="" onclick="show_group_list_modal_for_add_sibscriber();"><i class="fa fa-users"></i> Add to a group</a></li>
                                    <li class=""><a href="javascript:void(0)" class="text-danger" onclick="delete_selected_subscribers_from_this_group('groups_subscriber_list',<?php echo $group_id; ?>);"><i class="fa fa-times"></i> Delete selected</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>User</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Last updated</th>
                        <th class="text-center">Settings</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($subscriber_ids as $key => $value) {
                        if($page = get_details_from_db_table('subscriber',$value)){
                            $edit_url = BASE."/edit_subscriber/?id=".$page['id'];
                            $image_src = get_user_image_from_email($page['email']);
                ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i++ ?></td>
                                <td>
                                    <input type="checkbox" aria-label="Checkbox for following text input" value="<?php echo $page['id']; ?>">
                                </td>
                                <td><img src="<?php echo $image_src; ?>"></td>
                                <td><a href="<?php echo $edit_url; ?>" target="_blank"><?php echo $page['first_name']; ?></a></td>
                                <td><?php echo $page['last_name']; ?></td>
                                <td class="center"><?php echo $page['email']; ?></td>
                                <td class="center"><?php echo $page['phone']; ?></td>
                                <td class="center"><?php echo time_elapsed_string($page['created']); ?></td>
                                <td class="center"><?php echo time_elapsed_string($page['updated']); ?></td>
                                <td class="text-center">
                                    <a class="btn" href="<?php echo $edit_url; ?>" target=""><i class="fa fa-edit"></i> Edit</a>
                                    <button type="button" class="btn btn-danger btn-circle" onclick="delete_this_subscriber_from_this_group('<?php echo $page['id'] ?>',<?php echo $group_id; ?> ,this);" title="Delete this subscriber"><i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                <?php
                        }else{
                            $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
                            if($group_detais['subscriber_ids'] != NULL){
                                $subscriber_ids = json_decode($group_detais['subscriber_ids']);
                            }else{
                                $subscriber_ids = [];
                            }

                            $temp = [];
                            foreach ($subscriber_ids as $key => $id){
                                if ($value != $id) {
                                    $temp[] = $id;
                                }
                            }
                            $subscriber_ids = $temp;

                            $subscriber_ids = $mysqli->real_escape_string(json_encode($subscriber_ids));
                            $last_updated = date("Y-m-d H:i:s");
                            $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
                            $res = $mysqli->query($sql);
                        }
                    }
                ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
<?php
        }else{
            echo "No subscriber found";
        }
    }

    function process_delete_this_subscriber_from_this_group(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $id = $_REQUEST['id'];
        $group_id = $_REQUEST['group_id'];

        $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
        if($group_detais['subscriber_ids'] != NULL){
            $subscriber_ids = json_decode($group_detais['subscriber_ids']);
        }else{
            $subscriber_ids = [];
        }

        $temp = [];
        foreach ($subscriber_ids as $key => $value){
            if ($value != $id) {
                $temp[] = $value;
            }
        }
        $subscriber_ids = $temp;

        $subscriber_ids = $mysqli->real_escape_string(json_encode($subscriber_ids));
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }

    function process_delete_selected_subscribers_from_this_group(){
        global $mysqli;
        $ids = $_REQUEST['ids'];
        $user_id = $_SESSION['user_id'];
        $group_id = $_REQUEST['group_id'];

        $ids = json_decode($ids);
        

        $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
        if($group_detais['subscriber_ids'] != NULL){
            $subscriber_ids = json_decode($group_detais['subscriber_ids']);
        }else{
            $subscriber_ids = [];
        }

        $subscriber_ids = array_diff($subscriber_ids, $ids);



        $temp = [];
        foreach ($subscriber_ids as $key => $value){
            if ($value != $id) {
                $temp[] = $value;
            }
        }
        $subscriber_ids = $temp;

        $subscriber_ids = $mysqli->real_escape_string(json_encode($subscriber_ids));
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }

    function process_gen_select_group_list(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $options = '<option value="">Select a subscriber list</option>';
        $res = $mysqli->query("SELECT * FROM subscriber_groups WHERE ( user_id = '$user_id' AND status='1') ORDER BY id DESC  LIMIT 0,10");
        $groups_arr = $res->fetch_all( MYSQLI_ASSOC );
        if(count($groups_arr) > 0){
            foreach ($groups_arr as $group) { 
                $info = $group['info'];
                $info = json_decode($info);
                $name = $info->name;

                $subscriber_ids = $group['subscriber_ids'];
                if($subscriber_ids == NULL){
                    $subscriber_ids = "[]";
                }
                $subscriber_ids = json_decode($subscriber_ids);

                $options .= '<option value="'.$group['id'].'" >'.$name.'('.count($subscriber_ids).')</option>';
            }
        }
        echo $options;
    }

    function process_get_page_share_div(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $page_id = $_REQUEST['page_id'];
        $res = $mysqli->query("SELECT id, name, title, html, type FROM pages WHERE id='$page_id' AND user_id = '$user_id' LIMIT 1");
        if( $res->num_rows > 0 ) {
            $arr = $res->fetch_array( MYSQLI_ASSOC );
            $html_data = $arr['html'];
            $page_type = $arr['type'];
            $page_name = $arr['name'];
            $page_title = $arr['title'];
            $page_handle = get_page_meta($page_id,"page_handle");
            if(get_user_meta($user_id,"wh_file_location") != ""){
                $url = "https://".get_user_meta($user_id,"wh_file_location").'?page='.$page_id.'/'.get_page_meta($page_id,"page_handle");
            }else{
                $url = BASE.'/preview/?page='.$page_id.'/'.get_page_meta($page_id,"page_handle");
            }
?>
            <div class="" style="max-width: 100%;">
                    <div class="row justify-content-center text-center">
                        <div class="title col-12 col-lg-12">
                            <h3 class="">
                                Easily share your idea with your audience.
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-center text-center">
                        <div class="title col-12 col-lg-12">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" class="btn btn-info btn-circle btn-lg btn-social btn-facebook"><i class="fa fa-facebook"></i></a>
                            <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="btn btn-info btn-circle btn-lg btn-social btn-google-plus"><i class="fa fa-google-plus"></i></a>
                          <!-- <a href="<?php echo $url; ?>" target="_blank" class="btn btn-info btn-circle btn-lg btn-social btn-twitter"><i class="fa fa-twitter"></i></a> -->
                        </div>
                    </div>
                <?php
                  if($page_type == 'email'){
                ?>
                    <hr>
                    <?php 
                        $my_email_arr = [];
                        $google_gmail_address = get_user_meta($user_id, 'google_gmail_address');
                        if($google_gmail_address != ""){
                            $my_email_arr[] = $google_gmail_address;
                        }
                        $email_host_user_name = get_user_meta($user_id, 'email_host_user_name');
                        if($email_host_user_name != ""){
                            $my_email_arr[] = $email_host_user_name;
                        }
                        $mailgun_domain = get_user_meta($user_id, 'mailgun_domain');
                        if($mailgun_domain != ""){
                            $my_email_arr[] = $mailgun_domain;
                        }

                        $connected_email_option = '<option value="">Select an email or a service</option>';
                        foreach ($my_email_arr as $key => $value) {
                            $connected_email_option .= '<option value="'.$value.'">'.$value.'</option>';
                        }
                    ?>
                    <div class="row">
                        <div class="media-container-column col-lg-12" data-form-type="formoid">
                            <form class="mbr-form" action="<?php echo BASE; ?>/processor/?process=send_mail_to_a_subscriber_list" method="post" data-form-title="Mobirise Form" onsubmit="return check_send_email_info(this);">
                                <div class="row row-sm-offset">
                                    <div class="col-md-6 multi-horizontal" data-for="name">
                                        <div class="form-group">
                                            <label class="form-control-label mbr-fonts-style display-7" for="name-form1-2w">Select your email or a service</label>
                                            <?php
                                                if(count($my_email_arr) > 0){
                                            ?>
                                                    <select class="form-control" id="selected_email" name="my_email">
                                                          <?php echo $connected_email_option; ?>
                                                    </select>
                                            <?php
                                                }else{
                                            ?>
                                                    <a href="<?php echo BASE; ?>/auth_settings">Please setup your mail</a>
                                            <?php
                                                }
                                            ?>
                                            <div class="error email_error" style="display: none;">Please select your email</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 multi-horizontal" data-for="phone">
                                        <div class="form-group">
                                            <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-2w">Select a subscriber list</label>
                                            <select class="form-control select_group_list" id="selected_group_list" name="group_id">
                      
                                            </select>
                                            <a href="<?php echo BASE; ?>/subscribers">Create new</a>
                                            <div class="error s_list_error" style="display: none;">Please select your subscriber list</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 multi-horizontal" data-for="phone">
                                        <div class="form-group">
                                            <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-2w">Subject of your mail</label>
                                            <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Email subject">
                                            <div class="error subject_error" style="display: none;">Please give a subject</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 multi-horizontal" data-for="phone">
                                        <div class="form-group">
                                            <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-2w">Sending date</label>
                                            <input type="text" class="form-control" id="sending_time" name="sending_time" placeholder="Sending date">
                                            <div class="error date_error" style="display: none;">Please select a date</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
                    
                                <span class="input-group-btn">
                                    <button href="" type="submit" class="btn btn-primary btn-form display-4"><i style="font-size:24px" class="fa">&#xf1d9;</i>SEND EMAIL</button>
                                </span>
                            </form>
                        </div>
                    </div>
                <?php
                  }
                ?>
<?php
        }else{
            echo "No page found!!!";
        }
    }

    function process_send_mail_to_a_subscriber_list(){
        global $mysqli;
        $user_id = $_SESSION['user_id'];
        $page_id = $_REQUEST['page_id'];
        $my_email = $_REQUEST['my_email'];
        $group_id = $_REQUEST['group_id'];
        $sending_time = $_REQUEST['sending_time'];
        $email_subject = $_REQUEST['email_subject'];
        
        $email_subject = $mysqli->real_escape_string($email_subject);
        if($sending_time == ""){
            $last_updated = date("Y-m-d H:i:s");
            $sending_time = $last_updated;
        }else{
            $user_timezone = get_user_meta($user_id, 'user_timezone');
            if ($user_timezone != "") {
                $offset=$user_timezone*(60*60);
                $dateFormat="Y-m-d H:i:s";
                $sending_time = strtotime($sending_time)-$offset;
                $sending_time = gmdate($dateFormat, $sending_time);
            }
        }
        

        $email_method = null;
        $res = $mysqli->query("SELECT id, name, title, html, type FROM pages WHERE id='$page_id' AND user_id = '$user_id' LIMIT 1");
        if( $res->num_rows > 0 ) {
            if($my_email != "" && $group_id != "" && $email_subject != ""){
                $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
                $subscriber_ids = json_decode($group_detais['subscriber_ids']);
                if($subscriber_ids != NULL){
                    $subscriber_ids = json_encode($subscriber_ids);

                    $sql = "INSERT INTO email_queue ( user_id, email, subscriber_arr, subject, sending_time, page_id, info, status ) VALUES ( '$user_id', '$my_email', '$subscriber_ids', '$email_subject', '$sending_time', $page_id ,'$info', 2) ";

                    $res = $mysqli->query($sql);
                }

            }else{
                echo "Choose your email, subscriber list and subject";
                die();
            }
        }else{
            echo "Invalid page id";
            die();
        }
        header("Location: ".BASE."/stats/email");
    }

    function process_total_email_process(){
      global $mysqli;
      $sql = "SELECT id FROM email_stats WHERE status = 1";
      $res = $mysqli->query($sql);
      echo $res->num_rows;
    }
?>
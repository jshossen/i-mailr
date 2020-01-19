<?php
if(logged_in()){
    form_processor();
    include "files/dashboard/phpsection/header.php";

    $group_detais = get_details_from_db_table('subscriber_groups',$_REQUEST['id']);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo json_decode($group_detais['info'])->name; ?>
                    <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#edit_group_name"><i class="fa fa-pencil"></i></button>
                    <a type="button" class="btn btn-danger btn-circle" onclick="delete_this_subscriber_group(<?php echo $_REQUEST['id']; ?>)"><i class="fa fa-times"></i></a>

                    </h1>
                </div>
                <br>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Subscriber list
                        </div>
                        <div class="panel-body">
                            <div id="subscriber_list">
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                                </div>
                            </div>
                            <?php include "files/dashboard/phpsection/add_subscriber_to_group.php" ?>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="edit_group_name">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo BASE; ?>/group/?process=edit_group_name" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Change group name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Group name</label>
                            <input class="form-control" placeholder="Group name" name="group_name" autocomplete="off" value="<?php echo json_decode($group_detais['info'])->name; ?>">
                            <input type="hidden" name="group_id" value="<?php echo $_REQUEST['id']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
          </div>
        </div>

        <!-- /#page-wrapper -->
        <input type="hidden" id="group_id" value="<?php echo $_REQUEST['id']; ?>">
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
    please_go("sign_in");
}

function process_edit_group_name(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $group_name = $mysqli->real_escape_string( $_REQUEST['group_name'] );
    $group_id = $_REQUEST['group_id'];
    
    $res = $mysqli->query("SELECT info FROM subscriber_groups WHERE ( user_id = '$user_id' AND status='1' AND id=$group_id) LIMIT 1");
    if( $res->num_rows > 0 ) {
        $groups_arr = $res->fetch_array( MYSQLI_ASSOC );
        $info = $groups_arr['info'];
        $info = json_decode($info);
        $info->name = $group_name;

        $sql = "UPDATE subscriber_groups SET info = '".json_encode($info)."' WHERE id = '$group_id' AND user_id = '$user_id'";
        $res = $mysqli->query($sql);
    }   
    header("Location: ".BASE."/group/?id=".$group_id); 
}
?>
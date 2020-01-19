<?php
if(logged_in()){
	form_processor();
    include "files/dashboard/phpsection/header.php";
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All subscriber</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<div class="panel panel-info">
                        <div class="panel-heading">
                        Subscriber list
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12" style="padding: 15px;">
                                <button class="btn btn-info pull-right" data-toggle="modal" data-target="#create_groups"><i class="fa fa-plus" aria-hidden="true"></i> Create new subscribers list</button>

                                <?php include "files/dashboard/phpsection/create_groups.php" ?>
                            </div>
                        	<div id="groups_list">
	                        	<div class="text-center">
	                        		<i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
	                        	</div>
	                        </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        Subscribers
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12" style="padding: 15px;">
                                <div class="pull-right">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#create_subscriber"><i class="fa fa-plus" aria-hidden="true"></i> Add new subscriber</button>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#import_subscriber"><i class="fa fa-download" aria-hidden="true"></i> Import new subscribers</button>
                                    <?php include "files/dashboard/phpsection/create_subscriber.php" ?>
                                    <?php include "files/dashboard/phpsection/import_subscriber.php" ?>
                                </div>
                            </div>
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
        <!-- /#page-wrapper -->
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
	please_go("sign_in");
}

function process_import_subscribers() {
    $user_id = $_SESSION['user_id'];
    global $mysqli;
    if ($_FILES[csv][size] > 0) { 
        //get the csv file 
        $file = $_FILES[csv][tmp_name]; 
        $handle = fopen($file,"r"); 
         
        //loop through the csv file and insert into database 
        $i = 0;
        $cus_var=[];
        $total_data = [];
        $wrong_data = [];
        while ($data = fgetcsv($handle,1000,",","'")){ 
            if($data != NULL){
                if ($i == 0){
                    if ($data[0] == "first_name" && $data[1] == "last_name" && $data[2] == "email" && $data[3] == "phone"){
                        $count = count($data);
                        if ($count > 4) {
                            for ($k=4; $k < $count; $k++) { 
                                $cus_var[$k] = $data[$k];
                            }
                        }       
                    }else{
                        echo "Please give 'first_name, last_name, email, phone' properly...";
                        die();
                    }
                }else 
                {
                    if (count($data) >= 4){
                        if (filter_var($data[2], FILTER_VALIDATE_EMAIL)) {
                            
                                $temp['first_name'] = $data[0];
                                $temp['last_name'] = $data[1];
                                $temp['email'] = $data[2];
                                $temp['phone'] = $data[3];
                                if (count($data) > 4) {
                                    for ($j=4; $j < count($data); $j++) { 
                                        $temp[$cus_var[$j]] = $data[$j];
                                    }
                                }
                                $total_data[] = $temp;

                        }else{
                            $wrong_data[] = $data;
                        }
                    }else{
                        $wrong_data[] = $data;
                    }
                }
            }
            $i += 1;
        }

        for ($i=0; $i < count($total_data); $i++){
                $cus_var = [];
                foreach ($total_data[$i] as $key => $value) {
                    if($key == 'first_name' ) { $first_name = $value; }
                    else if($key == 'last_name' ) { $last_name = $value; }
                    else if($key == 'email' ) { $email = $value; }
                    else if($key == 'phone' ) { $phone = $value; }
                    else {
                        $cus_var[$key] = $value;
                    }
                }
            $custom_variable = json_encode($cus_var);

            $sql = "SELECT email FROM subscriber WHERE email = '$email' AND user_id = $user_id LIMIT 1";

            $pres = $mysqli->query($sql);

            if ($pres->num_rows == 0) {
                $sql = "INSERT INTO subscriber ( user_id, first_name , last_name, email, phone, date_of_birth, custom_variable, created, updated, info, status) VALUES ( '$user_id','$first_name','$last_name','$email','$phone','" . date("Y-m-d H:i:s") . "' , '$custom_variable','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '[]' ,'1' ) ";
                $res = $mysqli->query($sql);
                if (!$res) {
                    echo "error";
                }
            }
        }
        header("Location:".BASE."/subscribers");
    }else{
        echo "Invalid format";
    }
}

?>
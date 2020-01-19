<?php
if(logged_in()){
    form_processor();
    include "files/dashboard/phpsection/header.php";

    if($break[$start+1] == "email"){
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Email</h1>
                </div>
                <br>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Email sending details
                        </div>
                        <div class="panel-body">
                            <div id="sending_details">
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
        </div>
<?php
    }else{
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Statistics</h1>
                </div>
                <br>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Dashboard details
                            <div id="reportrange" class="pull-right" style="cursor: pointer;">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>
                        </div>
                        
                        <div class="panel-body">
                            <div id="dashboard_details">
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Devices
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div id="device_details">
                                                <div class="text-center">
                                                    <i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>

                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Countries
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div id="country_details">
                                                <div class="text-center">
                                                    <i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>

                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Browser
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div id="browser_details">
                                                <div class="text-center">
                                                    <i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>

                                
                            </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="" id="start_date">
        <input type="hidden" name="" id="end_date">
<?php
    }
    include "files/dashboard/phpsection/footer.php";
}else{
    please_go("sign_in");
}
function process_load_dashboard_details(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];

    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime(date('Y-m-d')." -1 month"));
    $end_date = $end_date ." 23:59:59";
    $start_date = $start_date. " 00:00:01";

    if (isset($_REQUEST['start_date'])) {
        $start_date = $_REQUEST['start_date'];
    }
    if (isset($_REQUEST['end_date'])) {
        $end_date = $_REQUEST['end_date'];
    }

    $start_date = get_user_timezone_date($user_id, $start_date);
    $end_date = get_user_timezone_date($user_id, $end_date);

    $sql = "SELECT id FROM pages WHERE user_id = '$user_id' AND type = 'page' AND status='1'";
    $res = $mysqli->query($sql);
    $total_page = $res->num_rows;

    $sql = "SELECT id FROM pages WHERE user_id = '$user_id' AND type = 'email' AND status='1'";
    $res = $mysqli->query($sql);
    $total_email = $res->num_rows;

    $sql = "SELECT id FROM pageviews WHERE user_id = '$user_id' AND date BETWEEN '$start_date' AND '$end_date'";
    $res = $mysqli->query($sql);
    $total_page_views = $res->num_rows;

    $sql = "SELECT DISTINCT ip FROM pageviews WHERE user_id = '$user_id' AND date BETWEEN '$start_date' AND '$end_date'";
    $res = $mysqli->query($sql);
    $total_unique_page_views = $res->num_rows;

?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-powerpoint-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_page; ?></div>
                            <div>Total page</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><a href="<?php echo BASE; ?>/dashboard">View Details</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-newspaper-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_email; ?></div>
                            <div>Total email page</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><a href="<?php echo BASE; ?>/dashboard">View Details</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-eye fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_page_views; ?></div>
                            <div>Total page view</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-secret fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_unique_page_views; ?></div>
                            <div>Total unique page view</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php
}
function process_load_device_details(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];

    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime(date('Y-m-d')." -1 month"));
    $end_date = $end_date ." 23:59:59";
    $start_date = $start_date. " 00:00:01";

    if (isset($_REQUEST['start_date'])) {
        $start_date = $_REQUEST['start_date'];
    }
    if (isset($_REQUEST['end_date'])) {
        $end_date = $_REQUEST['end_date'];
    }

    $start_date = get_user_timezone_date($user_id, $start_date);
    $end_date = get_user_timezone_date($user_id, $end_date);

    $sql = "SELECT id, device, country, browser FROM pageviews WHERE user_id = '$user_id' AND date BETWEEN '$start_date' AND '$end_date'";

    $res = $mysqli->query($sql);
    $device_arr = array();
    $country_arr = array();
    $browser_arr = array();

    if( $res->num_rows > 0 ) {
        while( $arr = $res->fetch_array( MYSQLI_ASSOC ) ) {
            $device_arr[$arr['device']] += 1;
            $country_arr[$arr['country']] += 1;
            $browser_arr[$arr['browser']] += 1;
        }
        $result = array();
        $arr = array();
        foreach ($device_arr as $key => $value) {
            if($key=="desktop")$key = 'Desktop';
            if($key=="mobile")$key = 'Mobile';
            $arr['label'] = $key;
            $arr['value'] = $value;
            $result['device'][] = $arr;
        }

        $arr = array();
        foreach ($country_arr as $key => $value) {
            $arr['label'] = $key;
            $arr['value'] = $value;
            $result['country'][] = $arr;
        }

        $arr = array();
        foreach ($browser_arr as $key => $value) {
            $arr['label'] = $key;
            $arr['value'] = $value;
            $result['browser'][] = $arr;
        }
        
    }
    echo json_encode($result);
}

function process_load_email_sending_details(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $count = 1;
?>
    <ul style="list-style-type: none;">
    <?php 
        $sql = "SELECT * FROM email_queue WHERE user_id = $user_id ORDER BY id DESC";
        $res = $mysqli->query($sql);
        if($res->num_rows > 0){
            while( $arr = $res->fetch_array( MYSQLI_ASSOC ) ) {
                $e_q_id = $arr['id'];
                $total_subscriber = count(json_decode($arr['subscriber_arr']));
                $sql = "SELECT * FROM email_stats WHERE user_id = $user_id AND email_queue_id = $e_q_id";
                $total_email_process = $mysqli->query($sql);
                $total_email_process = $total_email_process->num_rows;

                $done = (($total_email_process/$total_subscriber)*100);
                if($arr['status'] == 0 && $done != 100){
                    $progress_type = 'danger';
                }else if($done == 100){
                    $progress_type = 'success';
                }else{
                    $progress_type = 'info';
                }
    ?>
        <li>
            <a href="#" style="text-decoration: none;">
                <div>
                    <p>
                        <h3><strong><?php echo ($count++).". ".$arr['subject']; ?></strong></h3>
                        <span class="pull-right text-muted"><?php echo $total_email_process; ?>/<?php echo $total_subscriber; ?> email sent</span>
                    </p>
                    <p>
                        <span><?php echo $arr['email']; ?></span>
                        <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo get_user_timezone_date($user_id, $arr['sending_time']); ?></span> <i class="fa fa-eye"></i> <a target="_blank" href="<?php echo BASE; ?>/preview/?page=<?php echo $arr['page_id'] ?>">View template</a>
                    </p>
                    <div class="progress progress-striped <?php echo ($arr['status'] == 0) ? "" : "active";?>">
                        <div class="progress-bar progress-bar-<?php echo $progress_type;?>" role="progressbar" style="width: <?php echo $done; ?>%">
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="divider"></li>
    <?php
            }
        }else{
            echo '<li><a href="#" style="text-decoration: none;">No history found!!!</a></li>';
        }
    ?>
    </ul>
<?php
}
if($break[$start+1] != "email"){
?>
<script>
    $(function() {

        var start = moment().subtract(31, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            var data = $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            data = data[0].innerHTML;
            
            data = data.split(" ");
            data[1] = data[1].replace(/,/g, '');
            data[5] = data[5].replace(/,/g, '');
            var months = ["January", "February", "March", "April", "May", "June", "July" , "August", "September", "October", "November", "December"];
            for(var i = 0;i < months.length;i++) {
                if(data[0] == months[i]) {
                    data[0] = i + 1;
                    data[0] = '' + data[0];
                    if (data[0].length == 1) {
                        data[0] = '0'+data[0];
                    }
                }

                if(data[4] == months[i]) {
                    data[4] = i + 1;
                    data[4] = '' + data[4];
                    if (data[4].length == 1) {
                        data[4] = '0'+data[4];
                    }
                }
            }

            //check if day is 2 or 02
            if (data[1].length == 1) {
                data[1] = '0'+data[1];
            }

            if (data[5].length == 1) {
                data[5] = '0'+data[5];
            }

            var start_date = data[2] + "-" + data[0] + "-" + data[1] + " " + "00:00:01";
            var end_date = data[6] + "-" + data[4] + "-" + data[5] + " " + "23:59:59";

            var data = 'start_date='+encodeURIComponent(start_date);
            data += '&end_date='+encodeURIComponent(end_date);
            $('#start_date').val(start_date);
            $('#end_date').val(end_date);
            http_post_request( base + '/stats/?process=load_dashboard_details', data , 'load_dashboard_details_done' );

            // console.log(data);
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
        
    });

</script>
<?php 
    }
?>
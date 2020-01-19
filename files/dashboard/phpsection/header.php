<?php
    $user_info = $_SESSION['user_info'];
    $user_details = json_decode($user_info['user_details']);
    $user_name = $user_details->name;
    $img_url = BASE."/files/images/user.png";
    if(isset($user_details->image)){
        $img_url = $user_details->image;
    }
    $user_status = $user_info['status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <script> var base = '<?php echo BASE; ?>'; </script>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE; ?>/files/images/fab/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE; ?>/files/images/fab/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE; ?>/files/images/fab/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE; ?>/files/images/fab/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE; ?>/files/images/fab/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE; ?>/files/images/fab/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE; ?>/files/images/fab/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE; ?>/files/images/fab/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE; ?>/files/images/fab/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BASE; ?>/files/images/fab/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE; ?>/files/images/fab/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE; ?>/files/images/fab/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE; ?>/files/images/fab/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE; ?>/files/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo BASE; ?>/files/dashboard/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo BASE; ?>/files/dashboard/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo BASE; ?>/files/dashboard/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo BASE; ?>/files/dashboard/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo BASE; ?>/files/dashboard/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/files/dashboard/css/bootstrap-datepicker.css" />

    <link href="<?php echo BASE; ?>/files/dashboard/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>/files/css/style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE; ?>/dashboard">Hi, <?php echo $user_name; ?></a>
            </div>



            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <?php 
                            global $mysqli;
                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM email_queue WHERE user_id = $user_id AND status != 0 ORDER BY id DESC LIMIT 3";
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
                                            <strong><?php echo $arr['subject']; ?></strong>
                                            <span class="pull-right text-muted"><?php echo $total_email_process; ?>/<?php echo $total_subscriber; ?> email sent</span>
                                        </p>
                                        <p>
                                            <span><?php echo $arr['email']; ?></span>
                                            <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo get_user_timezone_date($user_id, $arr['sending_time']); ?></span>
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
                        <li>
                            <a class="text-center" href="<?php echo BASE; ?>/stats/email">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo BASE; ?>/profile_settings"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo BASE; ?>/auth_settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE; ?>/revoke_me/?provider=bulkmail"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>




            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="text-center">
                            <img src="<?php echo $img_url; ?>" class="img-circle" alt="Cinque Terre" width="100" > 
                        </li>
                        <li class="text-center">
                            <a data-toggle="collapse" data-target="#package_div" style="cursor: pointer;">Your package</a>
                            <div id="package_div" class="collapse">
                                <?php
                                    $page = $_SESSION['rule']['page'];
                                    $status = $_SESSION['rule']['status'];
                                    $subscriber = $_SESSION['rule']['subscriber'];

                                    if($status == 0 || $status == 1){
                                        $package ="Free";
                                    }else if($status == 2){
                                        $package ="Pro";
                                    }else if($status == 3){
                                        $package ="Premium";
                                    }
                                ?>
                                Package: <?php echo $package ?><br>
                                Page: <?php echo $page ?><br>
                                Subscriber: <?php echo $subscriber ?><br>
                                Email: Unlimited<br>
                            </div>
                            
                        </li>
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control search" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>/home"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-ul fa-fw"></i> Subscriber<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li style="display: none;">
                                    <a href="<?php echo BASE; ?>/subscriber_list"><i class="fa fa-user fa-fw"></i> Subscriber list</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE; ?>/subscribers"><i class="fa fa-users fa-fw"></i> All subscriber</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo BASE; ?>/auth_settings"><i class="fa fa-plug fa-fw"></i> Auth settings</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE; ?>/profile_settings"><i class="fa fa-user fa-fw"></i> Profile settings</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>/stats"><i class="fa fa-area-chart fa-fw"></i> Stats</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li style="color: red;">
                            <a href="<?php echo BASE; ?>/trash"><i class="fa fa-trash-o fa-fw"></i> Trash</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li style="color: red;">
                            <a href="<?php echo BASE; ?>/revoke_me/?provider=bulkmail"><i class="fa fa-sign-out fa-fw"></i> Log out</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                            if($user_status == 1){
                        ?>
                            <li class="text-center">
                                <a type="button" href="<?php echo BASE ?>/pricing" class="btn btn-primary btn-xs btn-block" style="border-radius: 0px;">Upgrade your plan</a>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
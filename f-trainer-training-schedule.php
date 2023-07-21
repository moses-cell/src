<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-trainer-training-schedule.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Trainer Training Details Form";
    $title = "Training Information";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <link href="assets/css/jquery.confirm.css" rel="stylesheet" />
        
        <script src="assets/js/jmodal-popup.js"></script>
        <script src="assets/js/page/jf-trainer-training-schedule.js"></script>
        <script src="assets/js/plugins/jquery-confirm.js"></script>


    </head>
    <body class="nav-fixed bg-light">
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>
        <!-- Top app bar navigation menu-->
        <main id="main" class="main" >
            <div class="pagetitle" >
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Trainer Section</li>
                        <li class="breadcrumb-item active">Training Schedule</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <nav class="nav mb-2">
                                <a class="nav-link tab-link tab-link-active " id='training_tab' href="#training">Training Information</a>
                                <a class="nav-link tab-link" id='participant_tab' href="#participant">Participant List</a>
                            </nav>
                            <div class="card-body">
                                <div id='training_form'>
                                    <div class="card-title"><?php echo $title; ?></div>
                                    <div class="card-subtitle mb-4">Review and update internal training information below.</div>
                                    <?php include 'sub/trainer-training-schedule/sub-training-information-form.php'; ?>
                                </div>
                                <div id='participant_list' style='display: none;'>
                                    <div class="card-title">Training Participant List</div>
                                    <?php include 'sub/trainer-training-schedule/sub-participant-list.php'; ?>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
            </section>    
        </main>
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

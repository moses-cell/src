<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-training-application.php";
    require_once "library/page/b_f-training-application-unit.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Training Application Form";
    $title = "Training Information";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jf-training-application.js"></script>
        <script src="assets/js/page/jf-training-application-unit.js"></script>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/js/jmodal-popup.js"></script>

        <link href="assets/css/jquery.confirm.css" rel="stylesheet" />
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
                                    <?php include 'sub/training-application/sub-training-application-form.php'; ?>
                                    <div id="loading-overlay">
                                        <div class="loading-icon"></div>
                                    </div>
                                </div>
                                <div id='participant_list' style='display: none;'>
                                    <div class="card-title">Training Participant List</div>
                                    <?php include 'sub/training-schedule/sub-participant-list.php'; ?>
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

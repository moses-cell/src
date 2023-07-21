<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-training-application-details.php";
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
        <link href="assets/css/datatable.css" rel="stylesheet" />
        
        <script src="assets/js/page/jf-training-application-details.js"></script>

        <link href="assets/css/jquery.confirm.css" rel="stylesheet" />
        <script src="assets/js/plugins/jquery-confirm.js"></script>
        <script src="assets/js/jmodal-popup.js"></script>

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
                        <li class="breadcrumb-item active">Training Application</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <?php
                                if ($_SESSION['user_type'] == 'internal') {
                                        include 'sub/training-application-details/sub-internal.php';
                                } else {
                                    include 'sub/training-application-details/sub-external.php';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </section>    
        </main>
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

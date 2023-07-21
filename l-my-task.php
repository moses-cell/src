<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_l-my-task.php";
    
    $pages_name = "My Task";
    $title = "";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>

    </head>
    <body class="nav-fixed bg-light">
         <!-- Top app bar navigation menu-->
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?php echo $pages_name; ?></h1>
                 <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Account</li>
                        <li class="breadcrumb-item active">My Task</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            if ($pending_approval !=  '') {
                                include 'sub/my-task/sub-pending-approval-list.php';
                            }
                            if ($pending_evaluation !=  '') {
                                include 'sub/my-task/sub-pending-evaluation-list.php';
                            }
                            if ($pending_assessment !=  '') {
                                include 'sub/my-task/sub-pending-assessment-list.php';
                            }
                            if ($pending_trainer_assessment !=  '') {
                                include 'sub/my-task/sub-pending-trainer-assessment-list.php';
                            }
                            if ($pending_approval == '' &&  $pending_evaluation == '' && $pending_assessment == '' && $pending_trainer_assessment == '') {
                                echo 'NO PENDING TASK';
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>
        
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>    
    </body>
</html>

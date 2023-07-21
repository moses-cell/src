<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "Pending Trainer Assessment";
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
        <script src="assets/js/page/jl-pending-trainer-assessment.js"></script>

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
                        <li class="breadcrumb-item">HR Report</li>
                        <li class="breadcrumb-item">Trainer Assessment</li>
                        <li class="breadcrumb-item active">Pending Trainer Assessment</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?></h5>
                                <table id="datatable" class="display cell-border display cell-border masterTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="70px">Staff No</th>
                                            <th width="200px">Staff Name</th>
                                            <th width="200px">Training title</th>
                                            <th width="80px">Start Date</th>
                                            <th width="80px">End Date</th>
                                            <th width="200px">Trainer Name</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Trainer Name</th>
                                        </tr>     
                                    </tfoot>
                                </table>
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

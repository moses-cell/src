<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_global_parameter.php";
    
    $pages_name = "Dashboard Reporting";
    $title = "Monthly Training Schedule List (" . date('F Y') . ")";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/js/plugins/moment.min.js"></script>
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/page/jl-dashboard-admin-monthly-training-list.js"></script>


    </head>
    <body class="nav-fixed bg-light">
         <!-- Top app bar navigation menu-->
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">HR Report</li>
                        <li class="breadcrumb-item">Dashboard Reporting</li>
                        <li class="breadcrumb-item active">Yearly Training Schedule</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                                <div class="row mb-4">
                                     <div class="col-md-4 ">
                                        <div class="form-group floating-label">
                                           <select class="form-select " id="trainingcategory" name="trainingcategory">
                                                <?php echo _select_option_training_category(true); ?>
                                            </select>
                                            <label class="mr-sm-2" for="trainingcategory">Training Category</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <button class="btn btn-prasarana" type="button" id='reset'>Reset</button>
                                        <button class="btn btn-prasarana" type="button" id='excel'>Export to Excel</button>
                                        <button class="btn btn-prasarana" type="button" id='hr_dashboard'>Return to HR Dashboard</button>
                                    </div>
                                </div>
                                <table id="datatable" class="display cell-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Module Code</th>
                                            <th>Module Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
                                            <th>Training Category</th>
                                            <th>Maximum Seats</th>
                                            <th>Who Can Apply</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Module Code</th>
                                            <th>Module Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
                                            <th>Training Category</th>
                                            <th>Maximum Seats</th>
                                            <th>Who Can Apply</th>
                                            <th>Status</th>
                                            <th></th>
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

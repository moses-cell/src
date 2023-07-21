<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "Training Module";
    $title = "Training Module List";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/page/jl-depoh-training-module.js"></script>

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
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Training Module List</h5>
                                <table id="datatable" class="display cell-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Module Code</th>
                                            <th>Module Name</th>
                                            <th>Training Category</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
                                            <th>Maximum Seats</th>
                                            <th>Who Can Apply</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Module Code</th>
                                            <th>Module Name</th>
                                            <th>Training Category</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
                                            <th>Maximum Seats</th>
                                            <th>Who Can Apply</th>
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

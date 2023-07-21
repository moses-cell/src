<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "HR - Training Module";
    $title = "Disable Training Module List";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/jmodal-popup.js"></script>
        <script src="assets/js/page/jl-training-module.js"></script>

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
                        <li class="breadcrumb-item">HR Section</li>
                        <li class="breadcrumb-item">Training</li>
                        <li class="breadcrumb-item active">Training Module</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                                <div class="btn-list mb-4">
                                    
                                    <button class="btn btn-prasarana" type="button" id='import'>Upload Training Module</button>
                                    <button class="btn btn-prasarana" type="button" id='new'>New Training Module</button>
                                    <button class="btn btn-prasarana" type="button" id='excel'>Export to Excel</button>
                                </div>
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

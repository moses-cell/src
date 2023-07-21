<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "My Unit Training";
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
        <script src="assets/js/page/jl-my-unit-training.js"></script>

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
                        <li class="breadcrumb-item">Secretary & Admin Section</li>
                        <li class="breadcrumb-item">Training</li>
                        <li class="breadcrumb-item active">Unit Staff Training Status</li>
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
                                            <th></th>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
                                            <th>Status</th>
                                            <th>Bonding</th>
                                            <th>Attendance</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
                                            <th>Status</th>
                                            <th>Bonding</th>
                                            <th>Attendance</th>
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

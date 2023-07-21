<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Active Training";
    $title = "Active Training by Department";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/page/jl-active-training-dept.js"></script>

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
                        <li class="breadcrumb-item">Active Training</li>
                        <li class="breadcrumb-item active">Training List by Department</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?></h5>
                                <div class="page-header mb-4 mt-4">
                                    <div class="row mb-4">
                                        <div class="col-md-4 text-start">
                                            <div class="form-group floating-label">
                                                <select class="form-select " id="department" name="department">
                                                    <?php echo _select_option_department(); ?>
                                                </select>
                                                <label class="mr-sm-2" for="department">Department</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h4></h4>
                                </div>
                                <table id="datatable" class="display cell-border display cell-border masterTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Section</th>
                                            <th>Unit</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
                                            <th>Status</th>
                                            <th>Bonding</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Staff No</th>                                            
                                            <th>Staff Name</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Section</th>
                                            <th>Unit</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
                                            <th>Status</th>
                                            <th>Bonding</th>
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

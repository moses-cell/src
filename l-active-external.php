<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Active Training";
    $title = "Active Training by External Participant";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/page/jl-active-training-external.js"></script>

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
                        <li class="breadcrumb-item active">External Participant Training List</li>
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
                                        <div class="col-md-2 ">
                                            <div class="form-group floating-label">
                                                <input type="text" class="form-control " id="sdate" name="sdate" placeholder="Enter Start Date" onfocus="this.blur();" />
                                                <label for="sdt">Start Date</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2 ">
                                            <div class="form-group floating-label">
                                                <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter End Date" onfocus="this.blur();" />
                                                <label for="edate">End Date</label>
                                            </div>
                                        </div>      
                                        <div class="col-md-4 text-start">
                                            <button class="btn btn-prasarana" type="button" id='reset'>Reset</button>
                                            <button class="btn btn-prasarana" type="button" id='excel'>Export to Excel</button>
                                                
                                        </div>
                                    </div>
                                    <h4></h4>
                                </div>
                                <table id="datatable" class="display cell-border display cell-border masterTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Company Name</th>
                                            <th>Department</th>
                                            <th>Staff Name</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Company Name</th>
                                            <th>Department</th>
                                            <th>Staff Name</th>
                                            <th>Training title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Training Provider</th>
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

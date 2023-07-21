<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "Rejected Secretary/Admin Training Request";
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
        <script src="assets/js/page/jl-training-request.js"></script>

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
                        <li class="breadcrumb-item">Training Request</li>
                        <li class="breadcrumb-item active">Rejected Training Request</li>
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
                                            <th>Training Code</th>
                                            <th>Training title</th>
                                            <th>Training Provider</th>
                                            <th>Training Category</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
                                            <th>Who Can Apply</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Training Code</th>
                                            <th>Training title</th>
                                            <th>Training Provider</th>
                                            <th>Training Category</th>
                                            <th>Total Days</th>
                                            <th>Total Hours</th>
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

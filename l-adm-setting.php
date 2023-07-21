<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "Admin - Setting";
    $title = "PRINTIS Application Setting";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/js/jmodal-popup.js"></script>
        <script src="assets/js/page/jl-setting.js"></script>

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
                        <li class="breadcrumb-item">Admin Section</li>
                        <li class="breadcrumb-item active">Setting</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?></h5>
                                <div class="btn-list mb-4">
                                </div>
                                <table id="datatable" class="display cell-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Setting</th>
                                            <th>Value</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Setting</th>
                                            <th>Value</th>
                                            <th>Description</th>
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

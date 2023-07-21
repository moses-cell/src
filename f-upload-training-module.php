<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-adm-emp-grade.php";
    
    $pages_name = "Upload - Training Module";
    $title = "Training Module";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/modalhead.php" ?> 
        <link href="assets/css/jquery.confirm.css" rel="stylesheet" />
        <script src="assets/js/plugins/jquery-confirm.js"></script>
        <script src="assets/js/page/jf-upload-training-module.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <main id="main-modal" class="main-modal" >
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                    <?php include 'sub/upload/sub-data-upload-form.php'; ?>
                                <div id="loading-overlay">
                                    <div class="loading-icon"></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>    
        </main>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

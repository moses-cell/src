<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-adm-training-location.php";
    
    $pages_name = "Admin -Training Provider";
    $title = "Training Location Form";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/modalhead.php" ?> 
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <link href="assets/css/datatable.css" rel="stylesheet" />

        <script src="assets/js/page/jf-training-location.js"></script>
    <!--    <script src="assets/js/page/jf-training-location.js"></script>!-->
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <main id="main-modal" class="main-modal" >
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title . $training_provider; ?></div>
                                    <?php include 'sub/training-location/sub-training-location-form.php'; ?>
                                <div id="loading-overlay">
                                    <div class="loading-icon"></div>
                                </div>  
                            </div>
                            <div class="card-body">
                                <?php include 'sub/training-location/sub-training-location-list.php'; ?>
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
 
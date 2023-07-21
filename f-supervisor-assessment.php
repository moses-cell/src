<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-evaluation.php";
    
    $pages_name = "Learning & Culture";
    $title = "Post Training Evaluation / Penilaian Selepas Latihan";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jf-super-eval.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>
        <!-- Top app bar navigation menu-->
        <main id="main" class="main" >
            <div class="pagetitle" >
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Supervisor Assessment</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                <div class="card-subtitle mb-4">Review and fill in post training evaluation below.</div>
                                    <form id='dataform' action="" method="post" autocomplete='off' name='dataform'>
                                        <?php include 'sub/evaluation/sub-staff-info-form.php'; ?>
                                        <?php include 'sub/evaluation/sub-super-evaluation-section-1-form.php'; ?>
                                        <?php include 'sub/evaluation/sub-super-evaluation-section-2-form.php'; ?>
                                        <?php include 'sub/evaluation/sub-super-evaluation-section-3-form.php'; ?>
                                        <?php include 'sub/evaluation/sub-super-evaluation-section-4-form.php'; ?>
                                        <?php include 'sub/evaluation/hidden-data.php'; ?>
                                    </form>
                                <div id="loading-overlay">
                                    <div class="loading-icon"></div>
                                </div>  
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

<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_global_parameter.php";
    
    $pages_name = "HR Administration Dashboard";
    $menu = "Dashboard";
    $sub_menu = "Dashboard";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jl-dashboard-admin.js"></script>
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
                        <li class="breadcrumb-item">HR Section</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

          <section class="section dashboard">
            <div class="row">
              <div class="col-lg-8">
                <div class="row">
                    <?php include 'sub/dashboard/sub-training-yearly-schedule.php'; ?>
                    <?php include 'sub/dashboard/sub-monthly-training-schedule.php'; ?>
                    <?php include 'sub/dashboard/sub-yearly-training-registered.php'; ?>
                    <?php include 'sub/dashboard/sub-monthly-training-registered.php'; ?>
                    <?php include 'sub/dashboard/sub-internal-training-registered.php';?>
                    <?php include 'sub/dashboard/sub-external-training-registered.php';?>
                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body pb-0" style="position:relative;">
                                <h5 class="card-title">Training Registered Report <span>| <?php echo get_current_year(); ?></span></h5>
                                <canvas id="TrainingChart" style="max-height: 600px;"></canvas>
                            </div>
                        </div>
                        
                    </div>
                </div>
              </div><!-- End col-lg-8 -->
              <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Incoming Schedule <span> | <?php echo get_current_month_year(); ?> </span></h5>
                        <div class="activity">
                            <div id="incoming_schedule"></div>
                        </div>
                    </div><!-- End Recent Activity -->
                </div>
                
            </div>
          </section>

  </main><!-- End #main -->
        <?php include "pages/page_footer.php" ?>
        <script src="assets/vendor/chart.js/chart.min.js"></script>
        <?php include "pages/html_footer.php" ?>
    </body>
</html>

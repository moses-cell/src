<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Training Schedule";
    $title = "Training Calender";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/calendar.css" rel="stylesheet">
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
                        <li class="breadcrumb-item">Depoh Admin</li>
                        <li class="breadcrumb-item">Training</li>
                        <li class="breadcrumb-item active">Schedule Training Calendar</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Training Schedule Calender</h5>
                                <div class="page-header mb-4">
                                    <div class="row mb-4">
                                        <div class="col-md-4 text-start">
                                            <div class="form-group floating-label">
                                                <select class="form-select " id="trainingcategory" name="trainingcategory">
                                                    <?php echo _select_option_training_category(); ?>
                                                </select>
                                                <label class="mr-sm-2" for="trainingcategory">Training Category</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-end">
                                            <div class="btn-group">
                                                <button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
                                                <button class="btn btn-default" data-calendar-nav="today">Today</button>
                                                <button class="btn btn-primary" data-calendar-nav="next">Next >></button>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                                <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                                <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                                <button class="btn btn-warning" data-calendar-view="day">Day</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <h4></h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <div id="showEventCalendar"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="mb-4">Training List</h5>
                                        <ul id="eventlist" class="list-group"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
        <?php include "pages/page_footer.php" ?>

        <?php include "pages/html_footer.php" ?>    
        <script type="text/javascript" src="assets/js/plugins/js_underscore.js"></script>
        <script type="text/javascript" src="assets/js/plugins/calendar.js"></script>
        <script src="assets/js/page/jl-training-calendar-depoh.js"></script>

    </body>
</html>

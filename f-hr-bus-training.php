<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "HR - Bus Training Form";
    $title = "Technical Bus Training";
    $sub_menu = "HRIT";
    $nav_index = "2";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/training.js"></script>
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
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section id="section">
                <div id="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                    <div class="card-subtitle mb-4">Review and update internal training information below.</div>
                                        <form>
                                            <div class="row mb-4"> <!-- Form Group (training title)-->
                                                <div class="col-md-12">
                                                    <label for="title">Training Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"  placeholder="Enter training title" />
                                                </div>
                                            </div> <!-- Form Group (training title)-->
                                            <div class="row mb-4"> <!-- Form Group (Start / End Date)-->
                                                <div class="col-md-3"> 
                                                    <label for="startdate">Start Date</label>
                                                    <input type="text" class="form-control " id="sdate" name="sdate"  placeholder="Enter training start date" />
                                                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label for="startdate">End Date</label>
                                                    <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter training end date" />
                                                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label for="enddate">Start Time</label>
                                                    <input type="text" class="form-control " id="stime" name="stime"  placeholder="Enter training start time" />
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label for="enddate">End Time</label>
                                                    <input type="text" class="form-control " id="etime" name="etime"  placeholder="Enter training end time" />
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row mb-4">
                                                <!-- Form Group (total days)-->
                                                <div class="col-md-4">
                                                    <label for="tdays">Total Days</label>
                                                    <input type="text" class="form-control " id="tdays" name="tdays"  placeholder="Enter total training days" />
                                                </div>
                                                <!-- Form Group (total hours)-->
                                                <div class="col-md-4">
                                                    <label for="thous">Total Hours</label>
                                                    <input type="text" class="form-control " id="thours" name="tdays"  placeholder="Enter total training hours" />
                                                </div>
                                                <!-- Form Group (total hours)-->
                                                <div class="col-md-4">
                                                    <label for="maxseat">Maximum Seats</label>
                                                    <input type="text" class="form-control " id="maxseat" name="maxseat"  placeholder="Enter maximum seats" />
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <!-- Form Group (total days)-->
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox my-1 ">
                                                        <input type="checkbox" class="custom-control-input" id="traineval">
                                                        <label class="custom-control-label" for="traineval">Training Evaluation</label>
                                                    </div>
                                                </div>
                                                <!-- Form Group (total hours)-->
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox my-1 ">
                                                        <input type="checkbox" class="custom-control-input" id="posttraineval">
                                                        <label class="custom-control-label" for="posttraineval">Trainner Evaluation</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <!-- Save changes button-->
                                            <div class="text-end"><button class="btn btn-primary" type="button">Save changes</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer-->
                <!-- Min-height is set inline to match the height of the drawer footer-->
                <?php include "pages/page_footer.php" ?>
            </section>
        </main>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

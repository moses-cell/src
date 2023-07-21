<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "HR - Training Form";
    $title = "Internal Training";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/training.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>
        <!-- Top app bar navigation menu-->
        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                    <div class="card-subtitle mb-4">Review and update internal training information below.</div>
                                    <form>
                                        <div class="row mb-4"> <!-- Form Group (training title)-->
                                            <div class="col-md-12  floating-label">
                                                <input type="text" class="form-control" id="title" name="title"  placeholder="Enter training title" />
                                                <label for="title">Training Title</label>
                                            </div>
                                        </div> <!-- Form Group (training title)-->
                                        <div class="row mb-4"> <!-- Form Group (Start / End Date)-->
                                            <div class="col-md-3  floating-label"> 
                                                <input type="text" class="form-control " id="sdate" name="sdate"  placeholder="Enter training start date" />            
                                                <label for="sdate">Start Date</label>                                    
                                            </div>
                                            <div class="col-md-3  floating-label"> 
                                                <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter training end date" />           
                                                <label for="startdate">End Date</label>             
                                            </div>
                                            <div class="col-md-3 floating-label"> 
                                                <input type="text" class="form-control " id="stime" name="stime"  placeholder="Enter training start time" />
                                                <label for="stime">Start Time</label>
                                            </div>
                                            <div class="col-md-3 floating-label"> 
                                                <input type="text" class="form-control " id="etime" name="enddate"  placeholder="Enter training end time" />
                                                <label for="enddate">Start Time</label>
                                            </div>
                                        </div>
                                            <!-- Form Row        -->
                                            <div class="row mb-4">
                                                <!-- Form Group (total days)-->
                                                <div class="col-md-6 floating-label">
                                                    <input type="text" class="form-control " id="tdays" name="tdays"  placeholder="Enter total training days" />
                                                    <label for="tdays">Total Days</label>
                                                </div>
                                                <!-- Form Group (total hours)-->
                                                <div class="col-md-6 floating-label"> 
                                                    <input type="text" class="form-control " id="thours" name="thours"  placeholder="Enter total training hours" />
                                                    <label  for="thous">Total Hours</label>
                                                </div>
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row mb-4">
                                                <!-- Form Group (total days)-->
                                                <div class="col-md-4 floating-label">
                                                  
                                                    <select class="form-select " id="trainingcategory" name="trainingcategory">
                                                        <option selected>Please select</option>
                                                        <option value="1">Soft Skills</option>
                                                        <option value="2">Functional Training</option>
                                                    </select>
                                                    <label class="mr-sm-2" for="trainingcategory">Training Category</label>
                                                </div>
                                                <div class="col-md-4 floating-label">
                                                   
                                                    <select class="form-select " id="whocanapply" name="whocanapply">
                                                        <option selected>Please select</option>
                                                        <option value="1">Top Management</option>
                                                        <option value="2">Middle Management</option>
                                                        <option value="2">Executive</option>
                                                        <option value="2">Non Executive</option>
                                                    </select>
                                                    <label class="mr-sm-2" for="whocanapply">Who Can Apply</label>
                                                </div>
                                                <!-- Form Group (total hours)-->
                                                <div class="col-md-4 floating-label">
                                                    <input type="text" class="form-control " id="maxseat" name="maxseat"  placeholder="Enter maximum seats" />
                                                    <label for="maxseat">Maximum Seats</label>
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
                                                        <label class="custom-control-label" for="posttraineval">Post Training Evaluation</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox my-1 ">
                                                        <input type="checkbox" class="custom-control-input" id="supertraineval">
                                                        <label class="custom-control-label" for="supertraineval">Superior Training Evaluation</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12 ">
                                                    <div class="form-group floating-label">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder=" "></textarea>
                                                    <label for="remarks">Remarks</label>
                                                </div>
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
            </section>
            
        </main>
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

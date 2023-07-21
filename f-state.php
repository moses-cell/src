<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_state.php";
    
    $pages_name = "Parameter - State Form";
    $title = "State";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jstate.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <?php include "pages/top_nav.php" ?>
        <!-- Layout wrapper-->
        <div id="layoutDrawer">
            <!-- Layout navigation-->
            <div id="layoutDrawer_nav">
                <!-- Drawer navigation-->
                <nav class="drawer accordion drawer-light bg-white " id="drawerAccordion">
                    <!-- User Login        -->
                    <?php include "pages/user_info.php" ?>
                    <!-- Menu        -->
                   <?php include "pages/left_menu.php" ?>

                </nav>
            </div>
            <!-- Layout content-->
            <div id="layoutDrawer_content">
                <!-- Main page content-->
                <main>
                    <!-- Page header-->
                    <header class="bg-dark">
                        <div class="container-xl px-5"><h1 class="text-white py-3 mb-0 display-6"><?php echo $pages_name; ?></h1></div>
                    </header>
                    <!-- Account profile page content-->
                    <div class="container-xl p-5">
                        <!-- Tab bar navigation-->
                        <?php include "sub/parameter/top_nav_state.php"; ?>
                        <!-- Divider-->
                        <hr class="mt-0 mb-5" />
                        <!-- Profile content row-->
                        <div class="row gx-5">
                            <div class="col-xl-12">
                                <!-- Account details card-->
                                <div class="card card-raised mb-5">
                                    <div class="card-body p-5">
                                        <div class="card-title"><?php echo $title; ?></div>
                                        <div class="card-subtitle mb-4">Review and update state below.</div>
                                        <form id="fcountry" name="fcountry" action="" method="post" autocomplete='off'>
                                            <div class="row mb-4"> <!-- Form Group (training title)-->
                                                <div class="col-md-3">
                                                    <label for="title">Country</label>
                                                    <select class="custom-select " id="country" name="country">
                                                        <option value=''>Please select</option>
                                                        <?php echo $sCountry; ?>
                                                    </select>
                                                </div>
                                            </div> <!-- Form Group (training title)-->
                                            <div class="row mb-4"> <!-- Form Group (training title)-->
                                                <div class="col-md-3">
                                                    <label for="title">State Code</label>
                                                    <input type="text" class="form-control" id="statecode" name="statecode"  placeholder="enter state code" <?php echo $readonly; ?>/>
                                                </div>
                                            </div> <!-- Form Group (training title)-->
                                            <div class="row mb-4"> <!-- Form Group (Start / End Date)-->
                                                <div class="col-md-8"> 
                                                    <label for="startdate">State</label>
                                                    <input type="text" class="form-control " id="state" name="state"  placeholder="enter state name" />      
                                                </div>
                                            </div>
                                        
                                            <!-- Save changes button-->
                                            <div class="text-end">
                                                    <button class="btn btn-primary" type="button" id="save">Save changes</button>
                                                    <button class="btn btn-primary" type="button" id="reset">Reset Form</button>
                                                    <button class="btn btn-primary" type="button" id="new">New State Form</button>
                                            </div>
                                            <?php include "sub/share_field.php" ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Footer-->
                <!-- Min-height is set inline to match the height of the drawer footer-->
                <?php include "pages/page_footer.php" ?>
            </div>
        </div>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>

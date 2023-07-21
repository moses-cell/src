<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_country.php";
    
    $pages_name = "Parameter - Country Form";
    $title = "Country";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jcountry.js"></script>
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
                        <?php include "sub/parameter/top_nav_country.php"; ?>
                        <!-- Divider-->
                        <hr class="mt-0 mb-5" />
                        <!-- Profile content row-->
                        <div class="row gx-5">
                            <div class="col-xl-12">
                                <!-- Account details card-->
                                <div class="card card-raised mb-5">
                                    <div class="card-body p-5">
                                        <div class="card-title"><?php echo $title; ?></div>
                                        <div class="card-subtitle mb-4">Review and update country below.</div>
                                        <form id="fcountry" name="fcountry" action="" method="post" autocomplete='off'>
                                            <div class="row mb-4"> <!-- Form Group (training title)-->
                                                <div class="col-md-3">
                                                    <label for="title">Country Code</label>
                                                    <input type="text" class="form-control" id="countrycode" name="countrycode"  placeholder="enter country code" <?php echo $readonly; ?>/>
                                                </div>
                                            </div> <!-- Form Group (training title)-->
                                            <div class="row mb-4"> <!-- Form Group (Start / End Date)-->
                                                <div class="col-md-8"> 
                                                    <label for="startdate">Country</label>
                                                    <input type="text" class="form-control " id="country" name="country"  placeholder="enter country name" />      
                                                </div>
                                            </div>
                                        
                                            <!-- Save changes button-->
                                            <div class="text-end">
                                                    <button class="btn btn-primary" type="button" id="save">Save changes</button>
                                                    <button class="btn btn-primary" type="button" id="reset">Reset Form</button>
                                                    <button class="btn btn-primary" type="button" id="new">New Country Form</button>
                                            </div>
                                            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['id'];?>">
                                            <input type="hidden" name="id" id="id" value="<?php echo $doc_id; ?>">
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

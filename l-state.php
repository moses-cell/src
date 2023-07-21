<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_state.php";
    
    $pages_name = "Parameter - State List";
    $title = "State List";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/js/plugins/datatable.min.js"></script>
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
                                        <table id="datatable" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <td>Country Code</td>
                                                    <td>Country</td>
                                                    <td>State Code</td>
                                                    <td>State</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td>Country Code</td>
                                                    <td>Country</td>
                                                    <td>State Code</td>
                                                    <td>State</td>
                                                    <td>Action</td>
                                                </tr>
                                            </tfoot>

                                        </table>
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

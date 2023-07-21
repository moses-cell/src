<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-adm-emp-roles.php";
    require_once 'library/page/b_global_parameter.php';


    $roles = "Admin, HR Admin";
    $authorize = check_user_access ($roles);
    $pages_name = "Admin -Employee Roless";
    $title = "Employee System Roles Form";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/modalhead.php" ?> 
        <script src="assets/js/page/jf-emp-roles.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <main id="main-modal" class="main-modal" >
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title mb-4"><?php echo $title; ?></div>
                                    <?php 
                                        if ($authorize)
                                            include 'sub/emp-roles/sub-emp-roles-form.php'; 
                                        else 
                                            include 'sub/not-authorize.php'
                                    ?>
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

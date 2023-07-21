<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $pages_name = "";
    $menu = "Dashboard";
    $sub_menu = "Dashboard";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
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

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
              <div class="row justify-content-center">
        <div class="login-wrap col-md-12 col-lg-12">
          <div class="p-4 p-md-5">
            <div class="icon d-flex align-items-center justify-content-center" style="width: 250px; background: #fff">
            </div>        
              <div class="p-4 p-md-5" style="text-align: center; font-weight: bolder;">ERROR - YOU ARE NOT AUTHORIZED TO ACCESS THIS SECTION</div>
          </div>
        </div>
      </div>
          </div>

        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>
    </body>
</html>

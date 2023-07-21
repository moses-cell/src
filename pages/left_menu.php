<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <?php
            if (isset($_SESSION['user_type'])) {
                if ($_SESSION['user_type'] == 'internal')
                    echo '<li class="nav-item">
                        <a class="nav-link dashboard" href="dashboard.php">
                            <i class="bi bi-grid" style="color: darkorange;"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>';
            }
        ?><!-- End Dashboard Nav -->
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-fill" style="color: #6495ED;"></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="account-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-menu " href="l-my-task.php">
                        <i class="bi bi-circle"></i><span>My Task</span>
                    </a>
                </li>
                <li>
                    <a class="nav-menu" href="l-c-my-training.php">
                        <i class="bi bi-circle"></i><span>My Training</span>
                    </a>
                </li>
            </ul>
        </li>    

        <?php
            if (isset($_SESSION['user_type'])) {
                if ($_SESSION['user_type'] == 'internal')
                    require_once 'left_staff_menu.php';
            }
        ?>
        
        <?php
            if (isset($_SESSION['trainer'])) {
                if ($_SESSION['trainer'] == 'y')
                    require_once 'left_trainer_menu.php';
            }
        ?>
        <?php
            if (isset($_SESSION['Unit Secretary'])) {
                if ($_SESSION['Unit Secretary'] == 'Yes')
                    require_once 'left_sec_menu.php';
            }
        ?>
        <?php
            if (isset($_SESSION['Rail Depoh Admin'])) {
                if ($_SESSION['Rail Depoh Admin'] == 'Yes')
                    require_once 'left_depoh_admin_menu.php';
            }
        ?>
        <?php
            if (isset($_SESSION['Bus Depoh Admin'])) {
                if ($_SESSION['Bus Depoh Admin'] == 'Yes')
                    require_once 'left_depoh_admin_menu.php';
            }
        ?>
        <?php
            if (isset($_SESSION['Rail Depoh Admin'])) {
                if ($_SESSION['Rail Depoh Admin'] == 'Yes')
                    require_once 'left_depoh_admin_menu.php';
            }
        ?>
        <?php
            if (isset($_SESSION['HR Admin'])) {
                if ($_SESSION['HR Admin'] == 'Yes')
                    require_once 'left_hr_menu.php';
            }
        ?>

        <?php
            if (isset($_SESSION['HR Admin'])) {
                if ($_SESSION['HR Admin'] == 'Yes')
                    require_once 'left_hr_menu.php';
            }
        ?>

        <?php
            if (isset($_SESSION['Admin'])) {
                if ($_SESSION['Admin'] == 'Yes')
                    require_once 'left_admin_menu.php';
            } 
            
            if (isset($_SESSION['HR Admin'])) {
                if ($_SESSION['HR Admin'] == 'Yes')
                    require_once 'left_admin_menu.php';
            }
        ?>


        <div class="menu-divider "></div>
      </ul>
    </aside><!-- End Sidebar-->
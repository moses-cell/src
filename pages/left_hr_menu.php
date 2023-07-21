        <div class="menu-divider "></div>
        <div class="menu-heading" id="HRSection"><span>HR Section</span><i id="HRSectionIcon" class="bi bi-chevron-down ms-auto"></i></div>

        <div id="HRSectionGroup">
            <li class="nav-item">
                <ul id="HRSectionGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu nav-sub-menu" href="dashboard-admin.php">
                            <i class="bi bi-person-rolodex" style="color:brown;"></i><span>HR Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu nav-sub-menu" href="l-hr-staff-profile.php">
                            <i class="bi bi-people-fill" style="color:red"></i><span>Staff Profile</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#HRTrainingModule-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-workspace" style="color:#FFBF00;"></i><span>Training Module</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="HRTrainingModule-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-hr-training-module.php">
                            <i class="bi bi-circle"></i><span>Training Module</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-module-enable.php">
                            <i class="bi bi-circle"></i><span>Enable Training Module</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-module-disable.php">
                            <i class="bi bi-circle"></i><span>Disable Training Module</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#HRTraining-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-workspace" style="color:#FFBF00;"></i><span>Training Schedule</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="HRTraining-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <!--<li>
                        <a class="nav-menu" href="f-hr-training-module.php">
                            <i class="bi bi-circle"></i><span>New Training Module</span>
                        </a>
                    </li> !-->
                    
                    <li>
                        <a class="nav-menu" href="l-hr-training-calendar.php">
                            <i class="bi bi-circle"></i><span>Training Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training.php">
                            <i class="bi bi-circle"></i><span>Active Training Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-completed.php">
                            <i class="bi bi-circle"></i><span>Completed Training Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-cancel.php">
                            <i class="bi bi-circle"></i><span>Cancelled Training Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-disable.php">
                            <i class="bi bi-circle"></i><span>Disable Training List</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#HRStaffTrainingRequest-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-cpu-fill" style="color:#97A2FF;"></i><span>Staff Training Request</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="HRStaffTrainingRequest-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-hr-external-training.php">
                            <i class="bi bi-circle"></i><span>New External Training</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-bonding.php">
                            <i class="bi bi-circle"></i><span>Staff Bonding</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#HRTrainingRequest-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bookmarks-fill" style="color:blue;"></i><span>Secretary/Admin Training Request</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="HRTrainingRequest-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <!--<li>
                        <a class="nav-menu" href="f-hr-training-module.php">
                            <i class="bi bi-circle"></i><span>New Training Module</span>
                        </a>
                    </li> !-->
                    <li>
                        <a class="nav-menu" href="l-hr-training-request.php">
                            <i class="bi bi-circle"></i><span>New Request</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-request-in-progress.php">
                            <i class="bi bi-circle"></i><span>In Progress</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-request-complete.php">
                            <i class="bi bi-circle"></i><span>Completed</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-training-request-reject.php">
                            <i class="bi bi-circle"></i><span>Rejected</span>
                        </a>
                    </li>
                </ul>
                

                <a class="nav-link collapsed" data-bs-target="#HRTrainer-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-fill" style="color:darkgreen;"></i><span>Trainer</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="HRTrainer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <!--<li>
                        <a class="nav-menu" href="f-hr-training-module.php">
                            <i class="bi bi-circle"></i><span>New Training Module</span>
                        </a>
                    </li> !-->
                    <li>
                        <a class="nav-menu" href="f-hr-trainer-profile.php">
                            <i class="bi bi-circle"></i><span>New Trainer Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-hr-trainer-profile.php">
                            <i class="bi bi-circle"></i><span>Trainer List</span>
                        </a>
                    </li>
                </ul>
            </li>    
        </div>
        <div class="menu-divider "></div>
        <div class="menu-heading" id="HRReportSection"><span>HR Report</span><i id="HRReportIcon" class="bi bi-chevron-down ms-auto"></i></div>

        <div id="HRReportSectionGroup">
            <li class="nav-item">
                <ul id="HRReportSectionGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu nav-sub-menu" href="training-analysis.php">
                            <i class="bi bi-person-rolodex" style="color:brown;"></i><span>TNA Report</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#DashboardReportGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-briefcase" style="color:blue"></i><span>Dashboard Reporting</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="DashboardReportGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-db-rpt-year-schedule.php">
                            <i class="bi bi-circle"></i><span>Current Year Training Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-db-rpt-month-schedule.php">
                            <i class="bi bi-circle"></i><span>Current Month Training Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-db-rpt-year-participant.php">
                            <i class="bi bi-circle"></i><span>Current Year Participant List</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-db-rpt-month-participant.php">
                            <i class="bi bi-circle"></i><span>Current Month Participant List</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-db-rpt-internal-participant.php">
                            <i class="bi bi-circle"></i><span>Current Month Internal Training Participant Registration</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-db-rpt-external-participant.php">
                            <i class="bi bi-circle"></i><span>Current Month External Training Participant Registration</span>
                        </a>
                    </li>
                </ul>


                <a class="nav-link collapsed" data-bs-target="#StaffActiveTrainingGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-briefcase-fill" style="color:blue"></i><span>Active Training</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="StaffActiveTrainingGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-active-dept.php">
                            <i class="bi bi-circle"></i><span>By Department</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-active-name.php">
                            <i class="bi bi-circle"></i><span>By Name</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-active-external.php">
                            <i class="bi bi-circle"></i><span>External Participant</span>
                        </a>
                    </li>
                </ul>

                <a class="nav-link collapsed" data-bs-target="#StaffInActiveTrainingGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-briefcase" style="color:indigo;"></i><span>In-Active Training</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="StaffInActiveTrainingGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-inactive-completed.php">
                            <i class="bi bi-circle"></i><span>Completed</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-inactive-cancel.php">
                            <i class="bi bi-circle"></i><span>Cancel</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-inactive-reject.php">
                            <i class="bi bi-circle"></i><span>Reject</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-inactive-external.php">
                            <i class="bi bi-circle"></i><span>External Participant</span>
                        </a>
                    </li>
                </ul>

                <a class="nav-link collapsed" data-bs-target="#StaffEvalGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-lines-fill" style="color:maroon;"></i><span>Staff Evaluation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="StaffEvalGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-pending-evaluation.php">
                            <i class="bi bi-circle"></i><span>Pending Evaluation</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-menu" href="l-completed-evaluation.php">
                            <i class="bi bi-circle"></i><span>Completed Evaluation</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#SuperEvalGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people-fill" style="color:green;"></i><span>Supervisor Evaluation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="SuperEvalGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-pending-supervisor-assessment.php">
                            <i class="bi bi-circle"></i><span>Pending Assessment</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-completed-supervisor-assessment.php">
                            <i class="bi bi-circle"></i><span>Completed Assessment</span>
                        </a>
                    </li>
                </ul>
                <a class="nav-link collapsed" data-bs-target="#TrainealEvalGroup-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-video" style="color:orangered;"></i><span>Trainer Evaluation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="TrainealEvalGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu" href="l-pending-trainer-assessment.php">
                            <i class="bi bi-circle"></i><span>Pending Assessment</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu" href="l-completed-trainer-assessment.php">
                            <i class="bi bi-circle"></i><span>Completed Assessment</span>
                        </a>
                    </li>
                </ul>  
            </li> 
        </div>
        <div class="menu-divider "></div>
        <div class="menu-heading" id="InternSection"><span>Internship Section</span><i id="InternSectionIcon" class="bi bi-chevron-down ms-auto"></i></div>
        <div id="InternSectionGroup">
            <li class="nav-item">
                <ul id="InternSectionGroup-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-menu nav-sub-menu" href="f-hr-intern-profile.php">
                            <i class="bi bi-person-plus-fill text-primary" ></i><span>New Internship Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu nav-sub-menu" href="l-hr-intern-profile.php">
                            <i class="bi bi-people-fill" style="color:red"></i><span>Internship Profile List</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-menu nav-sub-menu" href="l-hr-intern-allowance.php">
                            <i class="bi bi-coin" style="color:seagreen;"></i><span>Internship Allowance</span>
                        </a>
                    </li>
                </ul>
            </li>    
        </div>
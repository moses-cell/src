<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <select class="form-select " id="month" name="month">
                    <?php echo _select_option_month(); ?>
                </select>
                <label for="ic_no">Month</label>
            </div>
        </div>
        <div class="col-md-3  floating-label">
            <div class="form-group floating-label">
                <select class="form-select " id="year" name="year">
                    <?php echo _select_option_year(); ?>
                </select>
                <label for="ic_no">Year</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-8  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control name_select" id="student_name" name="student_name"  placeholder="Enter Student Name" />
                <label for="student_name">Student Name</label>
                
                <div class="input-group-append">
                    <button class="btn btn-outline-prasarana" type="button" id="verify">Get Student Details</button>
                </div>
                <div class='intern_list' id='intern_list' style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="ic_no" name="ic_no"  placeholder="Enter IC No" readonly />
                <label for="ic_no">IC No</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Employee Email" readonly  />
                <label for="staff_name">Personal Email Address</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="sdate" name="sdate"  placeholder="Enter Internship Start Date" readonly  />
                <label for="staff_name">Internship Start Date</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="edate" name="edate"  placeholder="Enter Internship End Date"  readonly />
                <label for="staff_name">Internship End Date</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->

    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="department" name="department"  placeholder="Enter Department" readonly />
                <label for="department">Department</label>
            </div>
        </div>
         <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="bank_name" name="bank_name"  placeholder="Enter Staff Bank Name" readonly />
                <label for="staff_position">Bank Name</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="acc_no" name="acc_no"  placeholder="Enter Bank Account No" readonly />
                <label for="personnel_area">Bank Account No</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    
    <!-- Form Row        -->
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_decimal" id="monthly_allowance" name="monthly_allowance"  placeholder="Enter Monthly Allowance" readonly />
                <label for="division">Monthly Allowance</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_numeric" id="mc" name="mc"  placeholder="Enter Medical Leave Allowance" readonly />
                <label for="personnel_area">Medical Leave Allowance</label>
            </div>
        </div>      
    </div>
    

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Internship Attendance & Allowance Details</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_decimal" id="mc_leave_taken" name="mc_leave_taken"  placeholder="Enter Medical Leave Taken" />
                        <label for="student_name">Medical Leave</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_decimal" id="total_leave_taken" name="total_leave_taken"  placeholder="Enter Paid Leave Taken" />
                        <label for="student_name">Paid Leave Taken</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_decimal" id="unpaid_leave_taken" name="unpaid_leave_taken"  placeholder="Enter Total Leave Taken" />
                        <label for="student_name">Unpaid Leave Taken</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control" id="total_mc_leave" name="total_mc_leave" readonly />
                        <label for="student_name">Previous Medical Leave Taken</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control" id="total_unpaid_leave" name="total_unpaid_leave"  placeholder="Enter Calendar Working Day" readonly />
                        <label for="student_name">Total Unpaid MC / Leave Taken</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_decimal" id="working_day" name="working_day"  placeholder="Enter Calendar Working Day" />
                        <label for="student_name">Calendar Working Day</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_decimal" id="daily_allowance" name="daily_allowance"  placeholder="Enter Daily Allowance" />
                        <label for="student_name">Daily Allowance</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control leave_calculate allow_numeric" id="add_deduction" name="add_deduction"  placeholder="Enter Additional  Working Days Deduction" />
                        <label for="student_name">Late Entrance / Early Release</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control" id="actual_work_day" name="actual_work_day"  placeholder="Enter Actual Calendar Working Day" readonly />
                        <label for="student_name">Total Actual Working Day</label>
                    </div>
                </div>
                
            </div>
            <div class="row mb-4">
                <div class="col-md-8 float-end"></div>
                <div class="col-md-4 float-end">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control " id="allowance_paid" name="allowance_paid"  placeholder="Enter Total Allowance" readonly />
                        <label for="student_name">Total Allowance Paid</label>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
        

    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='intern_id' name='intern_id' value='' />
    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
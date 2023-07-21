<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-2  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="ic_no" name="ic_no"  placeholder="Enter IC No"  />
                <label for="ic_no">IC No</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="student_name" name="student_name"  placeholder="Enter Student Name" />
                <label for="student_name">Student Name</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                 <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Employee Email"  />
                <label for="staff_name">Personal Email Address</label>
            </div>
        </div>
        <div class="col-md-2  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="contact_no" name="contact_no"  placeholder="Enter Student Name" />
                <label for="student_name">Contact No</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-6  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="qualification" name="qualification"  placeholder="Enter Intern Qualification"  />
                <label for="staff_name">Qualification</label>
            </div>
        </div>
        <div class="col-md-3  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="sdate" name="sdate"  placeholder="Enter Internship Start Date" onfocus="this.blur();" />
                <label for="staff_name">Internship Start Date</label>
            </div>
        </div>
        <div class="col-md-3  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="edate" name="edate"  placeholder="Enter Internship End Date" onfocus="this.blur();" />
                <label for="staff_name">Internship End Date</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->

    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="division" name="division"  placeholder="Enter Division" />
                <label for="department">Division</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="department" name="department"  placeholder="Enter Department" />
                <label for="department">Department</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="section" name="section"  placeholder="Enter Section" />
                <label for="department">Section</label>
            </div>
        </div>
    </div>
    <div class="row mb-4"> <!-- Form Group (training title)-->
         <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="bank_name" name="bank_name"  placeholder="Enter Staff Bank Name" />
                <label for="staff_position">Bank Name</label>
            </div>
        </div>
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="acc_no" name="acc_no"  placeholder="Enter Bank Account No" />
                <label for="personnel_area">Bank Account No</label>
            </div>
        </div>
  
        <div class="col-md-2  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_decimal" id="monthly_allowance" name="monthly_allowance"  placeholder="Enter Monthly Allowance" />
                <label for="division">Monthly Allowance</label>
            </div>
        </div>
        <div class="col-md-2  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_numeric" id="mc" name="mc"  placeholder="Enter Medical Leave Allowance" />
                <label for="personnel_area">Medical Leave</label>
            </div>
        </div>      
    </div>
    
    
    
        

    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
<form id='applicant_dataform' action="" method="post" autocomplete='off' name='applicant_dataform'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="staff_no" name="staff_no"  placeholder="Enter Staff No" readonly />
            <label for="coursecode">Employee No</label>
        </div>
        <div class="col-md-9  floating-label">
            <input type="text" class="form-control" id="staff_name" name="staff_name"  placeholder="Enter Employee Name" readonly/>
            <label for="staff_name">Employee Name</label>
        </div>
    </div> <!-- Form Group (training title)-->
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Employee Email"  readonly/>
            <label for="staff_name">Employee Email Address</label>
        </div>
        
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="staff_position" name="staff_position"  placeholder="Enter Staff Position" readonly/>
            <label for="staff_position">Staff Position</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="personal_area" name="personal_area"  placeholder="Enter Personnel Area" readonly/>
            <label for="personnel_area">Personnel Area</label>
        </div>
       
    </div> <!-- Form Group (training title)-->
    
    <!-- Form Row        -->
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="division" name="division"  placeholder="Enter Division" readonly/>
            <label for="division">Division</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="department" name="department"  placeholder="Enter Department" readonly/>
            <label for="personnel_area">Department</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="unit" name="unit"  placeholder="Enter Unit" readonly/>
            <label for="unit">Unit</label>
        </div>        
    </div>
    
    <!-- Form Row-->
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="subarea" name="subarea"  placeholder="Enter Employee Sub Area" readonly/>
            <label for="coursecode">Employee Sub Area</label>
        </div>
         <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="group" name="group"  placeholder="Enter Group" readonly/>
            <label for="group">Employee Group</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="subgroup" name="subgroup"  placeholder="Enter Employee Sub Group" readonly/>
            <label for="subgroup">Employee Sub Group</label>
        </div>
        
    </div>

    <!-- Form Row-->
    <div class="row mb-4">
        <div class="col-md-2  floating-label">
            <input type="text" class="form-control" id="appr_no" name="appr_no"  placeholder="Enter Approver No" readonly/>
            <label for="coursecode">Approver Staff No</label>
        </div>
        <div class="col-md-5  floating-label">
            <input type="text" class="form-control" id="appr_name" name="appr_name"  placeholder="Enter Approver Name" readonly/>
            <label for="coursecode">Approver Name</label>
        </div>
        <div class="col-md-5  floating-label">
            <input type="text" class="form-control" id="appr_email" name="appr_email"  placeholder="Enter Approver Email" readonly/>
            <label for="subgroup">Approver Email</label>
        </div>
    </div>
    <?php include 'sub/training-application-details/sub-hidden-data.php'; ?>
    
</form>
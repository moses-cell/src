    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="coursecode" name="coursecode"  placeholder="Enter Course Code" readonly />
            <label for="coursecode">Course Code</label>
        </div>
        <div class="col-md-9  floating-label">
            <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Course Name" readonly/>
            <label for="title">Course Name</label>
        </div>
    </div> <!-- Form Group (training title)-->
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3  floating-label">
            <div class="input-group floating-label">
                <div class="input-group-prepand floating-label w-50">
                    <input type="text" class="form-control " id="sdate" name="sdate"  placeholder="Training Start Date" readonly />
                    <label for="coursecode">Start Date</label>
                </div>
                <div class="input-group-append floating-label w-50">
                    <input type="text" class="form-control " id="edate" name="edate"  placeholder="Training End Date" readonly />
                    <label for="coursecode" >End Date</label>
                </div>
            </div>
        </div>
        <div class="col-md-2  floating-label">
            <input type="text" class="form-control" id="eval_date" name="eval_date"  placeholder="Enter Date" value="<?php echo Date('d-m-Y'); ?>" readonly/>
            <label for="title">Assessment Date</label>
        </div>
        <div class="col-md-7  floating-label">
            <input type="text" class="form-control" id="trainer_name" name="trainer_name"  placeholder="Enter Trainer/Facilitator Name"  readonly/>
            <label for="trainer_name">Trainer/Facilitator Name</label>
        </div>
    </div> <!-- Form Group (training title)-->
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
            <input type="text" class="form-control" id="section" name="section"  placeholder="Enter Section" readonly/>
            <label for="personnel_area">Section</label>
        </div>
    </div>

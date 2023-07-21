<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-2  floating-label">
            <input type="text" class="form-control" id="staff_no" name="staff_no"  placeholder="Enter Staff No" readonly />
            <label for="coursecode">Employee No</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="staff_name" name="staff_name"  placeholder="Enter Employee Name" readonly/>
            <label for="staff_name">Employee Name</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="ic" name="ic"  placeholder="Enter IC No" />
            <label for="staff_name">IC No</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="tel" name="tel"  placeholder="Enter Telephone No" />
            <label for="staff_name">Telephone No</label>
        </div>
    </div> <!-- Form Group (training title)-->
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Employee Email"  readonly/>
            <label for="staff_name">Employee Email Address</label>
        </div>
        <div class="col-md-4 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="email2" name="email2"  placeholder="Enter Alternate Email Address" />
                <label for="staff_name">Alternate Email Address</label>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group floating-label">
                <select class="form-select " id="meal" name="meal">
                    <?php echo _select_option_food_preferences(); ?>
                </select>
                <label for="staff_name">Food Preferences</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->

    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="grade" name="grade"  placeholder="Enter Staff Grade" readonly/>
            <label for="grade">Staff Grade</label>
        </div>
         <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="staff_position" name="staff_position"  placeholder="Enter Staff Position" readonly/>
            <label for="staff_position">Staff Position</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="personal_area" name="personal_area"  placeholder="Enter Personnel Area" readonly/>
            <label for="personnel_area">Personnel Area</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="group" name="group"  placeholder="Enter Group" readonly/>
            <label for="group">Group</label>
        </div>
    </div> <!-- Form Group (training title)-->
    
    <!-- Form Row        -->
    <div class="row mb-4">
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="division" name="division"  placeholder="Enter Division" readonly/>
            <label for="division">Division</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="department" name="department"  placeholder="Enter Department" readonly/>
            <label for="personnel_area">Department</label>
        </div>
        <div class="col-md-3  floating-label">
            <input type="text" class="form-control" id="section" name="section"  placeholder="Enter Section" readonly/>
            <label for="unit">Section</label>
        </div>   
        <div class="col-md-3  floating-label">
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
            <input type="text" class="form-control" id="subgroup" name="subgroup"  placeholder="Enter Employee Sub Group" readonly/>
            <label for="subgroup">Employee Sub Group</label>
        </div>
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="status" name="status"  placeholder="Enter Employee Status" readonly/>
            <label for="unit">Employee Status</label>
        </div>
    </div>

    <!-- Form Row-->
    <div class="row mb-4">
        <div class="col-md-5  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control name_select" id="appr_name" name="appr_name"  placeholder="Enter Approver Name" />
                <label for="coursecode">Approver Name</label>
                <div class='staff_list' id='appr_list' style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-2  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="appr_no" name="appr_no"  placeholder="Enter Approver No" readonly />
                <label for="coursecode">Approver Staff No</label>
            </div>
        </div>
        <div class="col-md-5  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="appr_email" name="appr_email"  placeholder="Enter Approver Email" readonly/>
                <label for="subgroup">Approver Email</label>
            </div>
        </div>
    </div>

    <!-- Form Row-->
    <div class="row mb-4">
        <div class="col-md-5  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control name_select" id="super_name" name="super_name"  placeholder="Enter Supervisor Name" />
                <label for="coursecode">Supervisor Name</label>
                <div class='staff_list' id='super_list' style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-2  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="super_no" name="super_no"  placeholder="Enter Supervisor Staff No" readonly />
                <label for="coursecode">Supervisor Staff No</label>
            </div>
        </div>
        <div class="col-md-5  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="super_email" name="super_email"  placeholder="Enter Supervisor Email" readonly/>
                <label for="subgroup">Supervisor Email</label>
            </div>
        </div>
    </div>
    <!-- Form Row-->
    <div class="row mb-4">
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                 <select class="form-select " id="sec_name" name="sec_name">
                    <?php echo _select_option_sec_name(); ?>
                </select>
                <label for="sec_name">Secretary/Administator Name</label>
            </div>
        </div>
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="sec_email" name="sec_email"  placeholder="Enter Secretary/Administator Email" readonly/>
                <label for="sec_email">Secretary/Administator Email</label>
            </div>
        </div>
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="sec_staff_no" name="sec_staff_no"  placeholder="Enter Secretary/Administator Staff No" readonly/>
                <label for="sec_email">Secretary/Administator Staff No</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <select class="form-select " id="depoh_name" name="depoh_name">
                    <?php echo _select_option_depoh_admin_name(); ?>
                </select>
                <label for="depoh_name">Rail/Bus Admin Name</label>
            </div>
        </div>
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="depoh_email" name="depoh_email"  placeholder="Enter Depoh Admin Email" readonly />
                <label for="depoh_email">Rail/Bus Admin Email</label>
            </div>
        </div>
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="depoh_staff_no" name="depoh_staff_no"  placeholder="Enter Bus/Rail Admin Staff No" readonly/>
                <label for="sec_email">Bus/Rail Admin Staff No</label>
            </div>
        </div>
       

    </div>
    
    
        

    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <?php echo $button_register; ?>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='trainingid' name='trainingid' value='<?php echo $trainingid; ?>' >
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
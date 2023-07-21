<form id='new_staff' action="" method="post" autocomplete='off' name='new_staff'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="staff_no" name="staff_no"  placeholder="Enter Staff No" />
                <label for="grade">Staff No</label>
            </div>
        </div>

        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="staff_name" name="staff_name"  placeholder="Enter Staff Name" readonly />
                <label for="title">Staff Name</label>
            </div>
        </div>

        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Staff Email" readonly />
                <label for="title">Email</label>
            </div>
        </div>
    </div>
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
                <label for="depoh_name">Bus/Rail Admin Name</label>
            </div>
        </div>
        <div class="col-md-4  ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="depoh_email" name="depoh_email"  placeholder="Enter Bus/Rail Admin Email" readonly />
                <label for="depoh_email">Bus/Rail Admin Email</label>
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
        <button class="btn btn-prasarana" type="button" id='save'>Update Staff List</button>
        <button class="btn btn-prasarana" type="button" id="close_dialog">Close</button>
    </div>

    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='editor_staff_no' name='editor_staff_no' value='<?php echo $_SESSION['staff_no']; ?>' />

</form>
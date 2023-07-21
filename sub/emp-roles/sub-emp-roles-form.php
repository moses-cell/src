<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <!--
    <div class="row mb-4" style="visibility: hidden;"> Form Group (training title)
        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" placeholder="Employee Email" id="email" name="email"  />
                <label for="email">Employee Email</label>
                <div class="input-group-append">
                    <button class="btn btn-outline-prasarana" type="button" id="verify">Verify Email</button>
                </div>
            </div>
        </div>
    </div>
    !-->
    <div class="row mb-4">
        <div class="col-md-4 ">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="staff_no" name="staff_no"  placeholder="Employee No" />
                <label for="title">Employee No</label>
                <div class="input-group-append">
                    <button class="btn btn-outline-prasarana" type="button" id="verify">Verify Employee No</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="name" name="name"  placeholder="Employee Name" readonly/>
            <label for="title">Employee Name</label>
        </div>
    </div>
    <div class="row mb-4" > <!--Form Group (training title)!-->
        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" placeholder="Employee Email" id="email" name="email" readonly  />
                <label for="email">Employee Email</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <?php echo _radio_roles_registration(); ?>
        </div>
    </div> <!-- Form Group (training title)-->
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
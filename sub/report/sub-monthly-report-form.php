<form id='data_form' action="" method="post" autocomplete='off' name='data_form' >
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="form-group floating-label">
                <select class="form-select " id="month" name="month">
                    <?php echo _select_option_month(); ?>
                </select>
                <label for="ic_no">Month</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-3  floating-label">
            <div class="form-group floating-label">
                <select class="form-select " id="year" name="year">
                    <?php echo _select_option_year(); ?>
                </select>
                <label for="ic_no">Year</label>
            </div>
        </div>
    </div>
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='report'>Generate Report</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
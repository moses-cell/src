<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <div class="input-group floating-label">
                <input type="text" class="form-control" placeholder="Setting Key" id="setting_key" name="setting_key"  readonly />
                <label for="email">Setting Key</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="setting_value" name="setting_value"  placeholder="Enter Setting Value"/>
            <label for="title">Setting Value</label>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-8  floating-label">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3" readonly></textarea> 
            <label for="title">Description</label>
        </div>
    </div>
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='page_id' name='page_id' value='<?php echo $_SESSION['page_id']; ?>' />

</form>
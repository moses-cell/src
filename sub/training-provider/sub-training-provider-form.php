<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-12  floating-label">
            <input type="text" class="form-control" id="provider_name" name="provider_name"  placeholder="Enter training Provider" />
            <label for="provider_name">Training Provider</label>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12  floating-label">
            <textarea class="form-control" id="details" name="details"  placeholder="Enter Description" rows="6"></textarea>
            <label for="details">Details</label>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <div class="form-check form-switch form-check-inline">
                <input type="checkbox" class="form-check-input " id="enable" name='enable' value="1" checked>
                <label class="form-check-label" for="enable">Enable</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='page_id' name='page_id' value='<?php echo $_SESSION['page_id']; ?>' />

</form>
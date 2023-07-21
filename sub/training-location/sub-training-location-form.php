<form id='data_form' action="" method="post" autocomplete='off' name='data_form'>
    <div class="row mb-3"> <!-- Form Group (training title)-->
        <div class="col-md-6 ">
            <div class="form-group floating-label">
                <select class="form-select " id="main_location" name="main_location"  placeholder="Enter training location" >
                    <?php echo $main_location; ?>
                </select>
                <label for="provider_name">Main Location</label>
            </div>
        </div>
        <div class="col-md-6  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="new_main_location" name="new_main_location"  placeholder="Enter training Provider" />
                <label for="new_main_location">New Main Location</label>
            </div>
        </div>
    </div>
    <div class="row mb-3"> <!-- Form Group (training title)--> 
        <div class="col-md-6  floating-label">
            <div class="row mb-2">
                <div class="col-md-12  ">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="sub_location" name="sub_location"  placeholder="Enter training Provider" />
                        <label for="provider_name">Sub Location</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12  ">
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="enable" name='enable' value="1" checked>
                        <label class="form-check-label" for="enable">Enable</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6  floating-label">
            <textarea class="form-control" id="details" name="details"  placeholder="Enter Details" rows="3"></textarea>
            <label for="details">Details</label>
        </div>
    </div>
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='new'>New</button>
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='page_id' name='page_id' value='<?php echo $_SESSION['page_id']; ?>' />
    <input type='hidden' id='provider_id' name='provider_id' value='<?php echo $_SESSION['provider_id']; ?>' />

</form>
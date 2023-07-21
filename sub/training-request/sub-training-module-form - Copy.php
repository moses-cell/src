<form id='data_form' action="" method="post" autocomplete='off' name='data_form' enctype="multipart/form-data">
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3">  
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="coursecode" name="coursecode"  placeholder="Enter Course Code" maxlength="10" />
                <label for="coursecode">Course Code</label>
            </div>
        </div>
        <div class="col-md-9 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Course Title" />
                <label for="title">Course Title</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->

    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-12 ">
            <div class="form-group floating-label">
                <textarea class="form-control" id="description" name="description" rows="3" placeholder=" "></textarea>
                <label for="description">Training Description</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    
    <!-- Form Row        -->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        <div class="col-md-6 ">
            <div class="row mb-4">
                <div class="col-md-12 ">
                    <div class="form-group floating-label">
                        <select class="form-select " id="trainingprovider" name="trainingprovider" autocomplete="on">
                            <?php echo select_option_training_provider(); ?>
                        </select>
                        <label class="mr-sm-2" for="trainingprovider">Training Provider</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-group floating-label">
                        <input type="text" name="newtrainingprovider" class="form-control " id="newtrainingprovider" name="newtrainingprovider" placeholder="Enter new training provider">
                        <label  for="newtrainingprovider">New Training Provider</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="row mb-4">    
                <div class="col-md-4 ">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control " id="tdays" name="tdays"  placeholder="Enter total training days" />
                        <label for="tdays">Total Days</label>
                    </div>
                </div>
                    
                <!-- Form Group (total hours)-->
                <div class="col-md-4 ">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control " id="thours" name="thours"  placeholder="Enter total training hours" />
                        <label  for="thous">Total Hours</label>
                    </div>
                </div>
                <!-- Form Group (total hours)-->
                <div class="col-md-4 ">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="max_sit" name="max_sit"  placeholder="Enter maximum seats" />
                        <label for="maxseat">Maximum Seats</label>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="form-group floating-label">
                        <select class="form-select " id="trainingcategory" name="trainingcategory">
                            <?php echo select_option_training_category(); ?>

                        </select>
                        <label class="mr-sm-2" for="trainingcategory">Training Category</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Form Row-->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        
                
        <div class="col-md-8 ">
            <div class="form-group floating-label ">
                <input id="fileupload" name="fileupload" type="file" accept="image/png, image/jpeg, .pdf, .doc, .docx, .xls, .ppt, .docx, .xlsx, .pptx " class="fileupload form-control"  />
            </div>
            <input type="hidden" name="filename" id="filename">
        </div>
        <div class="col-sm-4 ">
            <div class="input-group floating-label">
                <input type="text" class="form-control" placeholder="review file attached" id="fileattached" readonly value="No File Attach" />
                <label for="review_file_upload">Current Attachment</label>
                <div class="input-group-append">
                    <button class="btn btn-outline-prasarana" type="button" id="openfile">Click to Open</button>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-internal_title mt-2 mb-2">Target Audience (Employee Grade)</div>
                    <?php echo checkbox_target_audience(); ?>

                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-internal_title mt-2 mb-2">Who Can Apply (System Roles)</div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="hradmin" name='eligibility[]' value="HR Admin">
                        <label class="form-check-label" for="hradmin">HR Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="unit_secretary" name='eligibility[]' value="Unit Secretary">
                        <label class="form-check-label" for="unit_secretary">Unit Secretary</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="busdepohadmin" name='eligibility[]' value="Bus Depoh Admin">
                        <label class="form-check-label" for="busdepohadmin">Bus Depoh Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="raildepohadmin" name='eligibility[]' value="Rail Depoh Admin">
                        <label class="form-check-label" for="raildepohadmin">Rail Depoh Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="el_AllStaff" name='eligibility[]' value="All Staff">
                        <label class="form-check-label" for="el_AllStaff">All Staff</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-internal_title mt-2 mb-2">Training Evaluation</div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="eval" name='eval' value="1">
                        <label class="form-check-label" for="eval">Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="eval" name='eval' value="1">
                        <label class="form-check-label" for="eval">Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input" id="post_eval" name="post_eval" value="1">
                        <label class="form-check-label" for="post_eval">Post Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input" id="super_eval" name="super_eval" value="1">
                        <label class="form-check-label" for="super_eval">Superior Training Evaluation</label>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="enable_process" id="enable_process" value="1">
                <label class="form-check-label" for="enable">Enable this Activies</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 ">
            <div class="form-group floating-label">
            <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder=" "></textarea>
            <label for="remarks">Remarks</label>
        </div>
        </div>
    </div>
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Save changes</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='provider_list' name='provider_list' value='<?php json_training_provider(); ?>' >

</form>
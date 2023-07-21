<form id='data_form' action="" method="post" autocomplete='off' name='data_form' enctype="multipart/form-data">
    <!-- Save changes button-->
    <div class="text-start mb-4">
        <button class="btn btn-prasarana" type="button" id="close">Close Document 1</button>
        <button class="btn btn-prasarana" type="button" id='save'>Apply Training</button>
    </div>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3">  
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="coursecode" name="coursecode"  placeholder="Enter Course Code" readonly />
                <label for="coursecode">Course Code</label>
            </div>
        </div>
        <div class="col-md-9 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Course Title" readonly />
                <label for="title">Course Title</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->

    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-12 ">
            <div class="form-group floating-label">
                <textarea class="form-control" id="description" name="description" rows="3" placeholder=" " readonly></textarea>
                <label for="description">Training Description</label>
            </div>
        </div>
    </div> <!-- Form Group (training title)-->
    
    <!-- Form Row        -->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="sdate" name="sdate" placeholder="Enter Start Date" onfocus="this.blur();" readonly/>
                <label for="sdt">Start Date</label>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter End Date" onfocus="this.blur();" readonly/>
                <label for="edate">End Date</label>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control datetime" id="stime" name="stime" placeholder="Enter Start Time"  readonly/>
                <label for="sdt">Start Time</label>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control datetime" id="etime" name="etime"  placeholder="Enter End Time" readonly />
                <label for="edate">End Time</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">        
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="tdays" name="tdays"  placeholder="Enter total training days" readonly/>
                <label for="tdays">Total Days</label>
            </div>
        </div>
            
        <!-- Form Group (total hours)-->
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="thours" name="thours"  placeholder="Enter total training hours" readonly/>
                <label  for="thous">Total Hours</label>
            </div>
        </div>
        <!-- Form Group (total hours)-->
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="max_sit" name="max_sit"  placeholder="Enter maximum seats" readonly />
                <label for="maxseat">Maximum Seats</label>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" name="trainingcategory" id="trainingcategory" readonly> 
                <label class="mr-sm-2" for="trainingcategory">Training Category</label>
            </div>
        </div>
    </div>
    <!-- Form Row-->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        <div class="col-md-8 ">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" name="trainingprovider" id="trainingprovider" readonly >
                        <label class="mr-sm-2" for="trainingprovider">Training Provider</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" name="traininglocation" id="traininglocation" readonly>
                        <label class="mr-sm-2" for="traininglocation">Training Location</label>
                    </div>
                </div>
            
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group floating-label">
                        <input type="text" class="form-control" placeholder="training file attached" id="fileattached" readonly value="No File Attach" name="fileattached" />
                        <label for="review_file_upload">Current Attachment</label>
                        <div class="input-group-append">
                            <button class="btn btn-outline-prasarana" type="button" id="openfile">Click to Open</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 ">
            <div class="form-group floating-label">
                <textarea class="form-control" id="locationdetails" name="locationdetails" rows="4" placeholder=" " readonly></textarea>
                <label class="mr-sm-2" for="locationdetails">Training Location Details</label>
            </div>
        </div>
                
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-field-group ">
                <div class="card-body card-body-field-group">
                    <div class="card-internal_title mt-2 mb-2">Target Audience (Employee Grade)</div>
                    <?php checkbox_target_audience(true) ?>

                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-2">
        <div class="col-md-6">
            <div class="card card-field-group  ">
                <div class="card-body card-body-field-group">
                    <div class="card-internal_title mt-2 mb-2">Who Can Apply (System Roles)</div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="hradmin" name='eligibility[]' value="HR Admin" disabled>
                        <label class="form-check-label" for="hradmin">HR Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="unit_secretary" name='eligibility[]' value="Unit Secretary" disabled>
                        <label class="form-check-label" for="unit_secretary">Unit Secretary</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="busdepohadmin" name='eligibility[]' value="Bus Depoh Admin" disabled>
                        <label class="form-check-label" for="busdepohadmin">Bus Depoh Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="raildepohadmin" name='eligibility[]' value="Rail Depoh Admin" disabled>
                        <label class="form-check-label" for="raildepohadmin">Rail Depoh Admin</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="el_AllStaff" name='eligibility[]' value="All Staff" disabled>
                        <label class="form-check-label" for="el_AllStaff">All Staff</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-field-group">
                <div class="card-body card-body-field-group">
                    <div class="card-internal_title mt-2 mb-2">Training Evaluation</div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="eval" name='eval' value="1" disabled>
                        <label class="form-check-label" for="eval">Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input " id="eval" name='eval' value="1" disabled>
                        <label class="form-check-label" for="eval">Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline" >
                        <input type="checkbox" class="form-check-input" id="post_eval" name="post_eval" value="1" disabled>
                        <label class="form-check-label" for="post_eval">Post Training Evaluation</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input type="checkbox" class="form-check-input" id="super_eval" name="super_eval" value="1" disabled>
                        <label class="form-check-label" for="super_eval">Superior Training Evaluation</label>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <div class="row mb-4">
        <div class="col-md-12 ">
            <div class="form-group floating-label">
            <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder=" " readonly></textarea>
            <label for="remarks">Remarks</label>
        </div>
        </div>
    </div>
    

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='staff_no' name='staff_no' value='<?php echo $_SESSION['staff_no']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='sch_id' name='sch_id' value='<?php echo $_SESSION['sch_id'];?>' >
    <input type="hidden" name="filename" id="filename">

</form>
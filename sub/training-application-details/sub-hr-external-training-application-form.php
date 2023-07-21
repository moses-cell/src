<form id='training_dataform' action="" method="post" autocomplete='off' name='training_dataform' enctype="multipart/form-data">
    <!-- Save changes button-->
    
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3">  
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="coursecode" name="coursecode"  placeholder="Enter Course Code"  />
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
                <select class="form-select " id="trainingcategory" name="trainingcategory">
                    <?php echo _select_option_training_category(false); ?>
                </select> 
                <label class="mr-sm-2" for="trainingcategory">Training Category</label>
            </div>
        </div>
        <div class="col-md-3 ">                
            <?php echo _checkbox_training_evaluation(true, false, true); ?>
            
        </div>
    </div>
    <!-- Form Row-->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        <!-- Form Group (total days)-->
        <div class="col-md-4 ">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group floating-label">
                        <input type="text"class="form-control " id="trainingprovider" name="trainingprovider" placeholder="Select training provider"  readonly>
                        <label class="mr-sm-2" for="trainingprovidername">Training Provider</label>
        
                    </div>
                </div>
            </div>
            <div class="row " id="provider">
                <div class="col-md-12">                            
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="newtrainingprovider" name="newtrainingprovider"  placeholder="Enter New Training Provider" readonly />
                        <label for="newtrainingprovider">New Training Provider</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group floating-label">
                        <input type="text"class="form-control " id="traininglocation" name="traininglocation" placeholder="Select training location"  readonly>
                        <label class="mr-sm-2" for="traininglocationname">Training Location</label>
                    </div>
                </div>
            </div>
            <div class="row" id="location">
                <div class="col-md-12">                            
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="newmaintraininglocation" name="newmaintraininglocation"  placeholder="Enter Main Location" readonly/>
                        <label for="newmaintraininglocation">New Main Location</label>
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
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="input-group floating-label">
                <input type="text" class="form-control" placeholder="training file attached" id="fileattached" readonly value="No File Attach" name="fileattached" />
                <label for="review_file_upload">Current Attachment</label>
                <div class="input-group-append">
                    <button class="btn btn-outline-prasarana" type="button" id="openfile">Click to Open</button>
                </div>
            </div>
        </div>  
        <div class="col-sm-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="bonding" id="bonding" value="1" >
                <label class="form-check-label" for="enable">Staff Bonding</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="staff_request" id="staff_request" value="1" disabled>
                <label class="form-check-label" for="enable" style="color: ;">External Training Requested by Staff</label>
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

    
    <input type="hidden" name="filename" id="filename">

</form>
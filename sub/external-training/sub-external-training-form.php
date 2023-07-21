<form id='data_form' action="" method="post" autocomplete='off' name='data_form' enctype="multipart/form-data">
    <!-- Save changes button-->
   
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-3">  
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="coursecode" name="coursecode"  placeholder="Enter Course Code"  maxlength="25" title="Please key course code if exist else please leave it blank" />
                <label for="coursecode">Course Code</label>
            </div>
        </div>
        <div class="col-md-9 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Course Title"  />
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
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="sdate" name="sdate" placeholder="Enter Start Date" onfocus="this.blur();" />
                <label for="sdt">Start Date</label>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter End Date" onfocus="this.blur();"/>
                <label for="edate">End Date</label>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control datetime" id="stime" name="stime" placeholder="Enter Start Time"  />
                <label for="sdt">Start Time</label>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control datetime" id="etime" name="etime"  placeholder="Enter End Time" />
                <label for="edate">End Time</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">        
        <div class="col-md-2 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_numeric" id="tdays" name="tdays"  placeholder="Enter total training days" />
                <label for="tdays">Total Days</label>
            </div>
        </div>
            
        <!-- Form Group (total hours)-->
        <div class="col-md-2 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_numeric" id="thours" name="thours"  placeholder="Enter total training hours" />
                <label  for="thous">Total Hours</label>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group floating-label">
                <input type="text" class="form-control allow_decimal" id="cost" name="cost"  placeholder="Enter Cost Per Head" />
                <label for="maxseat">Cost Per Head</label>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group floating-label">
                <select class="form-select " id="trainingcategory" name="trainingcategory">
                    <?php echo _select_option_training_category(false); ?>
                </select>
                <label class="mr-sm-2" for="trainingcategory">Training Category</label>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group floating-label ">
                <input id="fileupload" name="fileupload" type="file" accept="image/png, image/jpeg, .pdf, .doc, .docx, .xls, .ppt, .docx, .xlsx, .pptx " class="fileupload form-control"  />
            </div>
            <input type="hidden" name="filename" id="filename">
        </div>
    </div>
    <!-- Form Row-->
    <!-- Form Row-->
    <div class="row mb-4">
        <!-- Form Group (total days)-->
        <div class="col-md-4 ">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group floating-label">
                        <input type="text"class="form-control " id="trainingprovidername" name="trainingprovidername" placeholder="Select training provider"  >
                        <label class="mr-sm-2" for="trainingprovidername">Training Provider</label>
                        <input type="hidden"class="form-control " id="trainingprovider" name="trainingprovider" placeholder="Select training provider">
                    </div>
                </div>
            </div>
            <div class="row " id="provider">
                <div class="col-md-12">                            
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="newtrainingprovider" name="newtrainingprovider"  placeholder="Enter New Training Provider" />
                        <label for="newtrainingprovider">New Training Provider</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group floating-label">
                        <input type="text"class="form-control " id="traininglocationname" name="traininglocationname" placeholder="Select training location"  >
                        <label class="mr-sm-2" for="traininglocationname">Training Location</label>
                        <input type="hidden"class="form-control " id="traininglocation" name="traininglocation" placeholder="Select training location">
                    </div>
                </div>
            </div>
            <div class="row" id="location">
                <div class="col-md-12">                            
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="newmaintraininglocation" name="newmaintraininglocation"  placeholder="Enter Main Location" />
                        <label for="newmaintraininglocation">New Main Location</label>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group floating-label">
                <textarea class="form-control" id="locationdetails" name="locationdetails" rows="4" placeholder=" " ></textarea>
                <label class="mr-sm-2" for="locationdetails">Training Location Details</label>
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
    
    <?php echo $form_button; ?>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='module_id' name='module_id' value='<?php echo $_SESSION['module_id'];?>' >
    <input type='hidden' id='provider_list' name='provider_list' value='<?php _json_training_provider(); ?>' >
    <input type='hidden' id='location_list' name='location_list' value='' >
    <input type='hidden' id='setting' name='setting' value='<?php echo $setting; ?>' >

</form>
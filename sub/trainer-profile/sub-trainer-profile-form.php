<form id='trainer_profile' action="" method="post" autocomplete='off' name='trainer_profile'>

    <div class="row">
        <div class="col-xl-4">
            <div class="card-body">
                <div class="row mb-0">
                    <div class="text-center">
                        <!-- Profile picture image-->
                        <img class="img-fluid rounded-circle mb-1" src="assets/img/avatar.png" alt="..." style="max-width: 150px; max-height: 150px" id="trainerpic"/>
                        <!-- Profile picture help block-->
                        <div class="caption fst-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <input type="file" name="pic" id="pic" accept="image/png, image/gif, image/jpeg" hidden/>
                        <button class="btn btn-prasarana" type="button" id="uploadpic" name="uploadpic" >
                            Upload Trainer Picture
                            <i class="material-icons trailing-icon">upload</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-md-8 mt-10">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="form-group floating-label">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="trainer_type" id="internal" value="internal" checked>
                            <label class="form-check-label" for="internal">Internal Trainer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="trainer_type" id="external" value="external">
                            <label class="form-check-label" for="external">External Trainer</label>
                        </div>
                    </div>            
                </div>
                <div class="col-md-4">
                    <div class="form-group floating-label">
                        <div class="form-check form-check-inline form-switch">
                            <input class="form-check-input" type="checkbox" name="disable_trainer" id="disable_trainer" value="0">
                            <label class="form-check-label" for="disable_trainer">Disable Trainer</label>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4 ">
                    <div class="input-group floating-label">
                        <input type="text" id="staff_no" name="staff_no" class="form-control" placeholder="Enter staff no" value="">
                        <label class="labels">Staff No</label>
                    </div>
                </div>   
                <div class="col-md-8">
                    <div class="input-group floating-label">
                        <input type="text" id='email' name="email" class="form-control" placeholder="enter trainer email address" value="">
                            <label class="labels">Email Address</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12 floating-label">
                    <div class="form-group floating-label">
                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter full name" value="">
                        <label class="labels">Full Name</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group floating-label">
                        <input type="text" id="dob" name='dob' class="form-control" placeholder="enter date of birth" value="" onfocus="this.blur()">
                        <label class="labels">DOB</label>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group floating-label">
                        <input type="text" id='ic' name='ic' class="form-control" placeholder="enter IC number" value="">
                        <label class="labels">IC No</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group floating-label">
                        <select class="form-select " id="maritalstatus" name="maritalstatus">
                            <option value=''>Please select</option>
                            <option value='Single'>SINGLE</option>
                            <option value='Married'>MARRIED</option>
                        </select>
                        <label class="labels">Marital Status</label>
                    </div>
                </div>
                <div class="col-md-6 floating-label">
                    <div class="form-group floating-label">
                        <input type="text" id='phone' name="phone" class="form-control" placeholder="enter trainer phone number" value="">
                        <label class="labels">Mobile Number</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 floating-label">
            <input type="text" class="form-control" placeholder="enter home address" value="" id='address' name='address'>
            <label class="labels">Home Address</label>
        </div>
    </div>

    <div class="text-start mb-4 text-end">
        <button class="btn btn-prasarana close_btn" type="button">Close Document</button>
        <button class="btn btn-prasarana" type="button" id='save_trainer'>Save Trainer Profile</button>
    </div>

    <!-- Save changes button-->
    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='picture' name='picture' value='' >

</form>
<script type="text/javascript" src="assets/js/page/jf-trainer-profile-form.js"></script>
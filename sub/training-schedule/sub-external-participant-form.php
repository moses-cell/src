<form id='external_participant' action="" method="post" autocomplete='off' name='external_participant'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-6  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Participant Email" />
                <label for="email">Participant Email</label>
            </div>
        </div>
        <div class="col-md-6  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Participan Name"  />
                <label for="title">Participant Name</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="company" name="company"  placeholder="Enter Participant Company"  />
                <label for="title">Participant Company</label>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12  floating-label">
            <div class="form-group floating-label">
                <input type="text" class="form-control" id="department" name="department"  placeholder="Enter Participant Department"  />
                <label for="title">Participant Deparment</label>
            </div>
        </div>
    </div>
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='update_external'>Update External Participant</button>
        <button class="btn btn-prasarana" type="button" id="close_dialog">Close</button>
    </div>

    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_GET['id']; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
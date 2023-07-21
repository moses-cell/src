<form id='new_participant' action="" method="post" autocomplete='off' name='new_participant'>
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="staff_no" name="staff_no"  placeholder="Enter Staff No" />
            <label for="grade">Staff No</label>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="staff_name" name="staff_name"  placeholder="Enter Staff Name" readonly />
            <label for="title">Staff Name</label>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4  floating-label">
            <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Staff Email" readonly />
            <label for="title">Email</label>
        </div>
    </div>
    
    
    <!-- Save changes button-->
    <div class="text-end">
        <button class="btn btn-prasarana" type="button" id='save'>Update Participant List</button>
        <button class="btn btn-prasarana" type="button" id="close_dialog">Close</button>
    </div>

    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_GET['id']; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
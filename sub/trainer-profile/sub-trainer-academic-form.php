<form id='trainer_academic' action="" method="post" autocomplete='off' name='trainer_academic'>
    <div class="row mb-4">    
        <div class="col-md-3 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="ayear" name="ayear" class="form-control" placeholder="Enter graduation year" value="" onkeyup="$(this).maskMoney();" maxlength="4">
                <label class="labels">Graduation Year</label>
            </div>
        </div>
        <div class="col-md-9 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="qualification" name='qualification' class="form-control" placeholder="Enter qualification" value="">
                <label class="labels">Qualification</label>
            </div>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col-md-6 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="major" name='major' class="form-control" placeholder="Enter major" value="">
                <label class="labels">Graduation Major</label>
            </div>
        </div>
         <div class="col-md-6 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="institution" name='institution' class="form-control" placeholder="Enter institution" value="">
                <label class="labels">Institution</label>
            </div>
        </div>
    </div>
    <!-- Save changes button-->
    <div class="text-start mb-4 text-end">
        <button class="btn btn-prasarana close_btn" type="button" >Close Document</button>
        <button class="btn btn-prasarana" type="button" id='add_academic'>Save Academic History</button>
    </div>
    <input type='hidden' id='academicdata' name='academicdata' value='<?php echo $academicdata; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='profileid' name='profileid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='academicid' name='academicid' value='<?php echo $_SESSION['academic_id'];?>' >
    
</form>
<br >
<div class="card-title">Academic History</div>
<table id="academic_datatable" class="display cell-border" style="width:100%">
    <thead>
        <tr>
            <th>Graduation Year</th>
            <th>Qualification</th>
            <th>Major</th>
            <th>Institution</th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Graduation Year</th>
            <th>Qualification</th>
            <th>Major</th>
            <th>Institution</th>
            <th></th>
        </tr>
    </tfoot>
</table>

    
       

<script type="text/javascript" src="assets/js/page/jf-trainer-profile-academic.js"></script>

<form id='trainer_employment' action="" method="post" autocomplete='off' name='trainer_employment'>
    <div class="row mb-4">    
        <div class="col-md-3 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="syear" name="syear" class="form-control" placeholder="Enter working start year" value="" onkeyup="$(this).maskMoney();" maxlength="4">
                <label class="labels">Start Year</label>
            </div>
        </div>
        <div class="col-md-3 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="eyear" name="eyear" class="form-control" placeholder="Enter working end year" value="" onkeyup="$(this).maskMoney();" maxlength="4" >
                <label class="labels">End Year</label>
            </div>
        </div>
        <div class="col-md-6 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="designation" name='designation' class="form-control" placeholder="Enter designation" value="">
                <label class="labels">Designation</label>
            </div>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col-md-6 floating-label">
            <div class="form-group floating-label">
                <textarea id='dept' name='dept' rows='3' class='form-control' placeholder="Enter division / department"></textarea>
                <label class="labels">Division / Department</label>
            </div>
        </div>
         <div class="col-md-6 floating-label">
            <div class="form-group floating-label">
                <textarea id='jd' name='jd' rows='3' class='form-control' placeholder="Enter job description"></textarea>
                <label class="labels">Job Description</label>
            </div>
        </div>
    </div>
    <!-- Save changes button-->
    <div class="text-start mb-4 text-end">
        <button class="btn btn-prasarana close_btn" type="button" >Close Document</button>
        <button class="btn btn-prasarana" type="button" id='add_working'>Save Working History</button>
    </div>
    <input type='hidden' id='empdata' name='empdata' value='<?php echo $empdata; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='profileid' name='profileid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='empid' name='empid' value='<?php echo $_SESSION['emp_id'];?>' >
    
</form>
<br >
<div class="card-title">Employment History</div>
<table id="datatable" class="display cell-border" style="width:100%">
    <thead>
        <tr>
            <th>Start Year</th>
            <th>End Year</th>
            <th>Designation</th>
            <th>Division / Department</th>
            <th>Job Description</th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Start Year</th>
            <th>End Year</th>
            <th>Designation</th>
            <th>Division / Department</th>
            <th>Job Description</th>
            <th></th>
        </tr>
    </tfoot>
</table>

    
       

<script type="text/javascript" src="assets/js/page/jf-trainer-profile-employment.js"></script>

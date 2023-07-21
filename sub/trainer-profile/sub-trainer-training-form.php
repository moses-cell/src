<form id='trainer_training' action="" method="post" autocomplete='off' name='trainer_academic'>
    <div class="row mb-4">    
        <div class="col-md-3 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="tyear" name="tyear" class="form-control" placeholder="Enter training year" value="" onkeyup="$(this).maskMoney();" maxlength="4">
                <label class="labels">Training Year</label>
            </div>
        </div>
        <div class="col-md-9 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="program" name='program' class="form-control" placeholder="Enter training program name" value="">
                <label class="labels">Program</label>
            </div>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col-md-12 floating-label">
            <div class="form-group floating-label">
                <input type="text" id="organiser" name='organiser' class="form-control" placeholder="Enter organiser" value="">
                <label class="labels">Organiser</label>
            </div>
        </div>
    </div>
    <!-- Save changes button-->
    <div class="text-start mb-4 text-end">
        <button class="btn btn-prasarana close_btn" type="button" >Close Document</button>
        <button class="btn btn-prasarana" type="button" id='add_training'>Save Training History</button>
    </div>
    <input type='hidden' id='trainingdata' name='trainingdata' value='<?php echo $trainingdata; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
    <input type='hidden' id='id' name='id' >
    <input type='hidden' id='profileid' name='profileid' value='<?php echo $_SESSION['page_id'];?>' >
    <input type='hidden' id='trainingid' name='trainingid' value='<?php echo $_SESSION['training_id'];?>' >
    
</form>
<br >
<div class="card-title">Training Course / Program Attended History</div>
<table id="training_datatable" class="display cell-border" style="width:100%">
    <thead>
        <tr>
            <th>Training Year</th>
            <th>Program</th>
            <th>Organiser</th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Training Year</th>
            <th>Program</th>
            <th>Organiser</th>
            <th></th>
        </tr>
    </tfoot>
</table>

    
       

<script type="text/javascript" src="assets/js/page/jf-trainer-profile-training.js"></script>

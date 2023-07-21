    <hr></hr>
    <br />
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">4</div>
        <div class="col-md-7 text-start">
            <div class="col font-weight-bold">Penilaian Keseluruhan</div>
            <div class="col font-italic ">Overall Assessment </div>
        </div>
        <div class="col-md-4">
            <div class="col font-weight-bold" id="total"></div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">5</div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <textarea class="form-control" id="super_comment" name="super_comment"  placeholder="Enter Comment" rows="4"  <?php echo $disable; ?> ></textarea>
                <label for="super_comment">Komen Penyelia / Supervisor Comments </label>
            </div>
            
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">6</div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="super_name" name="super_name"  placeholder="Enter Supervisor Name" readonly />
            <label for="super_name">Nama Penilai / Evaluator Name </label>
            </div>
            
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">7</div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="super_email" name="super_email"  placeholder="Enter Supervisor Email" readonly  <?php echo $disable; ?> />
            <label for="super_email">Email Penilai / Evaluator Email </label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">8</div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="appr_name" name="appr_name"  placeholder="Enter Approver Name"   <?php echo $disable; ?> />
            <label for="appr_name">Nama HOD / HOD Name</label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">9</div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <input type="text" class="form-control" id="appr_email" name="appr_email"  placeholder="Enter Approver Email "  <?php echo $disable; ?>  />
            <label for="appr_email">Email HOD</label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1">10</div>
        <div class="col-md-7 text-start">
            <div class="col font-weight-bold" id="status_bm"></div>
            <div class="col font-italic " id="status_bi"></div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-7 text-start">
            <div class="col font-weight-bold" id="retrain_bm"></div>
            <div class="col font-italic " id="retrain_bi"></div>
        </div>
    </div>
    <input type='hidden' id='overall' name='overall' >
    <input type='hidden' id='eval_status' name='eval_status' >
    <input type='hidden' id='retrain' name='retrain' >
   
    <!-------------------------------End of Section -------------------------------------------------------------!-->

     <div class="text-end">
        <?php echo $button; ?>
        
    </div>


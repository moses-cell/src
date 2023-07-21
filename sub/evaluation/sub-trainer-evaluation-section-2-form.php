    <hr></hr>
    <br />
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-7 text-start">
            <div class="input-group floating-label">
                <textarea class="form-control" id="comment" name="comment"  placeholder="Enter Comment" rows="4"  <?php echo $disable; ?>></textarea>
                <label for="super_comment">Comments </label>
            </div>
            
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-2 text-start">
            <div class="form-group floating-label">
                <select class="form-select" id="result_type" name="result_type"  <?php echo $disable; ?> >
                    <option value="">Please Select</option>
                    <option value="Qualified Module">Qualified Module</option>
                    <option value="Refresher Module">Refresher Module</option>
                </select>
                <label for="super_name">Result Type </label>
            </div>
            
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-2 text-start">
            <div class="input-group floating-label" id="theory_percent">
                <div class="input-group-prepand floating-label">
                    <input type="text" class="form-control allow_decimal" id="theory" name="theory"  placeholder="Enter Theory %"  <?php echo $disable; ?>/>
                    <label for="theory">Theory </label>
                </div>
                <div class="input-group-append floating-label " >
                    <input type="text" class="form-control " style="width:50%"   disabled value="%" />    
                </div>
            </div>

        </div>
        <div class="col-md-4 text-start  qualifying">
            <div class="form-check form-switch form-check-inline " style="width:50px">
                <input type="radio" class="form-check-input" id="theory_result_pass" name="theory_result" value="Pass"  <?php echo $disable; ?>>
                <label class="form-check-label" for="theory_result_pass">PASS</label>
            </div>
            <div class="form-check form-switch form-check-inline ">
                <input type="radio" class="form-check-input" id="theory_result_fail" name="theory_result" value="Fail"  <?php echo $disable; ?>>
                <label class="form-check-label" for="theory_result_pass">FAIL</label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-2 text-start">
            <div class="input-group floating-label" id="practical_percent">
                <div class="input-group-prepand floating-label">
                    <input type="text" class="form-control allow_decimal  "  id="practical" name="practical"  placeholder="Enter Practical %"  <?php echo $disable; ?>/>
                    <label for="super_email">Practical </label>
                </div>
                <div class="input-group-append floating-label " >
                    <input type="text" class="form-control  " style="width:50%"   disabled value="%" />    
                </div>
            </div>
        </div>
        <div class="col-md-4 text-start  qualifying">
            <div class="form-check form-switch form-check-inline " style="width:50px">
                <input type="radio" class="form-check-input" id="practical_result_pass" name="practical_result" value="Pass"  <?php echo $disable; ?>>
                <label class="form-check-label" for="practical_result_pass">PASS</label>
            </div>
            <div class="form-check form-switch form-check-inline ">
                <input type="radio" class="form-check-input" id="practical_result_fail" name="practical_result" value="Fail"  <?php echo $disable; ?>>
                <label class="form-check-label" for="practical_result_pass">FAIL</label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-2 text-start pt-2 font-weight-bold">Training Result</div>
        <div class="col-md-4 text-start pt-2 qualifying" >
            <div class="form-check form-switch form-check-inline " style="width:50px">
                <input type="radio" class="form-check-input" id="training_result_pass" name="training_result_qualified" value="Pass"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">PASS</label>
            </div>
            <div class="form-check form-switch form-check-inline ">
                <input type="radio" class="form-check-input" id="training_result_fail" name="training_result_qualified" value="Fail"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">FAIL</label>
            </div>
        </div>
        <div class="col-md-4 text-start pt-2 refresher">
            <div class="form-check form-switch  " style="width:250px">
                <input type="radio" class="form-check-input" id="training_result_poor" name="training_result_refresher" value="POOR - (70 AND BELOW)"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">POOR - (70 AND BELOW)</label>
            </div>
            <div class="form-check form-switch  " style="width:250px">
                <input type="radio" class="form-check-input" id="training_result_average" name="training_result_refresher" value="AVERAGE - (71 - 80)"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">AVERAGE - (71 - 80)</label>
            </div>
            <div class="form-check form-switch  " style="width:250px">
                <input type="radio" class="form-check-input" id="training_result_good" name="training_result_refresher" value="GOOD - (81-90)"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">GOOD - (81-90)</label>
            </div>
            <div class="form-check form-switch  " style="width:250px">
                <input type="radio" class="form-check-input" id="training_result_excellent" name="training_result_refresher" value="EXCELLENT - (91- 100)"  <?php echo $disable; ?> >
                <label class="form-check-label" for="training_result_pass">EXCELLENT - (91- 100)</label>
            </div>
        </div>
    </div>
    <div class="row mb-4" style="font-size: 0.8rem;">
        <div class="col-sm-1"></div>
        <div class="col-md-2 text-start">
            <div class="form-group floating-label">
                <select class="form-select" id="recommendation" name="recommendation" <?php echo $disable; ?> >
                    <option value="">Please Select</option>
                    <option value="REPEAT">REPEAT</option>
                    <option value="RE-SIT THEORY">RE-SIT THEORY</option>
                    <option value="RE-SIT PRACTICAL">RE-SIT PRACTICAL</option>
                    <option value="NO RECOMMENDATION">NO RECOMMENDATION</option>
                </select>
                <label for="super_name">Recommendation </label>
            </div>
            
        </div>
    </div>
    <input type='hidden' id='overall' name='overall' >
    <input type='hidden' id='eval_status' name='eval_status' >
    <input type='hidden' id='retrain' name='retrain' >
   
    <!-------------------------------End of Section -------------------------------------------------------------!-->

     <div class="text-end">
        <?php echo $button; ?>
    </div>


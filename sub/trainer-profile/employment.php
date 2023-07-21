<form id='trainer_employment' action="" method="post" autocomplete='off' name='trainer_employment'>
    <div class="row mb-4">    
        <div class="col-md-3 floating-label">
            <input type="text" id="syear" name="syear" class="form-control" placeholder="Enter working start year" value="" onkeyup="$(this).maskMoney();" maxlength="4">
            <label class="labels">Start Year</label>
        </div>
        <div class="col-md-3 floating-label">
            <input type="text" id="eyear" name="eyear" class="form-control" placeholder="Enter working end year" value="" onkeyup="$(this).maskMoney();" maxlength="4" >
            <label class="labels">End Year</label>
        </div>
        <div class="col-md-6 floating-label">
            <input type="text" id="designation" name='designation' class="form-control" placeholder="Enter designation" value="">
            <label class="labels">Designation</label>
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
        <button class="btn btn-prasarana" type="button" id='add_working'>Add Working History</button>
    </div>

    <br >
    <div class="card-title">Employment History</div>


    <div class="table-editor edited-table" id="table_history" data-mdb-entries="5" data-mdb-entries-options="[5, 10, 15, 20, 25]">
        <div class="table-editor__inner table-responsive ps" style="overflow: auto; position: relative;">
            <table class="table">
                <thead>
                <tr>
                    <th style="" > Start Year</th>
                    <th style="" > End Year</th>
                    <th style="" > Designation</th>
                    <th style="" > Division / Department</th>
                    <th style="" > Job Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr class=" ">
                        <td class="col-md-2">
                            <input type="text" id='syear1' name='syear1' class="form-control" placeholder="enter start year" value="">
                            
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='eyear1' name='eyear1' class="form-control" placeholder="enter end year" value="">
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='designation1' name='designation1' class="form-control" placeholder="enter designation" value="">
                        </td>
                        <td class="col-md-3">
                            <textarea id='dept1' name='dept1' rows='3' class='form-control' placeholder="enter division / department"></textarea>
                        </td>
                        <td class="col-md-3">
                            <textarea id='jd1' name='jd1' rows='3' class='form-control' placeholder="enter job description"></textarea>
                        </td>
                    </tr>
                    <tr class=" ">
                        <td class="col-md-2">
                            <input type="text" id='syear2' name='syear2' class="form-control" placeholder="enter start year" value="">
                            
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='eyear2' name='eyear2' class="form-control" placeholder="enter end year" value="">
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='designation2' name='designation2' class="form-control" placeholder="enter designation" value="">
                        </td>
                        <td class="col-md-3">
                            <textarea id='dept2' name='dept2' rows='3' class='form-control' placeholder="enter division / department"></textarea>
                        </td>
                        <td class="col-md-3">
                            <textarea id='jd2' name='jd2' rows='3' class='form-control' placeholder="enter job description"></textarea>
                        </td>
                    </tr>
                    <tr class=" ">
                        <td class="col-md-2">
                            <input type="text" id='syear3' name='syear3' class="form-control" placeholder="enter start year" value="">
                            
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='eyear3' name='eyear3' class="form-control" placeholder="enter end year" value="">
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='designation3' name='designation3' class="form-control" placeholder="enter designation" value="">
                        </td>
                        <td class="col-md-3">
                            <textarea id='dept3' name='dept3' rows='3' class='form-control' placeholder="enter division / department"></textarea>
                        </td>
                        <td class="col-md-3">
                            <textarea id='jd3' name='jd3' rows='3' class='form-control' placeholder="enter job description"></textarea>
                        </td>
                    </tr>
                    <tr class=" ">
                        <td class="col-md-2">
                            <input type="text" id='syear4' name='syear4' class="form-control" placeholder="enter start year" value="">
                            
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='eyear4' name='eyear4' class="form-control" placeholder="enter end year" value="">
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='designation4' name='designation4' class="form-control" placeholder="enter designation" value="">
                        </td>
                        <td class="col-md-3">
                            <textarea id='dept4' name='dept4' rows='3' class='form-control' placeholder="enter division / department"></textarea>
                        </td>
                        <td class="col-md-3">
                            <textarea id='jd4' name='jd4' rows='3' class='form-control' placeholder="enter job description"></textarea>
                        </td>
                    </tr>
                    <tr class=" ">
                        <td class="col-md-2">
                            <input type="text" id='syear5' name='syear5' class="form-control" placeholder="enter start year" value="">
                            
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='eyear5' name='eyear5' class="form-control" placeholder="enter end year" value="">
                        </td>
                        <td class="col-md-2">
                            <input type="text" id='designation5' name='designation5' class="form-control" placeholder="enter designation" value="">
                        </td>
                        <td class="col-md-3">
                            <textarea id='dept5' name='dept5' rows='3' class='form-control' placeholder="enter division / department"></textarea>
                        </td>
                        <td class="col-md-3">
                            <textarea id='jd5' name='jd5' rows='3' class='form-control' placeholder="enter job description"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>
<script type="text/javascript" src="assets/js/page/jf-trainer-profile-employment.js"></script>
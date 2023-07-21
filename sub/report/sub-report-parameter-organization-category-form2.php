                                <div class="card" style="overflow:visible;">
                                    <div class="card-body border" >
                                        <h1 class="card-title" style="font-size: 0.8rem;">Filter Parameter</h1>
                                        <div class="row mb-4">
                                            <div class="col-md-3 text-start">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control division_select" id="division" name="division"  placeholder="Enter Division Name" />
                                                    <label for="division">Division</label>
                                                    <div class='division_list' id='division_list' style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-start">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control department_select" id="department" name="department"  placeholder="Enter Department Name" />
                                                    <label for="department">Department</label>
                                                    <div class='department_list' id='department_list' style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-start">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control section_select" id="section" name="section"  placeholder="Enter Section Name" />
                                                    <label for="section">Section</label>
                                                    <div class='section_list' id='section_list' style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-start">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control unit_select" id="unit" name="unit"  placeholder="Enter Unit Name" />
                                                    <label for="unit">Unit</label>
                                                    <div class='unit_list' id='unit_list' style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-2 ">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control " id="sdate" name="sdate" placeholder="Enter Start Date" onfocus="this.blur();" />
                                                    <label for="sdt">Start Date</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2 ">
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control " id="edate" name="edate"  placeholder="Enter End Date" onfocus="this.blur();" />
                                                    <label for="edate">End Date</label>
                                                </div>
                                            </div>     
                                            <div class="col-md-4 ">
                                                <div class="form-group floating-label">
                                                   <select class="form-select " id="trainingcategory" name="trainingcategory">
                                                        <?php echo _select_option_training_category(true); ?>
                                                    </select>
                                                    <label class="mr-sm-2" for="trainingcategory">Training Category</label>
                                                </div>
                                            </div>                                 
                                            <div class="col-md-4 text-start">
                                                <button class="btn btn-prasarana" type="button" id='reset'>Reset</button>
                                                <button class="btn btn-prasarana" type="button" id='excel'>Export to Excel</button>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

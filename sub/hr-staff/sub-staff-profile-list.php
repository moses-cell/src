                            <h5 class="card-title"><?= $title ?></h5>
                                <div class="btn-list mb-4">
                                    <?php
                                        if (isset($button))
                                            echo $button;
                                    ?>
                                </div>
                                <table id="datatable" class="display cell-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th width="150px">Employee No</th>
                                            <th width="200px">Employee Name</th>
                                            <th width="200px">Position</th>
                                            <th width="200px">Personal Area</th>
                                            <th width="200px">Division</th>
                                            <th width="200px">Department</th>
                                            <th width="200px">Section</th>
                                            <th width="200px">Unit</th>
                                            <th width="50px">Grade</th>
                                            <th width="200px">Approver</th>
                                            <th width="200px">Supervisor</th>
                                            <th width="200px">Sec / Admin</th>
                                            <th width="200px">Depoh Admin</th>
                                            <th width="200px">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Employee No</th>
                                            <th>Employee Name</th>
                                            <th>Position</th>
                                            <th>Personal Area</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Section</th>
                                            <th>Unit</th>
                                            <th>Grade</th>
                                            <th>Approver</th>
                                            <th>Supervisor</th>
                                            <th>Sec / Admin</th>
                                            <th>Depoh Admin</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>     
                                    </tfoot>
                                </table>
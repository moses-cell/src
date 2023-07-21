<h5 class="card-title"><?= $title ?></h5>
                                <div class="btn-list mb-4">
                                    <button class="btn btn-prasarana" type="button" id='new'>New Employee Roles</button>
                                    <button class="btn btn-prasarana" type="button" id='excel'>Export to Excel</button>
                                    <button class="btn btn-prasarana" type="button" id='pdf'>Export to PDF</button>
                                </div>
                                <table id="datatable" class="display cell-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Staff Roles</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Staff No</th>
                                            <th>Staff Name</th>
                                            <th>Staff Roles</th>
                                            <th></th>
                                        </tr>     
                                    </tfoot>
                                </table>
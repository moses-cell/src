<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pending Approval List</h5>
        <table id="datatable" class="display cell-border masterTable" style="width:100%">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="100px">Staff No</th>
                    <th width="150px">Staff Name</th>
                    <th width="200px">Training title</th>
                    <th width="80px">Start Date</th>
                    <th width="80px">End Date</th>
                    <th width="50px">Total Days</th>
                    <th width="30px"></th>
                </tr>
            </thead>
            <tbody>
                <?php echo $pending_approval; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Staff No</th>
                    <th>Staff Name</th>
                    <th>Training title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Days</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

                
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pending My Evaluation</h5>
        <table id="datatable" class="display cell-border masterTable" style="width:100%">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="70px">Staff No</th>
                    <th width="200px">Staff Name</th>
                    <th width="200px">Training title</th>
                    <th width="80px">Start Date</th>
                    <th width="80px">End Date</th>
                    <th width="150px">Evaluation Type</th>
                    <th width="30px"></th>
                </tr>
            </thead>
            <tbody>
                <?php echo $pending_evaluation; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Staff No</th>
                    <th>Staff Name</th>
                    <th>Training title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Evaluation Type</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

                
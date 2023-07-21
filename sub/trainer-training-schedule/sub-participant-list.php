<?php //echo $add_participan; ?>
<button class="btn btn-prasarana mb-4 mt-2" type="button" id="excel">Print Participant List</button>
<?php echo $btn_notify; ?>
<div class="masterTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
<table id="participant_datatable" class="display cell-border masterTable" style=" width:100%">
    <thead>
        <tr>
            <?php if ($add_participan == '1') 
                echo '<th width="150px"></th>';
            ?>
            <th width="200px" >Participant Name</th>
            <th width="200px" >Department</th>
            <th width="200px" >Designation</th>
            <?php echo $thead; ?>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody; ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if ($add_participan == '1') 
                echo '<th></th>';
            ?>
            <th>Participant Name</th>
            <th>Department</th>
            <th>Designation</th>
            <?php echo $tfoot; ?>
        </tr>
    </tfoot>
</table>
</div>
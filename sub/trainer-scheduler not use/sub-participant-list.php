<?php echo $add_participan; ?>
<div class="masterTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
<table id="participant_datatable" class="display cell-border masterTable" style=" width:100%">
    <thead>
        <tr>
            <th width="200px" >Participant Name</th>
            <th width="200px" >Deparment</th>
            <th width="200px" >Designation</th>
            <?php echo $thead; ?>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Participant Name</th>
            <th>Deparment</th>
            <th>Designation</th>
            <?php echo $tfoot; ?>
        </tr>
    </tfoot>
</table>
</div>
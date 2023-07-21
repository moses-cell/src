<?php echo $add_participan; ?>


<div class="masterTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
<table id="participant_datatable" class="display cell-border masterTable" style=" width:100%">
    <thead>
        <tr>
            <?php if ($bol_cancel_participant  == '1') 

                echo '<th width="150px"></th>';
            ?>
            <th width="200px" >Participant Name</th>
            <th width="200px" >Department</th>
            <th width="200px" >Designation</th>
            <th width="100px" >Status</th>
            <?php echo $thead; ?>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody; ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if ($bol_cancel_participant  == '1') 
                echo '<th width="150px"></th>';
            ?>
            <th>Participant Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th width="100px" >Status</th>
            <?php echo $tfoot; ?>
        </tr>
    </tfoot>
</table>
</div>
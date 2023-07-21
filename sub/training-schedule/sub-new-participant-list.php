<table id="datatable" class="display cell-border " style=" width:100%">
    <thead>
        <tr>
            <th></th>
            <th width="200px" >Staff No</th>
            <th width="200px" >Staff Name</th>
            <th width="200px" >Department</th>
            <th width="200px" >Designation</th>
            <th width="200px" >Approver</th>
            <th width="200px" >Supervisor</th>
            <th width="200px" >Sec / Admin</th>
            <th width="200px" >Depoh Admin</th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>Staff No</th>
            <th>Staff Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Approver</th>
            <th>Supervisor</th>
            <th>Sec / Admin</th>
            <th>Depoh Admin</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<div class="text-end mt-4">
        <button class="btn btn-prasarana" type="button" id="close_dialog">Close</button>
</div>
<form id='data_form'>
    <input type='hidden' id='pageid' name='pageid' value='<?php echo $_GET['id']; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>

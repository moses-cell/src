<form id='data_form' action="" method="post" autocomplete='off' name='data_form' enctype="multipart/form-data">
    <div class="row mb-4"> <!-- Form Group (training title)-->
        <div class="col-md-8 ">
            <div class="form-group floating-label ">
                <input id="fileupload" name="fileupload" type="file" accept=".xls, .xlsx" class="fileupload form-control"  />
            </div>
            <input type="hidden" name="filename" id="filename">
        </div>
    </div>
    
    
    <!-- Save changes button-->
    <div class="text-end">
         <button class="btn btn-prasarana" type="button" id='download'>Download Template</button>
        <button class="btn btn-prasarana" type="button" id='upload'>Upload Data</button>
        <button class="btn btn-prasarana" type="button" id="close">Close</button>
    </div>

    <input type='hidden' id='data' name='data' value='<?php echo $data; ?>' />
    <input type='hidden' id='editor_name' name='editor_name' value='<?php echo $_SESSION['full_name']; ?>' />
</form>
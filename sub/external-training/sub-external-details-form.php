<nav class="nav">
    <a class="nav-link tab-link tab-link-active " id='applicant_tab' href="#profile">Applicant Information</a>
    <a class="nav-link tab-link" id='training_tab' href="#application">Training Information</a>
    <a class="nav-link tab-link" id='history_tab' href="#history">Training Applied History</a>
</nav>
<div class="text-start mb-1 p-3 ">
    <div class="row">
        <div class="col-md-8">
            <?php echo $appsbutton; ?>
        </div>
        <div class="col-md-4 text-end fw-bold" id='app_status'></div>
    </div>
</div>
<div class="card-body">
    <div id='applicant_form'>
        <div class="card-title mb-3">Employee Information</div>
        <?php include 'sub/training-application-details/sub-applicant-information-form.php'; ?>
    </div>
    <div id='training_form' style='display: none;'>
        <div class="card-title mb-3">Training Information</div>
        <?php include 'sub/external-training/sub-external-training-form.php'; ?>
    </div>
    <div id='history_form' style='display: none;'>
        <div class="card-title mb-3">Training History</div>
        <?php include 'sub/training-application-details/sub-training-history-list.php'; ?>
    </div>
</div>
<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-trainer-completion-notice.php";
    
    $pages_name = "Trainer Training Details Form";
    $title = "TRAINING COMPLETION NOTICE";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/modalhead.php" ?> 
        <link href="assets/css/jquery.confirm.css" rel="stylesheet" />
        <script src="assets/js/plugins/jquery-confirm.js"></script>


        <script src="assets/js/page/jf-training-completion-notice.js"></script>
    </head>
    <body class="nav-fixed bg-light" >
        <div id='email_body' style="max-width:1000px; ">
            <style type="text/css">
                .tbl_detail tr td  {
                    border: 1px solid;
                    padding: 10px;
                    border-collapse: collapse !important;
                   
                }

                td, td {
                    padding: 10px;
                    border-collapse: collapse;
                }
            </style>
            <p>Training Completion Notice</p>
            <p>Date : <?php echo date('d-m-Y') ?></p>
            <p>Course Title : <?php echo $traininig_title; ?></p>
            <p>Training Date : <?php echo $training_date; ?></p>
            <p>Trainer : <?php echo $trainer_name; ?></p>
            <br />
            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                We are pleased to notify that the following staffs have attended the course on scheduled date. They have fullfilled the course requirement and are now ready for departmental assessment.
            </p>

            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                Their results as indicated below:
            </p>

            <table style="margin-left: 0px; max-width:850px; border-collapse: collapse;"  class='tbl_detail'>
                <tr style="background: lightgray;">
                    <td width="50px">No</td>
                    <td width="250px">Name</td>
                    <td width="100px">Staff Id</td>
                    <td width="200px">Department</td>
                    <td width="150px">Result</td> 
                </tr>
                <?php echo $tbody; ?>
            </table>

            <?php echo $lst; ?>

            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                They are to report back to their own respective department soonest and are now ready for departmental assessment (Post Training Evaluation - PTE)
            </p>

            <p style="margin-left:0px;  line-height: 40px; max-width: 950px;">
                Supervisors need to complete with login Prasarana Integrated Training System (PRINTIS) (https://printis.prasarana.com.my). However, <b>PTE not applicable for Refresher Training</b>.
            </p>

            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                PTE form should be completed within (1) one month from the date of this notice. 
            </p>

            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                Academy will inform the result to department whether the staff is qualified/ not qualified to perform the job function assigned.
            </p>

            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                We appreciate your cooperation to ensure the acquired knowledge and skill of the staff is being put into practice accordingly.
            </p>

            <p style="margin-left:0px; line-height: 40px; max-width: 850px;">
                Regards,
            </p>
            
            <p style="margin-left:0px;  line-height: 40px; max-width: 850px;">
                <?php echo $trainer_name; ?>
            </p>


            
        </div>
        <div style="max-width:1000px">
            <button style="float: right; " class="btn btn-prasarana mb-4 mt-2" type="button" id="notice">Send Email Training Completion Notice</button>
        </div>
    </body>
</html>

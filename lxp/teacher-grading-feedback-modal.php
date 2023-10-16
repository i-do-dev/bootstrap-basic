<style style="text/css">
    .feedback_input_box {
        margin-top: 10px;
    }
    .feedback-btn {
        display: inline-block;
    }
</style>

<?php
$assignment = $args['assignment'];
$slide = $args['slide'];
$student = $args['student'];
$assignment_submission_id = $args['assignment_submission_id'];
?>

<!-- Modal -->
<div class="modal fade modal-lg" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-header-title">
                    <h2 class="modal-title" id="exampleModalLabel">Grade Feedback</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-3" id="feedbackForm">
                <input type="hidden" name="assignment" value="<?php echo $assignment; ?>" />
                <input type="hidden" name="slide" value="<?php echo $slide; ?>" />
                <input type="hidden" name="student" value="<?php echo $student; ?>" />
                <input type="hidden" name="assignment_submission_id" value="<?php echo $assignment_submission_id; ?>" />

                <div class="input_section">
                    <div class="input_box brief_input_box">
                        <div class="label_box brief_label_box">
                            <label class="label">Feedback</label>
                            <textarea class="brief_info form-control feedback_input_box" type="text" id="inputFeedback" name="feedback" placeholder="Enter grade feedback"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="input_section">
                    <div class="btn_box">
                        <button class="grade-box-btn feedback-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="grade-box-btn feedback-btn" id="assignFeedbackBtn"><span class="feedback-action">Add</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var feedbackModal = document.getElementById('feedbackModal');
        feedbackModalObj = new bootstrap.Modal(feedbackModal);
        window.feedbackModalObj = feedbackModalObj;

        jQuery("#addFeedbackModal").on('click', function() {
            feedbackModalObj.show();
        });
        
        let feedbackForm = jQuery("#feedbackForm");
        jQuery(feedbackForm).on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            // log all form data
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            /*
            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "feedback/save",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                jQuery('#feedbackForm .form-control').removeClass('is-invalid');
                feedbackModalObj.hide();
            }).fail(function (response) {
                jQuery('#feedbackForm .form-control').removeClass('is-invalid');
                if (response.responseJSON !== undefined) {
                    Object.keys(response.responseJSON.data.params).forEach(element => {
                        jQuery('input[name="' + element + '"]').addClass('is-invalid');
                        jQuery('textarea[name="' + element + '"]').addClass('is-invalid');
                    });
                }
            });
            */
        
        });

        feedbackModal.addEventListener('hide.bs.modal', function (event) {
            //jQuery('#inputFeedback').val("");
            //jQuery('.feedback-action').text("Add");
            //window.location.reload();
        });
    });
    
</script>
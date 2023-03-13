<?php
global $treks_src;
?>
<!-- Modal -->
<div class="modal fade modal-lg" id="schoolModal" tabindex="-1" aria-labelledby="schoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="schoolModalLabel">New School</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <!-- Add School Form -->
        <form class="row g-3" id="schoolForm" >
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <input type="hidden" name="post_id" value="0">
            <div class="col-md-12">
                <h5>School</h5>
            </div>
            <div class="col-md-12">
                <label for="inputSchoolName" class="form-label">School Name</label>
                <input type="text" class="form-control" id="inputSchoolName" name="school_name">
            </div>
            <div class="col-md-12">
                <label for="aboutTextarea" class="form-label">About School</label>
                <textarea class="form-control" id="inputAbout" name="school_about" rows="3"></textarea>
            </div>
            <div class="col-md-12">
                <h5>Administrator</h5>
            </div>
            <div class="col-md-3">
                <img src="<?php echo $treks_src; ?>/assets/img/profile-icon-lg.png" width="150" class="img-thumbnail" alt="Profile Image">
            </div>
            <div class="col-md-5">
                <label for="formFile" class="form-label">Upload Profile Picture</label>
                <input class="form-control" type="file" id="filePicture" name="profile_picture">
            </div>
            <div class="col-md-4">
            </div>

            <div class="col-md-6">
                <label for="inputFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="inputFirstName" name="first_name">
            </div>
            <div class="col-md-6">
                <label for="inputLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="inputLastName" name="last_name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="user_email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="user_password">
            </div>
            
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveSchoolBtn">Add</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    jQuery(document).ready(function() {
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var schoolModal = document.getElementById('schoolModal');
        schoolModalObj = new bootstrap.Modal(schoolModal);

        schoolModalObj.show();

        jQuery("#addSchoolModal").on('click', function() {
            schoolModalObj.show();
        });

        jQuery("#saveSchoolBtn").on('click', function() {
            jQuery("#schoolForm").submit();
        });
        
        let schoolForm = jQuery("#schoolForm");
        jQuery(schoolForm).on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "shools/save",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                jQuery('#schoolForm .form-control').removeClass('is-invalid');
                console.log("success >>>> " , response);
                // schoolModalObj.hide();
            }).fail(function (response) {
                jQuery('#schoolForm .form-control').removeClass('is-invalid');
                if (response.responseJSON !== undefined) {
                    Object.keys(response.responseJSON.data.params).forEach(element => {
                        jQuery('input[name="' + element + '"]').addClass('is-invalid');
                        jQuery('textarea[name="' + element + '"]').addClass('is-invalid');
                    });
                }
            });
        
        });
    });
    
</script>
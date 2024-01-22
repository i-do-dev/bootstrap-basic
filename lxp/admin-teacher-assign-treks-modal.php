<?php
global $treks_src;
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'tl_course',    
    'order' => 'asc'
);
$treks = get_posts($args);
?>

<style style="text/css">
    .teacher_input_box {
        padding: 0 0 30px !important;
    }
</style>

<!-- Teacher TREKs Modal -->
<div class="modal fade teachers-modal" id="teacherTreksModal" tabindex="-1" aria-labelledby="teacherTreksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-title">
                    <h2 class="modal-title" id="teacherTreksModalLabel"><span class="teacher-action-head">Restrict</span> Courses</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="teacherTreksForm">
                    <input type="hidden" name="teacher_post_id" id="teacher_post_id" value="0">
                    <div class="input_section">
                        <div class="input_box brief_input_box">
                            <!-- bootstrap html table with Select and Title columns. Select column should be checkbox array with select all checkbox -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="yes" id="select_all">
                                                <label class="form-check-label" for="select_all">
                                                    Select All
                                                </label>
                                            </div>
                                        </th>
                                        <th scope="col">Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($treks as $trek) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="treks[]" value="<?php echo $trek->ID; ?>"></td>
                                            <td>
                                                <img width="30" height="30" src="<?php echo $treks_src; ?>/assets/img/tr_main.jpg" class="rounded wp-post-image" /> 
                                                
                                                &nbsp <?php echo $trek->post_title; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn_box">
                            <button class="btn" id="saveTeacherBtn"><span class="teacher-action">Restrict</span></button>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    jQuery(document).ready(function() {
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var teacherTreksModal = document.getElementById('teacherTreksModal');
        teacherTreksModalObj = new bootstrap.Modal(teacherTreksModal);
        window.teacherTreksModalObj = teacherTreksModalObj;

        jQuery("#addTeacherModal").on('click', function() {
            teacherTreksModalObj.show();
        });

        let teacherTreksForm = jQuery("#teacherTreksForm");
        jQuery(teacherTreksForm).on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "teacher/treks/assign",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                jQuery('#teacherTreksForm .form-control').removeClass('is-invalid');
                teacherTreksModalObj.hide();
            }).fail(function (response) {
                jQuery('#teacherTreksForm .form-control').removeClass('is-invalid');
            });
        
        });

        teacherTreksModal.addEventListener('hide.bs.modal', function (event) {
            jQuery("#teacher_post_id").val(0);
            jQuery("#teacherTreksModal input[name='treks[]']").prop('checked', false);
            jQuery("#select_all").prop('checked', false);
            //window.location.reload();
        });

        jQuery("#select_all").on('click', function() {
            jQuery("#teacherTreksModal input[name='treks[]']").prop('checked', jQuery(this).prop('checked'));
        });
    });

    function onTeacherAssignCoursesClick(teacher_post_id) {
        jQuery("#teacher_post_id").val(teacher_post_id);

        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: apiUrl + "teacher/treks/assigned",
            data: {teacher_post_id}
        }).done(function( response ) {
            const teacher_treks = response.data;
            // set teacher_treks as checked
            jQuery("#teacherTreksModal input[name='treks[]']").prop('checked', false);
            teacher_treks.forEach(element => {
                jQuery("#teacherTreksModal input[name='treks[]'][value='" + element + "']").prop('checked', true);
            });
            teacherTreksModalObj.show();
        }).fail(function (response) {
            console.error("Can not load teacher");
        });
    }
    
</script>
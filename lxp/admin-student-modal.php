<?php
global $treks_src;
$school_post = $args['school_post'];
$teachers = $args['teachers'];
?>

<!-- Modal -->
<div class="modal fade students-modal" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-title">
                    <h2 class="modal-title" id="studentModalLabel"><span class="student-action">New</span> Student</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="studentForm">
                    <input type="hidden" name="school_admin_id" id="school_admin_id" value="<?php echo get_post_meta( $school_post->ID, 'lxp_school_admin_id', true ); ?>">
                    <input type="hidden" name="student_school_id" id="student_school_id" value="<?php echo $school_post->ID; ?>">
                    <!-- <input type="hidden" name="teacher_id" id="teacher_id" value="<?php // echo isset($_GET['teacher_id']) ? $_GET['teacher_id'] : 0; ?>"> -->
                    <input type="hidden" name="student_post_id" id="student_post_id" value="0">

                    <div class="personal_box">
                        <p class="personal-text">Personal information</p>
                        <!-- <div class="info_box">
                            <img class="action_logo" src="<?php // echo $treks_src ?>/assets/img/import.svg" alt="logo" />
                            <p class="personal-text import-text">Import info</p>
                        </div> -->
                    </div>
                    <!-- 
                    <div class="personal_box user-profile-box">
                        <img src="<?php // echo $treks_src ?>/assets/img/user-profile.svg" alt="logo" />
                        <div class="info_box">
                            <img class="action_logo" src="<?php // echo $treks_src ?>/assets/img/upload.svg" alt="logo" />
                            <p class="personal-text import-text">Upload</p>
                        </div>
                        <div class="info_box">
                            <img class="action_logo" src="<?php // echo $treks_src ?>/assets/img/delete-circled-outline.svg"
                                alt="logo" />
                            <p class="personal-text import-text remove_text">Remove</p>
                        </div>
                    </div>
                    -->

                    <div class="input_section">
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">First name</label>
                                <input class="form-control" type="text" name="first_name" id="first_name_student"
                                    placeholder="Enter student’s first name here" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">Last name</label>
                                <input class="form-control" type="text" name="last_name" id="last_name_student"
                                    placeholder="Enter student’s last name here" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">Username</label>
                                <input class="form-control" type="text" name="username" id="usernameStudent" placeholder="johndoe@gmail.com" />
                                <input type="hidden" id="inputUsernameDefaultStudent" name="username_default" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">Password</label>
                                <input class="form-control" type="password" name="user_password" id="passwordStudent" placeholder="***" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">ID</label>
                                <input class="form-control" type="text" name="student_id" id="idStudent" placeholder="Student ID" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">About</label>
                                <input class="form-control" type="text" name="about" id="aboutStudent"
                                    placeholder="Something about Student" />
                            </div>
                        </div>
                        <div class="input_box">
                            <div class="label_box">
                                <label class="label">Assign Teacher</label>
                                <!-- <input class="form-control" type="xxx" name="xxx" id="xxx" placeholder="***" /> -->
                                <select name="teacher_id" id="teacher_id" class="form-select">
                                    <option value="0">Select Teacher</option>
                                    <?php foreach ($teachers as $teacher) { ?>
                                        <option value="<?php echo $teacher->ID; ?>" <?php echo isset($_GET['teacher_id']) && $_GET['teacher_id'] == $teacher->ID ? "selected=selected" : ""; ?> ><?php echo $teacher->post_title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- 
                        <div class="input_box brief_input_box">
                            <div class="label_box brief_label_box id_label_box">
                                <label class="label">ID</label>
                                <input class="brief_info id_info" type="password" name="password"
                                    placeholder="0000" />
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="horizontal_line"></div>
                    <div class="input_section">
                        <h3 class="modal-title assign-text">Assign Grades</h3>
                        <div class="input_box brief_input_box">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox1" value="1st">
                                <label class="form-check-label" for="studentGradeCheckbox1">1st</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox2" value="2nd">
                                <label class="form-check-label" for="studentGradeCheckbox2">2nd</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox3" value="3rd">
                                <label class="form-check-label" for="studentGradeCheckbox3">3rd</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox4" value="4th">
                                <label class="form-check-label" for="studentGradeCheckbox4">4th</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox5" value="5th">
                                <label class="form-check-label" for="studentGradeCheckbox5">5th</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox6" value="6th">
                                <label class="form-check-label" for="studentGradeCheckbox6">6th</label>
                            </div>
                            <!-- <div class="label_box brief_label_box id_label_box">
                                <label class="label">Grade</label>
                                <div class="dropdown">
                                    <button class="input_dropdown" type="button" id="dropdownMenu2"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Select grades
                                        <img src="<?php // echo $treks_src ?>/assets/img/down-arrow.svg" alt="logo" />
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another
                                            action</button>
                                        <button class="dropdown-item" type="button">Something else
                                            here</button>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>

                        <div class="input_box brief_input_box">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox7" value="7th">
                                <label class="form-check-label" for="studentGradeCheckbox7">7th</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox8" value="8th">
                                <label class="form-check-label" for="studentGradeCheckbox8">8th</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input grade-checkbox" type="checkbox" name="grades[]" id="studentGradeCheckbox9" value="9th">
                                <label class="form-check-label" for="studentGradeCheckbox9">9th</label>
                            </div>
                        </div>

                        <!-- 
                        <div class="input_box brief_input_box">
                            <div class="label_box brief_label_box id_label_box">
                                <label class="label">Class</label>
                                <div class="dropdown">
                                    <button class="input_dropdown" type="button" id="dropdownMenu2"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Select classes
                                        <img src="<?php // echo $treks_src ?>/assets/img/down-arrow.svg" alt="logo" />
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another
                                            action</button>
                                        <button class="dropdown-item" type="button">Something else
                                            here</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="btn_box">
                            <button class="btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button class="btn" id="saveStudentBtn"><span class="student-action">Add</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

function onStudentEdit(student_id) {
    jQuery("#student_post_id").val(student_id);
    jQuery(".student-action").text("Update");
    
    let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
    let apiUrl = host + '/wp-json/lms/v1/';

    $.ajax({
        method: "POST",
        enctype: 'multipart/form-data',
        url: apiUrl + "students",
        data: {student_id}
    }).done(function( response ) {
        let student = response.data.student;
        let admin = response.data.admin.data;
        jQuery('#studentForm .form-control').removeClass('is-invalid');
        jQuery('#studentModal #aboutStudent').val(student.post_content);
        jQuery('#studentModal #idStudent').val(student.student_id);
        jQuery('#studentModal #teacher_id').val(student.teacher_id);
        jQuery('#studentModal #first_name_student').val(admin.first_name);
        jQuery('#studentModal #last_name_student').val(admin.last_name);
        jQuery('#studentModal #usernameStudent').val(admin.user_login);
        jQuery('#studentModal #inputUsernameDefaultStudent').val(admin.user_login);
        
        if (student.grades) {
            student.grades.forEach(grade => jQuery('#studentModal input.grade-checkbox[value=' + grade +']').prop('checked', true));
        }
        studentModalObj.show();
    }).fail(function (response) {
        console.error("Can not load student");
    });
}

    jQuery(document).ready(function() { 
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var studentModal = document.getElementById('studentModal');
        studentModalObj = new bootstrap.Modal(studentModal);
        window.studentModalObj = studentModalObj;

        studentModal.addEventListener('hide.bs.modal', function (event) {
            jQuery("#student_post_id").val(0);
            jQuery('#studentModal #aboutStudent').val("");
            jQuery('#studentModal #first_name_student').val("");
            jQuery('#studentModal #last_name_student').val("");
            jQuery('#studentModal #usernameStudent').val("");
            jQuery('#studentModal #inputUsernameDefaultStudent').val("");
            jQuery('#studentModal #passwordStudent').val("");
            window.location.reload();
        });

        let studentForm = jQuery("#studentForm");
        jQuery(studentForm).on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "students/save",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                jQuery('#studentForm .form-control').removeClass('is-invalid');
                studentModalObj.hide();
            }).fail(function (response) {
                jQuery('#studentForm .form-control').removeClass('is-invalid');
                if (response.responseJSON !== undefined) {
                    Object.keys(response.responseJSON.data.params).forEach(element => {
                        jQuery('#studentModal input[name="' + element + '"]').addClass('is-invalid');
                        jQuery('#studentModal textarea[name="' + element + '"]').addClass('is-invalid');
                        jQuery('#studentModal select[name="' + element + '"]').addClass('is-invalid');
                    });
                }
            });
        
        });
    });
</script>
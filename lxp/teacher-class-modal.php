<?php
global $treks_src;
?>

<div class="modal fade classs-modal" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered class-modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-title">
                    <h2 class="modal-title" id="classModalLabel"><span id="class-action-heading">New</span> Class</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="classForm">
                    <input type="hidden" name="class_teacher_id" id="class_teacher_id" value="<?php echo get_current_user_id(); ?>" />
                    <input type="hidden" name="class_post_id" id="class_post_id" value="0" />
                    <div class="personal_box">
                        <!-- Left Class box -->
                        <div class="class-information">
                            <p class="personal-text">Class information</p>
                            <div class="search_box">
                                <label class="trek-label">Class name</label>
                                <input type="text" class="period-select" value="" id="class_name" name="class_name" />
                            </div>
                            <div class="search_box">
                                <label class="trek-label">Description</label>
                                <textarea class="period-select" id="class_description" name="class_description"></textarea>
                            </div>
                            <div class="horizontal-line"></div>
                            <p class="personal-text">Schedule</p>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <td>Day</td>
                                        <td>Start time</td>
                                        <td>End time</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td><input type="time" id="monday-sd" name="monday-sd"></td>
                                        <td><input type="time" id="monday-ed" name="monday-ed"></td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td><input type="time" id="tuesday-sd" name="tuesday-sd"></td>
                                        <td><input type="time" id="tuesday-ed" name="tuesday-ed"></td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td><input type="time" id="wednesday-sd" name="wednesday-sd"></td>
                                        <td><input type="time" id="wednesday-ed" name="wednesday-ed"></td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td><input type="time" id="thursday-sd" name="thursday-sd"></td>
                                        <td><input type="time" id="thursday-ed" name="thursday-ed"></td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td><input type="time" id="firday-sd" name="firday-sd"></td>
                                        <td><input type="time" id="firday-ed" name="firday-ed"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Left Class box -->

                        <!-- Vertical Line -->
                        <div class="vertical-line"></div>

                        <!-- Right Class box -->
                        <div class="class-information class-information">
                            <p class="personal-text">Classs</p>

                            <!-- Select Grade -->
                            <div class="search_box">
                                <label class="trek-label">Grade</label>
                                <div class="dropdown period-box">
                                    <button class="input_dropdown dropdown-button" type="button"
                                        id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Select a Grade
                                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg"
                                            alt="logo" />
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item dropdown-class">
                                            <p>1st grade</p>
                                        </button>
                                        <button class="dropdown-item dropdown-class" type="button">
                                            <p>2d grade</p>
                                        </button>
                                        <button class="dropdown-item dropdown-class" type="button">
                                            <p>3rd grade</p>
                                        </button>
                                        <button class="dropdown-item dropdown-class" type="button">
                                            <p>4th grade</p>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- When Selected a Grade -->
                            <div class="search_box">
                                <label class="trek-label">Grade</label>
                                <div class="dropdown period-box">
                                    <button class="input_dropdown dropdown-button second-drop-button"
                                        type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        3rd period
                                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg"
                                            alt="logo" />
                                    </button>
                                    <div class="dropdown-menu grade-dropdown-menu"
                                        aria-labelledby="dropdownMenu2">
                                        <!-- Select All -->
                                        <button class="dropdown-item dropdown-item2 practice-button">
                                            <!-- Select Grade -->
                                            <div class="time-date-box class-class-box">
                                                <input class="form-check-input " type="checkbox"
                                                    value="" id="checkbox" />
                                                <div class="tags-body-detail">
                                                    <p class="select-all">Select All</p>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="scroll-box">
                                            <!-- Grade-->
                                            <button
                                                class="dropdown-item dropdown-item2 practice-button">
                                                <!-- Select Grade -->
                                                <div class="time-date-box class-class-box">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="check" />
                                                    <img src="<?php echo $treks_src; ?>/assets/img/class-student.svg"
                                                        alt="logo" />
                                                    <div class="tags-body-detail">
                                                        <p class="class-name">Gabriella Hawkins</p>
                                                    </div>
                                                </div>
                                            </button>
                                            <!-- Grade-->
                                            <button
                                                class="dropdown-item dropdown-item2 practice-button">
                                                <!-- Select Grade -->
                                                <div class="time-date-box class-class-box">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="check" />
                                                    <img src="<?php echo $treks_src; ?>/assets/img/class-student.svg"
                                                        alt="logo" />
                                                    <div class="tags-body-detail">
                                                        <p class="class-name">Gabriella Hawkins</p>
                                                    </div>
                                                </div>
                                            </button>
                                            <!-- Grade-->
                                            <button
                                                class="dropdown-item dropdown-item2 practice-button">
                                                <!-- Select Grade -->
                                                <div class="time-date-box class-class-box">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="check" />
                                                    <img src="<?php echo $treks_src; ?>/assets/img/class-student.svg"
                                                        alt="logo" />
                                                    <div class="tags-body-detail">
                                                        <p class="class-name">Gabriella Hawkins</p>
                                                    </div>
                                                </div>
                                            </button>
                                            <!-- Grade-->
                                            <button
                                                class="dropdown-item dropdown-item2 practice-button">
                                                <!-- Select Grade -->
                                                <div class="time-date-box class-class-box">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="check" />
                                                    <img src="<?php echo $treks_src; ?>/assets/img/class-student.svg"
                                                        alt="logo" />
                                                    <div class="tags-body-detail">
                                                        <p class="class-name">Gabriella Hawkins</p>
                                                    </div>
                                                </div>
                                            </button>
                                            <!-- Grade-->
                                            <button
                                                class="dropdown-item dropdown-item2 practice-button">
                                                <!-- Select Grade -->
                                                <div class="time-date-box class-class-box">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="check" />
                                                    <img src="<?php echo $treks_src; ?>/assets/img/class-student.svg"
                                                        alt="logo" />
                                                    <div class="tags-body-detail">
                                                        <p class="class-name">Gabriella Hawkins</p>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button Section -->
                    <div class="input_section">
                        <div class="btn_box class_btns">
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button class="btn" id="class-action">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

function onClassEdit(class_id) {
    jQuery("#class_post_id").val(class_id);
    jQuery(".class-action").text("Update");
    
    let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
    let apiUrl = host + '/wp-json/lms/v1/';

    $.ajax({
        method: "POST",
        enctype: 'multipart/form-data',
        url: apiUrl + "classs",
        data: {class_id}
    }).done(function( response ) {
        let class_record = response.data.class;
        let admin = response.data.admin.data;
        jQuery('#classForm .form-control').removeClass('is-invalid');
        jQuery('#classModal #aboutClass').val(class_record.post_content);
        jQuery('#classModal #first_name_class').val(admin.first_name);
        jQuery('#classModal #last_name_class').val(admin.last_name);
        jQuery('#classModal #emailClass').val(admin.user_email);
        jQuery('#classModal #inputEmailDefaultClass').val(admin.user_email);
        
        if (class_record.grades) {
            class_record.grades.forEach(grade => jQuery('#classModal input.grade-checkbox[value=' + grade +']').prop('checked', true));
        }
        classModalObj.show();
    }).fail(function (response) {
        console.error("Can not load class");
    });
}

    jQuery(document).ready(function() { 
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var classModal = document.getElementById('classModal');
        classModalObj = new bootstrap.Modal(classModal);
        window.classModalObj = classModalObj;
        
        classModal.addEventListener('hide.bs.modal', function (event) {
            
            jQuery("#class_post_id").val(0);
            jQuery('#classModal #aboutClass').val("");
            jQuery('#classModal #first_name_class').val("");
            jQuery('#classModal #last_name_class').val("");
            jQuery('#classModal #emailClass').val("");
            jQuery('#classModal #inputEmailDefaultClass').val("");
            jQuery('#classModal #passwordClass').val("");
            window.location.reload();
        });

        let classForm = jQuery("#classForm");
        jQuery(classForm).on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "classs/save",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                jQuery('#classForm .form-control').removeClass('is-invalid');
                classModalObj.hide();
            }).fail(function (response) {
                jQuery('#classForm .form-control').removeClass('is-invalid');
                if (response.responseJSON !== undefined) {
                    Object.keys(response.responseJSON.data.params).forEach(element => {
                        jQuery('#classModal input[name="' + element + '"]').addClass('is-invalid');
                        jQuery('#classModal textarea[name="' + element + '"]').addClass('is-invalid');
                    });
                }
            });
        
        });
    });
</script>
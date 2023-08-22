<?php
    global $treks_src;
    $userdata = get_userdata(get_current_user_id());
    $teacher_post = lxp_get_teacher_post($userdata->data->ID);
    //$classes = lxp_get_teacher_classes($teacher_post->ID);
    $default_classes = lxp_get_teacher_default_classes($teacher_post->ID);
    $classes = lxp_get_teacher_group_by_type($teacher_post->ID, 'classes');
    $classes = array_merge($default_classes, $classes);
    $other_groups = lxp_get_teacher_group_by_type($teacher_post->ID, 'other_group');
?>
<input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $teacher_post->ID; ?>" />
<div class="tab-pane fade show" id="step-3-tab-pane" role="tabpanel" aria-labelledby="step-3-tab" tabindex="2">

    <!-- New Assignment -->
    <section class="calendar-container select-assignment-section third-tab-section">
        <!-- New Assignment Calendar -->
        <div class="select-trek-box" id="new_assignment_data_2">
            <h3 class="new-assignment-heading">New Assignment</h3>
            <div class="select-calendar-box third-tab-calendar-box">
                <h4 class="new-assignment-heading select-calendar-heading">Calendar</h4>
                <div class="calendar-time-date third-tab-date-time">
                    <img src="<?php echo $treks_src; ?>/assets/img/clock-outline.svg" alt="logo" />
                    <div class="time-date-box days-box">
                        <div class="time-date-box">
                            <p class="date-time">Thursday, February 23</p>
                            <p class="date-time">09:00 am</p>
                            <p class="date-time to-text">To</p>
                            <p class="date-time">10:00 am</p>
                        </div>
                        <!-- <label class="to-text all-day-label">
                            <input class="form-check-input" type="checkbox" />
                            All day
                        </label> -->
                    </div>
                </div>
                <!-- TREK -->
                <h4 class="new-assignment-heading select-calendar-heading third-calendar-heading">TREK</h4>
                <div class="third-trek-box">
                    <div class="third-card-box">
                        <img src="<?php echo $treks_src; ?>/assets/img/interdependence-logo.svg" alt="img" />
                        <p class="interdependence-text">5.12A Interdependence</p>
                    </div>
                    <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="img" />
                </div>
                <!-- horizontal line -->
                <div class="horizontal-line"></div>
                <!-- RPA Segment -->
                <h4 class="new-assignment-heading select-calendar-heading">RPA Segments</h4>
                <div class="third-trek-box recall-trek-box">
                    <!-- Recall -->
                    <div class="tags-body recall-poly-body">
                        <div class="tags-body-polygon">
                            <span>R</span>
                        </div>
                        <div class="tags-body-detail">
                            <span>Recall</span>
                        </div>
                    </div>
                    <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="img" />
                </div>
                <div class="third-trek-box practice-trek-box">
                    <!-- Practice A -->
                    <div class="tags-body pa-poly-body">
                        <div class="tags-body-polygon ">
                            <span>P</span>
                        </div>
                        <div class="pa-body-detail">
                            <span>Practice A</span>
                        </div>
                    </div>
                    <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="img" />
                </div>
                <!-- horizontal line -->
                <div class="horizontal-line"></div>

                <!-- Number of Students -->
                <h4 class="new-assignment-heading select-calendar-heading">Students</h4>

                <!-- Student Period and Grade-->
                <div class="time-date-box days-box">
                    <div class="time-date-box">
                        <p class="date-time student-period">Science 3rd period</p>
                        <p class="date-time student-period">5th grade</p>
                        <p class="date-time student-period">8 students</p>
                    </div>
                </div>

                <!-- Select Student Profile logos -->
                <div class="select-students-logos">
                    <img class="" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                </div>
            </div>
        </div>

        <!-- Vertical Line -->
        <div class="tab-vertical-line"></div>

        <!-- Assign Content -->
        <div class="select-trek-box assign-content">
            <h3 class="new-assignment-heading assign-heading">Assign Content</h3>
            <p class="date-time assign-text">What class would you like to assign to?
            <div class="search_box">
                <label class="trek-label">Classes/Other Group</label>
                <input type="hidden" id="class_id" name="class_id" value="" />
                <select onChange="class_select()" class="form-select form-control" aria-label="Default select example" name="classes_other_group" id="classes_other_group">
                    <option value="0">Select Classe/Other Group</option>
                    <optgroup value="classes" label="Classes">
                        <?php
                            foreach ($classes as $class) {
                        ?>
                            <option value="<?php echo $class->ID; ?>"><?php echo $class->post_title; ?></option>
                        <?php        
                            }
                        ?>
                    </optgroup>
                    <optgroup value="other_group" label="Other Group">
                        <?php
                            foreach ($other_groups as $other_group) {
                        ?>
                            <option value="<?php echo $other_group->ID; ?>"><?php echo $other_group->post_title; ?></option>
                        <?php        
                            }
                        ?>
                    </optgroup>
                </select>
            </div>
            <div class="invalid-feedback" id="class_select_error">
                Please Select Classe/Other Group
            </div>

            <!-- Select a Students -->
            <div class="search_box">
                <label class="trek-label">Small Groups</label>                 
                <div class="dropdown period-box">
                    <input type="hidden" id="group_id" name="group_id" value="" />
                    <button class="input_dropdown dropdown-button" type="button" id="smallGroupDD"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="group_title">Select Small Group</span>
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="smallGroupDD">
                        <div id="small-groups-container"></div>                        
                    </div>
                </div> 
            </div>
            <div class="invalid-feedback" id="group_select_error">
                Please Select Small Group
            </div>
            
            <!-- Select a Students -->
            <div class="search_box">
                <label class="trek-label">Students</label>
                <div class="dropdown period-box">
                    <button class="input_dropdown dropdown-button second-drop-button" type="button"
                        id="studentsDD" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="select-students-label">Select Students</span>
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="studentsDD">
                        <!-- Select All -->
                        <button class="dropdown-item dropdown-item2 practice-button">
                            <!-- Select Student -->
                            <div class="time-date-box class-student-box">
                                <input class="form-check-input " type="checkbox" id="select-all-students" id="checkbox" />
                                <div class="tags-body-detail">
                                    <p class="select-all">Select All</p>
                                </div>
                            </div>
                        </button>
                        <div class="scroll-box">
                            <div id="students-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invalid-feedback" id="students_select_error">
                Please Select Students
            </div>
        </div>

    </section>

    <!-- Button Section -->
    <section class="calendar-container select-assignment-section btns-container">
        <div class="input_section">
            <div class="btn_box profile_buttons">
                <button class="btn profile_btn" type="button" onclick="go_previous()">Previous</button>
                <button class="btn profile_btn" id="assignment-create-btn">Create</button>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
    let apiUrl = host + '/wp-json/lms/v1/';
    window.selected_students_ids = [];

    function class_select() {
        var class_id = jQuery('#classes_other_group :selected').val();
        jQuery('#class_id').val(class_id);
        jQuery('#group_id').val("");
        jQuery('#group_title').text("Select Small Group");
        jQuery("#select-students-label").text("Select Students");
        jQuery("#select-all-students").prop("checked", false);
        jQuery("#students-container").empty();
        window.selected_students_ids = [];
        jQuery('.select-students-logos').html("");
        jQuery('.students_count_label').text("0");
        fetch_small_groups(class_id);
    }

    function fetch_small_groups(class_id) {        
        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: apiUrl + "class/groups",
            data: {class_id}
        }).done(function( response ) {
            window.class_small_group = response.data.small_groups;
            let class_small_group_html = window.class_small_group.map(small_group => class_small_group_dd_html(small_group)).join('\n');
            jQuery('#small-groups-container').html(class_small_group_html);
        }).fail(function (response) {
            console.error("Can not load class");
        });
    }

    function class_small_group_dd_html(small_group) {
        var title = "'"+small_group.post_title+"'";;
        return `
        <button class="dropdown-item dropdown-small-group" onclick="fetch_group_student(`+small_group.ID+`, `+title+`)">
            <p>`+small_group.post_title+`</p>
        </button>
        `;
    }
    

    function fetch_group_student(group_id, group_title) {
        jQuery('#group_id').val(group_id);
        jQuery('#group_title').text(group_title);
        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: apiUrl + "group/students",
            data: {group_id}
        }).done(function( response ) {
            window.class_students = response.data.students;
            let class_students_dd_html = window.class_students.map(student => class_student_dd_html(student)).join('\n');
            jQuery('#students-container').html(class_students_dd_html);
            class_students_select_event_init();
        }).fail(function (response) {
            console.error("Can not load class");
        });
    }

    function class_student_dd_html(student) {
        return `
        <button class="dropdown-item dropdown-item2 practice-button">
            <div class="time-date-box class-student-box">
                <input class="form-check-input" type="checkbox" value="` + student.post.ID + `" id="student_id_` + student.post.ID + `" name="student_ids[]" />
                <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="logo" />
                <div class="tags-body-detail">
                    <p class="student-name">` + student.user.user_email + `</p>
                </div>
            </div>
        </button>
        `;
    }
    
    function class_students_select_event_init() {
        jQuery("input[name='student_ids[]']").on('change', function(e) {
            onStudentsCheckboxSelect();
        });
    } 
    
    function onStudentsCheckboxSelect() {
        window.selected_students_ids = jQuery("input[name='student_ids[]']:checked").get().map(student_checkbox => jQuery(student_checkbox).val());
        let selected_students_label = window.selected_students_ids.length > 0 ? window.selected_students_ids.length : "Select Students";
        jQuery("#select-students-label").text(selected_students_label);
        jQuery(".students_count_label").text(window.selected_students_ids.length);
        set_student_logos();
    }

    function set_student_logos() {
        let logos_html = window.selected_students_ids.map(student_id => `<img class="student-logo" src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="logo" />`).join('\n');
        jQuery('.select-students-logos').html(logos_html);
    }

    function create_assignment() {

        let ok = true;
        if (!parseInt(jQuery("#class_id").val())) {
            ok = false;
            jQuery("#class_select_error").show();
        } else {
            jQuery("#class_select_error").hide();
        }

        if (!parseInt(jQuery("#group_id").val())) {
            ok = false;
            jQuery("#group_select_error").show();
        } else {
            jQuery("#group_select_error").hide();
        }

        if (window.selected_students_ids.length == 0) {
            ok = false;
            jQuery("#students_select_error").show();
        } else {
            jQuery("#students_select_error").hide();
        }

        if (ok) {
            let trek_id = jQuery("#trek_id").val()
            let segments_ids = jQuery("input[name='segments[]']:checked").get().map(segment => jQuery(segment).val());
            let segments_title = jQuery("input[name='segments[]']:checked").get().map(segment => jQuery(segment).attr('title'));
            let class_id = jQuery('#class_id').val();
            let group_id = jQuery('#group_id').val();
            let teacher_id = jQuery('#teacher_id').val();

            let formData = new FormData();
            formData.append('trek_id', trek_id);
            formData.append('segments_ids', JSON.stringify(segments_ids));
            formData.append('segments_title', JSON.stringify(segments_title));
            formData.append('class_id', class_id);
            formData.append('group_id', group_id);
            formData.append('student_ids', JSON.stringify(window.selected_students_ids));
            formData.append('teacher_id', teacher_id);
            formData.append('assignment_post_id', '0');
            formData.append('calendar_selection_info', JSON.stringify(window.calendarSelectionInfo));

            jQuery("#assignment-create-btn").attr("disabled", "disabled");

            $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: apiUrl + "assignments/save",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function( response ) {
                resetWizard();
                bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-1-tab')).show();
                window.calendar.refetchEvents();
                console.log("assignment created successfully.");
                jQuery("#assignment-create-btn").removeAttr("disabled");
            }).fail(function (response) {
                console.error(response);
                jQuery("#assignment-create-btn").removeAttr("disabled");
            });            
        }
    }

    jQuery(document).ready(function() {

        jQuery("#select-all-students").on('change', function(e) {
            if (jQuery(this).prop('checked')) {
                jQuery("input[name='student_ids[]']").prop('checked', true);
            } else {
                jQuery("input[name='student_ids[]']").prop('checked', false);
            }
            onStudentsCheckboxSelect();
        });

        jQuery("#assignment-create-btn").on('click', function(e) {
            create_assignment();
        });
    });

    function resetWizard() {
        jQuery("#class_id").val("");
        jQuery('#group_id').val("");
        jQuery('#group_title').text("Select Small Group");
        jQuery("#select-students-label").text("Select Students");
        jQuery("#select-all-students").prop("checked", false);
        jQuery("#students-container").empty();
        window.selected_students_ids = [];
        jQuery('.select-students-logos').html("");
        jQuery('.students_count_label').text("0");
    }
</script>
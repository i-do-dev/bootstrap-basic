<?php
    global $treks_src, $trek_post;
    
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'tl_trek',
        'meta_key'        => 'sort',
        'orderby'        => 'meta_value_num',
        'order' => 'asc'
    );
    $treks = get_posts($args);
    if ( isset($_GET['trek']) && $_GET['trek'] == 0 && isset($_GET['segment']) && $_GET['segment'] == 0 ) {
        $trek_post = $treks[0];
    }
    $select_trek_title = !boolval($trek_post) ? "Select a TREK" : $trek_post->post_title;    
    $trek_id = $trek_post ? $trek_post->ID : 0;

    global $wpdb;    
    $trek_sections = ( boolval($trek_post) ) ? $wpdb->get_results("SELECT * FROM {$wpdb->prefix}trek_sections WHERE trek_id={$trek_post->ID} ORDER BY sort") : [];

    $overview = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Overview"; }));
    $recall = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Recall"; }));
    $practice_a = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Practice A"; }));
    $practice_b = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Practice B"; }));
    $apply = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Apply"; }));
    $segment_id = isset($_GET['segment']) ? $_GET['segment'] : null;
    $select_segment_title = $segment_id ? "1" : "Select a RPA segment";

?>
<div class="tab-pane fade show" id="step-2-tab-pane" role="tabpanel" aria-labelledby="setp-2-tab" tabindex="1">

    <!-- New Assignment Calendar Section -->
    <section class="calendar-container select-assignment-section">

        <!-- New Assignment -->
        <div class="select-trek-box" id="new_assignment_data_1">
            <h3 class="new-assignment-heading">New Assignment</h3>
            <div class="select-calendar-box">
                <h4 class="new-assignment-heading select-calendar-heading">Calendar</h4>
                    <a href='javascript:void();' onClick='set_date_time();'>
                    <div class="calendar-time-date <?php echo boolval($trek_post) ? 'third-tab-date-time' : '' ?>">
                        <img src="<?php echo $treks_src; ?>/assets/img/clock-outline.svg" alt="logo" />                    
                        <div class="time-date-box days-box">
                            <div class="time-date-box">
                                <p class="date-time"><span id="assignment_day"></span>, <span id="assignment_month"></span> <span id="assignment_date"></span></p>
                                <p class="date-time" id="assignment_time_start"></p>
                                <p class="date-time to-text">To</p>
                                <p class="date-time"><span id="assignment_day_end"></span>, <span id="assignment_month_end"></span> <span id="assignment_date_end"></span></p>
                                <p class="date-time" id="assignment_time_end"></p>
                            </div>
                            <!-- <label class="to-text all-day-label">
                                <input class="form-check-input" type="checkbox" />
                                All day
                            </label> -->
                        </div>                    
                    </div>
                </a>
                
                <?php if (boolval($trek_post)) { ?>
                    <!-- TREK -->
                    <h4 class="new-assignment-heading select-calendar-heading third-calendar-heading">TREK</h4>
                    <div class="third-trek-box">
                        <div class="third-card-box">
                            <img src="<?php echo $treks_src; ?>/assets/img/interdependence-logo.svg" alt="img" />
                            <p class="trek_title"><?php echo $select_trek_title ?></p>
                        </div>
                        <!-- <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="img" /> -->
                    </div>
                    <!-- horizontal line -->
                    <div class="horizontal-line"></div>
                    <!-- RPA Segment -->
                    <h4 class="new-assignment-heading select-calendar-heading">RPA Segments</h4>
                    <div id="rpa_segments_container">
                        <?php 
                            if ( $_GET['segment'] > 0 ) {
                                $trek_section = get_trek_section_by_id($_GET['segment']);
                                $trek_notation = implode('-', explode(' ', strtolower($trek_section->title)));
                        ?>
                            <div class="third-trek-box <?php echo $trek_notation; ?>-trek-box">
                                <!-- Selected Section -->
                                <div class="tags-body <?php echo $trek_notation; ?>-poly-body">
                                    <div class="tags-body-polygon">
                                        <span><?php echo $trek_section->title[0]; ?></span>
                                    </div>
                                    <div class="tags-body-detail">
                                        <span><?php echo $trek_section->title; ?></span>
                                    </div>
                                </div>
                                <!-- <img class="cursor-img" src="<?php //echo $treks_src; ?>/assets/img/delete.svg" alt="img" /> -->
                            </div>
                        <?php } } ?>                        
                    </div>                     
                    
                    <!-- horizontal line -->
                <div class="horizontal-line"></div>

                <!-- Number of Students -->
                <h4 class="new-assignment-heading select-calendar-heading">Students</h4>

                <!-- Student Period and Grade-->
                <div class="time-date-box days-box">
                    <div class="time-date-box">
                        <!-- <p class="date-time student-period">Science 3rd period</p>
                        <p class="date-time student-period">5th grade</p> -->
                        <p class="date-time student-period"><span class="student_count students_count_label">0</span> students</p>
                    </div>
                </div>

                <!-- Select Student Profile logos -->
                <div class="select-students-logos">
                    <!-- <img class="" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" />
                    <img class="student-logo" src="<?php //echo $treks_src; ?>/assets/img/class-student.svg" alt="logo" /> -->
                </div>

            </div>
        </div>

        <!-- Vertical Line -->
        <div class="tab-vertical-line"></div>

        <!-- Assign Content -->
        <div class="select-trek-box assign-content">
            <h3 class="new-assignment-heading assign-heading">Assign Content</h3>
            <p class="date-time assign-text">Select a content to assign</p>
            <div class="search_box">
                <input type="hidden" name="trek_id" id="trek_id" value="<?php echo $trek_id ?>" />
                <label class="trek-label">TREK</label>
                <div class="dropdown period-box">
                    <button class="input_dropdown dropdown-button" type="button" id="dropdownMenu2"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="trek_title"><?php echo $select_trek_title; ?></span>
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        
                        <?php foreach ($treks as $trek) { ?>
                            <button class="dropdown-item dropdown-item2 dropdown-class" onclick="set_trek_id(<?php echo $trek->ID; ?>, '<?php echo $trek->post_title; ?>')">
                                <div class="third-card-box">
                                    <img src="<?php echo $treks_src; ?>/assets/img/interdependence-logo.svg" alt="img" />
                                    <p class="interdependence-text"><?php echo $trek->post_title; ?></p>
                                </div>
                            </button>
                        <?php } ?>
                        <!-- <button class="dropdown-item dropdown-item2 dropdown-class">
                            <div class="third-card-box">
                                <img src="<?php //echo $treks_src; ?>/assets/img/interdependence-logo.svg" alt="img" />
                                <p class="interdependence-text">5.12A Interdependence</p>
                            </div>
                        </button>
                        <button class="dropdown-item dropdown-item2 dropdown-class" type="button">
                            <div class="third-card-box">
                                <img src="<?php //echo $treks_src; ?>/assets/img/unsplash-logo.svg" alt="img" />
                                <p class="interdependence-text">5.7B Forces & Experimental Design</p>
                            </div>
                        </button>
                        <button class="dropdown-item dropdown-item2 dropdown-class" type="button">
                            <div class="third-card-box">
                                <img src="<?php //echo $treks_src; ?>/assets/img/unsplash-logo2.svg" alt="img" />
                                <p class="interdependence-text">5.6A Physical Properties</p>
                            </div>
                        </button> -->
                        
                    </div>
                </div>
                <div class="invalid-feedback" id="trek_select_error">
                    Please select TREK
                </div>
            </div>
            <div class="search_box">
                <label class="trek-label">RPA segment</label>

                <!-- Select a RPA segment -->
                <div class="dropdown period-box">
                    <button class="input_dropdown dropdown-button second-drop-button" type="button" id="rpaSegmentsDD" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="select-segment-title"><?php echo $select_segment_title ?></span>
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="rpaSegmentsDD">
                        <!-- Recall Button-->
                        <button
                            class="dropdown-item dropdown-item2 polygon-button overview-button dropdown-class">
                            <!-- overview -->
                            <div class="tags-body select-tags-body-polygon overview-poly-body">
                                <input class="form-check-input input-overview" type="checkbox" value="<?php echo $overview ? $overview[0]->id : '' ?>" title="Overview" id="Recall" name="segments[]" <?php echo $overview && $overview[0]->id == $segment_id ? 'checked=checked' : '' ?> />
                                <div class="tags-body-polygon">
                                    <span>O</span>
                                </div>
                                <div class="tags-body-detail">
                                    <span>Overview</span>
                                </div>
                            </div>
                        </button>
                        <button
                            class="dropdown-item dropdown-item2 polygon-button recall-button dropdown-class">
                            <!-- Recall -->
                            <div class="tags-body select-tags-body-polygon recall-poly-body">
                                <input class="form-check-input input-recall" type="checkbox" value="<?php echo $recall ? $recall[0]->id : '' ?>" title="Recall" id="Recall" name="segments[]" <?php echo $recall && $recall[0]->id == $segment_id ? 'checked=checked' : '' ?> />
                                <div class="tags-body-polygon">
                                    <span>R</span>
                                </div>
                                <div class="tags-body-detail">
                                    <span>Recall</span>
                                </div>
                            </div>
                        </button>
                        <!-- Practice Button A -->
                        <button
                            class="dropdown-item dropdown-item2 polygon-button practice-button dropdown-class">
                            <!-- Practice A -->
                            <div class="tags-body select-tags-body-polygon pa-poly-body">
                                <input class="form-check-input input-practiceA" type="checkbox" value="<?php echo $practice_a ? $practice_a[0]->id : '' ?>" title="Practice A" id="practiceA" name="segments[]" <?php echo $practice_a && $practice_a[0]->id == $segment_id ? 'checked=checked' : '' ?> />
                                <div class="tags-body-polygon ">
                                    <span>P</span>
                                </div>
                                <div class="pa-body-detail">
                                    <span>Practice A</span>
                                </div>
                            </div>
                        </button>
                        <!-- Practice Button B -->
                        <button
                            class="dropdown-item dropdown-item2 polygon-button practice-button dropdown-class">
                            <!-- Practice B -->
                            <div class="tags-body select-tags-body-polygon pa-poly-body">
                                <input class="form-check-input input-practiceB" type="checkbox" value="<?php echo $practice_b ? $practice_b[0]->id : '' ?>" title="Practice B" id="practiceB" name="segments[]" <?php echo $practice_b && $practice_b[0]->id == $segment_id ? 'checked=checked' : '' ?> />
                                <div class="tags-body-polygon ">
                                    <span>P</span>
                                </div>
                                <div class="pa-body-detail">
                                    <span>Practice B</span>
                                </div>
                            </div>
                        </button>
                        <!-- Apply Button -->
                        <button class="dropdown-item dropdown-item2 polygon-button apply-button dropdown-class">
                            <!-- Apply -->
                            <div class="tags-body select-tags-body-polygon apply-poly-body">
                                <input class="form-check-input input-apply" type="checkbox" value="<?php echo $apply ? $apply[0]->id : '' ?>" title="Apply" id="apply" name="segments[]" <?php echo $apply && $apply[0]->id == $segment_id ? 'checked=checked' : '' ?>/>
                                <div class="tags-body-polygon apply-body-polygon">
                                    <span>A</span>
                                </div>
                                <div class="pa-body-detail">
                                    <span>Apply</span>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="invalid-feedback" id="trek_section_select_error">
                Please select Segment(s)
            </div>
        </div>
    </section>

    <!-- Button Section -->
    <section class="calendar-container select-assignment-section btns-container">
        <div class="input_section">
            <div class="btn_box profile_buttons">
                <button class="btn profile_btn" type="button" aria-label="Close" onclick="go_previous()">Previous</button>
                <button class="btn profile_btn" onclick="go_step_3()">Continue</button>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {        
        set_rpa_segment();
        jQuery("input[name='segments[]']").on('change', function(e) {            
            let segments_count = jQuery("input[name='segments[]']:checked").length;
            if (segments_count) {
                //jQuery('#select-segment-title').text(segments_count);
                set_rpa_segment();
            } else {
                jQuery('#select-segment-title').text("Select a RPA segment");
            }

            jQuery("#rpa_segments_container").html(
                jQuery("input[name='segments[]']:checked").get()
                .map( trek_section_checked => trek_sections_html(window.trek_sections_json.filter(section => section.id == jQuery(trek_section_checked).val())[0]) )
                .join("\n")
            );
        });
    });

    function set_rpa_segment() {
        let segments_count = jQuery("input[name='segments[]']:checked").length;
        if ( segments_count ) {
            var segment_array = jQuery("input[name='segments[]']:checked").map( function () {
                var segment_title = jQuery(this).attr('title');
                var color = '';
                if ( segment_title == 'Overview' ) {
                    color = '#979797';
                } else if ( segment_title == 'Recall' ) {
                    color = '#ca2738';
                } else if ( segment_title == 'Practice A' || segment_title == 'Practice B' ) {
                    color = '#1fa5d4';
                } else if ( segment_title == 'Apply' ) {
                    color = '#9fc33b';
                }
                return `<span style='color:`+color+`'>` + segment_title + `</span> `;
            }).get().join(', ');
            jQuery('#select-segment-title').html(segment_array);
        }
    }

    function set_date_time() {
        jQuery('#set_date_time').val(1);
        bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-1-tab')).show();
    }

    function trek_sections_html(section) {
        let notation = section.title.toLowerCase().split(' ').join('-');
        return `
        <div class="third-trek-box ` + notation + `-trek-box">          
            <div class="tags-body ` + notation + `-poly-body">
                <div class="tags-body-polygon">
                    <span>` + section.title[0] + `</span>
                </div>
                <div class="tags-body-detail">
                    <span>` + section.title + `</span>
                </div>
            </div>
        </div>`;
    }

    function set_trek_id(trek_id, trek_title) {
        jQuery('#trek_id').val(trek_id);
        jQuery('.trek_title').text(trek_title);
    }

    function go_step_3() {
        jQuery('#set_date_time').val(0);
        jQuery('#set_date_time_alert').hide();

        ok = true;
        if (!parseInt(jQuery('#trek_id').val())) {
            jQuery('#trek_select_error').show();
            ok = false;
        } else {
            jQuery('#trek_select_error').hide();
        }

        let segments_count = jQuery("input[name='segments[]']:checked").length;
        if (segments_count) {
            jQuery('#trek_section_select_error').hide();    
        } else {
            jQuery('#trek_section_select_error').show();
            ok = false;
        }
        
        if (ok) {
            bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-3-tab')).show();
        }
    }

    window.trek_sections_json = <?php echo json_encode($trek_sections); ?>;
    
</script>
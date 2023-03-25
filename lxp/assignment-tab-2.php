<?php
global $treks_src, $trek_post;
$select_trek_title = $trek_post ? $trek_post->post_title : "Select a TREK";
$trek_id = $trek_post ? $trek_post->ID : 0;
global $wpdb;
$trek_sections = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}trek_sections WHERE trek_id={$trek_post->ID} ORDER BY sort");
$overview = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Overview"; }));
$recall = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Recall"; }));
$practice_a = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Practice A"; }));
$practice_b = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Practice B"; }));
$apply = array_values(array_filter($trek_sections, function ($trek_section) { return $trek_section->title === "Apply"; }));
$segment_id = isset($_GET['segment']) ? $_GET['segment'] : null;
$select_segment_title = $segment_id ? "1" : "Select a RPA segment";
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'tl_trek',
    'order' => 'asc'
);
$treks = get_posts($args);
?>
<div class="tab-pane fade show" id="step-2-tab-pane" role="tabpanel" aria-labelledby="setp-2-tab" tabindex="1">

    <!-- New Assignment Calendar Section -->
    <section class="calendar-container select-assignment-section">

        <!-- New Assignment -->
        <div class="select-trek-box">
            <h3 class="new-assignment-heading">New Assignment</h3>
            <div class="select-calendar-box">
                <h4 class="new-assignment-heading select-calendar-heading">Calendar</h4>
                <div class="calendar-time-date">
                    <img src="<?php echo $treks_src; ?>/assets/img/clock-outline.svg" alt="logo" />
                    <div class="time-date-box days-box">
                        <div class="time-date-box">
                            <p class="date-time"><span id="assignment_day"></span>, <span id="assignment_month"></span> <span id="assignment_date"></span></p>
                            <p class="date-time" id="assignment_time_start"></p>
                            <p class="date-time to-text">To</p>
                            <p class="date-time" id="assignment_time_end"></p>
                        </div>
                        <!-- <label class="to-text all-day-label">
                            <input class="form-check-input" type="checkbox" />
                            All day
                        </label> -->
                    </div>
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
                            <span id="select-trek-title"><?php echo $select_trek_title; ?></span>
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        
                        <?php foreach ($treks as $trek) { ?>
                            <button class="dropdown-item dropdown-item2 dropdown-class" onclick="set_trek_id(<?php echo $trek->ID; ?>)">
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
                                <input class="form-check-input input-overview" type="checkbox" value="<?php echo $overview ? $overview[0]->id : '' ?>" id="Recall" name="segments[]" <?php echo $overview && $overview[0]->id == $segment_id ? 'checked=checked' : '' ?> />
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
                                <input class="form-check-input input-recall" type="checkbox" value="<?php echo $recall ? $recall[0]->id : '' ?>" id="Recall" name="segments[]" <?php echo $recall && $recall[0]->id == $segment_id ? 'checked=checked' : '' ?> />
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
                                <input class="form-check-input input-practiceA" type="checkbox" value="<?php echo $practice_a ? $practice_a[0]->id : '' ?>" id="practiceA" name="segments[]" <?php echo $practice_a && $practice_a[0]->id == $segment_id ? 'checked=checked' : '' ?> />
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
                                <input class="form-check-input input-practiceB" type="checkbox" value="<?php echo $practice_b ? $practice_b[0]->id : '' ?>" id="practiceB" name="segments[]" <?php echo $practice_b && $practice_b[0]->id == $segment_id ? 'checked=checked' : '' ?> />
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
                                <input class="form-check-input input-apply" type="checkbox" value="<?php echo $apply ? $apply[0]->id : '' ?>" id="apply" name="segments[]" <?php echo $apply && $apply[0]->id == $segment_id ? 'checked=checked' : '' ?>/>
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
        </div>
    </section>

    <!-- Button Section -->
    <section class="calendar-container select-assignment-section btns-container">
        <div class="input_section">
            <div class="btn_box profile_buttons">
                <button class="btn profile_btn" type="button" aria-label="Close" onclick="go_previous()">Previous</button>
                <button class="btn profile_btn" oncli>Continue</button>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("input[name='segments[]']").on('change', function(e) {
            let segments_count = jQuery("input[name='segments[]']:checked").length;
            if (segments_count) {
                jQuery('#select-segment-title').text(segments_count);
            } else {
                jQuery('#select-segment-title').text("Select a RPA segment");
            }
        });
    });

    function set_trek_id(trek_id) {
        jQuery('#trek_id').val(trek_id);
    }

    function go_step_3() {
        bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-3-tab')).show();
    }
</script>
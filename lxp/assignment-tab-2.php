<?php
global $treks_src;
?>
<div class="tab-pane fade show active2" id="classes-tab-pane" role="tabpanel" aria-labelledby="classes-tab" tabindex="1">

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
                            <p class="date-time">Thursday, February 23</p>
                            <p class="date-time">09:00 am</p>
                            <p class="date-time to-text">To</p>
                            <p class="date-time">10:00 am</p>
                        </div>
                        <label class="to-text all-day-label">
                            <input class="form-check-input" type="checkbox" />
                            All day
                        </label>
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
                <label class="trek-label">TREK</label>
                <div class="dropdown period-box">
                    <button class="input_dropdown dropdown-button" type="button" id="dropdownMenu2"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select a TREK
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item dropdown-item2 dropdown-class">
                            <div class="third-card-box">
                                <img src="<?php echo $treks_src; ?>/assets/img/interdependence-logo.svg" alt="img" />
                                <p class="interdependence-text">5.12A Interdependence</p>
                            </div>
                        </button>
                        <button class="dropdown-item dropdown-item2 dropdown-class" type="button">
                            <div class="third-card-box">
                                <img src="<?php echo $treks_src; ?>/assets/img/unsplash-logo.svg" alt="img" />
                                <p class="interdependence-text">5.7B Forces & Experimental Design</p>
                            </div>
                        </button>
                        <button class="dropdown-item dropdown-item2 dropdown-class" type="button">
                            <div class="third-card-box">
                                <img src="<?php echo $treks_src; ?>/assets/img/unsplash-logo2.svg" alt="img" />
                                <p class="interdependence-text">5.6A Physical Properties</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="search_box">
                <label class="trek-label">RPA segment</label>

                <!-- Select a RPA segment -->
                <div class="dropdown period-box">
                    <button class="input_dropdown dropdown-button second-drop-button" type="button"
                        id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select a RPA segment
                        <img class="rotate-arrow" src="<?php echo $treks_src; ?>/assets/img/down-arrow.svg" alt="logo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <!-- Recall Button-->
                        <button
                            class="dropdown-item dropdown-item2 polygon-button recall-button dropdown-class">
                            <!-- Recall -->
                            <div class="tags-body select-tags-body-polygon recall-poly-body">
                                <input class="form-check-input input-recall" type="checkbox" value=""
                                    id="Recall" />
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
                                <input class="form-check-input input-practiceA" type="checkbox" value=""
                                    id="practiceA" />
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
                                <input class="form-check-input input-practiceB" type="checkbox" value=""
                                    id="practiceB" />
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
                                <input class="form-check-input input-apply" type="checkbox" value=""
                                    id="apply" />
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
                <button class="btn profile_btn" type="button" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button class="btn profile_btn">Continue</button>
            </div>
        </div>
    </section>
</div>
<?php
global $treks_src;
global $trek_post;
?>
<section class="welcome-section assignment-section">
    <div id="back-btn">
        <?php if ($trek_post) { ?>
                <button class="back-btn" id="go_back" onclick="go_back('<?php echo site_url('trek/'.$trek_post->post_name); ?>')">
                    <img src="<?php echo $treks_src; ?>/assets/img/back.svg" alt="logo" />
                    <p class="back-btn-text">Back</p>
                </button>
        <?php } ?>
    </div>
    <!-- Assignment Tabs -->
    <nav class="nav-section select-section">
        <ul class="treks_ul select-ul" id="myTab" role="tablist">
            <li>
                <button class="select-link active" id="step-1-tab" data-bs-toggle="tab"
                    data-bs-target="#step-1-tab-pane" type="button" role="tab" aria-controls="step-1-tab-pane"
                    aria-selected="true">
                    <span class="select-num">1</span>
                    Select a space in your calendar
                </button>
            </li>
            <li>
                <button class="select-link" id="step-2-tab" data-bs-toggle="tab" 
                    data-bs-target="#step-2-tab-pane" type="button" role="tab" aria-controls="step-2-tab-pane" aria-selected="true">
                    <span class="select-num">2</span>
                    Select TREK or RPA segments
                </button>
            </li>
            <li>
                <button class="select-link" id="step-3-tab" data-bs-toggle="tab" 
                    data-bs-target="#step-3-tab-pane" type="button" role="tab" aria-controls="step-3-tab-pane" aria-selected="true">

                    <span class="select-num third-select-num">3</span>
                    Select Class and Students
                </button>
            </li>
        </ul>
    </nav>
    <!-- End Assignment Tabs -->
</section>

<script type="text/javascript">
    jQuery(document).ready(function() {

        let allTabs = document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function (event) {
                console.log('event.target >>> ', jQuery(event.target).attr('id'));
                
                switch (jQuery(event.target).attr('id')) {
                    case 'step-1-tab':
                        window.calendar.render();
                        break;
                    case 'step-2-tab':                        
                        set_assignment_date();
                        window.back_tab = bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-1-tab'));
                        break;
                    case 'step-3-tab':
                        jQuery('#new_assignment_data_2').html(jQuery('#new_assignment_data_1').html());                      
                        window.back_tab = bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-2-tab'));
                        break;
                    default:
                        break;
                }
                
                // event.target // newly activated tab
                // event.relatedTarget // previous active tab

            });
        });

    });

    function set_assignment_date() {
        let assignment_date_start = new Date(window.calendarSelectionInfo.start);
        let day = new Intl.DateTimeFormat("en-US", { weekday: "long" }).format(assignment_date_start);
        let month = new Intl.DateTimeFormat("en-US", { month: "long" }).format(assignment_date_start);
        let date = assignment_date_start.getDate();
        let time_start = assignment_date_start.toLocaleTimeString('en-US', {timeZone: 'UTC'});
        let assignment_date_end = new Date(window.calendarSelectionInfo.end);
        let time_end = assignment_date_end.toLocaleTimeString('en-US', {timeZone: 'UTC'});
        jQuery("#assignment_day").text(day);
        jQuery("#assignment_month").text(month);
        jQuery("#assignment_date").text(date);
        jQuery("#assignment_time_start").text(time_start);
        jQuery("#assignment_time_end").text(time_end);
    }

    function go_back(url) {
        window.location = url;
    }

    function go_previous() {
        window.back_tab.show();
    }
</script>
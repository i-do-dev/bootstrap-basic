<?php
global $treks_src;
?>
<div class="tab-pane fade show active" id="step-1-tab-pane" role="tabpanel" aria-labelledby="step-1-tab" tabindex="0">
    <!-- New Assignment Day Week Month Buttons -->
    <section class="assignment-section new-assignment-section">
        <h3 class="new-assignment-heading">New Assignment</h3>
        <!-- <div class="button-box">
            <button class="assignment-button day-button">Day</button>
            <button class="assignment-button week-button active">Week</button>
            <button class="assignment-button month-button">Month</button>
        </div> -->
    </section>
    <!-- Calendar Section -->
    <section class="new-assignment-section calendar-container">
        <section class="assignment-section calendar-section">
            <div class="row">
                <div class="col col-md-2">
                    <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/left-arrow.svg" alt="arrow" onclick="calendar_prev()" />
                </div>
                <div class="col col-md-8">
                    <p class="month-text month-date-text" id="month-date-text" style="padding-top: 5px;"></p>
                </div>
                <div class="col col-md-2">
                    <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/right-arrow.svg" alt="arrow" onclick="calendar_next()" />
                </div>
            </div>
            <div class="previous-last-box">
                <!-- <img class="cursor-img" src="<?php // echo $treks_src; ?>/assets/img/left-arrow.svg" alt="arrow" onclick="calendar_prev()" /> -->
                <p class="month-text" id="month-text">February</p>
                <!-- <img class="cursor-img" src="<?php // echo $treks_src; ?>/assets/img/right-arrow.svg" alt="arrow" onclick="calendar_next()" /> -->
            </div>
        </section>
    </section>
    <section class="calendar-container">
        <section class="calendar-section">
            <div id="calendar"></div>
        </section>
    </section>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {

        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            selectable: true,
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            headerToolbar: false,
            allDaySlot: false,
            events: apiUrl + "assignments/calendar/events/?user_id=" + <?php echo get_current_user_id(); ?> ,
            dayHeaderContent: function (args) {
                let weekday_el = document.createElement('p');
                weekday_el.innerHTML = new Intl.DateTimeFormat("en-US", { weekday: "long" }).format(args.date);
                weekday_el.classList.add("month-text");
                weekday_el.classList.add("month-date-text");
                let day_el = document.createElement('p');
                day_el.innerHTML = new Intl.DateTimeFormat("en-US", { day: "numeric" }).format(args.date);
                day_el.classList.add("month-text");
                day_el.classList.add("month-date-text");
                day_el.classList.add("text-bold");
                let event_dom_nodes = [day_el, weekday_el];
                return {domNodes: event_dom_nodes};
            },
            eventClassNames: function(arg) {
                let segment_class = "segment-default-event";
                if (arg.event.extendedProps.hasOwnProperty("segment")) {
                    segment_class = "practice-b-event";
                }
                return segment_class;
            },
            eventContent: function(arg) {
                let lesson_segment_el = document.createElement('p');
                lesson_segment_el.innerHTML = arg.event.title;
                let event_title_class  = "practice-b-segment-event-title";
                lesson_segment_el.classList.add(event_title_class);
                lesson_segment_el.classList.add("lxp-event-title");
                
                let course_el = document.createElement('p');
                course_el.innerHTML = arg.event.extendedProps.course;
                let event_sub_title_class = "practice-b-segment-event-sub-title"
                course_el.classList.add(event_sub_title_class);
                course_el.classList.add("lxp-event-sub-title");

                let event_dom_nodes = [lesson_segment_el, course_el];
                return {domNodes: event_dom_nodes};
            },
            eventClick: function(eventClickInfo) {
                jQuery('#student-progress-course-title').text(eventClickInfo.event.extendedProps.course);
                jQuery('#student-progress-course-segment').text(eventClickInfo.event.title);
                jQuery('#student-progress-course-segment-char').text(eventClickInfo.event.title[0]);
                var segmentColor = "#1fa5d4";
                jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-tab-polygon').css('background-color', segmentColor);
                jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon-name, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-user-name').css('color', segmentColor);
                fetch_assignment_stats(eventClickInfo.event.id);
                window.assignmentStatsModalObj.show();
            },
            select: function( calendarSelectionInfo ) {
                window.calendarSelectionInfo = calendarSelectionInfo;
                bootstrap.Tab.getOrCreateInstance(document.querySelector('#step-2-tab')).show();
            },
            viewDidMount: function(viewObject) {
                jQuery('#month-date-text').text(viewObject.view.getCurrentData().viewTitle);
                let month = new Intl.DateTimeFormat("en-US", { month: "long" }).format(viewObject.view.currentStart);
                jQuery("#month-text").text(month);
            }
        });
        calendar.render();
        window.calendar = calendar;
    });

    function calendar_next() {
        window.calendar.next();
        jQuery('#month-date-text').text(window.calendar.view.getCurrentData().viewTitle);
        let month = new Intl.DateTimeFormat("en-US", { month: "long" }).format(window.calendar.view.currentStart);
        jQuery("#month-text").text(month);
    }
    function calendar_prev() {
        window.calendar.prev();
        jQuery('#month-date-text').text(window.calendar.view.getCurrentData().viewTitle);
        let month = new Intl.DateTimeFormat("en-US", { month: "long" }).format(window.calendar.view.currentStart);
        jQuery("#month-text").text(month);
    }

    function fetch_assignment_stats(assignment_id) {
        jQuery("#student-modal-loader").show();
        jQuery("#student-modal-table").hide();
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';
        jQuery.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: apiUrl + "assignment/stats",
            data: {assignment_id}
        }).done(function( response ) {
            jQuery("#student-modal-table tbody").html( response.data.map(student => student_assignment_stat_row_html(student, assignment_id)).join('\n') );
            jQuery("#student-modal-loader").hide();
            jQuery("#student-modal-table").show();
        }).fail(function (response) {
            console.error("Can not load teacher");
        });
    }

    function student_assignment_stat_row_html(student, assignment_id) {
        return `
            <tr>
                <td>
                <div class="table-user">
                    <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="user" />
                    <div class="user-about">
                    <h5>` + student.name + `</h5>
                    <p>` +  (student.grades && student.grades.length > 0 ? JSON.parse(student.grades).join(', ') : ``) + `</p>
                    </div>
                </div>
                </td>
                <td>
                <div class="table-status">` + student.status + `</div>
                </td>
                <td>` + student.progress + `</td>
                <td>` + student.score + `</td>
                <td><a href='<?php echo site_url("grade-assignment"); ?>?assignment=` + assignment_id + `&student=` + student.ID + `' target="_blank"><img src="<?php echo $treks_src; ?>/assets/img/review-icon.svg" alt="svg" width="30" /></a></td>
            </tr>
        `;
    }
    
</script>
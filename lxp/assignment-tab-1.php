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
            <p class="month-text month-date-text" id="month-date-text"></p>
            <div class="previous-last-box">
                <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/left-arrow.svg" alt="arrow" onclick="calendar_prev()" />
                <p class="month-text" id="month-text">February</p>
                <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/right-arrow.svg" alt="arrow" onclick="calendar_next()" />
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
                    segment_class = arg.event.extendedProps.segment + "-event";
                }
                return segment_class;
            },
            eventContent: function(arg) {
                let trek_segment_el = document.createElement('p');
                trek_segment_el.innerHTML = arg.event.title;
                let event_title_class  = arg.event.extendedProps.segment + "-segment-event-title";
                trek_segment_el.classList.add(event_title_class);
                trek_segment_el.classList.add("lxp-event-title");
                
                let trek_el = document.createElement('p');
                trek_el.innerHTML = arg.event.extendedProps.trek;
                let event_sub_title_class = arg.event.extendedProps.segment + "-segment-event-sub-title"
                trek_el.classList.add(event_sub_title_class);
                trek_el.classList.add("lxp-event-sub-title");

                let event_dom_nodes = [trek_segment_el, trek_el];
                return {domNodes: event_dom_nodes};
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
    
</script>
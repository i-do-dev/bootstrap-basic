<?php
get_template_part('lxp/functions');
lxp_login_check();

$treks_src = get_stylesheet_directory_uri() . '/treks-src';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendar</title>
  <link href="<?php echo $treks_src; ?>/style/common.css" rel="stylesheet" />
  <link href="<?php echo $treks_src; ?>/style/header-section.css" rel="stylesheet" />
  <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/calendar.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/calendar-style.css" />
  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/newAssignment.css" />

  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
  <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
  <script src="<?php echo $treks_src; ?>/js/webshim/js-webshim/minified/polyfiller.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

  <style type="text/css">
    .calendar-container .calendar-flex-box .calendar-main {
      height: auto !important;
    }

    .calendar-container .calendar-flex-box .calendar-right-box .small-calendar {
      height: auto !important;
    }
  </style>
</head>

<body>
  <!-- Menu -->
  <nav class="navbar navbar-expand-lg treks-nav">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <div class="header-logo-search">
          <!-- logo -->
          <div class="header-logo">
            <img src="<?php echo $treks_src; ?>/assets/img/header_logo.svg" alt="svg" />
          </div>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
          <div class="header-logo-search">
            <!-- searching input -->
            <div class="header-search">
              <img src="<?php echo $treks_src; ?>/assets/img/header_search.svg" alt="svg" />
              <form action="<?php echo site_url("search"); ?>">
                  <input placeholder="Search" id="q" name="q" value="<?php echo isset($_GET["q"]) ? $_GET["q"]:''; ?>" />
              </form>
            </div>
          </div>
        </div>
        <div class="d-flex" role="search">
          <div class="header-notification-user">
            <?php get_template_part('trek/user-profile-block') ?>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Basic Container -->
  <section class="main-container b-space">
    <!-- Nav Section -->
    <nav class="nav-section">
        <?php get_template_part('trek/navigation') ?>
    </nav>
  </section>

  <section class="calendar-container">
    <div class="d-flex align-content-center justify-content-between mb-3">
      <h1 class="calendar-heading m-0">Calendar</h1>
    </div>

    <div class="calendar-flex-box">
      <div class="calendar-main" style="padding: 15px;">
        <div id="calendar"></div>
      </div>
      <div class="calendar-right-box">
        <div class="small-calendar">
          <div id="calendar-monthly">
            <form action="#" class="ws-validate">
              <div class="form-row">
                  <input type="date" class="hide-replaced" />
              </div>
              <div class="form-row">
                  <input type="submit" />
              </div>
            </form>
          </div>
        </div>
        <div class="rpa-segments-box">
          <h5 class="rpa-heading">RPA Segments</h5>
          <div class="rpa-segments-form">
            <div class="form-check">
              <input class="form-check-input input-all" type="checkbox" value="" id="all" />
              <label class="form-check-label" for="all"> All </label>
            </div>
            <div class="form-check">
              <input class="form-check-input input-recall" type="checkbox" value="" id="Recall" />
              <label class="form-check-label" for="Recall"> Recall </label>
            </div>
            <div class="form-check">
              <input class="form-check-input input-practiceA" type="checkbox" value="" id="practiceA" />
              <label class="form-check-label" for="practiceA"> Practice A</label>
            </div>
            <div class="form-check">
              <input class="form-check-input input-practiceB" type="checkbox" value="" id="practiceB" />
              <label class="form-check-label" for="practiceB"> Practice B </label>
            </div>
            <div class="form-check">
              <input class="form-check-input input-apply" type="checkbox" value="" id="apply" />
              <label class="form-check-label" for="apply"> Apply </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php get_template_part('lxp/assignment-stats-modal', 'assignment-stats-modal'); ?>

  <script type="text/javascript">
      jQuery(document).ready(function() {

          let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
          let apiUrl = host + '/wp-json/lms/v1/';
          
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
              timeZone: 'UTC',
              selectable: false,
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
              eventClick: function(eventClickInfo) {
                  jQuery('#student-progress-trek-title').text(eventClickInfo.event.extendedProps.trek);
                  jQuery('#student-progress-trek-segment').text(eventClickInfo.event.title);
                  jQuery('#student-progress-trek-segment-char').text(eventClickInfo.event.title[0]);
                  switch (eventClickInfo.event.title) {
                      case 'Overview':
                          segmentColor = "#979797";
                          break;
                      case 'Recall':
                          segmentColor = "#ca2738";
                          break;
                      case 'Practice A':
                          segmentColor = "#1fa5d4";
                          break;
                      case 'Practice B':
                          segmentColor = "#1fa5d4";
                          break;
                      case 'Apply':
                          segmentColor = "#9fc33b";
                          break;
                      default:
                          segmentColor = "#ca2738";
                          break;
                  }
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
          init_monthly_calendar();
      });

      function init_monthly_calendar() {
        webshim.setOptions('forms-ext', {
              replaceUI: 'auto',
              types: 'date',
              date: {
                  startView: 2,
                  inlinePicker: true,
                  classes: 'hide-inputbtns'
              }
          });
          webshim.setOptions('forms', {
              lazyCustomMessages: true
          });
          //start polyfilling
          webshim.polyfill('forms forms-ext');
          const date = new Date();
          //YYYY-MM-DD format
          const dateString = date.toISOString().split("T")[0];
          jQuery("#calendar-monthly input[type='date']").val(dateString);

          jQuery("#calendar-monthly input[type='date']").on("change", function() {
            window.calendar.gotoDate(jQuery(this).val());
          });
      }

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
                  <td><a href='<?php echo site_url("grade-assignment"); ?>?assignment=` + assignment_id + `&student=` + student.ID + `'><img src="<?php echo $treks_src; ?>/assets/img/review-icon.svg" alt="svg" width="30" /></a></td>
              </tr>
          `;
      }
  </script>
</body>

</html>
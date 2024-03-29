<?php
// get_template_part('lxp/functions');
global $treks_src;
$teacher_post = lxp_get_teacher_post( get_userdata(get_current_user_id())->ID );
if (is_null($teacher_post)) {
  die("This account is inactive. Please contact site administrator. ". '<a href="' . wp_logout_url("login") . '">Logout</a>');
}

$treks = array();
$treks_restricted = get_post_meta($teacher_post->ID, 'treks_restricted');
$treks_restricted = is_array($treks_restricted) && count($treks_restricted) > 0 ? $treks_restricted : array(0);

// Start the loop.
$courseId =  isset($_GET['courseid']) ? $_GET['courseid'] : get_post_meta($post->ID, 'tl_course_id', true);
$trek_count = 6;
$args = array(
	'posts_per_page'   => 3,
	'post_type'        => 'tl_trek'
);

$treks_saved = get_post_meta($teacher_post->ID, 'treks_saved');
// filter $treks_saved to only include treks that are not in $treks_restricted
$treks_saved = array_filter($treks_saved, function($trek_id) use ($treks_restricted) {
  return !in_array($trek_id, $treks_restricted);
});

if ($treks_saved) {
  $args['post__not_in'] = $treks_saved;
  if (is_array($treks_saved) && count($treks_saved) < $trek_count) {
    $trek_count = $trek_count - count($treks_saved);
    $args['posts_per_page']   = $trek_count;
  } else {
    $trek_count = 1;
  }
}

$lxp_visited_treks = get_post_meta($teacher_post->ID, 'lxp_visited_treks');
// filter $lxp_visited_treks to only include treks that are not in $treks_restricted
$lxp_visited_treks = array_filter($lxp_visited_treks, function($trek_id) use ($treks_restricted) {
  return !in_array($trek_id, $treks_restricted);
});
$lxp_visited_treks_to_show = is_array($lxp_visited_treks) && count($lxp_visited_treks) > 0 ? array_diff(array_reverse($lxp_visited_treks), $treks_saved) : array();

if (count($lxp_visited_treks_to_show) > 0) {
  $args['post__in'] = array_merge($lxp_visited_treks_to_show);
  $args['orderby'] = 'post__in';
} else {
  $args['meta_key'] = 'sort';
  $args['orderby'] = 'meta_value_num';
  $args['order'] = 'ASC';
}

if ( get_userdata(get_current_user_id())->user_email === "guest@rpatreks.com" ) {
  $args = array(
    'include' => '15',
    'post_type'        => 'tl_trek',
    'order' => 'post__in'
  );
}


if (isset($args['post__not_in']) && count($treks_restricted) > 0) {
  $args['post__not_in'] = array_merge($args['post__not_in'], $treks_restricted);
} elseif (!isset($args['post__not_in']) && count($treks_restricted) > 0) {
  $args['post__not_in'] = $treks_restricted;
}

$treks = get_posts($args);

while (have_posts()) : the_post();

if (is_null($teacher_post)) {
  die("Teacher is not associated with any school. contact admin. <a href='". wp_logout_url("login") ."'>Logout</a>");
}
$assignments = lxp_get_teacher_assignments($teacher_post->ID);
$teacher_saved_treks = lxp_get_teacher_saved_treks($teacher_post->ID, $treks_saved);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php the_title(); ?></title>
  <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
  <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/newAssignment.css" />

  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>

    <style type="text/css">
      .treks-card {
        width: 300px !important;
        position: relative;
      }
      .treks-card-link {
        text-decoration: none !important;
      }
      .polygon-shap {
        padding-top: 12px !important;
      }
      .student-stats-link {
        padding-left: 10px !important;
      }
      .student-stats-link {
        padding-left: 10px !important;
      }
      .student-progress-link {
        color: #000000 !important;
        text-decoration: none !important;
      }
      /* .treks-card-saved with icon element in it in top right absolute position */
      .treks-card-saved {
        position: absolute;
        top: 0;
        right: 0;
        width: 35px;
        height: 38px;
        z-index: 2;
        margin-top: 10px;
        margin-right: 8px;
      }
      .treks-card-saved-back {
        position: absolute;
        top: 0;
        right: 0;
        width: 20px;
        height: 20px;
        z-index: 1;
        margin-top: 15px;
        margin-right: 15px;
        background-color: #ffffff;
      }     
      .bg-gray {
          background: #757575 !important;
      }
      .bg-orange {
          background: #de6c03 !important;
      }
      .bg-green {
          background: #6dc200 !important;
      }
      .bg-blue {
          background: #1fa5d4 !important;
      }
    </style>
</head>

<body>

  <script type="text/javascript">
    function fetch_assignment_stats(assignment_id, trek, segment, statuses, start, end) {

      jQuery('#student-progress-trek-title').text(trek);
      jQuery('#student-progress-trek-segment').text(segment);
      jQuery('#student-progress-trek-segment-char').text(segment[0]);
      // starting date and time
      let start_date = new Date(start);
      let start_date_string = start_date.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' });
      let start_time_string = start_date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
      jQuery('#student-progress-trek-start-time').text(start_date_string + ' ' + start_time_string);
      // ending date and time
      let end_date = new Date(end);
      let end_date_string = end_date.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' });
      let end_time_string = end_date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
      jQuery('#student-progress-trek-end-time').text(end_date_string + ' ' + end_time_string);

      var segmentColor = "#979797";
      switch (segment) {
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
              segmentColor = "#979797";
              break;
      }
      jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-tab-polygon').css('background-color', segmentColor);
      jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon-name, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-user-name').css('color', segmentColor);
      
      window.assignmentStatsModalObj.show();
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
          const in_progress_students = response.data.filter(student => statuses.includes(student.status));
          jQuery("#student-modal-table tbody").html( in_progress_students.map(student => student_assignment_stat_row_html(student, assignment_id)).join('\n') );
          jQuery("#student-modal-loader").hide();
          jQuery("#student-modal-table").show();
      }).fail(function (response) {
          console.error("Can not load teacher");
      });
    }

    function student_assignment_stat_row_html(student, assignment_id) {
      let statusClass = '';
      switch (student.status) {
        case 'To Do':
          statusClass = 'bg-gray';
          break;
        case 'In Progress':
          statusClass = 'bg-orange';
          break;
        case 'Completed':
          statusClass = 'bg-green';
          break;
        case 'Graded':
          statusClass = 'bg-blue';
          break;
      }
      
      return `
          <tr>
              <td>
              <div class="table-user">
                  <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="user" />
                  <div class="user-about">
                  <h5><a class='student-progress-link' href='<?php echo site_url("grade-assignment"); ?>?assignment=` + assignment_id + `&student=` + student.ID + `'>` + student.name + `</a></h5>
                  </div>
              </div>
              </td>
              <td>
              <div class="table-status ` + statusClass + `">` + (student.status === 'Completed' ? 'Submitted' : student.status) + `</div>
              </td>
              <td><a class='student-progress-link' href='<?php echo site_url("grade-assignment"); ?>?assignment=` + assignment_id + `&student=` + student.ID + `'>` + student.progress + `</a></td>
              <td>` + student.score + `</td>
              <td><a href='<?php echo site_url("grade-assignment"); ?>?assignment=` + assignment_id + `&student=` + student.ID + `'><img src="<?php echo $treks_src; ?>/assets/img/review-icon.svg" alt="svg" width="30" /></a></td>
          </tr>
      `;
    }
  </script>

  <nav class="navbar navbar-expand-lg bg-light">
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
  <section class="main-container">
    <!-- Nav Section -->
    <nav class="nav-section">
      <?php get_template_part('trek/navigation') ?>
    </nav>

    <!-- Reminders: section-->
<!--     <section class="reminder-section">
      <div class="reminder-section-div">
        
        <div class="reminder-title reminder-detail">
          <img src="<?php // echo $treks_src; ?>/assets/img/rm_calendar.svg" />
          <span>Reminders:</span>
        </div>
        
        <div class="reminder-detail reminder-vli">
          <span>Physical Properties Thu 9:00 AM</span>
        </div>
        
        <div class="reminder-detail reminder-vli">
          <span>Forces & Experimental Design Fri 10:00 AM</span>
        </div>
        
        <div class="reminder-detail">
          <span>Physics Fri 1:00 PM</span>
        </div>
        
        <div class="reminder-detail">
          <span>Mathematics Mon 11:00 AM</span>
        </div>
        
        <div class="reminder-arrow">
          <img src="<?php echo $treks_src; ?>/assets/img/rm_arrow down.svg" />
        </div>
      </div>
    </section>
 -->
    <!-- Recent TREKs -->
    <section class="recent-treks-section">
      <div class="recent-treks-section-div">
        <!--  TREKs header-->
        <div class="recent-treks-header section-div-header">
          <h2>My TREKs</h2>
          <div>
            <a href="<?php echo site_url('treks'); ?>">See All</a>
          </div>
        </div>
        <!-- TREKs cards -->
        <div class="recent-treks-cards-list">
          <!-- each cards  -->
          
          <?php
          foreach($teacher_saved_treks as $trek) {
          ?>
            <a href="<?php echo get_post_permalink($trek->ID); ?>" class="treks-card-link">
              <div class="recent-treks-card-body treks-card">
                  <div class="treks-card-saved"><img width="35" height="35" src="<?php echo $treks_src; ?>/assets/img/trek-save-filled-icon.svg" alt="svg" /></div>
                  <div class="treks-card-saved-back"></div>
                  <div>
                    <?php echo get_the_post_thumbnail($trek->ID, "medium", array( 'class' => 'rounded' )); ?>
                  </div>
                  <div>
                    <h3><?php echo get_the_title($trek->ID); ?></h3>
                    <!-- <span>Due date: May 17, 2023</span> -->
                  </div>
                </div>
            </a>
          <?php } ?>
          
          <?php
          foreach($treks as $trek) {
          ?>
            <a href="<?php echo get_post_permalink($trek->ID); ?>" class="treks-card-link">
              <div class="recent-treks-card-body treks-card">
                  <div>
                    <?php echo get_the_post_thumbnail($trek->ID, "medium", array( 'class' => 'rounded' )); ?>
                  </div>
                  <div>
                    <h3><?php echo get_the_title($trek->ID); ?></h3>
                    <!-- <span>Due date: May 17, 2023</span> -->
                  </div>
                </div>
            </a>
          <?php } ?>

        </div>
      </div>
    </section>

    <!--Pending Assignments  -->
    <section class="pending-assignments-section">
      <div class="pending-assignments-section-div">
        <!--  header -->
        <div class="pending-assignments-header section-div-header">
          <h2>Pending Assignments</h2>
          <div>
            <a href="<?php echo site_url('calendar');?>">See All</a>
          </div>
        </div>
        <!--  table -->
        <div class="pending-assignments-table">
          <table>
            <thead>
              <tr>
                <th>Class</th>
                <th>TREK</th>
                <th>Segment</th>
                <th>Date</th>
                <th>Student Progress</th>
                <th>Students Submitted</th>
                <th>Students Graded</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach ($assignments as $assignment) { 
                  
                  $calendar_selection_info = json_decode(get_post_meta($assignment->ID, 'calendar_selection_info', true));
                  $start = '';
                  if (!is_null($calendar_selection_info) && property_exists($calendar_selection_info, 'start') && gettype($calendar_selection_info->start) === 'string') {
                    $start = $calendar_selection_info->start;
                  } elseif (!is_null($calendar_selection_info) && property_exists($calendar_selection_info, 'start') && gettype($calendar_selection_info->start) === 'object') {
                    $start = $calendar_selection_info->start->date;
                  }

                  $end = '';
                  if (!is_null($calendar_selection_info) && property_exists($calendar_selection_info, 'end') && gettype($calendar_selection_info->end) === 'string') {
                    $end = $calendar_selection_info->end;
                  } elseif (!is_null($calendar_selection_info) && property_exists($calendar_selection_info, 'end') && gettype($calendar_selection_info->end) === 'object') {
                    $end = $calendar_selection_info->end->date;
                  }

                  $class_id = intval(get_post_meta($assignment->ID, 'class_id', true));
                  $class_post = get_post($class_id);
                  $trek_section_id = get_post_meta($assignment->ID, 'trek_section_id', true);
                  global $wpdb;
                  $trek_section = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}trek_sections WHERE id={$trek_section_id}");
                  $trek = get_post(get_post_meta($assignment->ID, 'trek_id', true));
                  $segment = implode("-", explode(" ", strtolower($trek_section->title))) ;
                  
                  $student_stats = lxp_assignment_stats($assignment->ID);
                  $statuses = array("To Do", "In Progress");
                  $students_in_progress = array_filter($student_stats, function($studentStat) use ($statuses) {
                    return in_array($studentStat["status"], $statuses);
                  });

                  $statuses = array("Completed");
                  $students_graded = 0;
                  $students_completed = array_filter($student_stats, function($studentStat) use ($statuses, $assignment, &$students_graded) {
                    $ok = false;
                    $ok = in_array($studentStat["status"], $statuses);
                    if ($ok) {
                      $assignment_submission_item = lxp_get_assignment_submissions($assignment->ID, $studentStat["ID"]);
                      if (count($assignment_submission_item) > 0 && get_post_meta($assignment_submission_item['ID'], 'mark_as_graded', true) === 'true') {
                        $students_graded++;
                        $ok = false;
                      }
                    }
                    return $ok;
                  });
              ?>
                <tr>
                  <td><?php echo $class_id > 0 && $class_post ? $class_post->post_title : '---'; ?></td>
                  <td><?php echo $trek->post_title; ?></td>
                  <td>
                    <div class="assignments-table-cs-td-poly">
                      <div class="polygon-shap polygonshape-<?php echo $segment; ?>">
                        <span><?php echo $trek_section->title[0]; ?></span>
                      </div>
                      <div>
                        <span><?php echo $trek_section->title; ?></span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <?php
                      $start_date = get_post_meta($assignment->ID, "start_date", true);
                      $start_date = date("M d, Y", strtotime($start_date));
                      echo $start_date;
                    ?>
                  </td>
                  <td>
                    <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['To Do', 'In Progress'], '<?php echo $start; ?>', '<?php echo $end; ?>')"><?php echo count($students_in_progress); ?>/<?php echo count($student_stats); ?></a></div>
                  </td>
                  <td>
                    <?php
                      $student_stats = lxp_assignment_stats($assignment->ID);
                    ?>
                    <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['Completed'], '<?php echo $start; ?>', '<?php echo $end; ?>')"><?php echo count($students_completed); ?>/<?php echo count($student_stats); ?></a></div>
                  </td>
                  <td>
                    <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['Graded'], '<?php echo $start; ?>', '<?php echo $end; ?>')"><?php echo $students_graded; ?>/<?php echo count($student_stats); ?></a></div>
                  </td>
                </tr>  
              <?php } ?>
<!--               <tr>
                <td>Elephants</td>
                <td>
                  <div class="assignments-table-cs-td-poly">
                    <div class="polygon-shap">
                      <span>P</span>
                    </div>
                    <div>
                      <span>Physical Properties</span>
                      <span>Practice B</span>
                    </div>
                  </div>
                </td>
                <td>Jan 21, 2023</td>
                <td>25/30</td>
              </tr>
              <tr>
                <td>Elephants</td>
                <td>
                  <div class="assignments-table-cs-td-poly">
                    <div class="polygon-shap">
                      <span>P</span>
                    </div>
                    <div>
                      <span>Physical Properties</span>
                      <span>Practice B</span>
                    </div>
                  </div>
                </td>
                <td>Jan 21, 2023</td>
                <td>25/30</td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Calendar &  Activities Completed Overall -->
    <!-- 
    <section class="clen-act-section">
      <div class="clen-act-section-div">
        <div class="calendar-portion">
          <div class="calendar-portion-header section-div-header">
            <h2>Pending Assignments</h2>
            <div>
              <a href="#">See All</a>
            </div>
          </div>
        </div>
        <div class="activities-portion">
          <div class="activities-portion-header section-div-header">
            <h2>Activities Completed Overall</h2>
          </div>

          <div class="activities-portion-prap">
            <p>This is the status of all the activities you have assigned.</p>

            <div class="activities-portion-progress">
               
                <div class="portion-progress-div">
                  <div class="recall-progress-bar"></div>
                  <p>Recall</p>
                </div>

                <div class="portion-progress-div">
                  <div class="pa-progress-bar"></div>
                  <p>Practice A</p>
                </div>

                <div class="portion-progress-div">
                  <div class="pb-progress-bar"></div>
                  <p>Practice B</p>
                </div>

                <div class="portion-progress-div">
                  <div class="apply-progress-bar"></div>
                  <p>Apply</p>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
     -->
  </section>
  <?php get_template_part('lxp/assignment-stats-modal', 'assignment-stats-modal'); ?>

  <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
  <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>
<?php endwhile; ?>
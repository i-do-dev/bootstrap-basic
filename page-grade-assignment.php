<?php
get_template_part('lxp/functions');
lxp_login_check();
if ( !(isset($_GET['assignment']) && intval($_GET['assignment']) > 0) ) {
    wp_redirect(site_url("/calendar"));
}

$student_id = 0;
if ( (isset($_GET['student']) && intval($_GET['student']) > 0) ) {
  $student_id = intval($_GET['student']);
}

$assignment = lxp_get_assignment($_GET['assignment']);
$students = lxp_get_students($assignment->lxp_student_ids);
$trek = get_post($assignment->trek_id);
$trek_section = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}trek_sections WHERE id={$assignment->trek_section_id}");
$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$slide_current = isset($_GET['slide']) ? $_GET['slide'] : 0;
$assignment_submission = lxp_get_assignment_submissions($assignment->ID, $student_id);
$grade = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide_current . "_grade", true) : '';
$result = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide_current . "_result", true) : '';
$total_grades_str = $result ? '/' .json_decode($result)->score->max : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grade Assignment</title>
    <link href="<?php echo $treks_src; ?>/style/common.css" rel="stylesheet" />
    <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/assignments.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/newAssignment.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      crossorigin="anonymous"
    />
    
    <style type="text/css">
      .time-date-box {
        margin-left: 60px;
      }

      body {
        background-color: #f6f7fa !important;
      }

      .grade-box-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 8px 24px;
        width: 100%;
        border-radius: 20px;
        font-family: 'Arial';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        margin: 0 0 8px;
        color: #757575;
        background: #eaedf1;
      }

      .grade-box-btn {
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 8px 40px;
          font-family: 'Nunito';
          font-style: normal;
          font-weight: 500;
          font-size: 16px;
          line-height: 24px;
          margin: 0 auto;
          color: #0b5d7a;
          background-color: transparent;
          border: 1px solid #0b5d7a;
          border-radius: 8px;
          margin-top: 10px;
      }

      .grade-box {
        margin-left: 50px;
        margin-right: 50px;
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

      .no-right-border {
          border-right: 0px !important;
      }

      .summary_link {
        text-decoration: none;
      }

      .summary_link:hover {
        color: #fff;
      }

      .add-feedback-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 14px;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <?php get_template_part('trek/header-logo'); ?>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
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
    <section class="main-container" style=" margin-bottom: 0px;">
        <nav class="nav-section">
            <?php // get_template_part('trek/navigation') ?>
        </nav>
    </section>

    <!-- main secton -->
    <section class="main_assignment_section">
      <!-- back button -->
      <section class="assigmint_back_button">
        <a href="<?php echo site_url("assignments"); ?>">
          <span> <img src="<?php echo $treks_src; ?>/assets/img/back.svg" alt="" /> </span> Back
        </a>
      </section>

      <!-- heading section -->

      <section class="assig_heading">
        <h2>Grade Assignment</h2>

        <!-- student cat -->

        <div class="students-breadcrumb">
          <div class="interdependence-user">
            <img src="<?php echo $treks_src; ?>/assets/img/tr_main.png" alt="user" class="inter-user-img" />
            <h3 class="inter-user-name"><?php echo $trek->post_title; ?></h3>
          </div>
          <img src="<?php echo $treks_src; ?>/assets/img/bc_arrow_right.svg" alt="user" class="students-breadcrumb-arrow" />
          <div class="interdependence-tab">
            <?php
            if ($trek_section->title === 'Overview') {
                $segmentColor = "#979797";
            } else if ($trek_section->title === 'Recall') {
                $segmentColor = "#ca2738";
            } else if ($trek_section->title === 'Practice A') {
                $segmentColor = "#1fa5d4";
            } else if ($trek_section->title === 'Practice B') {
                $segmentColor = "#1fa5d4";
            } else if ($trek_section->title === 'Apply') {
                $segmentColor = "#9fc33b";
            }
            ?>
            <div class="inter-tab-polygon" style="background-color: <?php echo $segmentColor; ?>">
              <h4><?php echo $trek_section->title[0]; ?></h4>
            </div>
            <h3 class="inter-tab-polygon-name" style="color: <?php echo $segmentColor; ?>"><?php echo $trek_section->title; ?></h3>
          </div>
          <div class="time-date-box">
            <p class="date-time"><span id="assignment_day"><?php echo date("D", strtotime($assignment->start_date)); ?></span>, <span id="assignment_month"><?php echo date("F", strtotime($assignment->start_date)); ?></span> <span id="assignment_date"><?php echo date("d", strtotime($assignment->start_date)); ?></span>, <span id="assignment_date"><?php echo date("Y", strtotime($assignment->start_date)); ?></span></p>
            <p class="date-time" id="assignment_time_start"><?php echo date("h:i:s a", strtotime($assignment->start_time)); ?></p>
            <p class="date-time to-text">To</p>
            <p class="date-time" id="assignment_time_end"><?php echo date("h:i:s a", strtotime($assignment->end_time)); ?></p>
          </div>
          
        </div>
      </section>

      <!-- Table section -->
      <section class="student_assignment_tab">
        <!-- School nav tabs -->
        <nav class="assignment_tabs">
          <h2>Students</h2>
          <ul class="treks_ul" id="myTab" role="tablist">
            <?php 
              foreach ($students as  $student) { 
                $assignment_submissions = assignments_submissions([$assignment], $student);
                $status = count($assignment_submissions) > 0 ? $assignment_submissions[0][$assignment->ID]["status"] : 'not submitted';
                $statusClass= '';
                switch ($status) {
                  case 'To Do':
                    $statusClass = 'bg-gray';
                    break;
                  case 'In Progress':
                    $statusClass = 'bg-orange';
                    break;
                  case 'Completed':
                    $statusClass = 'bg-green';
                    break;
                }
            ?>
              <li onclick="switch_student(<?php echo $student->ID; ?>)">
                <div
                  class="nav-link tab_btn <?php echo $student->ID == $student_id ? 'active' : ''; ?>"
                  id="two-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#two-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="two-tab-pane"
                  aria-selected="true"
                >
                  <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />

                  <div class="student_abouts_tab tab_bg_w">
                    <div class="student_about">
                      <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" class="student_user_img" alt="user" />
                      <div class="student_names">
                        <h4><?php echo $student->name; ?></h4>
                        <p><?php echo is_array(json_decode($student->grades)) ? implode(', ', json_decode($student->grades)) : ""; ?></p>
                      </div>
                    </div>
                    <div class="stu_tag">
                      <?php 
                        if ($status && $status === 'Completed') {
                          $status = 'Submitted';
                        }

                        if (is_array($assignment_submission) && $status && $status === 'Submitted' && get_post_meta($assignment_submission['ID'], 'mark_as_graded', true) === 'true') {
                          $status = 'Graded';
                          $statusClass = 'bg-blue';
                        }

                        if (!$assignment_submission && $status && $status === 'Submitted') {
                          $assignment_submission_item = lxp_get_assignment_submissions($assignment->ID, $student->ID);
                          if (count($assignment_submission_item) > 0 && get_post_meta($assignment_submission_item['ID'], 'mark_as_graded', true) === 'true') {
                            $status = 'Graded';
                            $statusClass = 'bg-blue';
                          }
                        }
                      ?>
                      <span class="student_label label_red <?php echo $statusClass; ?>"><?php echo $status; ?></span>
                      <img src="<?php echo $treks_src; ?>/assets/img/select-arrow-up.svg" alt="" />
                    </div>
                  </div>
                </div>
              </li>
            <?php } ?>
          </ul>
          <!-- 
          <ul class="treks_ul" id="myTab" role="tablist">
            <li>
              <div
                class="nav-link active tab_btn"
                id="one-tab"
                data-bs-toggle="tab"
                data-bs-target="#one-tab-pane"
                type="button"
                role="tab"
                aria-controls="one-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />

                <div class="student_abouts_tab tab_bg_w">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_green">Completed</span>
                    <img src="<?php echo $treks_src; ?>/assets/img/select-arrow-up.svg" alt="" />
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="two-tab"
                data-bs-toggle="tab"
                data-bs-target="#two-tab-pane"
                type="button"
                role="tab"
                aria-controls="two-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />

                <div class="student_abouts_tab tab_bg_w">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_green">Completed</span>
                    <img src="<?php echo $treks_src; ?>/assets/img/select-arrow-up.svg" alt="" />
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="three-tab"
                data-bs-toggle="tab"
                data-bs-target="#three-tab-pane"
                type="button"
                role="tab"
                aria-controls="three-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />

                <div class="student_abouts_tab tab_bg_w">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_green">Completed</span>
                    <img src="<?php echo $treks_src; ?>/assets/img/select-arrow-up.svg" alt="" />
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="four-tab"
                data-bs-toggle="tab"
                data-bs-target="#four-tab-pane"
                type="button"
                role="tab"
                aria-controls="four-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />

                <div class="student_abouts_tab tab_bg_w">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_green">Completed</span>
                    <img src="<?php echo $treks_src; ?>/assets/img/select-arrow-up.svg" alt="" />
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="five-tab"
                data-bs-toggle="tab"
                data-bs-target="#five-tab-pane"
                type="button"
                role="tab"
                aria-controls="five-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/refresh-icon.svg" alt="" class="" />

                <div class="student_abouts_tab">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_red">In Progress</span>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="six-tab"
                data-bs-toggle="tab"
                data-bs-target="#six-tab-pane"
                type="button"
                role="tab"
                aria-controls="six-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/refresh-icon.svg" alt="" class="" />

                <div class="student_abouts_tab">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_red">In Progress</span>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div
                class="nav-link tab_btn"
                id="six-tab"
                data-bs-toggle="tab"
                data-bs-target="#six-tab-pane"
                type="button"
                role="tab"
                aria-controls="six-tab-pane"
                aria-selected="true"
              >
                <img src="<?php echo $treks_src; ?>/assets/img/warning-icon.svg" alt="" class="" />

                <div class="student_abouts_tab tab_op">
                  <div class="student_about">
                    <img src="<?php echo $treks_src; ?>/assets/img/rec_tre_img3.svg" alt="" class="student_user_img" />
                    <div class="student_names">
                      <h4>Jane Cooper</h4>
                      <p>5th grade</p>
                    </div>
                  </div>
                  <div class="stu_tag">
                    <span class="student_label label_black">To Do</span>
                  </div>
                </div>
              </div>
            </li>
          </ul>
           -->
        </nav>
        <!-- End School nav tabs -->

        <!-- Tabs Table -->
        <?php 
          $slides = get_assignment_lesson_slides( intval($_GET['assignment']) );
          if (isset($_GET['slide']) && intval($_GET['slide']) === intval($slides->data->totalSlides)) {
            get_template_part("lxp/grade-book", "grade-book", array('slides' => $slides, 'assignment_submission' => $assignment_submission));
          }else if ( isset($_GET['action']) && $_GET['action'] == 'grade' ) {
            $lessons = lxp_get_trek_digital_journals($trek->ID);
            $trek_lesson = null;
            foreach($lessons as $lesson){ if (trim($trek_section->title) === trim($lesson->post_title)) { $trek_lesson = $lesson; }; }
            $lti_post_attr_id = get_post_meta($trek_lesson->ID, 'lti_post_attr_id', true);
            $attrId = $lti_post_attr_id ? $lti_post_attr_id : 0;
            $queryParam = '';
            if (isset($_GET['slide'])) {
              $queryParam = "&slideNumber=" . $_GET['slide'];
            }
            $student_user_id = get_post_meta($_GET['student'], 'lxp_student_admin_id', true);
            $queryParam .= "&student=" . $student_user_id;
            $queryParam .= "&skipSave=1";
            $slidesData = $slides->data;
            $slides = $slides->slides;
            $slideIndex = intval($_GET['slide']);
            $slide_filtered_arr = array_filter($slides, function($slide) use($slideIndex) {
              return $slide->slide == $slideIndex;
            });
            ?>
              <div class="tab-content" id="myTabContent">
                <div class="container">
                  
                  <div class="row">
                    
                      <div class="col col-md-8">
                        <iframe style="border: none;width: 100%;height: 395px;" class="" src="<?php echo site_url() ?>?lti-platform&post=<?php echo $trek_lesson->ID ?>&id=<?php echo $attrId ?><?php echo $queryParam ?>" allowfullscreen></iframe>
                      </div>
                      <?php 
                        if (count($slide_filtered_arr) > 0) {
                          $slide_filtered = array_values($slide_filtered_arr)[0];
                          $max_grades = $slide_filtered->gradedManually && $slide_filtered->totalGrades ? $slide_filtered->totalGrades : 10;
                      ?>
                        <div class="col col-md-4">
                            <div class="grade-box">
                                <span class="grade-box-slide"><?php echo $slide_filtered->title; ?></span>
                                <?php if ($slide_filtered->type == 'Essay') { ?>
                                  <div class="grade-select">
                                    <select name="grade" id="grade" class="form-select">
                                      <option value="">----</option>
                                      <?php foreach (range(0, intval($max_grades)) as $grade_number) { ?>
                                        <option value="<?php echo $grade_number; ?>"><?php echo $grade_number; ?></option>
                                      <?php } ?>
                                    </select>
                                    <button class="grade-box-btn" onclick="assign_grade(<?php echo $_GET['slide']; ?>)">&nbsp;&nbsp;&nbsp;Grade&nbsp;&nbsp;&nbsp;</button>
                                    <br />
                                    <button class="add-feedback-btn btn btn-outline-info btn-lg" id="addFeedbackModal">Add Feedback</button>
                                    <button class="grade-box-btn" onclick="back()">Back</button>
                                  </div>
                                <?php 
                                  } else { 
                                    $auto_score = lxp_assignment_submission_auto_score($assignment_submission['ID'], $slideIndex);
                                    $score = $auto_score['score'];
                                    $max = $auto_score['max'];
                                ?>
                                  <!-- <div class="alert alert-primary text-center" role="alert"> Auto-graded </div> -->
                                  <span class="grade-box-slide"><?php echo $max ? "Grade: $score/$max" : "Not Submitted"; ?></span>
                                  <button class="grade-box-btn" onclick="back()">Back</button>
                                <?php } ?>
                        </div>
                      <?php } else { ?>
                        <div class="col col-md-4">
                          <div class="alert alert-warning text-center" role="alert">
                            <i>Slide <?php echo $_GET['slide']; ?></i> is not gradable.
                          </div>
                        </div>
                      <?php } ?>
                  </div>

                </div>
              </div>
          <?php } else {
            get_template_part("lxp/teacher-grade", "teacher-grade", array('assignment' => intval($_GET['assignment']), 'slides' => $slides));            
          }
        ?>
        <!-- End Table -->
      </section>
    </section>

    <script
      src="https://code.jquery.com/jquery-3.6.3.js"
      integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
      crossorigin="anonymous"
    ></script>
    <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
    <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      // function grade() redirect to grade page
      function grade(slide) {
        window.location.href = location.origin + location.pathname + "?assignment=<?php echo $_GET['assignment']; ?>&student=<?php echo $_GET['student']; ?>" + "&action=grade&slide=" + slide;
      }

      <?php if($assignment_submission) { ?>
      // function assign_grade() assign grade and selected grade to student
      function assign_grade(slide) {
        let grade = jQuery("#grade").val();
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';
        $.ajax({
          url: apiUrl + 'assignment/submission/grade',
          type: "POST",
          data: {
            "assignment_submission_id": "<?php echo $assignment_submission['ID']; ?>",
            "slide": slide,
            "grade": grade
          },
          success: function (response) {
            // back();
            window.location.reload();
          },
          error: function (error) {
            console.log(error);
          }
        });
      }

      <?php } ?>
      
      function back() {
        window.location.href = window.location.origin + window.location.pathname + "?assignment=<?php echo $_GET['assignment']; ?>&student=<?php echo $_GET['student']; ?>";
      }

      function switch_student(student_post_id) {
        window.location.href = window.location.origin + window.location.pathname + "?assignment=<?php echo $_GET['assignment']; ?>&student=" + student_post_id;
      }

      jQuery(document).ready(function () {
        var student_assignment_grade = "<?php echo $grade; ?>";
        if (student_assignment_grade) {
          jQuery("#grade").val(student_assignment_grade);
        }
        window.slideMessageReceivedCount = 0;
        window.slideMessageReceived = 0;
        window.addEventListener('message', function (event) {
          if (typeof event.data === 'object' && event.data.hasOwnProperty('currentSlide')) {
            window.slideMessageReceivedCount++;
            if (window.slideMessageReceivedCount > 1) {
              const params = new URLSearchParams(window.location.search);
              if (window.slideMessageReceived > 0 && window.slideMessageReceived !== parseInt(event.data.currentSlide)) {
                params.set('slide', event.data.currentSlide);
                window.location = window.location.origin + window.location.pathname + '?' + params.toString();  
              }
            } else if (window.slideMessageReceivedCount <= 1) {
              window.slideMessageReceived = parseInt(event.data.currentSlide);
            }
          }
        });

        // handle Mark as Graded check
        jQuery('#markGraded').on('change', function() {
          let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
          let apiUrl = host + '/wp-json/lms/v1/';
          let checked = jQuery(this).prop('checked');
          jQuery.ajax({
            url: apiUrl + 'assignment/submission/mark-as-graded',
            type: "POST",
            data: {
              "assignment_submission_id": "<?php echo $assignment_submission ? $assignment_submission['ID'] : 0; ?>",
              "checked": checked
            },
            success: function (response) {
              console.log(response);
              window.location.reload();
            },
            error: function (error) {
              console.log(error);
            }
          });
        });
        
      });
    </script>
    <?php
      if (isset($_GET['assignment']) && isset($_GET['slide']) && isset($_GET['student'])) {
        get_template_part("lxp/teacher-grading-feedback-modal", "teacher-grading-feedback-modal", array( 'assignment' => intval($_GET['assignment']), 'slide' => $_GET['slide'], 'assignment_submission_id' => $assignment_submission['ID'], 'student' => $_GET['student'] ));
      } 
      
      if ($assignment_submission) {
        get_template_part(
          "lxp/teacher-grading-feedback-view-modal", 
          "teacher-grading-feedback-view-modal", 
          array('assignment_submission_id' => $assignment_submission['ID'] )
        ) ;
      }
    ?>
  </body>
</html>

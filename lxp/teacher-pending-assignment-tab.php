<?php
  global $treks_src;
  $assignments = $args["assignments"];
  // filter $assignments based on "To Do", "In Progress" statuses and not having "Completed" status
  $assignments = array_filter($assignments, function($assignment) {
    $student_stats = lxp_assignment_stats($assignment->ID);
    $statuses = array("To Do", "In Progress",'Completed');
    $students_in_progress = array_filter($student_stats, function($studentStat) use ($statuses) {
      return in_array($studentStat["status"], $statuses);
    });
    return count($students_in_progress) > 0;
  });
  
?>
<!--  table -->
<div id="pending-tab-content" class="pending-assignments-table tab-pane fade" role="tabpanel">
  <table>
    <thead>
      <tr>
        <th>Class</th>
        <th>Course</th>
        <th>Lesson</th>
        <th>Due Date</th>
        <th>Student Progress</th>
        <th>Students Submitted</th>
        <th>Students Graded</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($assignments as $assignment) { 
          $class_post = get_post(get_post_meta($assignment->ID, 'class_id', true));
          $lxp_lesson_post = get_post(get_post_meta($assignment->ID, 'lxp_lesson_id', true));
          $course = get_post(get_post_meta($assignment->ID, 'course_id', true));
          $lesson_segment = implode("-", explode(" ", strtolower($lxp_lesson_post->post_title))) ;
          
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
          
        if ($students_graded != count($student_stats)) {
      ?>
        <tr>
          <td><?php echo $class_post->post_title; ?></td>
          <td>
            <?php 
              echo $course->post_title; 
              $course_post_image = has_post_thumbnail( $course->ID ) ? get_the_post_thumbnail_url($course->ID) : $treks_src.'/assets/img/tr_main.jpg';                       
            ?>
          </td>
          <td>
            <div class="assignments-table-cs-td-poly">
              <div class="polygon-shap">
                <!-- <span><?php echo $lxp_lesson_post->post_title[0]; ?></span> -->
                <span>L</span>
              </div>
              <div>
                <span><?php echo $lxp_lesson_post->post_title; ?></span>
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
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $course->post_title; ?>', '<?php echo $lxp_lesson_post->post_title; ?>', ['To Do', 'In Progress'], '<?php echo $course_post_image; ?>')"><?php echo count($students_in_progress); ?>/<?php echo count($student_stats); ?></a></div>
          </td>
          <td>
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $course->post_title; ?>', '<?php echo $lxp_lesson_post->post_title; ?>', ['Completed'], '<?php echo $course_post_image; ?>')"><?php echo count($students_completed); ?>/<?php echo count($student_stats); ?></a></div>
          </td>
          <td>
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $course->post_title; ?>', '<?php echo $lxp_lesson_post->post_title; ?>', ['Graded'], '<?php echo $course_post_image; ?>')"><?php echo $students_graded; ?>/<?php echo count($student_stats); ?></a></div>
          </td>
        </tr>  
      <?php } } ?>
    </tbody>
  </table>
</div>
<?php
  global $treks_src;
  $assignments = $args["assignments"];
  // filter $assignments based on "Completed" status and not having "To Do", "In Progress" statuses and count should be equal to total students
  $assignments = array_filter($assignments, function($assignment) {
    $student_stats = lxp_assignment_stats($assignment->ID);
    $statuses = array("Completed");
    $students_completed = array_filter($student_stats, function($studentStat) use ($statuses) {
      return in_array($studentStat["status"], $statuses);
    });
    return count($students_completed) > 0 && count($students_completed) === count($student_stats);
    //return count($students_completed) > 0;
  });
?>
<!--  table -->
<div id="completed-tab-content" class="pending-assignments-table tab-pane fade" role="tabpanel">
  <table>
    <thead>
      <tr>
        <th>Class</th>
        <th>TREK</th>
        <th>Segment</th>
        <th>Due Date</th>
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
          $segment = implode("-", explode(" ", strtolower($trek_section->title)));

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

          // if ( $students_graded === count($student_stats) ) { 
      ?>
        <tr>
          <td><?php echo $class_post && $class_id > 0 ? $class_post->post_title : 'Demo Class'; ?></td>
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
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['Completed'], '<?php echo $start; ?>', '<?php echo $end; ?>')"><?php echo count($students_completed); ?>/<?php echo count($student_stats); ?></a></div>
          </td>
          <td>
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['Graded'], '<?php echo $start; ?>', '<?php echo $end; ?>')"><?php echo $students_graded; ?>/<?php echo count($student_stats); ?></a></div>
          </td>
        </tr>  
      <?php 
           // } 
          } ?>
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
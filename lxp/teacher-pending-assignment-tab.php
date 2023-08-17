<?php
  global $treks_src;
  $assignments = $args["assignments"];
?>
<!--  table -->
<div id="pending-tab-content" class="pending-assignments-table tab-pane fade" role="tabpanel">
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
          $class_post = get_post(get_post_meta($assignment->ID, 'class_id', true));
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
          $students_completed = array_filter($student_stats, function($studentStat) use ($statuses) {
            return in_array($studentStat["status"], $statuses);
          });
      ?>
        <tr>
          <td><?php echo $class_post ? $class_post->post_title : 'Demo Class'; ?></td>
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
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['To Do', 'In Progress'])"><?php echo count($students_in_progress); ?>/<?php echo count($student_stats); ?></a></div>
          </td>
          <td>
            <?php
              $student_stats = lxp_assignment_stats($assignment->ID);
            ?>
            <div class="student-stats-link"><a href="#" onclick="fetch_assignment_stats(<?php echo $assignment->ID; ?>, '<?php echo $trek->post_title; ?>', '<?php echo $trek_section->title; ?>', ['Completed'])"><?php echo count($students_completed); ?>/<?php echo count($student_stats); ?></a></div>
          </td>
          <td>
            0
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
<?php
global $wpdb;
$userdata = isset($args['userdata']) ? $args['userdata'] : get_userdata(get_current_user_id());
$student_post = isset($args['student_post']) ? $args['student_post'] : lxp_get_student_post(get_current_user_id());
$assignments = isset($args['assignments']) ? $args['assignments'] : lxp_get_student_assignments($student_post->ID);

if (isset($args['trek_post_id'])) {
    // $assignments filter by trek id
    $assignments = array_filter($assignments, function ($assignment) use ($args) {
        return $assignment->trek_id == $args['trek_post_id'];
    });
}

foreach ($assignments as $assignment) {
    $trek = get_post($assignment->trek_id);
    $trek_section = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}trek_sections WHERE id = {$assignment->trek_section_id}");
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
    } else {
        $segmentColor = "#979797";
    }

    $args = array( 'posts_per_page'   => -1, 'post_type'        => 'tl_lesson', 'meta_query' => array(array('key'   => 'tl_course_id', 'value' =>  $trek->tl_course_id)));
    $lessons = get_posts($args);
    $digital_journal_link = null;
    foreach($lessons as $lesson){ if (trim($trek_section->title) === trim($lesson->post_title)) { $digital_journal_link = get_permalink($lesson->ID); }; }
    $digital_journal_link = $digital_journal_link . '?assignment_id=' . $assignment->ID;
?>

<a href="<?php echo $digital_journal_link; ?>" class="student-assignment-block" target="_blank">
    <div>
        <div class="assig-label-card">
            <div class="header">
            <div class="tags-body-polygon bg-green" style="background-color: <?php echo $segmentColor; ?>">
                <span><?php echo $trek_section->title[0]; ?></span>
            </div>
            </div>
            <div class="tag-assig-tetaul">
            <h3 style="color: <?php echo $segmentColor; ?>"><?php echo $trek_section->title; ?></h3>
            <p><?php echo $trek->post_title; ?></p>
            </div>
        </div>
        <!-- 
        <div class="progress" style="height: 4px">
            <div
            class="progress-bar"
            role="progressbar"
            style="width: 25%"
            aria-valuenow="25"
            aria-valuemin="0"
            aria-valuemax="100"
            ></div>
        </div>
         -->
    </div>
</a>

<?php } ?>


<?php if (count($assignments) == 0) { ?>
    <div style="color: gray;"><i><h6>No Assignment(s)</h6></i></div>
<?php } ?>
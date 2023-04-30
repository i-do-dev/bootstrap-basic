<?php
function lxp_login_check()
{
  if (!is_user_logged_in()) {
    global $wp;
    $url = "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    wp_redirect(site_url('login') . '?redirect=' . urlencode($url));
  }
}

function lxp_get_user_school_post($user_id = 0)
{
    $user_id = intval($user_id) > 0 ? $user_id : get_current_user_id();
    $school_query = new WP_Query( array( 
        'post_type' => TL_SCHOOL_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,
        'meta_query' => array(
            array('key' => 'lxp_school_admin_id', 'value' => $user_id, 'compare' => '=')
        )
    ) );
    $posts = $school_query->get_posts();
    $school_post = count( $posts ) > 0 ? $posts[0] : null;
    return $school_post;
}

function lxp_get_user_district_post($user_id = 0)
{
    $user_id = intval($user_id) > 0 ? $user_id : get_current_user_id();
    $district_query = new WP_Query( array( 
        'post_type' => TL_DISTRICT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,
        'meta_query' => array(
            array('key' => 'lxp_district_admin', 'value' => $user_id, 'compare' => '=')
        )
    ) );
    $posts = $district_query->get_posts();
    $district_post = count( $posts ) > 0 ? $posts[0] : null;
    return $district_post;
}

function lxp_get_district_schools($district_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_SCHOOL_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_school_district_id', 'value' => $district_id, 'compare' => '=')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return $posts;
}

function lxp_get_school_teachers($school_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_TEACHER_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_teacher_school_id', 'value' => $school_id, 'compare' => '=')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return $posts;
}

function lxp_get_school_students($school_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_STUDENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_student_school_id', 'value' => $school_id, 'compare' => '=')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return $posts;
}

function lxp_get_all_schools_teachers($school_ids)
{
    if (empty($school_ids)) {
        return array();
    }
    
    $school_query = new WP_Query( array( 
        'post_type' => TL_TEACHER_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_teacher_school_id', 'value' => $school_ids, 'compare' => 'IN')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return $posts;
}

function lxp_get_all_schools_students($school_ids)
{

    if (empty($school_ids)) {
        return array();
    }
    
    $school_query = new WP_Query( array( 
        'post_type' => TL_STUDENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_student_school_id', 'value' => $school_ids, 'compare' => 'IN')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return $posts;
}

function lxp_get_teacher_post($lxp_teacher_admin_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_TEACHER_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_teacher_admin_id', 'value' => $lxp_teacher_admin_id, 'compare' => '=')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return ( count($posts) > 0 ? $posts[0] : null );
}

function lxp_get_teacher_classes($lxp_class_teacher_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_CLASS_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_class_teacher_id', 'value' => $lxp_class_teacher_id, 'compare' => '=')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_student_all_classes($student_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_CLASS_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_student_ids', 'value' => $student_id, 'compare' => '=')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_all_teachers_classes($teachers_ids)
{
    if (empty($teachers_ids)) {
        return array();
    }

    $school_query = new WP_Query( array( 
        'post_type' => TL_CLASS_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_class_teacher_id', 'value' => $teachers_ids, 'compare' => 'IN')
        )
    ) );
    return $school_query->get_posts();
}

function get_trek_section_by_id($section_id)
{
    global $wpdb;
    return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}trek_sections WHERE id={$section_id}");
}

function lxp_get_class_assignments($class_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_ASSIGNMENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'class_id', 'value' => $class_id, 'compare' => '=')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_all_teachers_assignments($teachers_ids)
{

    if (empty($teachers_ids)) {
        return array();
    }

    $school_query = new WP_Query( array( 
        'post_type' => TL_ASSIGNMENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_assignment_teacher_id', 'value' => $teachers_ids, 'compare' => 'IN')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_teacher_assignments($teacher_id, $count = -1)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_ASSIGNMENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => $count,        
        'meta_query' => array(
            array('key' => 'lxp_assignment_teacher_id', 'value' => $teacher_id, 'compare' => 'IN')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_trek_segment_assignment($trek_id,  $trek_section_id, $lxp_assignment_teacher_id)
{
    $assignments_query = new WP_Query( array( 
        'post_type' => TL_ASSIGNMENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'trek_id', 'value' => $trek_id, 'compare' => '='),
            array('key' => 'trek_section_id', 'value' => $trek_section_id, 'compare' => '='),
            array('key' => 'lxp_assignment_teacher_id', 'value' => $lxp_assignment_teacher_id, 'compare' => '=')
        )
    ) );
    return $assignments_query->get_posts();
}

function lxp_get_assignment($assignment_id) {
    $assignment = get_post($assignment_id);
    $assignment->grade = get_post_meta($assignment_id, 'grade', true);
    $assignment->lxp_assignment_teacher_id = get_post_meta($assignment_id, 'lxp_assignment_teacher_id', true);
    $assignment->lxp_student_ids = get_post_meta($assignment_id, 'lxp_student_ids');
    $assignment->trek_section_id = get_post_meta($assignment_id, 'trek_section_id', true);
    $assignment->trek_id = get_post_meta($assignment_id, 'trek_id', true);
    $assignment->start_date = get_post_meta($assignment_id, 'start_date', true);
    $assignment->schedule = json_decode(get_post_meta($assignment_id, 'schedule', true));
    return $assignment;
}

function lxp_get_students($students_ids) {
    $students = array_map(function ($student_id)
    {
        $student = get_post($student_id);
        $student->grades = get_post_meta($student_id, 'grades', true);
        $admin = get_userdata(get_post_meta($student_id, 'lxp_student_admin_id', true));
        $student->admin_first_name = get_user_meta($admin->ID, 'first_name', true);
        $student->admin_last_name = get_user_meta($admin->ID, 'last_name', true);
        $student->name = $admin->data->display_name;
        $student->status = "In progress";
        $student->score = "0%";
        $student->progress = "0/0";
        return $student;
    }, $students_ids);
    return $students;
}

function lxp_get_trek_digital_journals($trek_id) {
    $courseId =  get_post_meta($trek_id, 'tl_course_id', true);
    $journal_query = new WP_Query( array( 
        'post_type' => "tl_lesson", 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'tl_course_id', 'value' => $courseId, 'compare' => '=')
        )
    ) );
    return $journal_query->get_posts();
}

// function lxp_get_student_assignment_grade to get grade for student with slid number
function lxp_get_student_assignment_grade($student_post_id, $assignment_post_id, $slide) {
    $assignment_grade_key = "assignment_" . $assignment_post_id . "_slide_" . $slide . "_grade";
    return get_post_meta($student_post_id, $assignment_grade_key, true);
}

function lxp_get_student_post($student_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_STUDENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_student_admin_id', 'value' => $student_id, 'compare' => '=')
        )
    ) );
    
    $posts = $school_query->get_posts();
    return count($posts) > 0 ? $posts[0] : null;
}

// function lxp_get_student_assignments to get all student assignments using WPQuery object and return array of assignments
function lxp_get_student_assignments($student_post_id)
{
    $school_query = new WP_Query( array( 
        'post_type' => TL_ASSIGNMENT_CPT, 
        'post_status' => array( 'publish' ),
        'posts_per_page'   => -1,        
        'meta_query' => array(
            array('key' => 'lxp_student_ids', 'value' => $student_post_id, 'compare' => 'IN')
        )
    ) );
    return $school_query->get_posts();
}

function lxp_get_assignments_treks($assignments)
{
    $treks = array_map(function ($assignment) { return get_post($assignment->trek_id)->ID; }, $assignments);
    $query = new WP_Query( array( 'post_type' => TL_TREK_CPT , 'posts_per_page'   => -1, 'post_status' => array( 'publish' ), 'post__in' => array_values(array_unique($treks)), 'meta_key' => 'sort', 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );
    return $query->get_posts();
}

function lxp_assignment_stats($assignment_id) {
    $students_ids = get_post_meta($assignment_id, 'lxp_student_ids');
    $q = new WP_Query( array( "post_type" => TL_STUDENT_CPT, 'posts_per_page'   => -1, "post__in" => $students_ids ) );
    $students_posts = $q->get_posts();
    $students = array_map(function ($student) { 
        $lxp_student_admin_id = get_post_meta($student->ID, 'lxp_student_admin_id', true);
        $userdata = get_userdata($lxp_student_admin_id);
        $grades = get_post_meta($student->ID, 'grades', true);
        $data = array("ID" => $student->ID, "name" => $userdata->data->display_name, "status" => "In progress", "progress" => "0/10", "score" => "0", "grades" => $grades);
        return $data;
    } , $students_posts);
    return $students;
}

function lxp_get_teacher_saved_treks($teacher_post_id, $treks_saved_ids)
{
    // get teacher post type 'treks_saved' metadata
    $treks_saved_ids = get_post_meta($teacher_post_id, 'treks_saved');
    $query = new WP_Query( array( 'post_type' => TL_TREK_CPT , 'posts_per_page'   => -1, 'post_status' => array( 'publish' ), 'post__in' => array_values(array_unique($treks_saved_ids)), 'meta_key' => 'sort', 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );
    return $query->get_posts();
}

// function to get assignment submission post type by assignment id using WPQuery object which returns array of posts.
function lxp_get_assignment_submissions($assignment_id, $student_post_id)
{
    $query = new WP_Query( array( 'post_type' => TL_ASSIGNMENT_SUBMISSION_CPT , 'posts_per_page'   => -1, 'post_status' => array( 'publish' ), 
                                'meta_query' => array(
                                    array('key' => 'lxp_assignment_id', 'value' => $assignment_id, 'compare' => '='),
                                    array('key' => 'lxp_student_id', 'value' => $student_post_id, 'compare' => '=')
                                )
                            )
                        );
    $assignment_submission_posts = $query->get_posts();

    if ($assignment_submission_posts) {
        $assignment_submission_post = $assignment_submission_posts[0];
        $assignment_submission_post_data = array(
            'ID' => $assignment_submission_post->ID,
            'lxp_assignment_id' => get_post_meta($assignment_submission_post->ID, 'lxp_assignment_id', true),
            'lxp_student_id' => get_post_meta($assignment_submission_post->ID, 'lxp_student_id', true),
            'lti_user_id' => get_post_meta($assignment_submission_post->ID, 'lti_user_id', true),
            'submission_id' => get_post_meta($assignment_submission_post->ID, 'submission_id', true),
            'score_min' => get_post_meta($assignment_submission_post->ID, 'score_min', true),
            'score_max' => get_post_meta($assignment_submission_post->ID, 'score_max', true),
            'score_raw' => get_post_meta($assignment_submission_post->ID, 'score_raw', true),
            'score_scaled' => get_post_meta($assignment_submission_post->ID, 'score_scaled', true),
            'completion' => boolval(get_post_meta($assignment_submission_post->ID, 'completion', true)),
            'duration' => get_post_meta($assignment_submission_post->ID, 'duration', true)
        );
        return $assignment_submission_post_data;
    } else {
        return null;
    }
}

function lxp_user_assignment_attempted($assignment_id, $user_id) {
    $query = new WP_Query( array( 'post_type' => TL_ASSIGNMENT_CPT , 'posts_per_page'   => -1, 'post_status' => array( 'publish' ), 'p' => $assignment_id,
                                'meta_query' => array(
                                    array('key' => 'attempted_students', 'value' => $user_id, 'compare' => 'IN')
                                )
                            )
                        );
    $assignment_posts = $query->get_posts();
    return count($assignment_posts) > 0 ? true : false;
}
?>
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
?>
<?php
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
?>
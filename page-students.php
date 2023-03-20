<?php
get_template_part('trek/functions');
lxp_login_check();

$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$userdata = get_userdata(get_current_user_id());

$userRole = count($userdata->roles) > 0 ? $userdata->roles[0] : '';
switch ($userRole) {
  case 'lxp_client_admin':
    get_template_part('lxp/client-students');
    break;
  case 'lxp_school_admin':
    get_template_part('lxp/school-students');
    break;
  case 'lxp_teacher':
    //get_template_part('lxp/teacher-dashboard');
    break;
  default:
    echo 'Not a valid User role';
    break;
}

?>
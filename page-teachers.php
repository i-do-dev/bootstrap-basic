<?php
get_template_part('lxp/functions');
lxp_login_check();

$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$userdata = get_userdata(get_current_user_id());

$userRole = count($userdata->roles) > 0 ? $userdata->roles[0] : '';
switch ($userRole) {
  case 'lxp_client_admin':
    get_template_part('lxp/client-teachers');
    break;
  case 'lxp_school_admin':
    get_template_part('lxp/school-teachers');
    break;
  case 'administrator':
    get_template_part('lxp/admin-teachers');
    break;
  default:
    echo 'Not a valid User role';
    break;
}

?>
<?php
get_template_part('lxp/functions');
lxp_login_check();

$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$userdata = get_userdata(get_current_user_id());
$userRole = count($userdata->roles) > 0 ? array_values($userdata->roles)[0] : '';
switch ($userRole) {
  case 'lxp_client_admin':
    get_template_part('lxp/client-schools');
    break;
  case 'administrator':
    get_template_part('lxp/admin-schools');
    break;
  default:
    echo 'Not a valid User role';
    break;
}

?>
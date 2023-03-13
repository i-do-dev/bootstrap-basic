<?php
global $treks_src;
?>
<ul>
    <li class="nav-section-selected">
        <img src="<?php echo $treks_src; ?>/assets/img/nav_dashboard-dots.svg" />
        <a href="<?php echo site_url("dashboard") ?>">Dashboard</a>
    </li>
    <li>
        <img src="<?php echo $treks_src; ?>/assets/img/nav-home.svg" />
        <a href="<?php echo site_url("schools") ?>">Schools</a>
    </li>
    <li>
        <img src="<?php echo $treks_src; ?>/assets/img/nav-verified-user.svg" />
        <a href="<?php echo site_url("teachers") ?>">Teachers</a>
    </li>
    <li>
        <img src="<?php echo $treks_src; ?>/assets/img/nav-user.svg" />
        <a href="<?php echo site_url("students") ?>">Students</a>
    </li>

</ul>
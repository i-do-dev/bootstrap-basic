<?php
  global $treks_src;
  global $post;
?>
<nav class="nav-section">
  <ul>
    <li class="<?php echo $post->post_name === "dashboard" ? "nav-section-selected" : ""; ?>">
      <img src="<?php echo $treks_src; ?>/assets/img/<?php echo $post->post_name === "dashboard" ? "nav_dashboard-dots.svg" : "nav_dashboard-dots_gray.svg"; ?>" />
      <a href="<?php echo site_url("dashboard") ?>">Dashboard</a>
    </li>
    <li class="<?php echo $post->post_name === "treks" || $post->post_type === "tl_trek" ? "nav-section-selected" : ""; ?>">
      <img src="<?php echo $treks_src; ?>/assets/img/<?php echo $post->post_name === "treks" || $post->post_type === "tl_trek" ? "nav_treks_selected.svg" : "nav_Treks.svg"; ?>" />
      <a href="<?php echo site_url("treks") ?>">TREKs</a>
    </li>
    <li>
      <img src="<?php echo $treks_src; ?>/assets/img/nav_reports.svg" />
      <a href="<?php echo site_url("assignments"); ?>">Assignments</a>
    </li>
  </ul>
</nav>
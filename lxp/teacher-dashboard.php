<?php
// get_template_part('lxp/functions');
global $treks_src;

// Start the loop.
$courseId =  isset($_GET['courseid']) ? $_GET['courseid'] : get_post_meta($post->ID, 'tl_course_id', true);
$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'tl_trek',
  'order' => 'asc',
);

if ( get_userdata(get_current_user_id())->user_email === "guest@rpatreks.com" ) {
  $args = array(
    'include' => '15',
    'post_type'        => 'tl_trek',
    'order' => 'post__in'
  );
}

$treks = get_posts($args);
while (have_posts()) : the_post();

$teacher_post = lxp_get_teacher_post( get_userdata(get_current_user_id())->ID );
$assignments = lxp_get_teacher_assignments($teacher_post->ID, 3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php the_title(); ?></title>
  <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
  <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
    <style type="text/css">
      .treks-card {
        width: 300px !important;
      }
      .treks-card-link {
        text-decoration: none !important;
      }
    </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">

        <div class="header-logo-search">
          <!-- logo -->
          <div class="header-logo">
            <img src="<?php echo $treks_src; ?>/assets/img/header_logo.svg" alt="svg" />
          </div>

        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
          <div class="header-logo-search">

            <!-- searching input -->
            <div class="header-search">
              <img src="<?php echo $treks_src; ?>/assets/img/header_search.svg" alt="svg" />
              <input placeholder="Search" />
            </div>
          </div>
        </div>
        <div class="d-flex" role="search">
          <div class="header-notification-user">
            <?php get_template_part('trek/user-profile-block') ?>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Basic Container -->
  <section class="main-container">
    <!-- Nav Section -->
    <nav class="nav-section">
      <?php get_template_part('trek/navigation') ?>
    </nav>

    <!-- Reminders: section-->
<!--     <section class="reminder-section">
      <div class="reminder-section-div">
        
        <div class="reminder-title reminder-detail">
          <img src="<?php // echo $treks_src; ?>/assets/img/rm_calendar.svg" />
          <span>Reminders:</span>
        </div>
        
        <div class="reminder-detail reminder-vli">
          <span>Physical Properties Thu 9:00 AM</span>
        </div>
        
        <div class="reminder-detail reminder-vli">
          <span>Forces & Experimental Design Fri 10:00 AM</span>
        </div>
        
        <div class="reminder-detail">
          <span>Physics Fri 1:00 PM</span>
        </div>
        
        <div class="reminder-detail">
          <span>Mathematics Mon 11:00 AM</span>
        </div>
        
        <div class="reminder-arrow">
          <img src="<?php echo $treks_src; ?>/assets/img/rm_arrow down.svg" />
        </div>
      </div>
    </section>
 -->
    <!-- Recent TREKs -->
    <section class="recent-treks-section">
      <div class="recent-treks-section-div">
        <!--  TREKs header-->
        <div class="recent-treks-header section-div-header">
          <h2>My TREKs</h2>
          <div>
            <a href="<?php echo site_url('treks'); ?>">See All</a>
          </div>
        </div>
        <!-- TREKs cards -->
        <div class="recent-treks-cards-list">
          <!-- each cards  -->
          <?php
          foreach($treks as $trek) {
          ?>
          <a href="<?php echo get_post_permalink($trek->ID); ?>" class="treks-card-link">
            <div class="recent-treks-card-body treks-card">
                <div>
                  <?php echo get_the_post_thumbnail($trek->ID, "medium", array( 'class' => 'rounded' )); ?>
                </div>
                <div>
                  <h3><?php echo get_the_title($trek->ID); ?></h3>
                  <span>Due date: May 17, 2023</span>
                </div>
              </div>
          </a>
          <?php
          }
          ?>
        </div>
      </div>
    </section>

    <!--Pending Assignments  -->
    <section class="pending-assignments-section">
      <div class="pending-assignments-section-div">
        <!--  header -->
        <div class="pending-assignments-header section-div-header">
          <h2>Assignments</h2>
          <div>
            <a href="<?php echo site_url('calendar');?>">See All</a>
          </div>
        </div>
        <!--  table -->
        <div class="pending-assignments-table">
          <table>
            <thead>
              <tr>
                <th>Class</th>
                <th>Assignments</th>
                <th>Due Date</th>
                <th>Pending</th>
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
                  $segment = implode("-", explode(" ", strtolower($trek_section->title))) ;
              ?>
                <tr>
                  <td><?php echo $class_post->post_title; ?></td>
                  <td>
                    <div class="assignments-table-cs-td-poly">
                      <div class="polygon-shap polygonshape-<?php echo $segment; ?>">
                        <span><?php echo $trek_section->title[0]; ?></span>
                      </div>
                      <div>
                        <span><?php echo $trek->post_title; ?></span>
                        <span><?php echo $trek_section->title; ?></span>
                      </div>
                    </div>
                  </td>
                  <td>---</td>
                  <td>0/0</td>
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
      </div>
    </section>

    <!-- Calendar &  Activities Completed Overall -->
    <!-- 
    <section class="clen-act-section">
      <div class="clen-act-section-div">
        <div class="calendar-portion">
          <div class="calendar-portion-header section-div-header">
            <h2>Pending Assignments</h2>
            <div>
              <a href="#">See All</a>
            </div>
          </div>
        </div>
        <div class="activities-portion">
          <div class="activities-portion-header section-div-header">
            <h2>Activities Completed Overall</h2>
          </div>

          <div class="activities-portion-prap">
            <p>This is the status of all the activities you have assigned.</p>

            <div class="activities-portion-progress">
               
                <div class="portion-progress-div">
                  <div class="recall-progress-bar"></div>
                  <p>Recall</p>
                </div>

                <div class="portion-progress-div">
                  <div class="pa-progress-bar"></div>
                  <p>Practice A</p>
                </div>

                <div class="portion-progress-div">
                  <div class="pb-progress-bar"></div>
                  <p>Practice B</p>
                </div>

                <div class="portion-progress-div">
                  <div class="apply-progress-bar"></div>
                  <p>Apply</p>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
     -->
  </section>

  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
  <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>
<?php endwhile; ?>
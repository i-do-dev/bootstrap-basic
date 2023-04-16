<?php
global $userdata;
$teacher_post = lxp_get_teacher_post($userdata->data->ID);

//$treks_src = plugin_dir_url( __FILE__ ) . 'treks-src';
$treks_src = get_stylesheet_directory_uri() . '/treks-src';
// Start the loop.
$courseId =  isset($_GET['courseid']) ? $_GET['courseid'] : get_post_meta($post->ID, 'tl_course_id', true);
$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'tl_lesson',
	'meta_query' => array(
		array(
			'key'   => 'tl_course_id',
			'value' =>  $courseId
		)
	)
);
$lessons = get_posts($args);
$button_styles = array();
while (have_posts()) : the_post();
global $wpdb;
$trek_sections = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}trek_sections WHERE trek_id={$post->ID} AND title='Overview' ORDER BY sort");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php the_title(); ?></title>
    <link href="<?php echo $treks_src; ?>/style/common.css" rel="stylesheet" />
    <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
    <link href="<?php echo $treks_src; ?>/style/style-trek-section.css" rel="stylesheet" />
    <link href="<?php echo $treks_src; ?>/style/trek-section.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/studentTreksOverview.css" />
    
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />

    <style type="text/css">
      .student-assignment-block {
        text-decoration: none !important;
      }
      .header-notification-user .copy-anchor
      {
        display: none;
      }
      
      .trek-section-hide {
        display: none;
      }
      .trek-section-nav-anchor {
        text-decoration: none;
      }
      .trek-main-heading {
        font-size: 1.5rem;
      }

      .digital-student-journal-section {
        justify-content: end;
      }
      .digital-student-journal-btn {
        width: 110% !important;
      }
      .trek-main-heading-wrapper {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin-bottom: 10px;
      }
      .trek-main-heading-top-link {
        margin-left: auto;
        background-color: #eaedf1;
        color: #979797;
        border: 1.5px solid #979797;
        padding: 6px;
        text-decoration: auto;
        font-size: 0.85rem;
      }
      .central-cncpt-section h1 {
        font-size: 1.6rem;
      }
      /* .central-cncpt-section h2 {
        font-size: 1.4rem;
      } */
      .central-cncpt-section h3 {
        font-size: 1.3rem;
      }
      .copy-anchor-icon-img {
        margin-left: 5px;
      }
      
      a:target {
        background-color: yellow !important;
      }
      
      a {
        color: #434343 !important;
      }
      
      ul {
        padding-left: 2rem !important;
      }
      table tr td {
        padding-top: 0.8rem !important;
        padding-left: 0.5rem !important;
      }

      .overview-poly-body .tags-body-polygon {
        width: 38px !important;
        height: 32px !important;
      } 
      /* overview active style */
      .tags-body.overview-poly-body-active {
        background: #979797;
      }
      .overview-poly-body-active .tags-body-detail span {
        color: #fff !important;
      }
      .overview-poly-body-active .tags-body-polygon {
        background: #fff !important;
      }
      .overview-poly-body-active .trek-section-character-overview {
        color: #979797 !important;
      }
      .tags-body.overview-poly-body-hover {
        background: #979797;
      }
      .overview-poly-body-hover .tags-body-detail span {
        color: #fff !important;
      }
      .overview-poly-body-hover .tags-body-polygon {
        background: #fff !important;
      }
      .overview-poly-body-hover .trek-section-character-overview {
        color: #979797 !important;
      }

      /* recall active style */
      .tags-body.recall-poly-body-active {
        background: #ca2738;
      }
      .recall-poly-body-active .tags-body-detail span {
        color: #fff !important;
      }
      .recall-poly-body-active .tags-body-polygon {
        background: #fff !important;
      }
      .recall-poly-body-active .trek-section-character-recall {
        color: #ca2738 !important;
      }
      .tags-body.recall-poly-body-hover {
        background: #ca2738;
      }
      .recall-poly-body-hover .tags-body-detail span {
        color: #fff !important;
      }
      .recall-poly-body-hover .tags-body-polygon {
        background: #fff !important;
      }
      .recall-poly-body-hover .trek-section-character-recall {
        color: #ca2738 !important;
      }

      /* practice a active style */
      .tags-body.pa-poly-body-active {
        background: #1fa5d4;
      }
      .pa-poly-body-active .tags-body-detail span {
        color: #fff !important;
      }
      .pa-poly-body-active .tags-body-polygon {
        background: #fff !important;
      }
      .pa-poly-body-active .trek-section-character-pa {
        color: #1fa5d4 !important;
      }
      .tags-body.pa-poly-body-hover {
        background: #1fa5d4;
      }
      .pa-poly-body-hover .tags-body-detail span {
        color: #fff !important;
      }
      .pa-poly-body-hover .tags-body-polygon {
        background: #fff !important;
      }
      .pa-poly-body-hover .trek-section-character-pa {
        color: #1fa5d4 !important;
      }

      /* practice b active style */
      .tags-body.pb-poly-body-active {
        background: #1fa5d4;
      }
      .pb-poly-body-active .tags-body-detail span {
        color: #fff !important;
      }
      .pb-poly-body-active .tags-body-polygon {
        background: #fff !important;
      }
      .pb-poly-body-active .trek-section-character-pb {
        color: #1fa5d4 !important;
      }
      .tags-body.pb-poly-body-hover {
        background: #1fa5d4;
      }
      .pb-poly-body-hover .tags-body-detail span {
        color: #fff !important;
      }
      .pb-poly-body-hover .tags-body-polygon {
        background: #fff !important;
      }
      .pb-poly-body-hover .trek-section-character-pb {
        color: #1fa5d4 !important;
      }

      /* apply active style */
      .tags-body.apply-poly-body-active {
        background: #9fc33b;
      }
      .apply-poly-body-active .tags-body-detail span {
        color: #fff !important;
      }
      .apply-poly-body-active .tags-body-polygon {
        background: #fff !important;
      }
      .apply-poly-body-active .trek-section-character-apply {
        color: #9fc33b !important;
      }
      .tags-body.apply-poly-body-hover {
        background: #9fc33b;
      }
      .apply-poly-body-hover .tags-body-detail span {
        color: #fff !important;
      }
      .apply-poly-body-hover .tags-body-polygon {
        background: #fff !important;
      }
      .apply-poly-body-hover .trek-section-character-apply {
        color: #9fc33b !important;
      }

      .fc-timegrid-event-harness:hover {
        cursor: pointer;
      }


    </style>
  </head>
  <body>
    
    <!-- Calendar Modal -->
    <?php get_template_part('trek/parts/assign-calendar'); ?>
    <!-- <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="calendarModalLabel">Calendar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-primary" role="alert">
              Loading Calendar ....
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
 -->
    <!-- Student Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="studentModalLabel">Assigned Students</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-primary" role="alert">
              Loading Students ....
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg treks-nav">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <div class="header-logo-search">
            <!-- logo -->
            <div class="header-logo">
              <img src="<?php echo $treks_src; ?>/assets/img/header_logo.svg" alt="svg" />
            </div>
          </div>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
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
              <?php get_template_part('trek/user-profile-block'); ?>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Basic Container -->
    <section class="main-container">
      <!-- Nav Section -->
      <nav class="nav-section">
        <?php get_template_part('trek/navigation-student') ?>
      </nav>

      <!-- My TREKs breadcrumbs -->
      <section class="my-trk-bc-section">
        <div class="my-trk-bc-section-div">
          <!-- breadcrumbs -->
          <img class="bc-img-1" src="<?php echo $treks_src; ?>/assets/img/bc_img.svg" />
          <p>My TREKs</p>
          <img class="bc-img-2" src="<?php echo $treks_src; ?>/assets/img/bc_arrow_right.svg" />
          <p><?php the_title(); ?></p>
        </div>
      </section>
      <!-- My TREKs Detail -->
      <section class="my-trk-detail-section">
        <div class="my-trk-detail-section-div">
          <!-- TREKs image  -->
          <div class="my-trk-detail-img">
            <!-- <img src="<?php //echo $treks_src; ?>/assets/img/tr_main.png" /> -->
            <?php the_post_thumbnail('medium', array( 'class' => 'rounded' )); ?>
          </div>
          <!-- TREKs detail -->
          <div class="my-trk-detail-prep">
            <!-- Title -->
            <div class="detail-prep-title">
              <h2><?php the_title(); ?></h2>
            </div>
            <!-- Description -->
            <div class="detail-prep-desc">
				      <p><?php echo $post->post_content; ?></p>
            </div>

            <!-- Navigation -->
            <div class="detail-prep-tags">
              <?php
                if ( $trek_sections ) {
                  foreach ( $trek_sections as $trek_section ) {
                    $button_style = strrpos($trek_section->title, " ") ? implode('', array_map(function($section_title) { return strtolower(substr($section_title, 0, 1)); }, explode(' ', strtolower($trek_section->title)))) : strtolower($trek_section->title);
                    $defined_button_styles = ['overview', 'recall', 'apply', 'pa', 'pb'];
                    $button_style = in_array($button_style, $defined_button_styles) ? $button_style : 'other';
                    $button_styles[trim($trek_section->title)] = "$button_style-poly-body";
              ?>
                  <!-- Navigation Button -->
                  <a href="#<?php echo implode('_', explode(' ', $trek_section->title));?>" class="trek-section-nav-anchor"> 
                    <div class="tags-body <?php echo $button_style; ?>-poly-body <?php echo $button_style === 'overview' ? 'overview-poly-body-active' : ''; ?>">
                      <div class="tags-body-polygon">
                        <span class="trek-section-character-<?php echo $button_style; ?>"><?php echo substr($trek_section->title, 0, 1);?></span>
                      </div>
                      <div class="tags-body-detail">
                        <span><?php echo $trek_section->title;?></span>
                      </div>
                    </div>
                  </a>
              <?php
                  }
                }
              ?>
                <a href="#Assignments" class="trek-section-nav-anchor nav-link"> 
                  <div class="tags-body overview-poly-body">
                    <div class="tags-body-detail">
                      <span> &nbsp; Assignments</span>
                    </div>
                  </div>
                </a>
            </div>
          </div>
        </div>
      </section>

      
      <?php  if ($post->post_name === "5-12a-interdependence") { ?>
        <section class="central-cncpt-section  trek-section-Overview">
              <br>
              <input type="hidden" name="buttonStyle" value="overview-poly-body">
              <!-- section heading -->
              <div class="trek-main-heading-wrapper">
                                <h1 class="trek-main-heading" id="Overview" style="color:#000000">Overview </h1>                
              </div>

              <div class="trek-main-body-wrapper">
                <h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Central Concepts</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">All of life depends on basic needs including food, shelter, air, and space for habitat.&nbsp;</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">All living organisms interact with other living and nonliving parts of their ecosystems.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Living organisms rely on this integration of living and nonliving components to grow and reproduce.</span></span></span></li>
</ul>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Misconceptions</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Dead organisms are considered organic biotic factors in ecosystems, not abiotic.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students need to understand that populations refer to living things and that a community is made of both the living and nonliving part of an ecosystem.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students should know that one ecosystem or environment can be made of many overlapping habitats. A habitat and ecosystem are not the same thing.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">When space is used as one of the needs of living things students need to understand that it includes more than an area to live but&nbsp; an area to find food, water, reproduce and raise young.</span></span></span></li>
</ul>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Segment Title &amp; Activities Description</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#ca2738"><strong>Recall</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000"><strong>Review: What Do Living Things Need?</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students recall prior knowledge of the basic needs of all organisms in their environment with transparent thinking.</span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#1fa5d4"><strong>Practice A</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000"><strong>Investigation: Rain &amp; Shine</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students collect and analyze data in a simulated comparative investigation to answer the research question, “How does water affect plant growth?” </span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#1fa5d4"><strong>Practice B</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000"><strong>In the Field: Billie the Birdwatcher</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students actively read and reflect as field scientists, support a second hand field investigation with Billie the Birdwatcher, and identify appropriate habitats for three North American bird species.</span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#9fc33b"><strong>Apply</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000"><strong>Mission: The Great Turtle Rescue</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students embark on a task-based problem-solving real-world scenario with a mission for a wildlife release in a nearby wildlife refuge using habitat maps adapted from Brazoria National Wildlife Refuge of coastal eastern Texas.</span></span></span></li>
</ul>

<p><span style="font-size:12pt"><span style="font-family:Roboto,sans-serif"><span style="color:#212529">&nbsp;</span></span></span></p>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Integrated Standards Alignment</strong></span></span></span></h2>

<p><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">All standards are based on Texas Essential Knowledge &amp; Skills statements unless otherwise noted.&nbsp;</span></span></span></p>


<h3><span style="font-size:13.999999999999998pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Looking Behind: Grades 3 and 4</strong></span></span></span></h3>
<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Science</strong></span></span></span>

	<ul>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">3.12A Explain how temperature and precipitation affect animal growth and behavior through migration and hibernation and plant responses through dormancy.
		</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">4.12A Investigate and explain how most producers can make their own food using sunlight, water, and carbon dioxide through the cycling of matter.
		</span></span></span></li>
	</ul>
	</li>
</ul>


<h3><span style="font-size:13.999999999999998pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Looking Ahead: Middle School</strong></span></span></span></h3>
<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Science</strong></span></span></span>

	<ul>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">6.12A  Investigate how organisms and populations in an ecosystem depend on and may compete for biotic factors such as food and abiotic factors such as availability of light and water, range of temperatures, or soil composition.
		</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">8.12A Explain how disruptions such as population changes, natural disasters, and human intervention impact the transfer of energy in food webs in ecosystems.
		</span></span></span></li>
	</ul>
	</li>
</ul>

              </div>
            </section>

      <?php }?>

      <?php  if ($post->post_name === "5-7b-forces-experimental-design") { ?>

        <section class="central-cncpt-section  trek-section-Overview">
              <br>
              <input type="hidden" name="buttonStyle" value="overview-poly-body">
              <!-- section heading -->
              <div class="trek-main-heading-wrapper">
                                <h1 class="trek-main-heading" id="Overview" style="color:#000000">Overview </h1>                
              </div>

              <div class="trek-main-body-wrapper">
                <h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#212529"><strong>Central Concepts</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">The forces of gravity, friction, and magnetism are directly observable and measured through experimentation.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">Motion is caused by unbalanced forces acting on objects and can be increased or decreased.&nbsp;&nbsp;</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">The amount of mass has an effect on how much an object moves.&nbsp;</span></span></span></li>
</ul>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Misconceptions</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Only Earth has gravity is not true. Gravity does not just occur on Earth but everywhere in space.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">When a moving object stops it is because it runs out of force. Objects do not contain force and cannot run out of it. Force is not the same thing as energy.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">If an object is not moving that does not mean that there are no forces acting on it. There are many forces that work on objects such as gravity, and atmospheric pressure.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">An object does not need force to keep moving. If an object does not meet resistance it will keep moving.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">All magnets work on all metals. Magnets do not work on all metals because all metals do not have iron.</span></span></span></li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">All magnets are made of iron is a misconception because they can have other elements that can strengthen them.</span></span></span></li>
</ul>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#212529"><strong>Segment Title &amp; Activities Description</strong></span></span></span></h2>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#ca2738"><strong>Recall</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Review: “How do we study motion?”</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">Students recall prior knowledge of the basics of physical science and how we can directly observe changes in motion when objects are pushed or pulled.</span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#1fa5d4"><strong>Practice A</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Investigation: Rocket Trajectories and STEAM Extension: Art (Optional)</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">Students collect and analyze data in a simulated experimental investigation to answer the research question, “How does changing a balloon rocket’s trajectory angle affect the distance traveled?” and an optional activity for differentiated groups developing a model to represent cause and effect. </span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#1fa5d4"><strong>Practice B</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>In the Lab: Harley’s Helmet Quest</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">Students actively read and reflect as lab scientists while supporting a second hand field investigation with Harley the Helmet Researcher to help write a guideline for manufacturing stronger helmets in sports safety.</span></span></span><br>
	&nbsp;</li>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#9fc33b"><strong>Apply</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Mission: Ramping Up Mobility</strong></span></span></span><br>
	<span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#000000">Students embark on a problem-solving, real-world scenario with the mission to </span></span></span><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">determine changes in motion on wheelchairs based on mass and surfaces, then use force measurements to select the most efficient wheelchair.</span></span></span></li>
</ul>

<p><span style="font-size:12pt"><span style="font-family:Roboto,sans-serif"><span style="color:#212529">&nbsp;</span></span></span></p>

<h2><span style="font-size:16pt"><span style="font-family:Nunito,sans-serif"><span style="color:#000000"><strong>Integrated Standards Alignment</strong></span></span></span></h2>

<p><span style="font-size:12pt"><span style="font-family:Roboto,sans-serif"><span style="color:#212529">All standards are based on Texas Essential Knowledge &amp; Skills statements unless otherwise noted.&nbsp;</span></span></span></p>

<h3><span style="font-size:13.999999999999998pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Looking Behind: Grades 3 and 4&nbsp;</strong></span></span></span></h3>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">Science&nbsp;</span></span></span>

	<ul>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">3.7A Demonstrate and describe forces acting on an object in contact or at a distance, including magnetism, gravity, and pushes and pulls.</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">3.7B Demonstrate and observe how position and motion can be changed by pushing and pulling objects such as swings, balls, and wagons.</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">4.7A Plan and conduct descriptive investigations to explore the patterns of forces such as gravity, friction, or magnetism in contact or at a distance on an object.</span></span></span></li>
	</ul>
	</li>
</ul>

<h3><span style="font-size:13.999999999999998pt"><span style="font-family:Arial"><span style="color:#212529"><strong>Looking Ahead: Middle School&nbsp;</strong></span></span></span></h3>

<ul>
	<li style="list-style-type:disc"><span style="font-size:12pt"><span style="font-family:Roboto,sans-serif"><span style="color:#212529">Science&nbsp;</span></span></span>

	<ul>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">6.7A Identify and explain how forces act on objects, including gravity, friction, magnetism, applied forces, and normal forces, using real-world applications.</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">7.7C Measure, record, and interpret an object's motion using distance-time graphs.</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">8.7A Calculate and analyze how the acceleration of an object is dependent upon the net force acting on the object and the mass of the object using Newton’s Second Law of Motion</span></span></span></li>
		<li style="list-style-type:circle"><span style="font-size:12pt"><span style="font-family:Arial"><span style="color:#212529">8.7B Investigate and describe how Newton's three laws of motion act simultaneously within systems such as in vehicle restraints, sports activities, amusement park rides, Earth's tectonic activities, and rocket launches.</span></span></span><br>
		<span style="font-size:12pt"><span style="font-family:Roboto,sans-serif"><span style="color:#212529">&nbsp;</span></span></span></li>
	</ul>
	</li>
</ul>
              </div>
            </section>
            
      <?php }?>

      <?php 
        if ( $trek_sections ) {
          foreach ( $trek_sections as $trek_section ) {
            $trek_section_hide = strtolower(trim($trek_section->title)) !== 'overview' ? 'trek-section-hide' : ''; 
      ?>
            <!-- 
            <section class="central-cncpt-section <?php echo $trek_section_hide; ?> <?php echo 'trek-section-'.implode('_', explode(' ', $trek_section->title));?>">
              <br />
              <input type="hidden" name="buttonStyle" value="<?php echo $button_styles[trim($trek_section->title)]; ?>" />
              
              <div class="trek-main-heading-wrapper">
                <?php
                  $headingColor = "#000000";
                  if ("overview" === strtolower(trim($trek_section->title))) {
                    $headingColor = "#000000";
                  } else if ("recall" === strtolower(trim($trek_section->title))) {
                    $headingColor = "#ca2738";
                  } else if ("practice a" === strtolower(trim($trek_section->title))) {
                    $headingColor = "#1fa5d4";
                  } else if ("practice b" === strtolower(trim($trek_section->title))) {
                    $headingColor = "#1fa5d4";
                  } else if ("apply" === strtolower(trim($trek_section->title))) {
                    $headingColor = "#9fc33b";
                  }
                ?>
                <h1 class="trek-main-heading" id="<?php echo implode('_', explode(' ', $trek_section->title));?>" style="color:<?php echo $headingColor?>"><?php echo $trek_section->title;?> <?php echo strtolower($trek_section->title) !== 'overview' ? 'Teacher Instructions' : ''; ?></h1>                
              </div>

              <div class="trek-main-body-wrapper">
                <?php echo stripslashes($trek_section->content);?>
              </div>
            </section>    -->
      <?php
          }
        }
      ?>
      <section class="central-cncpt-section trek-section-hide trek-section-Assignments">
        <div class="student-over-tab-content">
          <div class="tab-pane">
            <div class="stu-assig-cards">
              <?php 
                $trek_post_id = $post->ID;
                get_template_part('lxp/student-assignments-blocks', null, array('trek_post_id' => $trek_post_id));
              ?>
            </div>
          </div>
        </div>
      </section>
    </section>

    <script
      src="https://code.jquery.com/jquery-3.6.3.js"
      integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
      crossorigin="anonymous"
    ></script>
    <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
    <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <script type="text/javascript">
      function assign(trek_id, section_id) {
        window.location = "<?php echo site_url("assignment"); ?>" + "?trek=" + trek_id + "&segment=" + section_id;
      }
    </script>

    <script type="text/javascript">

      jQuery(document).ready(function() {
        
        const segment_classes = ["overview-poly-body", "recall-poly-body", "pa-poly-body", "pb-poly-body", "apply-poly-body"];
        const segment_active_classes = ["overview-poly-body-active", "recall-poly-body-active", "pa-poly-body-active", "pb-poly-body-active", "apply-poly-body-active"];
        
        var trekUrl = "<?php echo get_permalink($post->ID); ?>";

        // set copy icons to links
        jQuery("a").each(function() {
          if ($(this).attr("id")) {
            // prevent link action from navigation if it is #
            if ($(this).attr("href") === "#") {
              $(this).on('click', function(e) {
                e.preventDefault();
              });
            }

            $( '<a class="copy-anchor" href="#' + $(this).attr("id") + '" id="' + $(this).attr("id") + '_Copy_Link"><img class="copy-anchor-icon-img" src="<?php echo $treks_src; ?>/assets/img/link_icon.png" width="20" height="20" /></a>' ).insertAfter( $(this) );
            jQuery('#' + jQuery(this).attr("id") + '_Copy_Link').on('click', function(e) {
              e.preventDefault();

              var targetLinkArr = jQuery(this).attr("href").split('#');
              targetLinkId = targetLinkArr.length === 2 ? targetLinkArr[1] : null;
              if (targetLinkId) {
                var trekTargetUrl = trekUrl + "#" + targetLinkId;
                console.log("copy -- ", trekTargetUrl);

                document.addEventListener('copy', function(e) {
                    e.clipboardData.setData('text/plain', trekTargetUrl);
                    e.preventDefault();
                }, true);

                document.execCommand('copy');  
              }
            })
          }
        });

        // ************ Navigation Tabs ****************
        jQuery('a.trek-section-nav-anchor').on('mouseover', function(e) {
          const has_active_class = jQuery(this).find('.tags-body').attr('class').split(/\s+/).filter(className => segment_active_classes.includes(className));
          const has_segment_class = jQuery(this).find('.tags-body').attr('class').split(/\s+/).filter(className => segment_classes.includes(className));
          if (!has_active_class.length) {
            if (has_segment_class.length) {
              const sectionHoverSelector = has_segment_class[0] + '-hover';
              if (!jQuery(this).find('.tags-body').hasClass(sectionHoverSelector)) {
                jQuery(this).find('.tags-body').addClass(sectionHoverSelector);
              }
            } else {
              console.log("other segment ....");
            }
          }
        });

        jQuery('a.trek-section-nav-anchor').on('mouseleave', function(e) {
          const has_segment_class = jQuery(this).find('.tags-body').attr('class').split(/\s+/).filter(className => segment_classes.includes(className));
          if (has_segment_class.length > 0) {
            const sectionHoverSelector = has_segment_class[0] + '-hover';
            jQuery(this).find('.tags-body').removeClass(sectionHoverSelector);
          }
        });

        // on trek section click
        jQuery('a.trek-section-nav-anchor').on('click', function(e) {
          if (!jQuery(this).find('.digital-student-journal-btn').length) {
            e.preventDefault();
            const navHref = jQuery(this).attr('href').split('#');
            if (navHref.length > 1) {
              jQuery('.central-cncpt-section').addClass('trek-section-hide');
              jQuery('.trek-section-' + navHref[1]).removeClass('trek-section-hide');
            }

            const has_segment_class = jQuery(this).find('.tags-body').attr('class').split(/\s+/).filter(className => segment_classes.includes(className));
            if (has_segment_class.length > 0) {
              segment_classes.forEach(segment_class => {
                jQuery('a.trek-section-nav-anchor .' + segment_class).removeClass(segment_class + '-active');
              });
              const sectionHoverSelector = has_segment_class[0] + '-active';
              jQuery(this).find('.tags-body').addClass(sectionHoverSelector);
            }
          }
        });

        // ********* Execute the bookmark link ****************
        if (location.hash && jQuery('a' + location.hash).length > 0) {
          jQuery('section.central-cncpt-section').get().forEach(function(section) {            
            if (!jQuery(section).hasClass('trek-section-hide')) {
              jQuery(section).addClass('trek-section-hide');
            }
          });
          jQuery('a' + location.hash).parents('section.central-cncpt-section').removeClass('trek-section-hide');
          
          // set menu link active
          const buttonStyle =  jQuery('a' + location.hash).parents('section.central-cncpt-section').find('input[name="buttonStyle"]').val();
          console.log('buttonStyle ========>>> ', buttonStyle);
          segment_classes.forEach(segment_class => {
            jQuery('a.trek-section-nav-anchor .' + segment_class).removeClass(segment_class + '-active');
          });
          const sectionSelector = buttonStyle;
          
          
          jQuery('a.trek-section-nav-anchor .' + sectionSelector).get().forEach(element => {
            // console.log("1**************** ", jQuery(element).attr('class'));
            // console.log("2**************** ", !jQuery(element).hasClass('digital-student-journal-btn'));
            if (!jQuery(element).hasClass('digital-student-journal-btn')) {
              // jQuery(element).find('.' + sectionSelector).addClass(sectionSelector + '-active');
              jQuery(element).addClass(sectionSelector + '-active');
            }  
          });
          
          // book mark scrolling
          const bookmarkPosition = jQuery('a' + location.hash).position();
          if (bookmarkPosition) {
            window.scrollTo(bookmarkPosition.left, bookmarkPosition.top);
          }
        }
      });

      // **************** Student Modal ************************************************
      var studentModal = document.getElementById('studentModal');
      studentModalObj = new bootstrap.Modal(studentModal);
      studentModal.addEventListener('show.bs.modal', function (event) {
        var modalBody = studentModal.querySelector('.modal-body');
        let apiUrl = window.location.origin + '/wp-json/lms/v1/';
        $.ajax({
          method: "POST",
          url: apiUrl + "trek/section/assigned/students",
          data: { trek_section_id: window.trek_section_id, teacher_id: window.teacher_id }
        }).done(function( students ) {
          if (students.length > 0 ) {
            jQuery(modalBody).html(studentModelHTML(students, window.trek_section_id, window.teacher_id));
          } else {
            jQuery(modalBody).html('<div class="alert alert-warning" role="alert">No students assigned!</div>');
          }
        });
      });

      studentModal.addEventListener('hidden.bs.modal', function (event) {
        var modalBody = studentModal.querySelector('.modal-body');
        jQuery(modalBody).html('<div class="alert alert-primary" role="alert">Loading Students ....</div>');
      });

      function studentModelHTML(students, trek_section_id, teacher_id) {
        html = '<ul class="list-group">'
          students.forEach(student => {
            html +=  '<li class="list-group-item d-flex justify-content-between align-items-start">'
                  +'    <div class="ms-2 me-auto">'
                  +'      <div class="fw-regular">'+ student.name +'</div>'
                  +'      <em><small>5th grade</small></em>'
                  +'    </div>'
                  +'    <button type="button" class="btn btn-primary btn-sm">Report</button> &nbsp;'
                  +'    <button type="button" class="btn btn-danger btn-sm" onclick="unassign_student(' + student.student_assignment_id + ',' + trek_section_id + ',' + teacher_id + ')">Unassign</button>'
                +'    </li>';
          });

          html += '</ul>';
        return html;
      }

      function unassign_student(student_assignment_id, trek_section_id, teacher_id) {
        let apiUrl = window.location.origin + '/wp-json/lms/v1/';
        $.ajax({
          method: "POST",
          url: apiUrl + "trek/section/unassign/student",
          data: { student_assignment_id, trek_section_id, teacher_id}
        }).done(function( students ) {
          jQuery(".central-cncpt-section").get().forEach(el => {
            if(!jQuery(el).hasClass('trek-section-hide')) {
                jQuery(el).find('span.segment-student-count').text(students.length);
            }
          });
          studentModalObj.hide();
        });
      }

      // **************** Calendar Modal ************************************************
      var calendarModal = document.getElementById('calendarModal');
      calendarModalObj = new bootstrap.Modal(calendarModal);
      calendarModal.addEventListener('show.bs.modal', function (event) {
        jQuery('.trek-title-label').text(window.trekTitle);
        jQuery('.trek-segment-label').text(window.trekSectionTitle);
        jQuery('.trek-segment-label-character').text(window.trekSectionTitle[0]);
        var segmentColor = "#ca2738";
        if (window.trekSectionTitle === 'Overview') {
          segmentColor = "#979797";
        } else if (window.trekSectionTitle === 'Recall') {
          segmentColor = "#ca2738";
        } else if (window.trekSectionTitle === 'Practice A') {
          segmentColor = "#1fa5d4";
        } else if (window.trekSectionTitle === 'Practice B') {
          segmentColor = "#1fa5d4";
        } else if (window.trekSectionTitle === 'Apply') {
          segmentColor = "#9fc33b";
        }
        jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-tab-polygon').css('background-color', segmentColor);
        jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon-name, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-user-name').css('color', segmentColor);
        jQuery('.assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user').css('background-color', '#eaedf1');
        
        window.selectedCalendarEvent = null;
        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';
        var apiUrlLoadAssignments = host + '/wp-json/lms/v1/get/all/trek/events?user_id=<?php echo get_current_user_id() ?>';
        var calendarEl = document.getElementById('assignmentCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          selectable: true,
          initialView: 'timeGridWeek',
          events: apiUrlLoadAssignments ,
          select: function( selectionInfo ) {
              const start = selectionInfo.startStr;
              const end =  selectionInfo.endStr;
              const allDay = selectionInfo.allDay;
              window.selectedCalendarEvent = {start, end, allDay};
          }
        });
        calendar.render();
        window.calendarObj = calendar;
        // load users
        window.dataForCalendar;
        $.ajax({
          method: "POST",
          url: apiUrl + "trek/section/unassigned/students",
          data: { trek_section_id: window.dataForCalendar.trek_section_id, teacher_id: window.dataForCalendar.user_id }
        }).done(function( students ) {
          studentsHtml = "";
          students.forEach(student => {
            studentsHtml += '<div class="assignment-search-result">'
                            +'   <div class="search-user">'
                            +'       <input class="form-check-input checked-students" type="checkbox" value="' + student.id + '">'
                            +'       <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="user" />'
                            +'       <div class="user-name-detail">'
                            +'           <h5>' + student.name + '</h5>'
                            +'           <p>5th grade</p>'
                            +'       </div>'
                            +'   </div>'
                            +'</div>';
          });
          jQuery('.assignment-search').html(studentsHtml);
        });

        // var modalBody = calendarModal.querySelector('.modal-body');
        // let apiUrl = window.location.origin + '/wp-json/lms/v1/';
        
        /* $.ajax({
          method: "POST",
          url: apiUrl + "trek/section/assigned/students",
          data: { trek_section_id: window.trek_section_id, teacher_id: window.teacher_id }
        }).done(function( students ) {
          if (students.length > 0 ) {
            jQuery(modalBody).html(studentModelHTML(students, window.trek_section_id, window.teacher_id));
          } else {
            jQuery(modalBody).html('<div class="alert alert-warning" role="alert">No students assigned!</div>');
          }
        }); */
      });

      calendarModal.addEventListener('hidden.bs.modal', function (event) {
        // var modalBody = calendarModal.querySelector('.modal-body');
        // jQuery(modalBody).html('<div class="alert alert-primary" role="alert">Loading Students ....</div>');
      });

      function fetch_trek_assignments_calendar(trek_section_id, teacher_id) {
        window.trekTitle = jQuery('.detail-prep-title').text().replace(/\r?\n|\r/g, "").trim();
        jQuery(".central-cncpt-section").get().forEach(el => {
          if(!jQuery(el).hasClass('trek-section-hide')) {
            window.trekSectionTitle =  jQuery(el).find('h1.trek-main-heading').text().replace(/\r?\n|\r/g, "").trim();
          }
        });
        
        // window.trek_section_id = trek_section_id;
        // window.teacher_id = teacher_id;
        window.dataForCalendar = {trek_section_id, user_id: teacher_id};
        calendarModalObj.show();
      }
      /* 
      function studentModelHTML(students, trek_section_id, teacher_id) {
        html = '<ul class="list-group">'
          students.forEach(student => {
            html +=  '<li class="list-group-item d-flex justify-content-between align-items-start">'
                  +'    <div class="ms-2 me-auto">'
                  +'      <div class="fw-regular">'+ student.name +'</div>'
                  +'      <em><small>5th grade</small></em>'
                  +'    </div>'
                  +'    <button type="button" class="btn btn-primary btn-sm">Report</button> &nbsp;'
                  +'    <button type="button" class="btn btn-danger btn-sm" onclick="unassign_student(' + student.student_assignment_id + ',' + trek_section_id + ',' + teacher_id + ')">Unassign</button>'
                +'    </li>';
          });

          html += '</ul>';
        return html;
      }
      */

      function test_unassign_student(student_assignment_id, trek_section_id, teacher_id) {
        let apiUrl = window.location.origin + '/wp-json/lms/v1/';
        /* $.ajax({
          method: "POST",
          url: apiUrl + "trek/section/unassign/student",
          data: { student_assignment_id, trek_section_id, teacher_id}
        }).done(function( students ) {
          jQuery(".central-cncpt-section").get().forEach(el => {
            if(!jQuery(el).hasClass('trek-section-hide')) {
                jQuery(el).find('span.segment-student-count').text(students.length);
            }
          });
          calendarModalObj.hide();
        }); */
      }

      function trek_section_create_assignment() {
        let selected_students = [];
        jQuery('.checked-students:checked').each((i, el) => {
          selected_students.push(jQuery(el).val());
        });

        let ok = true;
        let message = "";
        if (selected_students.length === 0) {
          ok = false;
          message += "Please select Student(s). ";
        }
        if (window.selectedCalendarEvent === null) {
          ok = false;
          message += "Please select date time on Calendar";
        }

        // window.dataForCalendar
        if (ok) {
          let data = {...window.selectedCalendarEvent, ...window.dataForCalendar, teacher_id: window.dataForCalendar.user_id, student_ids: selected_students };
          let apiUrl = window.location.origin + '/wp-json/lms/v1/';
          $.ajax({
            url: apiUrl + "trek/section/assigned/students/store",
            data,
            type: "POST",
            async: false,
            success: function(students) {
                jQuery(".central-cncpt-section").get().forEach(el => {
                  if(!jQuery(el).hasClass('trek-section-hide')) {
                      jQuery(el).find('span.segment-student-count').text(students.length);
                  }
                });
            }
        }).always(function(){
            calendarObj.refetchEvents();
            bootstrap.Modal.getInstance(document.getElementById('calendarModal')).hide();
        });
        } else {
          alert(message);
        }
      }

      function assign_modal_close() {
        bootstrap.Modal.getInstance(document.getElementById('calendarModal')).hide();
      }
    </script>

    <?php get_template_part('lxp/assignment-stats-modal', 'assignment-stats-modal'); ?>

    <script type="text/javascript">
      function fetch_students(students_ids, trek_title, trek_segment) {
        jQuery("#student-modal-loader").show();
        jQuery("#student-modal-table").hide();
        format_modal_elements(trek_title, trek_segment);
        window.assignmentStatsModalObj.show();

        let host = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress' : window.location.origin;
        let apiUrl = host + '/wp-json/lms/v1/';
        jQuery.ajax({
          method: "POST",
          url: apiUrl + "students/list",
          data: { students_ids }
        }).done(function( response ) {
          jQuery("#student-modal-table tbody").html( response.data.map(student => student_assignment_stat_row_html(student)).join('\n') );
          jQuery("#student-modal-loader").hide();
          jQuery("#student-modal-table").show();
        });
      }

      function format_modal_elements(trek_title, trek_segment) {
        jQuery('#student-progress-trek-title').text(trek_title);
        jQuery('#student-progress-trek-segment').text(trek_segment);
        jQuery('#student-progress-trek-segment-char').text(trek_segment[0]);
        switch (trek_segment) {
            case 'Overview':
                segmentColor = "#979797";
                break;
            case 'Recall':
                segmentColor = "#ca2738";
                break;
            case 'Practice A':
                segmentColor = "#1fa5d4";
                break;
            case 'Practice B':
                segmentColor = "#1fa5d4";
                break;
            case 'Apply':
                segmentColor = "#9fc33b";
                break;
            default:
                segmentColor = "#ca2738";
                break;
        }
        jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-tab-polygon').css('background-color', segmentColor);
        jQuery('.students-modal .modal-content .modal-body .students-breadcrumb .interdependence-tab .inter-tab-polygon-name, .assignment-modal .modal-content .modal-body .assignment-modal-left .recall-user .inter-user-name').css('color', segmentColor);
      }

      function student_assignment_stat_row_html(student) {
          return `
              <tr>
                  <td>
                  <div class="table-user">
                      <img src="<?php echo $treks_src; ?>/assets/img/profile-icon.png" alt="user" />
                      <div class="user-about">
                      <h5>` + student.name + `</h5>
                      <p>` +  (student.grades && student.grades.length > 0 ? JSON.parse(student.grades).join(', ') : ``) + `</p>
                      </div>
                  </div>
                  </td>
                  <td>
                  <div class="table-status">` + student.status + `</div>
                  </td>
                  <td>` + student.progress + `</td>
                  <td>` + student.score + `</td>
                  <td><a href='<?php echo site_url("calendar"); ?>' target="_blank"><img src="<?php echo $treks_src; ?>/assets/img/review-icon.svg" alt="svg" width="30" /></a></td>
              </tr>
          `;
      }
    </script>
  </body>
</html>
<?php endwhile; ?>
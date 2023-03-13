<?php
ob_start();
$treks_src = get_stylesheet_directory_uri() . '/treks-src';
// Start the loop.
$courseId =  isset($_GET['courseid']) ? $_GET['courseid'] : get_post_meta($post->ID, 'tl_course_id', true);
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'tl_trek',
    'order' => 'asc'
);
$treks = get_posts($args);
while (have_posts()) : the_post();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php the_title(); ?></title>
        <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

        <style type="text/css">
            .treks-card {
                width: 300px !important;
            }

            .fc-content {
                padding: 7px;
            }

            .eventCloseBtn {
                padding: 3px;
                font-size: 18px;
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <?php get_template_part('lxp/admin-nav'); ?>
            </nav>

            <!-- Reminders: section-->
            <section class="reminder-section">
                <div class="reminder-section-div">
                    <!-- reminder title -->
                    <div class="reminder-title reminder-detail">
                        <img src="<?php echo $treks_src; ?>/assets/img/rm_calendar.svg" />
                        <span>Reminders:</span>
                    </div>
                    <!-- Physical Properties -->
                    <div class="reminder-detail reminder-vli">
                        <span>Physical Properties Thu 9:00 AM</span>
                    </div>
                    <!-- Forces & Experimental Design  -->
                    <div class="reminder-detail reminder-vli">
                        <span>Forces & Experimental Design Fri 10:00 AM</span>
                    </div>
                    <!-- Physics  -->
                    <div class="reminder-detail">
                        <span>Physics Fri 1:00 PM</span>
                    </div>
                    <!-- Mathematics Mon  -->
                    <div class="reminder-detail">
                        <span>Mathematics Mon 11:00 AM</span>
                    </div>
                    <!-- Arrow down
        <div class="reminder-arrow">
          <img src="<?php echo $treks_src; ?>/assets/img/rm_arrow down.svg" />
        </div> -->
                </div>
            </section>

            <!-- Recent TREKs -->
            <section class="recent-treks-section">
                <div class="recent-treks-section-div">
                    <!--  TREKs header-->
                    <div class="recent-treks-header section-div-header">
                        <h2>Schools</h2>
                    </div>
                    <div class="recent-treks-cards-list">
                        <div>
                            <button id="addSchoolModal" type="button" class="btn btn-primary">Add School</button>
                        </div>
                    </div>
                    <!-- TREKs cards -->
                    <div class="recent-treks-cards-list">
                        <div>
                            <form name="seach_form" method="get" action="">
                                <input type="text" name="search_param" value="<?php echo isset($_GET['search_param']) ? $_GET['search_param'] : '' ?>" />
                                <input type="submit">
                            </form>
                        </div>
                        <br>
                        <!-- each cards  -->
                    </div>
                    <div class="recent-treks-cards-list">

                        <!-- each cards  -->
                        <div>
                            <?php echo do_shortcode("[Schools-Short-Code]"); ?>
                        </div>
                    </div>
                </div>
            </section>



        </section>

        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <script src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
        <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <?php get_template_part('lxp/client-school-modal'); ?>

    </body>

    </html>
<?php endwhile;
ob_end_flush(); ?>
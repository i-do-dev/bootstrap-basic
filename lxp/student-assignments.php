<?php
$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$userdata = get_userdata(get_current_user_id());
$student_post = lxp_get_student_post(get_current_user_id());
$assignments = lxp_get_student_assignments($student_post->ID);
$treks = lxp_get_assignments_treks($assignments);
// Start the loop.
while (have_posts()) : the_post();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assignments</title>
    <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/studentTreksOverview.css" />
    <style type="text/css">
        .treks-card {
        width: 300px !important;
        }
        .treks-card-link {
        text-decoration: none !important;
        }
        .student-assignment-block {
            text-decoration: none !important;
        }
        .trek-assignments-heading {
            margin-left: 16px !important;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
    <section class="main-container treks_main_container">
        <!-- Nav Section -->
        <div class="main-container nav_container">
            <nav class="nav-section nav_section_treks">
                <?php get_template_part('trek/navigation-student') ?>
            </nav>
        </div>
        <!-- Recent Filters & TREKs flex -->
        <div class="filter_treks_flx">
            <!-- Recent Filters -->
            <section class="recent-treks-section filter_treks_section">
            </section>
            <!-- Recent TREKs -->
            <section class="recent-treks-section filter_treks_section filter_my_treks_sec">
                <div class="recent-treks-section-div">
                    <!--  TREKs header-->
                    <div class="section-div-header">
                        <h2>Assignments</h2>
                    </div>
                    <!-- TREKs cards -->
                    <div class="tab-content" id="myTabContent">
                        <div class="student-over-tab-content">
                            <div class="tab-pane">
                                <?php foreach ($treks as $trek) { ?>
                                    <h6 class="trek-assignments-heading"><?php echo $trek->post_title; ?></h6>
                                    <div class="stu-assig-cards">
                                        <?php get_template_part('lxp/student-assignments-blocks', null, array("trek_post_id" => $trek->ID, "userdata" => $userdata, "student_post" => $student_post, "assignments" => $assignments)); ?>
                                    </div>
                                    <br />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script
        src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
    <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
<?php endwhile; ?>
<?php
// get_template_part('lxp/functions');
global $treks_src;
$school_post = lxp_get_user_school_post();
$teachers = lxp_get_school_teachers($school_post->ID);
$students = lxp_get_school_students($school_post->ID);
$school_teachers_ids = array_map(function ($teacher) { return $teacher->ID; }, $teachers);
$classes = lxp_get_all_teachers_classes($school_teachers_ids);
$assignments = lxp_get_all_teachers_assignments($school_teachers_ids);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School Dashboard</title>
    <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/schoolDashboard.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/schoolAdminTeachers.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/addNewTeacherModal.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/calendar.css" />
    <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <style type="text/css">
        .tab-content > .active {
            display: block !important;
        }
        
        label.add-heading {
         cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
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
                        <?php get_template_part('trek/user-profile-block'); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Nav Section -->
    <section class="main-container">
        <nav class="nav-section">
            <?php get_template_part('lxp/admin-nav'); ?>
        </nav>
    </section>

    <!-- Welcome: section-->
    <section class="welcome-section">

        <!-- Welcome: heading-->
        <div class="welcome-content">
            <h2 class="welcome-heading">Welcome <?php echo $school_post->post_title; ?>!</h2>
            <p class="welcome-text">Here's how your academic system looks like</p>
        </div>

        <!-- Total Schools: section-->
        <section class="school-section">
            <section class="school-cards-section">
                <div class="cards-box">
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/verified-user.svg" alt="logo" />
                        <h3 class="numbers-heading"><?php echo count($teachers); ?></h3>
                        <p class="name-text">Teachers</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/classes.svg" alt="logo" />
                        <h3 class="numbers-heading"><?php echo count($classes); ?></h3>
                        <p class="name-text">Classes</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/groups.svg" alt="logo" />
                        <h3 class="numbers-heading">0</h3>
                        <p class="name-text">Groups</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/user.svg" alt="logo" />
                        <h3 class="numbers-heading"><?php echo count($students); ?></h3>
                        <p class="name-text">Students</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/assignment.svg" alt="logo" />
                        <h3 class="numbers-heading"><?php echo count($assignments); ?></h3>
                        <p class="name-text">Assignments</p>
                    </div>

                </div>

                <!-- Table Section -->
                <section class="recent-treks-section-div table-section">
                    <nav class="nav-section treks_nav table_tabs">
                        <ul class="treks_ul" id="myTab" role="tablist">
                            <li>
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#teacher-tab-content" type="button" role="tab" aria-controls="teacher-tab-content"
                                    aria-selected="false">
                                    Teachers
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                    data-bs-target="#student-tab-content" type="button" role="tab"
                                    aria-controls="student-tab-content" aria-selected="true">
                                    Students
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="to-tab" data-bs-toggle="tab"
                                    data-bs-target="#class-tab-content" type="button" role="tab"
                                    aria-controls="class-tab-content" aria-selected="false">
                                    Classes
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="inprogress-tab" data-bs-toggle="tab"
                                    data-bs-target="#group-tab-content" type="button" role="tab"
                                    aria-controls="group-tab-content" aria-selected="false">
                                    Groups
                                </button>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content">
                        <?php get_template_part('lxp/school-dashboard-teachers-tab', 'teacher-tab', array('teachers' => $teachers)); ?>
                        <?php get_template_part('lxp/school-dashboard-students-tab', 'student-tab', array('students' => $students)); ?>
                        <?php get_template_part('lxp/school-dashboard-classes-tab', 'class-tab', array('classes' => $classes)); ?>
                    </div>
                </section>
            </section>
            <!-- Recent TREKs -->
            <section class="recent-treks-section" style="width: 100%;">
                <div class="recent-treks-section-div">
                    <!--  TREKs header-->
                    <div class="recent-treks-header section-div-header">
                        <h2>Top TREKs</h2>
                        <div>
                            <a href="#">See All</a>
                        </div>
                    </div>
                    <!-- TREKs cards -->
                    <!-- 
                    <div class="recent-treks-cards-list">

                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php // echo $treks_src; ?>/assets/img/admin_rec_tre_img1.svg" />
                            </div>
                            <div>
                                <h3>5.12A Interdependence</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php // echo $treks_src; ?>/assets/img/admin_rec_tre_img2.svg" />
                            </div>
                            <div class="recent-second-card">
                                <h3>5.7B Forces & Experimental Design</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php // echo $treks_src; ?>/assets/img/admin_rec_tre_img3.svg" />
                            </div>
                            <div>
                                <h3>5.6A Physical Properties</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                    </div>
 -->
                </div>
                <!-- Assignment section -->
                <section class="recent-treks-section assignment-section">
                    <div class="recent-treks-section-div">
                        <!--  Assignment header-->
                        <div class="recent-treks-header section-div-header">
                            <h2>Assignments</h2>
                        </div>
                        <div class="section-div-header">
                            <h2 class="to-do">To Do</h2>
                        </div>
                        <div class="section-div-header">
                            <h2 class="progress-heading">In Progress</h2>
                        </div>
                </section>
            </section>
        </section>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script
        src="<?php echo $treks_src; ?>/js/Animated-Circular-Progress-Bar-with-jQuery-Canvas-Circle-Progress/dist/circle-progress.js"></script>
    <script src="<?php echo $treks_src; ?>/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    
    <?php get_template_part('lxp/school-teacher-modal'); ?>
    <?php get_template_part('lxp/school-student-modal', 'student-modal', array("school_post" => $school_post)); ?>
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.nav-link').on('show.bs.tab', function (event) {
                localStorage.setItem("school_dashboard_tab", jQuery(event.target).attr('data-bs-target'));
            });

            let current_tab = localStorage.getItem("school_dashboard_tab");
            if (current_tab) {
                let tabEl = jQuery('button.nav-link[data-bs-target="' + current_tab + '"]');
                var tab = new bootstrap.Tab(tabEl);
                tab.show();
            } else {
                let tabEl = jQuery('button.nav-link[data-bs-target="' + '#teacher-tab-content' + '"]');
                var tab = new bootstrap.Tab(tabEl);
                tab.show();
            }
        });
    </script>
</body>

</html>
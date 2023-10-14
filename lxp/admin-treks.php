<?php
//get_template_part('lxp/functions');
lxp_login_check();
$treks_src = get_stylesheet_directory_uri() . '/treks-src';
// get treks based on tekversion metadata using WP_Query and meta_query
$tekversion = isset($_GET['tekversion']) ? $_GET['tekversion'] : '2017';
$treks = get_posts(array(
    'post_type' => TL_TREK_CPT,
    'posts_per_page' => -1,
    'meta_key' => 'sort', 'orderby' => 'meta_value_num', 'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'tekversion',
            'value' => $tekversion,
            'compare' => '='
        ),
    )
));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>District / Teachers</title>
    <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/schoolAdminTeachers.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/schoolDashboard.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/schoolAdminStudents.css" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/adminTeacher.css" />
    <link href="<?php echo $treks_src; ?>/style/treksstyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/addNewTeacherModal.css" />
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

    <!-- Teachers: section-->
    <section class="welcome-section">
        <!-- Teachers: heading-->
        <div class="welcome-content">
            <h2 class="welcome-heading">TREKs</h2>
            <p class="welcome-text">Comprehensive teacher database and records management</p>
            <br />
            <!-- bootstrap form with Dstricts drop down component displaying using $district_posts -->
            <form class="row g-3 recent-treks-section-div">
                <!-- column md 12 with merge -->
                <div class="col-md-4">
                    <label for="tekversion-drop-down" class="form-label">Version</label>
                    <select id="tekversion-drop-down" class="form-select">
                        <option value="2017" <?php echo isset($_GET['tekversion']) && $_GET['tekversion'] == '2017' ? 'selected=selected' : ''; ?>>2017 TEKS (Beta)</option>
                        <option value="2021" <?php echo isset($_GET['tekversion']) && $_GET['tekversion'] == '2021' ? 'selected=selected' : ''; ?>>2021 TEKS (New TEKS)</option>
                    </select>                    
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </form>
        </div>

        <!-- Teachers: section-->
        <section class="school-section">
            <section class="school_teacher_cards">

                <!-- Admin Teacher Table Section -->
                <section class="recent-treks-section-div table-school-section">

                    <div class="students-table">
                        <div class="school-box">

                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="">
                                        <div class="th1">
                                            TREK
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th1 th2">
                                            TEK Version
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($treks as $trek) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $trek->post_title; ?>
                                        </td>
                                        <td>
                                            <?php echo get_post_meta($trek->ID, 'tekversion', true); ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button" onclick="onTREKEdit(<?php echo $trek->ID; ?>)">
                                                        <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                        Edit</button>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                        <!-- 
                        <div class="school-box">
                            <div class="showing-row-box">
                                <p class="showing-row-text">Showing 1 - 5 of 25</p>
                            </div>
                            <div class="row-box">
                                <p class="showing-row-text">First</p>
                                <img class="previous-slide-img" src="<?php // echo $treks_src; ?>/assets/img/previous-arrow.svg" alt="logo" />
                                <div class="slides-boxes">
                                    <div class="slide-box"><span class="showing-row-text slide-num">1</span></div>
                                    <div class="slide-box"><span class="showing-row-text slide-num slide-num2">2</span>
                                    </div>
                                    <div class="slide-box"><span class="showing-row-text slide-num slide-num2">3</span>
                                    </div>
                                </div>
                                <img class="last-slide-img" src="<?php // echo $treks_src; ?>/assets/img/last-slide.svg" alt="logo" />
                                <p class="showing-row-text">Last</p>
                            </div>
                        </div>
                         -->

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
    
    <script>
        $(document).ready(function () {
            $('#tekversion-drop-down').change(function () {
                var tekversion = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('tekversion', tekversion);
                window.location.href = url.href;
            });
        });
    </script>

    <?php 
        //get_template_part('lxp/admin-teacher-assign-treks-modal');
        // check if district_id and school_id GET set
        //get_template_part('lxp/admin-teacher-modal');
        
    ?>
        <!-- <div class="modal fade teachers-modal" id="teacherModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-header-title">
                            <h2 class="modal-title" id="teacherModalLabel"><span class="teacher-action-head">New</span> Teacher</h2>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Please select <strong>District</strong> and <strong>School</strong> to add/edit a teacher.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
            
    
    <script type="text/javascript">
        function onTREKEdit(x) {
            // redirect to wp admin post edit page in new tab
            window.open('<?php echo get_admin_url(); ?>post.php?post=' + x + '&action=edit', '_blank');
        }
    </script>
</body>

</html>
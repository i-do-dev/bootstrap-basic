<?php
get_template_part('trek/functions');
lxp_login_check();

$treks_src = get_stylesheet_directory_uri() . '/treks-src';
$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'tl_trek',
    'order' => 'asc'
);

if ( get_userdata(get_current_user_id())->user_email === "guest@rpatreks.com" ) {
    $args = array(
        'include' => '15',
        'post_type'        => 'tl_trek',
        'order' => 'post__in'
    );
}

$treks = get_posts($args);
// Start the loop.
while (have_posts()) : the_post();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="<?php echo $treks_src; ?>/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $treks_src; ?>/style/header-section.css" />
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
                <?php get_template_part('trek/navigation') ?>
            </nav>
        </div>
        <!-- Recent Filters & TREKs flex -->
        <div class="filter_treks_flx">
            <!-- Recent Filters -->
            <section class="recent-treks-section filter_treks_section">
                <div class="recent-treks-section-div recent_filter_treks_div">
                    <!--  TREKs header-->
                    <div class="section-div-header filter_section">
                        <div class="filter_bx">
                            <img src="<?php echo $treks_src; ?>/assets/img/filter-logo.svg" />
                            <h2>Filters</h2>
                        </div>
                        <div>
                            <a href="#">See All</a>
                        </div>
                    </div>
                    <div class="treks_bottom_border">
                        <h3 class="filter_treks_heading">TREKs</h3>
                    </div>
                    <div class="treks_bottom_border">
                        <h3 class="filter_treks_heading">Strand</h3>
                    </div>
                    <div class="treks_bottom_border">
                        <h3 class="filter_treks_heading">BackPack</h3>
                    </div>
                </div>
            </section>
            <!-- Recent TREKs -->
            <section class="recent-treks-section filter_treks_section filter_my_treks_sec">
                <div class="recent-treks-section-div">
                    <!--  TREKs header-->
                    <div class="section-div-header">
                        <h2>My TREKs</h2>
                    </div>
                    <nav class="nav-section treks_nav">
                        <ul class="treks_ul" id="myTab" role="tablist">
                            <li>
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                    data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane"
                                    aria-selected="true">All</button>
                            </li>
                            <li>
                                <button class="nav-link" id="to-tab" data-bs-toggle="tab"
                                    data-bs-target="#todo-tab-pane" type="button" role="tab"
                                    aria-controls="todo-tab-pane" aria-selected="true">To Do</button>
                            </li>
                            <li>
                                <button class="nav-link" id="inprogress-tab" data-bs-toggle="tab"
                                    data-bs-target="#inprogress-tab-pane" type="button" role="tab"
                                    aria-controls="inprogress-tab-pane" aria-selected="true">In Progress</button>
                            </li>
                            <li>
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                    data-bs-target="#completed-tab-pane" type="button" role="tab"
                                    aria-controls="completed-tab-pane" aria-selected="true">Completed</button>
                            </li>
                        </ul>
                        <div class="treks_inner_flx">
                            <img src="<?php echo $treks_src; ?>/assets/img/filter-right-logo.svg" />
                            <div class="sort_flex_bx">
                                <img src="<?php echo $treks_src; ?>/assets/img/filter-sort-logo.svg" />
                                <p>Sort by A-Z</p>
                            </div>
                        </div>
                    </nav>
                    <!-- TREKs cards -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active recent-treks-cards-list treks_card_list" id="all-tab-pane"
                            role="tabpanel" aria-labelledby="all-tab" tabindex="0">
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
                        <div class="tab-pane fade show recent-treks-cards-list treks_card_list" id="todo-tab-pane"
                            role="tabpanel" aria-labelledby="todo-tab" tabindex="1">
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
                        <div class="tab-pane fade show recent-treks-cards-list treks_card_list" id="inprogress-tab-pane"
                            role="tabpanel" aria-labelledby="inprogress-tab" tabindex="2">
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
                        <div class="tab-pane fade show recent-treks-cards-list treks_card_list" id="completed-tab-pane"
                            role="tabpanel" aria-labelledby="completed-tab" tabindex="3">
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
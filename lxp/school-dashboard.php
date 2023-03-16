<?php
get_template_part('lxp/functions');
global $treks_src;
$district_post = lxp_get_user_district_post();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
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
                        <!-- notification -->
                        <div class="header-notification">
                            <img src="<?php echo $treks_src; ?>/assets/img/header_bell-notification.svg" alt="svg" />
                        </div>
                        <!-- user detail & Image  -->
                        <div class="header-user">
                            <!-- User Avatar -->
                            <div class="user-avatar">
                                <img src="<?php echo $treks_src; ?>/assets/img/header_avatar.svg" alt="svg" />
                            </div>
                            <!-- User short detail -->
                            <div class="user-detail">
                                <span class="user-detail-name">Kristin Watson</span>
                                <span>Science teacher</span>
                            </div>
                            <!-- Arrow for open menu -->
                            <div class="user-options">
                                <img src="<?php echo $treks_src; ?>/assets/img/header_arrow open.svg" alt="svg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Nav Section -->
    <section class="main-container">
        <nav class="nav-section">
            <ul>
                <li class="nav-section-selected">
                    <img src="<?php echo $treks_src; ?>/assets/img/nav_dashboard-dots.svg" />
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <img src="<?php echo $treks_src; ?>/assets/img/nav-verified-user.svg" />
                    <a href="/">Teachers</a>
                </li>
                <li>
                    <img src="<?php echo $treks_src; ?>/assets/img/nav-user.svg" />
                    <a href="/">Students</a>
                </li>
                <li>
                    <img src="<?php echo $treks_src; ?>/assets/img/nav_Treks.svg" />
                    <a href="/">TREKs</a>
                </li>
            </ul>
        </nav>
    </section>

    <!-- Welcome: section-->
    <section class="welcome-section">

        <!-- Welcome: heading-->
        <div class="welcome-content">
            <h2 class="welcome-heading">Welcome Nathan!</h2>
            <p class="welcome-text">Here's how your academic system looks like</p>
        </div>

        <!-- Total Schools: section-->
        <section class="school-section">
            <section class="school-cards-section">
                <div class="cards-box">
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/verified-user.svg" alt="logo" />
                        <h3 class="numbers-heading">22</h3>
                        <p class="name-text">Teachers</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/classes.svg" alt="logo" />
                        <h3 class="numbers-heading">19</h3>
                        <p class="name-text">Classes</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/groups.svg" alt="logo" />
                        <h3 class="numbers-heading">11</h3>
                        <p class="name-text">Groups</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/user.svg" alt="logo" />
                        <h3 class="numbers-heading">345</h3>
                        <p class="name-text">Students</p>
                    </div>
                    <div class="card">
                        <img src="<?php echo $treks_src; ?>/assets/img/assignment.svg" alt="logo" />
                        <h3 class="numbers-heading">124</h3>
                        <p class="name-text">Assignments</p>
                    </div>

                </div>

                <!-- Table Section -->
                <section class="recent-treks-section-div table-section">
                    <nav class="nav-section treks_nav table_tabs">
                        <ul class="treks_ul" id="myTab" role="tablist">
                            <li>
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                    data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane"
                                    aria-selected="true">
                                    Teachers
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="to-tab" data-bs-toggle="tab"
                                    data-bs-target="#todo-tab-pane" type="button" role="tab"
                                    aria-controls="todo-tab-pane" aria-selected="true">
                                    Classes
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="inprogress-tab" data-bs-toggle="tab"
                                    data-bs-target="#inprogress-tab-pane" type="button" role="tab"
                                    aria-controls="inprogress-tab-pane" aria-selected="true">
                                    Groups
                                </button>
                            </li>
                            <li>
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                    data-bs-target="#completed-tab-pane" type="button" role="tab"
                                    aria-controls="completed-tab-pane" aria-selected="true">
                                    Students
                                </button>
                            </li>
                        </ul>
                    </nav>
                    <div class="add-teacher-box">
                        <div class="search-filter-box">
                            <input type="text" name="text" placeholder="Search..." />
                            <div class="filter-box">
                                <img src="<?php echo $treks_src; ?>/assets/img/filter-alt.svg" alt="filter logo" />
                                <p class="filter-heading">Filter</p>
                            </div>
                        </div>
                        <div class="add-box">
                            <img src="<?php echo $treks_src; ?>/assets/img/add.svg" alt="logo" />
                            <p class="add-heading">Add New Teacher</p>
                        </div>
                    </div>
                    <div class="students-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="">
                                        <div class="th1">
                                            Teacher
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th1 th2">
                                            Email
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th1 th3">
                                            Classes
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th1 th4">
                                            Grades
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th1 th5">
                                            ID
                                            <img src="<?php echo $treks_src; ?>/assets/img/showing.svg" alt="logo" />
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="user-box">
                                        <div class="table-user">
                                            <img src="<?php echo $treks_src; ?>/assets/img/user1.svg" alt="user" />
                                            <div class="user-about">
                                                <h5>Jane Cooper</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-status">tranthuy.nute@gmail.com</div>
                                    </td>
                                    <td>4</td>
                                    <td class="grade">
                                        <span>
                                            4th
                                        </span>
                                    </td>
                                    <td>3627</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                    Edit</button>
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="logo" />
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="second-row">
                                    <td class="user-box">
                                        <div class="table-user">
                                            <img src="<?php echo $treks_src; ?>/assets/img/user2.svg" alt="user" />
                                            <div class="user-about">
                                                <h5>Wade Warren</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-status wade-email">manhhachkt08@gmail.com</div>
                                    </td>
                                    <td>5</td>
                                    <td class="grade">
                                        <div class="grades_box">
                                            <span class="span">4th</span>
                                            <span class="span">5th</span>

                                        </div>
                                    </td>
                                    <td>5322</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                    Edit</button>
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="logo" />
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="user-box">
                                        <div class="table-user">
                                            <img src="<?php echo $treks_src; ?>/assets/img/user3.svg" alt="user" />
                                            <div class="user-about">
                                                <h5>Esther Howard</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-status">nvt.isst.nute@gmail.com</div>
                                    </td>
                                    <td><span>3</span></td>
                                    <td class="grade">
                                        <div class="grades_box">
                                            <span>3rd</span>
                                            <span>4th</span>
                                        </div>
                                    </td>
                                    <td>3024</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                    Edit</button>
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="logo" />
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="user-box">
                                        <div class="table-user">
                                            <img src="<?php echo $treks_src; ?>/assets/img/user4.svg" alt="user" />
                                            <div class="user-about">
                                                <h5>Brooklyn Simmons</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-status">trungkienspktnd@gamail.com</div>
                                    </td>
                                    <td>3</td>
                                    <td class="grade">
                                        <span>
                                            5th
                                        </span>
                                    </td>
                                    </td>
                                    <td>3614</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                    Edit</button>
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="logo" />
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="user-box">
                                        <div class="table-user">
                                            <img src="<?php echo $treks_src; ?>/assets/img/user5.svg" alt="user" />
                                            <div class="user-about">
                                                <h5>Jenny Wilson</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-status">trungkienspktnd@gamail.com</div>
                                    </td>
                                    <td>3</td>
                                    <td class="grade">
                                        <span>
                                            3rd
                                        </span>
                                    </td>
                                    </td>
                                    <td>2984</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown_btn" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo $treks_src; ?>/assets/img/dots.svg" alt="logo" />
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/edit.svg" alt="logo" />
                                                    Edit</button>
                                                <button class="dropdown-item" type="button">
                                                    <img src="<?php echo $treks_src; ?>/assets/img/delete.svg" alt="logo" />
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>
            <!-- Recent TREKs -->
            <section class="recent-treks-section">
                <div class="recent-treks-section-div">
                    <!--  TREKs header-->
                    <div class="recent-treks-header section-div-header">
                        <h2>Top TREKs</h2>
                        <div>
                            <a href="#">See All</a>
                        </div>
                    </div>
                    <!-- TREKs cards -->
                    <div class="recent-treks-cards-list">
                        <!-- each cards  -->

                        <!-- card 1 -->
                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php echo $treks_src; ?>/assets/img/admin_rec_tre_img1.svg" />
                            </div>
                            <div>
                                <h3>5.12A Interdependence</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                        <!-- card 2 -->
                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php echo $treks_src; ?>/assets/img/admin_rec_tre_img2.svg" />
                            </div>
                            <div class="recent-second-card">
                                <h3>5.7B Forces & Experimental Design</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                        <!-- card 3 -->
                        <div class="recent-treks-card-body">
                            <div>
                                <img src="<?php echo $treks_src; ?>/assets/img/admin_rec_tre_img3.svg" />
                            </div>
                            <div>
                                <h3>5.6A Physical Properties</h3>
                                <span>Due date: May 17, 2023</span>
                            </div>
                        </div>
                    </div>
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
</body>

</html>
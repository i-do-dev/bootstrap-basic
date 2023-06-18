
<?php
global $treks_src;
$assignment_id = $args['assignment'];
$slides = get_assignment_lesson_slides(intval($assignment_id));
$slides_pages = array_chunk($slides, 4);

$student_id = 0;
if ( (isset($_GET['student']) && intval($_GET['student']) > 0) ) {
  $student_id = intval($_GET['student']);
}

$assignment = lxp_get_assignment($assignment_id);
$assignment_submission = lxp_get_assignment_submissions($assignment->ID, $student_id);
?>
<div class="tab-content" id="myTabContent">
    <!-- Teachers Table -->
    <h1 class="stu_heading">Submissions</h1>
    <div
    class="tab-pane fade show active"
    id="one-tab-pane"
    role="tabpanel"
    aria-labelledby="one-tab"
    tabindex="0"
    >
    <div
        id="carouselExampleControlsNoTouching"
        class="carousel slide"
        data-bs-touch="false"
        data-bs-interval="false"
    >
        <div class="carousel-inner" style="height: 250px;">
        
            <?php foreach ($slides_pages as $page_key => $slide_page) { ?>
                <div class="carousel-item<?php echo $page_key == 0 ? ' active' : ''; ?>">
                    <div class="slider_cards_flex">
                        <?php 
                            foreach ($slide_page as $slide_key => $slide) { 
                            $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide->slide));
                            $green_class = $grade > 0 ? 'green_slide' : '';
                            $no_right_border = count($slide_page) == $slide_key + 1 ? ' no-right-border' : '';

                            $grade = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide->slide . "_grade", true) : '';
                            $result = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide->slide . "_result", true) : '';
                            $total_grades_str = $result ? '/' .json_decode($result)->score->max : '';
                        ?>
                            <div class="student_grade_card<?php echo $no_right_border; ?>">
                                <span class="student_slide <?php echo $grade == '' ? "gray" : 'green'; ?>_slide <?php echo $green_class; ?>">Slide <?php echo $slide->slide; ?></span>
                                <p><?php echo $slide->title; ?></p>
                                <h2 class="gray_grade"><?php echo $grade == '' ? "Not Graded" : $grade.$total_grades_str; ?></h2>
                                <button class="grade_btn" onclick="grade(<?php echo $slide->slide; ?>)">Grade</button>
                                <?php if($grade != '') { ?>
                                    <img style="margin-top: 10px;" src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
            
        </div>

        <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleControlsNoTouching"
        data-bs-slide="prev"
        >
        <span class="carousel-control-prev-icon" aria-hidden="true"
            ><img src="<?php echo $treks_src; ?>/assets/img/slide-icon.svg" alt=""
        /></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleControlsNoTouching"
        data-bs-slide="next"
        >
        <span class="carousel-control-next-icon" aria-hidden="true"
            ><img src="<?php echo $treks_src; ?>/assets/img/slide-icon.svg" alt=""
        /></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- <div class="student_buttons">
        <div class="total_label">
        <h2>Total score:</h2>
        <span>0/19</span>
        </div>
        <button class="save_btn">Save</button>
    </div> -->
    </div>
    <!-- Classes Table -->
    <div
    class="tab-pane fade show"
    id="two-tab-pane"
    role="tabpanel"
    aria-labelledby="two-tab"
    tabindex="1"
    ></div>
    <!-- Groups Table -->
    <div
    class="tab-pane fade show"
    id="three-tab-pane"
    role="tabpanel"
    aria-labelledby="three-tab"
    tabindex="2"
    ></div>
    <!-- Students Table -->
    <div
    class="tab-pane fade show"
    id="four-tab-pane"
    role="tabpanel"
    aria-labelledby="four-tab"
    tabindex="3"
    ></div>
</div>

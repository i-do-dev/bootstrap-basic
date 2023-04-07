
<?php
global $treks_src;
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
        <div class="carousel-inner">
        
        <div class="carousel-item active">
            <div class="slider_cards_flex">
                <?php 
                    foreach (range(1, 4) as $slide) { 
                    $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide));
                    $green_class = $grade > 0 ? 'green_slide' : '';
                ?>
                    <div class="student_grade_card">
                        <span class="student_slide gray_slide <?php echo $green_class; ?>">Slide <?php echo $slide; ?></span>
                        <!-- <p>What Is Happening?</p> -->
                        <!-- <h2 class="gray_grade">1/1</h2> -->
                        <button class="grade_btn" onclick="grade(<?php echo $slide; ?>)">Grade</button>
                        <?php if($grade > 0) { ?>
                            <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="carousel-item">
            <div class="slider_cards_flex">
                <?php 
                    foreach (range(5, 8) as $slide) { 
                    $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide));
                    $green_class = $grade > 0 ? 'green_slide' : '';
                ?>
                    <div class="student_grade_card">
                        <span class="student_slide gray_slide <?php echo $green_class; ?>">Slide <?php echo $slide; ?></span>
                        <!-- <p>What Is Happening?</p> -->
                        <!-- <h2 class="gray_grade">1/1</h2> -->
                        <button class="grade_btn" onclick="grade(<?php echo $slide; ?>)">Grade</button>
                        <?php if($grade > 0) { ?>
                            <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="carousel-item">
            <div class="slider_cards_flex">
                <?php 
                    foreach (range(9, 12) as $slide) { 
                    $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide));
                    $green_class = $grade > 0 ? 'green_slide' : '';
                ?>
                    <div class="student_grade_card">
                        <span class="student_slide gray_slide <?php echo $green_class; ?>">Slide <?php echo $slide; ?></span>
                        <!-- <p>What Is Happening?</p> -->
                        <!-- <h2 class="gray_grade">1/1</h2> -->
                        <button class="grade_btn" onclick="grade(<?php echo $slide; ?>)">Grade</button>
                        <?php if($grade > 0) { ?>
                            <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="carousel-item">
            <div class="slider_cards_flex">
                <?php 
                    foreach (range(13, 16) as $slide) { 
                    $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide));
                    $green_class = $grade > 0 ? 'green_slide' : '';
                ?>
                    <div class="student_grade_card">
                        <span class="student_slide gray_slide <?php echo $green_class; ?>">Slide <?php echo $slide; ?></span>
                        <!-- <p>What Is Happening?</p> -->
                        <!-- <h2 class="gray_grade">1/1</h2> -->
                        <button class="grade_btn" onclick="grade(<?php echo $slide; ?>)">Grade</button>
                        <?php if($grade > 0) { ?>
                            <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="carousel-item">
            <div class="slider_cards_flex">
                <?php 
                    foreach (range(17, 20) as $slide) { 
                    $grade = intval(lxp_get_student_assignment_grade($_GET['student'], $_GET['assignment'], $slide));
                    $green_class = $grade > 0 ? 'green_slide' : '';
                ?>
                    <div class="student_grade_card">
                        <span class="student_slide gray_slide <?php echo $green_class; ?>">Slide <?php echo $slide; ?></span>
                        <!-- <p>What Is Happening?</p> -->
                        <!-- <h2 class="gray_grade">1/1</h2> -->
                        <button class="grade_btn" onclick="grade(<?php echo $slide; ?>)">Grade</button>
                        <?php if($grade > 0) { ?>
                            <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>




        <!-- 
        <div class="carousel-item">
            <div class="slider_cards_flex">
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 3</span>
                <p>What Is Happening?</p>
                <h2 class="gray_grade">1/1</h2>
                <button class="grade_btn">Grade</button>
            </div>
            <div class="student_grade_card">
                <span class="student_slide green_slide">Slide 6</span>
                <p>Vocabulary Check</p>
                <h2 class="black_grade">6/6</h2>
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
            </div>
            <div class="student_grade_card">
                <span class="student_slide green_slide">Slide 7</span>
                <p>Apply Academic Terms</p>
                <h2 class="black_grade">4/6</h2>
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
            </div>
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 6</span>
                <p>Connect to You!</p>
                <h2 class="gray_grade">2/4</h2>
                <button class="grade_btn">Grade</button>
            </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="slider_cards_flex">
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 3</span>
                <p>What Is Happening?</p>
                <h2 class="gray_grade">1/1</h2>
                <button class="grade_btn">Grade</button>
            </div>
            <div class="student_grade_card">
                <span class="student_slide green_slide">Slide 6</span>
                <p>Vocabulary Check</p>
                <h2 class="black_grade">6/6</h2>
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
            </div>
            <div class="student_grade_card">
                <span class="student_slide green_slide">Slide 7</span>
                <p>Apply Academic Terms</p>
                <h2 class="black_grade">4/6</h2>
                <img src="<?php echo $treks_src; ?>/assets/img/check-g.svg" alt="" class="check-g" />
            </div>
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 6</span>
                <p>Connect to You!</p>
                <h2 class="gray_grade">2/4</h2>
                <button class="grade_btn">Grade</button>
            </div>
            </div>
        </div>
            -->
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

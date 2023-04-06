
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
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 1</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(1)">Grade</button>
            </div>

            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 2</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(2)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 3</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(3)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 4</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(4)">Grade</button>
            </div>

            </div>
        </div>
        
        <div class="carousel-item">
            <div class="slider_cards_flex">
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 5</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(5)">Grade</button>
            </div>

            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 6</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(6)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 7</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(7)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 8</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(8)">Grade</button>
            </div>

            </div>
        </div>
        
        
        <div class="carousel-item">
            <div class="slider_cards_flex">
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 9</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(9)">Grade</button>
            </div>

            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 10</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(10)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 11</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(11)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 12</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(12)">Grade</button>
            </div>

            </div>
        </div>

        
        
        <div class="carousel-item">
            <div class="slider_cards_flex">
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 13</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(13)">Grade</button>
            </div>

            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 14</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(14)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 15</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(15)">Grade</button>
            </div>
            
            <div class="student_grade_card">
                <span class="student_slide gray_slide">Slide 16</span>
                <!-- <p>What Is Happening?</p> -->
                <!-- <h2 class="gray_grade">1/1</h2> -->
                <button class="grade_btn" onclick="grade(16)">Grade</button>
            </div>

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

<?php
global $treks_src;
?>
<div class="tab-pane fade show active" id="teachers-tab-pane" role="tabpanel" aria-labelledby="teachers-tab" tabindex="0">
    <!-- New Assignment Day Week Month Buttons -->
    <section class="assignment-section new-assignment-section">
        <h3 class="new-assignment-heading">New Assignment</h3>
        <div class="button-box">
            <button class="assignment-button day-button">Day</button>
            <button class="assignment-button week-button active">Week</button>
            <button class="assignment-button month-button">Month</button>
        </div>
    </section>
    <!-- Calendar Section -->
    <section class="new-assignment-section calendar-container">
        <section class="assignment-section calendar-section">
            <p class="month-text month-date-text">February 19 - 25, 2023</p>
            <div class="previous-last-box">
                <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/left-arrow.svg" alt="arrow" />
                <p class="month-text">February</p>
                <img class="cursor-img" src="<?php echo $treks_src; ?>/assets/img/right-arrow.svg" alt="arrow" />
            </div>
        </section>
    </section>
    <section class="calendar-container">
        <section class="calendar-section">
            <div id="calendar"></div>
        </section>
    </section>
</div>
<?php
global $treks_src;
?>
<section class="welcome-section assignment-section">
    <button class="back-btn">
        <img src="<?php echo $treks_src; ?>/assets/img/back.svg" alt="logo" />
        <p class="back-btn-text">Back</p>
    </button>

    <!-- Assignment Tabs -->
    <nav class="nav-section select-section">
        <ul class="treks_ul select-ul" id="myTab" role="tablist">
            <li>
                <button class="select-link active" id="teachers-tab" data-bs-toggle="tab"
                    data-bs-target="#teachers-tab-pane" type="button" role="tab" aria-controls="teachers-tab-pane"
                    aria-selected="true">
                    <span class="select-num">1</span>
                    Select a space in your calendar
                </button>
            </li>
            <li>
                <button class="select-link" id="classes-tab" data-bs-toggle="tab" data-bs-target="#classes-tab-pane"
                    type="button" role="tab" aria-controls="classes-tab-pane" aria-selected="true">
                    <span class="select-num">2</span>
                    Select TREK or RPA segments
                </button>
            </li>
            <li>
                <button class="select-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#groups-tab-pane"
                    type="button" role="tab" aria-controls="groups-tab-pane" aria-selected="true">

                    <span class="select-num third-select-num">3</span>
                    Select Class and Students
                </button>
            </li>
        </ul>
    </nav>
    <!-- End Assignment Tabs -->
</section>

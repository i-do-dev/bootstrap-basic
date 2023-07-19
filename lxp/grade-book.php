<?php
$assignment_submission = $args['assignment_submission'];
$slides = $args['slides'];
$slidesData = $slides->data;
$slides = $slides->slides;

// get assignment submission 'mark_as_graded' post meta
$mark_as_graded = get_post_meta($assignment_submission['ID'], 'mark_as_graded', true);
global $post;
?>
<div class="tab-content" id="myTabContent">
    <div class="container">
        <?php if ($post->post_name === 'grade-assignment') { ?>
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="back()"><i class="bi bi-arrow-return-left"></i> Back</button>
                </div>
                <div class="col-md-3 offset-md-6">
                    <div class="alert alert-info" role="alert" style="padding-left: 38px;">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="markGraded" <?php echo boolval($mark_as_graded) ? 'checked' : '/'; ?>>
                            <label class="form-check-label" for="markGraded"><strong>Mark Graded</strong></label>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Slide</th>
                            <th scope="col">Score/Total</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slides as $slide) { ?>
                            <tr>
                                <td>Slide <?php echo $slide->slide; ?>: <?php echo $slide->title; ?></td>
                                <td>
                                    <?php
                                        if(in_array($slide->type, array('Essay'))) {
                                            $grade = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide->slide . "_grade", true) : "";
                                            echo $grade === "" ? "---" : "$grade/10";
                                        } else {
                                            $auto_score = lxp_assignment_submission_auto_score($assignment_submission['ID'], intval($slide->slide));
                                            $score = $auto_score['score'];
                                            $max = $auto_score['max'];
                                            if ($max > 0) {
                                                echo $score. '/' . $max;
                                            } else {
                                                echo "---";
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(in_array($slide->type, array('Essay'))) {
                                            $grade = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide->slide . "_grade", true) : "";
                                            
                                            if ($grade) {
                                                $score = $grade;
                                                $max = 10;
                                                $percentage = ($score / $max) * 100;
                                                if ($percentage >= 80) {
                                                    $progress_class = "bg-success";
                                                    $icon = 'check-lg';
                                                } else {
                                                    $progress_class = "bg-danger";
                                                    $icon = 'x-lg';
                                                }
                                    ?>
                                                <div class="row">
                                                    <div class="col col-3">
                                                        <div class="<?php echo $progress_class; ?> rounded-pill" style="height: 25px; width: 100%;">
                                                            <center><i class="bi bi-<?php echo $icon; ?> text-white"></i></center>
                                                        </div>
                                                    </div>
                                                    <div class="col col-9">
                                                        <div class="progress" style="height: 25px;">
                                                            <div class="progress-bar <?php echo $progress_class; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $score; ?>" aria-valuemin="0" aria-valuemax="<?php echo $max; ?>">
                                                                <?php echo round(($score / $max) * 100); ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php        
                                            } else {
                                    ?>
                                            <div class="row">
                                                <div class="col col-3">
                                                    <div class="bg-warning rounded-pill" style="height: 25px; width: 100%;">
                                                        <center><i class="bi bi-dash-lg text-white"></i></center>
                                                    </div>
                                                </div>
                                                <div class="col col-9">
                                                    To Be Graded
                                                </div>
                                            </div>
                                    <?php
                                            }
                                        } else {
                                            $auto_score = lxp_assignment_submission_auto_score($assignment_submission['ID'], intval($slide->slide));
                                            $score = $auto_score['score'];
                                            $max = $auto_score['max'];
                                            if ($max > 0) {
                                                $percentage = ($score / $max) * 100;
                                                if ($percentage >= 80) {
                                                    $progress_class = "bg-success";
                                                    $icon = 'check-lg';
                                                } else {
                                                    $progress_class = "bg-danger";
                                                    $icon = 'x-lg';
                                                }
                                    ?>
                                                <div class="row">
                                                    <div class="col col-3">
                                                        <div class="<?php echo $progress_class; ?> rounded-pill" style="height: 25px; width: 100%;">
                                                            <center><i class="bi bi-<?php echo $icon; ?> text-white"></i></center>
                                                        </div>
                                                    </div>
                                                    <div class="col col-9">
                                                        <div class="progress" style="height: 25px;">
                                                            <div class="progress-bar <?php echo $progress_class; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $score; ?>" aria-valuemin="0" aria-valuemax="<?php echo $max; ?>"><?php echo round(($score / $max) * 100); ?>%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            } else {
                                    ?>
                                            <div class="row">
                                                <div class="col col-3">
                                                    <div class="bg-secondary rounded-pill" style="height: 25px; width: 100%;">
                                                        <center><i class="bi bi-dash-lg text-white"></i></center>
                                                    </div>
                                                </div>
                                                <div class="col col-9">
                                                    Not Auto-graded
                                                </div>
                                            </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
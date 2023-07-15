<?php
$assignment_submission = $args['assignment_submission'];
$slides = $args['slides'];
$slidesData = $slides->data;
$slides = $slides->slides;
?>
<div class="tab-content" id="myTabContent">
    <div class="container">
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
                                echo $grade === "" ? "---" : $grade;
                            } else {
                                $auto_score = lxp_assignment_submission_auto_score($assignment_submission['ID'], intval($slide->slide));
                                $score = $auto_score['score'];
                                $max = $auto_score['max'];
                                echo $score. '/' . $max;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(in_array($slide->type, array('Essay'))) {
                                $grade = $assignment_submission ? get_post_meta($assignment_submission['ID'], "slide_" . $slide->slide . "_grade", true) : "";
                                echo $grade === "" ? "To Be Graded" : "100%";
                            } else {
                                /* $auto_score = lxp_assignment_submission_auto_score($assignment_submission['ID'], intval($slide->slide));
                                $score = $auto_score['score'];
                                $max = $auto_score['max'];
                                echo $score. '/' . $max; */
                            }
                        ?>
                    </td>
                </tr>    
            <?php } ?>
        </tbody>
    </table>

    </div>
</div>
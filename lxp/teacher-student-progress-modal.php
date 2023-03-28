<?php global $treks_src; ?>
<div class="modal fade students-modal" id="studentProgressModal" tabindex="-1" aria-labelledby="studentProgressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-header-title">
            <img src="<?php echo $treks_src; ?>/assets/img/black-group.svg" alt="rocket" />
            <h2 class="modal-title" id="studentProgressModalLabel">Student Progress</h2>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="students-breadcrumb">
            <div class="interdependence-user">
                <img src="<?php echo $treks_src; ?>/assets/img/tr_main.png" alt="user" class="inter-user-img" />
                <h3 class="inter-user-name" id="student-progress-trek-title"></h3>
            </div>
            <img src="<?php echo $treks_src; ?>/assets/img/bc_arrow_right.svg" alt="user" class="students-breadcrumb-arrow" />
            <div class="interdependence-tab">
                <div class="inter-tab-polygon">
                <h4 id="student-progress-trek-segment-char"></h4>
                </div>
                <h3 class="inter-tab-polygon-name" id="student-progress-trek-segment"></h3>
            </div>
            </div>
            <div class="students-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Student</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Score (%)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                    <div class="table-user">
                        <img src="<?php echo $treks_src; ?>/assets/img/header_avatar.svg" alt="user" />
                        <div class="user-about">
                        <h5>Jane Cooper</h5>
                        <p>5th grade</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="table-status">Completed</div>
                    </td>
                    <td>10 /10</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>
                    <div class="table-user">
                        <img src="<?php echo $treks_src; ?>/assets/img/header_avatar.svg" alt="user" />
                        <div class="user-about">
                        <h5>Jane Cooper</h5>
                        <p>5th grade</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="table-status">Completed</div>
                    </td>
                    <td>10 /10</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>
                    <div class="table-user">
                        <img src="<?php echo $treks_src; ?>/assets/img/header_avatar.svg" alt="user" />
                        <div class="user-about">
                        <h5>Jane Cooper</h5>
                        <p>5th grade</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="table-status">Completed</div>
                    </td>
                    <td>10 /10</td>
                    <td>80</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        var studentProgressModal = document.getElementById('studentProgressModal');
        studentProgressModalObj = new bootstrap.Modal(studentProgressModal);
        window.studentProgressModalObj = studentProgressModalObj;

    });
</script>

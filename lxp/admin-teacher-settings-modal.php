<style type="text/css">
    #settingsModal .tab-content>.active {
        display: block !important;
    }
</style>
<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="settingsModalLabel">Settings</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Bootstrap tabs -->
                <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                    </li>
                </ul>
                <div class="tab-content" id="settingsTabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <!-- Active switch -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="activeSwitch">
                                    <label class="form-check-label" for="activeSwitch">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        let apiUrl = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress/wp-json/lms/v1/' : window.location.origin + '/wp-json/lms/v1/';

        var settingsModal = document.getElementById('settingsModal');
        settingsModalObj = new bootstrap.Modal(settingsModal);
        window.settingsModalObj = settingsModalObj;

        jQuery("#activeSwitch").on('change', function() {
            let isActive = jQuery(this).prop('checked');
            $.ajax({
                method: "POST",
                url: apiUrl + "teacher/settings/update",
                data: {active: isActive}
            }).done(function( response ) {
                console.log("Active status updated");
            }).fail(function (response) {
                console.error("Failed to update active status");
            });
        });
    });

    function onTeacherSettingsClick(teacherId) {
        let apiUrl = window.location.hostname === 'localhost' ? window.location.origin + '/wordpress/wp-json/lms/v1/' : window.location.origin + '/wp-json/lms/v1/';

        $.ajax({
            method: "GET",
            url: apiUrl + "teacher/settings"
        }).done(function( response ) {
            const settings = response.data;
            jQuery("#activeSwitch").prop('checked', settings.active);
            settingsModalObj.show();
        }).fail(function (response) {
            // console.error("Failed to load teacher settings");
            settingsModalObj.show();
        });
    }
</script>
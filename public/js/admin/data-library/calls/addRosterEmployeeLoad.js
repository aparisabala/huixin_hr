$(document).ready(function () {
    if ($('#frmLoadAddRosterEmployee').length > 0) {
        let rules = {
            employee_id: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmLoadAddRosterEmployee',
            validation: true,
            script: 'admin/data-library/department/crud/roster/modify/add-roster-employee/display',
            rules,
            afterSuccess: {
                type: 'load_html',
                target: 'add-roster-employee',
                afterLoad: (req, res) => {
                }
            }
        });
    }

    // Save form - use delegated event for dynamically loaded form
    $(document).on('submit', '#frmSaveAddRosterEmployee', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let url = (typeof baseurl !== 'undefined' ? baseurl : '/') + 'admin/data-library/department/crud/roster/modify/add-roster-employee/store';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (response) {
                if (response?.success) {
                    showInflate('Saved successfully!', 'success');
                } else {
                    showInflate('Save failed! Response was not successful.', 'error');
                }
            },
            error: function (xhr) {
                console.error('Save failed:', xhr);
                let msg = 'Save failed!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showInflate(msg, 'error');
            }
        });
    });

    function showInflate(message, type) {
        let cls = type === 'success' ? 'alert-success' : 'alert-danger';
        let html = `<div class="sufee-alert alert with-close ${cls} alert-dismissible fade show">${message}</div>`;
        $("#inflate").append(html);
        setTimeout(function () {
            $("#inflate").html("");
        }, 2000);
    }
});

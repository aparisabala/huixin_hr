$(document).ready(function () {

});
function userSetting(op) {
    if ($('#frmUpdateUserSettings').length > 0) {
        let rules = {
            user_ip: {
                required: true,
                maxlength: 253,
            },
        };
        ajaxRequest({
            element: 'frmUpdateUserSettings',
            validation: true,
            script: 'admin/employee/active/dt/active-employee/user-setting/update',
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }
}

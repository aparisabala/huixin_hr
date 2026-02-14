$(document).ready(function(){
    if ($('#frmLoadAddRosterEmployee').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
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
                afterLoad: (req,res) => {
                }
            }
        });
    }
});

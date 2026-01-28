$(document).ready(function(){

});
function viewEmployeeModal(op){
    //vpx_attach
    if($("#frmStartEmployee").length > 0) {
        PX?.utils?.dp({element: 'dp'});
         PX?.utils?.dp({
            element: 'dpt',
            timepicker: true,
            datepicker: false,
            format: 'h:i A',
            formatTime: 'h:i A',
            validateOnBlur: false,
            step: 2,
            scrollInput: false,
            onShow: function(ct, $input) {
                $input.val($input.val());
            }
        });
        if ($('#frmStartEmployee').length > 0) {
            let rules = {
                joining_date: {
                    required: true,
                },
                in_time: {
                    required: true,
                },
                out_time: {
                    required: true,
                }
            };
            PX?.ajaxRequest({
                element: 'frmStartEmployee',
                validation: true,
                script: 'admin/employee/draft/crud/view-draft-employee/entry',
                rules,
                afterSuccess: {
                    type: 'inflate_redirect_response_data',
                }
            });
        }
    }
}

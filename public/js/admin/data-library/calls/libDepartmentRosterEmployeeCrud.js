$(document).ready(function () {

    /* =============================
     Time Picker (in_time, out_time)
    ============================== */
    PX?.utils?.dp({
        element: 'dp-time',
        timepicker: true,
        datepicker: false,
        format: 'h:i A',
        formatTime: 'h:i A',
        validateOnBlur: false,
        step: 2,
        scrollInput: false,
        onShow: function (ct, $input) {
            $input.val($input.val());
        }
    });

    /* =============================
     STORE : Roster Employee
    ============================== */
    if ($('#frmStoreLibDepartmentRosterEmployee').length > 0) {

        let rules = {
            lib_department_rosters_id: {
                required: true,
            },
            lib_employees_id: {
                required: true,
            },
            in_time: {
                required: true,
            },
            out_time: {
                required: true,
            }
        };

        PX.ajaxRequest({
            element: 'frmStoreLibDepartmentRosterEmployee',
            validation: true,
            script: 'admin/data-library/department/crud/roster-employee',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    /* =============================
     UPDATE : Roster Employee
    ============================== */
    if ($('#frmUpdateLibDepartmentRosterEmployee').length > 0) {

        let rules = {
            lib_employees_id: {
                required: true,
            },
            in_time: {
                required: true,
            },
            out_time: {
                required: true,
            }
        };

        PX.ajaxRequest({
            element: 'frmUpdateLibDepartmentRosterEmployee',
            validation: true,
            script: 'admin/data-library/department/crud/roster-employee/' + $("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    /* =============================
     DATATABLE
    ============================== */

        if ($("#dtLibDepartmentRosterEmployee").length > 0) {

        let rosterId = $("#lib_department_rosters_id").val();

        let columns = [
            { data: 'id', title: 'ID' },
            { data: 'employee_name', title: 'Employee' },
            { data: 'in_time', title: 'In Time' },
            { data: 'out_time', title: 'Out Time' },
            {
                data: 'off_day',
                title: 'Off Day',
                class: 'text-center',
                render: d => d ? 'Yes' : 'No'
            },
            { data: 'created_at', title: 'Created' },
            {
                data: null,
                title: 'Action',
                class: 'text-end',
                render: row => `
                    <a href="${baseurl}admin/data-library/department/crud/roster-employee/${row.id}/edit"
                       class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-edit"></i>
                    </a>
                `
            }
        ];

        PX.renderDataTable('dtLibDepartmentRosterEmployee', {
            url: 'admin/data-library/department/crud/roster-employee/' + rosterId + '/list',
            columns: columns
        });
    }
});

/* =============================
 Bulk Actions
============================= */
function dtLibDepartmentRosterEmployee(table, api, op) {

    PX.deleteAll({
        element: "deleteAllLibDepartmentRosterEmployee",
        script: "admin/data-library/department/crud/roster-employee/delete-list",
        confirm: true,
        api,
    });

    PX.updateAll({
        element: "updateAllLibDepartmentRosterEmployee",
        script: "admin/data-library/department/crud/roster-employee/update-list",
        confirm: true,
        dataCols: {
            key: "ids",
            items: [
                {
                    index: 1,
                    name: "ids",
                    type: "input",
                    data: [],
                }
            ]
        },
        api,
        afterSuccess: {
            type: "inflate_response_data"
        }
    });

    PX?.dowloadPdf({
        ...op,
        btn: "downloadLibDepartmentRosterEmployeePdf",
        dataTable: "yes"
    });

    PX?.dowloadExcel({
        ...op,
        btn: "downloadLibDepartmentRosterEmployeeExcel",
        dataTable: "yes"
    });
}

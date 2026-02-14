$(document).ready(function () {

    if ($('#frmStoreLibDepartmentRoster').length > 0) {
        PX?.utils?.dp({ element: 'dp-roster', format: 'Y-m-d' });
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            lib_department_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        };
        PX.ajaxRequest({
            element: 'frmStoreLibDepartmentRoster',
            validation: true,
            script: 'admin/data-library/department/crud/roster',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateLibDepartmentRoster').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            lib_department_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        };
        PX.ajaxRequest({
            element: 'frmUpdateLibDepartmentRoster',
            validation: true,
            script: 'admin/data-library/department/crud/roster/' + $("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtLibDepartmentRoster").length > 0) {
        const { pageLang = {} } = PX?.config;
        const { table = {} } = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            /*{
                data: null,
                title: table?.serial,
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },*/
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'start_date',
                title: table?.start_date
            },
            {
                data: 'end_date',
                title: table?.end_date
            },


            {
                data: 'created_at',
                title: table?.created
            },

            {
                data: null,
                title: table?.action,
                class: 'text-end',
                render: function (data, type, row) {
                    return `
                    <a href="${baseurl}admin/data-library/department/crud/roster/modify/add-roster-employee"class="btn btn-outline-primary btn-sm" title="Manage Employee">
                        <i class="fas fa-users"></i>
                    </a>

                    <a href="${baseurl}admin/data-library/department/crud/roster/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtLibDepartmentRoster', {
            select: true,
            url: 'admin/data-library/department/crud/roster/list',
            columns: col_draft,
            body: { lib_department_id: $("#lib_department_id").val() },
            pdf: [1, 2]
        });
    }
})

function dtLibDepartmentRoster(table, api, op) {
    PX.deleteAll({
        element: "deleteAllLibDepartmentRoster",
        script: "admin/data-library/department/crud/roster/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllLibDepartmentRoster",
        script: "admin/data-library/department/crud/roster/update-list",
        confirm: true,
        dataCols: {
            key: "ids",
            items: [
                {
                    index: 1,
                    name: "ids",
                    type: "input",
                    data: [],
                },
                {
                    index: 1,
                    name: "serial",
                    type: "input",
                    data: []
                }
            ]
        },
        api,
        afterSuccess: {
            type: "inflate_response_data"
        }
    });
    PX?.dowloadPdf({ ...op, btn: "downloadLibDepartmentRosterPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadLibDepartmentRosterExcel", dataTable: "yes" })
}

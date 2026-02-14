$(document).ready(function(){

    if ($("#long_description").length > 0) {
        PX?.utils?.summerNote('long_description', { height: 400, id: 'long_description' });
    }
    if ($('#frmStoreEmployeeTask').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
             short_description: {
                required: true,
                maxlength: 253
            },
             long_description: {
                required: true,
            },
        };
        PX.ajaxRequest({
            element: 'frmStoreEmployeeTask',
            validation: true,
            script: 'employee/task-manage',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateEmployeeTask').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
             short_description: {
                required: true,
                maxlength: 253
            },
             long_description: {
                required: true,
            },
        };
        PX.ajaxRequest({
            element: 'frmUpdateEmployeeTask',
            validation: true,
            script: 'employee/task-manage/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtEmployeeTask").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: null,
                title: table?.serial,
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },
            {
                data: 'name',
                title: table?.name
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
                    return `<a href="${baseurl}employee/task-manage/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtEmployeeTask', {
            select: true,
            url: 'employee/task-manage/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtEmployeeTask(table, api, op) {
    PX.deleteAll({
        element: "deleteAllEmployeeTask",
        script: "employee/task-manage/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllEmployeeTask",
        script: "employee/task-manage/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadEmployeeTaskPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadEmployeeTaskExcel", dataTable: "yes" })
}

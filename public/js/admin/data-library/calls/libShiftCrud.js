$(document).ready(function () {

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

    if ($('#frmStoreLibShift').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreLibShift',
            validation: true,
            script: 'admin/data-library/shift',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateLibShift').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateLibShift',
            validation: true,
            script: 'admin/data-library/shift/' + $("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtLibShift").length > 0) {
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
                data: 'start_time',
                title: table?.start_time
            },
            {
                data: 'end_time',
                title: table?.end_time
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
                    return `<a href="${baseurl}admin/data-library/shift/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtLibShift', {
            select: true,
            url: 'admin/data-library/shift/list',
            columns: col_draft,
            pdf: [1, 2, 3]
        });
    }
})

function dtLibShift(table, api, op) {
    PX.deleteAll({
        element: "deleteAllLibShift",
        script: "admin/data-library/shift/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllLibShift",
        script: "admin/data-library/shift/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadLibShiftPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadLibShiftExcel", dataTable: "yes" })
}

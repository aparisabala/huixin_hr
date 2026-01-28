$(document).ready(function(){

    if ($('#frmStoreEmployeeDocument').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreEmployeeDocument',
            validation: true,
            script: 'admin/employee/draft/crud/document',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateEmployeeDocument').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateEmployeeDocument',
            validation: true,
            script: 'admin/employee/draft/crud/document/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtEmployeeDocument").length > 0) {
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
                data: 'lib_doc.name',
                title: table?.lib_document_id
            },
            {
                data: 'doc',
                title: table?.doc
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
                    return `<a href="${baseurl}admin/employee/draft/crud/document/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtEmployeeDocument', {
            select: true,
            url: 'admin/employee/draft/crud/document/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtEmployeeDocument(table, api, op) {
    PX.deleteAll({
        element: "deleteAllEmployeeDocument",
        script: "admin/employee/draft/crud/document/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllEmployeeDocument",
        script: "admin/employee/draft/crud/document/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadEmployeeDocumentPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadEmployeeDocumentExcel", dataTable: "yes" })
}

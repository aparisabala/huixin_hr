$(document).ready(function () {

    if ($("#dtActiveEmployee").length > 0) {
        const { pageLang = {} } = PX?.config;
        const { table = {} } = pageLang;
        let trigDetails = {
            body: {},
            modalCallback: 'viewEmployeeModal',
            element: 'viewEmployeeModal',
            script: 'admin/employee/draft/crud/view-draft-employee/display',
            title: 'Employee Details',
            globLoader: false
        };

        let trigUserSet = {
            body: {},
            modalCallback: 'userSetting',
            element: 'userSetting',
            script: 'admin/employee/active/dt/active-employee/user-setting/display',
            title: 'User Settings',
            globLoader: false
        };



        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: 'employee_id',
                title: table?.employee_id
            },
            {
                data: 'image',
                title: table?.avatar
            },
            {
                data: 'depertment.name',
                title: table?.lib_department_id
            },
            {
                data: 'designation.name',
                title: table?.lib_designation_id
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'email',
                title: table?.email
            },
            {
                data: 'mobile_number',
                title: table?.mobile_number
            },
            {
                data: 'status',
                title: table?.status
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
                    trigDetails = {
                        ...trigDetails,
                        body: { id: data?.id },
                        title: `Details of ${data?.name}`
                    };
                    trigUserSet = {
                        ...trigUserSet,
                        body: { id: data?.id },
                        title: `Settings of ${data?.name}`
                    };
                    return `<span  class="btn btn-outline-success btn-sm edit" title="Assign Assets">
                        Update
                    </span>
                    <span  class="btn btn-outline-info btn-sm edit" title="Assign Assets">
                        Assets
                    </span>
                    <span  data-bs-toggle='modal' data-bs-target='.editmodal' data-edit-prop='${JSON.stringify(trigUserSet)}' class="btn btn-outline-info btn-sm edit" title="View Details">
                        <i class="fas fa-cog"></i>
                    </span>
                    <span  data-bs-toggle='modal' data-bs-target='.editmodal' data-edit-prop='${JSON.stringify(trigDetails)}' class="btn btn-outline-success btn-sm edit" title="View Details">
                            <i class="fas fa-eye"></i>
                    </span>`;
                }
            },
        ];
        PX.renderDataTable('dtActiveEmployee', {
            select: true,
            url: 'admin/employee/active/active-employee/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtActiveEmployee(table, api, op) {
}

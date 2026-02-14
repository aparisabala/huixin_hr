<?php

return [
    'panels' => [
        'admin' => [
            'styles' => [
                'cdns' => [
                    'bootstrap5',
                    'fontAwesome',
                    'boxIcon',
                    'jqConfirm',
                    'datatable5',
                    'dateTimePicker',
                    'summer_note'
                ],
                'local' => [
                    'px/plugins',
                    'px',
                    'panel/admin',
                    'panel/minible'
                ],
                'conditional' => []
            ],
            'scripts' => [
                'cdns' => [
                    'jq',
                    'bootstrap5',
                    'popper',
                    'fontAwesome',
                    'boxIcon',
                    'jqConfirm',
                    'datatable5',
                    'dataTableSelectCheckbox',
                    'pdfmake',
                    'xlsx',
                    'dateTimePicker',
                    'summer_note'
                ],
                'local' => [
                    'px/plugins',
                    'px',
                    'panel/admin',
                    'panel/minible'
                ],
                'conditional' => [
                    'login',
                    'dashboard',
                    'setup',
                    'reset',
                    'system',
                    'data-library',
                    'employee',
                    'attendance'
                ]
            ]
        ],
        'employee' => [
            'styles' => [
                'cdns' => [
                    'bootstrap5',
                    'fontAwesome',
                    'boxIcon',
                    'jqConfirm',
                    'datatable5',
                    'dateTimePicker',
                    'summer_note'
                ],
                'local' => [
                    'px/plugins',
                    'px',
                    'panel/employee',
                    'panel/minible'
                ],
                'conditional' => []
            ],
            'scripts' => [
                'cdns' => [
                    'jq',
                    'bootstrap5',
                    'popper',
                    'fontAwesome',
                    'boxIcon',
                    'jqConfirm',
                    'datatable5',
                    'dataTableSelectCheckbox',
                    'pdfmake',
                    'xlsx',
                    'dateTimePicker',
                    'summer_note'
                ],
                'local' => [
                    'px/plugins',
                    'px',
                    'panel/employee',
                    'panel/minible'
                ],
                'conditional' => [
                    'login',
                    'dashboard',
                    'setup',
                    'reset',
                    'attendance',
                    'task-manage'
                ]
            ]
        ]
    ],
    'styles' => [
        'cdn' => [
            'bootstrap5' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'boxIcon' => ' <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">',
            'fontAwesome' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'jqConfirm' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'datatable5' => '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.10/css/jquery.dataTables.min.css">',
            'dataTableSelectCheckbox' => '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.css">',
            'dateTimePicker' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'animate' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'boostrapIcon' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />',
            'summer_note' => '<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">'
        ]
    ],
    'scripts' => [
        'cdn' => [
            'jq' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'bootstrap5' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'popper' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'jqConfirm' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'datatable5' => '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.10/js/jquery.dataTables.min.js"></script>',
            'dataTableSelectCheckbox' => '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>',
            'pdfmake' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js" integrity="sha512-axXaF5grZBaYl7qiM6OMHgsgVXdSLxqq0w7F4CQxuFyrcPmn0JfnqsOtYHUun80g6mRRdvJDrTCyL8LQqBOt/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'xlsx' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.core.min.js" integrity="sha512-UhlYw//T419BPq/emC5xSZzkjjreRfN3426517rfsg/XIEC02ggQBb680V0VvP+zaDZ78zqse3rqnnI5EJ6rxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'dateTimePicker' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'wow' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'easing' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'paralaxJs' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js" integrity="sha512-/6TZODGjYL7M8qb7P6SflJB/nTGE79ed1RfJk3dfm/Ib6JwCT4+tOfrrseEHhxkIhwG8jCl+io6eaiWLS/UX1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            'summer_note' => '<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>'
        ]
    ],
    'language' => [
        'admin.main-nav' => 'admin/layout/main-nav',
        'admin.login' => 'admin/login/index',
        'admin.reset' => 'admin/reset/index',
        'admin.profile.setup' => 'admin/setup/index',
        'admin.user.update' => 'admin/setup/user/index',
        'admin.user.pass.update' => 'admin/setup/pass/index',
        'admin.user.nav' => 'admin/setup/navs/index',
        'admin.system.user' => 'admin/system/user/index',
        'admin.system.user.user-role' => 'admin/system/user/user-role/index',
        'admin.system.user.policy' => 'admin/system/user/policy/index',
        'admin.data-library.salary.heads.crud' => 'admin/data-library/salary/heads/crud/index',
        'admin.data-library.designation.crud' => 'admin/data-library/designation/crud/index',
        'admin.data-library.department.crud' => 'admin/data-library/department/crud/index',
        'admin.data-library.leave.crud' => 'admin/data-library/leave/crud/index',
        'admin.employee.draft.crud' => 'admin/employee/draft/crud/index',
        'admin.employee.draft.crud.update-basic.form.update' => 'admin/employee/draft/crud/update-basic/form/update/index',
        'admin.employee.draft.crud.education.crud' => 'admin/employee/draft/crud/education/crud/index',
        'admin.data-library.board.crud' => 'admin/data-library/board/crud/index',
        'admin.data-library.dgree.crud' => 'admin/data-library/dgree/crud/index',
        'admin.employee.draft.crud.leave.crud' => 'admin/employee/draft/crud/leave/crud/index',
        'admin.employee.draft.crud.bank-details.form.update' => 'admin/employee/draft/crud/bank-details/form/update/index',
        'admin.data-library.banks.crud' => 'admin/data-library/banks/crud/index',
        'admin.data-library.salary.group.crud' => 'admin/data-library/salary/group/crud/index',
        'admin.data-library.salary.group.crud.modal.refresh-salary-item' => 'admin/data-library/salary/group/crud/modal/refresh-salary-item/index',
        'admin.employee.draft.crud.salary-setup.form.update' => 'admin/employee/draft/crud/salary-setup/form/update/index',
        'admin.employee.draft.crud.modal.view-draft-employee' => 'admin/employee/draft/crud/modal/view-draft-employee/index',
        'admin.employee.active.crud' => 'admin/employee/active/crud/index',
        'employee.main-nav' => 'employee/layout/main-nav',
        'employee.login' => 'employee/login/index',
        'employee.reset' => 'employee/reset/index',
        'employee.profile.setup' => 'employee/setup/index',
        'employee.user.update' => 'employee/setup/user/index',
        'employee.user.pass.update' => 'employee/setup/pass/index',
        'employee.user.nav' => 'employee/setup/navs/index',
        'employee.system.user' => 'employee/system/user/index',
        'employee.attendance.entry.form.store' => 'employee/attendance/entry/form/store/index',
        'employee.attendance.report.monthly.details' => 'employee/attendance/report/monthly/details/index',
        'admin.attendance.report.employee.load' => 'admin/attendance/report/employee/load/index',
        'employee.attendance.reconciliation.crud' => 'employee/attendance/reconciliation/crud/index',
        'employee.attendance.reports.monthly.details.modal.add-reconciliation' => 'employee/attendance/reports/monthly/details/modal/add-reconciliation/index',
        'admin.attendance.reconciliation.crud' => 'admin/attendance/reconciliation/crud/index',
        'admin.data-library.inventory.category.crud' => 'admin/data-library/inventory/category/crud/index',
        'admin.data-library.inventory.category.category-item.crud' => 'admin/data-library/inventory/category/category-item/crud/index',
        'admin.data-library.documents.crud' => 'admin/data-library/documents/crud/index',
        'admin.employee.draft.crud.document.crud' => 'admin/employee/draft/crud/document/crud/index',
        'admin.employee.active.dt.active-employee.modal.user-setting' => 'admin/employee/active/dt/active-employee/modal/user-setting/index',
        'admin.data-library.department.crud.roster.crud' => 'admin/data-library/department/crud/roster/crud/index',
        'admin.data-library.department.crud.roster.crud.crud' => 'admin/data-library/department/crud/roster/crud/crud/index',
        'employee.task-manage.crud' => 'employee/task-manage/crud/index'
    ]
];

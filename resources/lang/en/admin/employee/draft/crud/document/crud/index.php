<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => 'Add New Documents',
    'update' => 'Update Documents',
    'breadCum' => [
        'title' => 'Employee Documents',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Documents'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'lib_document_id' => 'Document Name',
        'doc' => 'Select Doc',
    ],
    'table' => [
        'id' => 'ID',
        'lib_document_id' => 'Document Name',
        'doc' => 'Uploaded Document',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];

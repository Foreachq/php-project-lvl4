<?php

return [
    'status' => [
        'name' => [
            'required' => 'This field is required',
            'unique' => 'Status name already exists',
        ]
    ],
    'flash' => [
        'status' => [
            'success' => [
                'create' => 'Status created successfully',
                'delete' => 'Status deleted successfully',
                'update' => 'Status updated successfully',
            ],
            'fail' => [
                'delete' => 'Couldn\'t delete status',
            ]
        ]
    ],
    'ujs' => [
        'sure' => 'Are you sure?',
    ]
];

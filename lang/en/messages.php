<?php

return [
    'form' => [
        'required' => 'This field is required',
        'status' => [
            'name' => [
                'unique' => 'Status name already exists',
            ]
        ],
        'label' => [
            'name' => [
                'unique' => 'Label name already exists',
            ]
        ],
        'task' => [
            'name' => [
                'unique' => 'Task name already exists',
            ]
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
        ],
        'label' => [
            'success' => [
                'create' => 'Label created successfully',
                'delete' => 'Label deleted successfully',
                'update' => 'Label updated successfully',
            ],
            'fail' => [
                'delete' => 'Couldn\'t delete label',
            ]
        ],
        'task' => [
            'success' => [
                'create' => 'Task created successfully',
                'delete' => 'Task deleted successfully',
                'update' => 'Task updated successfully',
            ],
        ]
    ],
    'ujs' => [
        'sure' => 'Are you sure?',
    ]
];

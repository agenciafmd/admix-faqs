<?php

use Agenciafmd\Faqs\Policies\FaqPolicy;

return [
    [
        'name' => config('admix-faqs.name'),
        'policy' => FaqPolicy::class,
        'abilities' => [
            [
                'name' => 'View',
                'method' => 'view',
            ],
            [
                'name' => 'Create',
                'method' => 'create',
            ],
            [
                'name' => 'Update',
                'method' => 'update',
            ],
            [
                'name' => 'Delete',
                'method' => 'delete',
            ],
            [
                'name' => 'Restore',
                'method' => 'restore',
            ],
        ],
        'sort' => 120,
    ],
];

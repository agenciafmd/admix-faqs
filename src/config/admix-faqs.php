<?php

return [
    'name' => 'Perguntas Frequentes',
    'icon' => 'icon fe-help-circle',
    'sort' => 20,
    'default_sort' => [
        '-is_active',
        '-star',
        '-published_at',
        'name',
    ],
    'category' => false,
    'call' => false,
    'published_at' => false,
    'short_description' => false,
    'wysiwyg' => false,
];

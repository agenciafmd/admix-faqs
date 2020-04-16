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
    'call' => false,
    'category' => false,
    'published_at' => true,
    'short_description' => false,
    'wysiwyg' => true,
];

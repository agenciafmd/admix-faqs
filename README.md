## F&MD - FAQ

![Área Administrativa](https://github.com/agenciafmd/admix-faqs/raw/master/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-faqs.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-faqs)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Perguntas Frequentes

## Instalação

```bash
composer require agenciafmd/admix-faqs:dev-master
```

Execute a migração

```bash
php artisan migrate
```

Se precisar do seed, faça a publicação

```bash
php artisan vendor:publish --tag=admix-faqs:seeders
```

**não esqueça do `composer dumpautoload`**

## Configuração

Por padrão, as configurações do pacote são:

```php
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
```

Se for preciso, você pode customizar estas configurações

```bash
php artisan vendor:publish --tag=admix-faqs:config
```

**caso tenha habilitado as categorias, é importante republicar os seeds**

## Segurança

Caso encontre alguma falha de segurança, por favor, envie um email para carlos@fmd.ag ao invés de abrir uma issue

## Licença

Licença MIT. [Clique aqui](LICENSE.md) para mais detalhes

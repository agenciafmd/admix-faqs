## F&MD - Faqs

- Perguntas frequentes

## Instalação

```bash
composer require agenciafmd/admix-faqs:dev-master
```

## Configuração

TODO: Explicar a configuração da categoria

## Uso

TODO: Exemplificar o uso

## Customização

Para customizar as configurações do pacote, publique os arquivos de configuração usando:
```
php artisan vendor:publish --provider="Agenciafmd\Faqs\Providers\FaqServiceProvider" --tag configs
```

```php
<?php

return [
    'name' => 'Perguntas frequentes',
    'icon' => 'icon fe-help-circle',
    'sort' => 20,
    'default_sort' => [
        '-is_active',
        '-star',
        '-published_at',
        'name',
    ],
    'call' => false,    
    'category' => true,
    'published_at' => false,    
    'short_description' => false,
    'wysiwyg' => true,
];
```

## Segurança

Caso encontre alguma falha de segurança, por favor, envie um email para carlos@fmd.ag ao invés de abrir uma issue

## Licença

Licença MIT. [Clique aqui](LICENSE.md) para mais detalhes

## F&MD - FAQs

![Área Administrativa](https://github.com/agenciafmd/admix-faqs/raw/v11/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-faqs.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-faqs)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- FAQs

## Instalação

```bash
sail composer require agenciafmd/admix-faqs:v11.x-dev
```

Execute a migração

```bash
sail artisan migrate
```

Se precisar de seeder, adicione no `database/seeders/DatabaseSeeder.php`

```php
use Agenciafmd\Faqs\Database\Seeders\FaqTableSeeder;

$this->call(FaqTableSeeder::class);
```

## Segurança

Caso encontre alguma falha de segurança, por favor, envie um e-mail para irineu@fmd.ag ao invés de abrir uma issue

## Créditos

- [Irineu Junior](https://github.com/irineujunior)

## Licença

Licença MIT. [Clique aqui](LICENSE.md) para mais detalhes
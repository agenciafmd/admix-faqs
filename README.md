## F&MD - FAQs

![Área Administrativa](https://github.com/agenciafmd/admix-faqs/raw/v10/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-faqs.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-faqs)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- FAQs

## Installation

```bash
composer require agenciafmd/admix-faqs:v10.x-dev
```

Run the migrations

```bash
php artisan migrate
```

If you want to use the seeder, add on your `database/seeders/DatabaseSeeder.php`

```php
use Agenciafmd\Faqs\Database\Seeders\FaqTableSeeder;

$this->call(FaqTableSeeder::class);
```

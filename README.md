<br>

<div align="center">
<img width="456" src="https://raw.githubusercontent.com/wayofdev/php-cs-fixer-config/master/assets/logo.gh-light-mode-only.png#gh-light-mode-only">
<img width="456" src="https://raw.githubusercontent.com/wayofdev/php-cs-fixer-config/master/assets/logo.gh-dark-mode-only.png#gh-dark-mode-only">
</div>



<br>

<br>

<div align="center">
<a href="https://github.com/wayofdev/php-cs-fixer-config/actions"><img alt="Build Status" src="https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Fwayofdev%2Fphp-cs-fixer-config%2Fbadge&style=flat-square"/></a>
<a href="https://packagist.org/packages/wayofdev/cs-fixer-config"><img src="https://img.shields.io/packagist/dt/wayofdev/cs-fixer-config?&style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wayofdev/cs-fixer-config"><img src="https://img.shields.io/packagist/v/wayofdev/cs-fixer-config?&style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wayofdev/cs-fixer-config"><img src="https://img.shields.io/packagist/l/wayofdev/cs-fixer-config?style=flat-square&color=blue" alt="Software License"/></a>
<a href="https://packagist.org/packages/wayofdev/cs-fixer-config"><img alt="Commits since latest release" src="https://img.shields.io/github/commits-since/wayofdev/php-cs-fixer-config/latest?style=flat-square"></a>
</div>

<br>

# PHP CS Fixer Config

Wrapper with pre-defined rules around the [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) package — A tool to automatically fix PHP Coding Standards issues.

If you **like/use** this package, please consider **starring** it. Thanks!

<br>

## 💿 Installation

### → Using composer

Require as dependency:

```bash
$ composer req wayofdev/cs-fixer-config
```

<br>

## 🛠 Configuration

1. Create PHP file and name it `.php-cs-fixer.dist.php` and place it inside root directory of project. It will be recognized by PHP CS Fixer automatically.

2. Example contents of `.php-cs-fixer.dist.php` file:

   ```php
   <?php

   declare(strict_types=1);

   use WayOfDev\PhpCsFixer\Config\ConfigBuilder;
   use WayOfDev\PhpCsFixer\Config\RuleSets\DefaultSet;

   require_once 'vendor/autoload.php';

   return ConfigBuilder::createFromRuleSet(new DefaultSet())
       ->inDir(__DIR__ . '/src')
       ->inDir(__DIR__ . '/tests')
       ->addFiles([__FILE__])
       ->getConfig();
   ```

3. Place `.php-cs-fixer.cache` file into `.gitignore`

<br>

## 💻 Usage

### → Running

Fix coding standards by simply running console command:

```bash
$ php vendor/bin/php-cs-fixer fix -v
```

### → Using Makefile

To use with our `Makefile`:

1. Add `scripts` section to `composer.json`:

   ```json
   {
       "scripts": {
           "cs-fix": "php vendor/bin/php-cs-fixer fix -v",
           "cs-diff": "php vendor/bin/php-cs-fixer fix --dry-run -v --diff"
       }
   }
   ```

2. Use `Makefile` code to run PHP-CS-Fixer tests:

   ```bash
   # Run inspections and fix code
   $ make cs-fix

   # Check coding standards without applying the fix
   $ make cs-diff
   ```

<br>

## 🧪 Running Tests

### → PHPUnit tests

To run tests, run the following command:

```bash
$ make test
```

### → Static Analysis

Code quality using PHPStan:

```bash
$ make stan
```

### → Coding Standards Fixing

Fix code using The PHP Coding Standards Fixer (PHP CS Fixer) to follow our standards:

```bash
$ make cs-fix
```

<br>

## 🤝 License

[![Licence](https://img.shields.io/github/license/wayofdev/php-cs-fixer-config?style=for-the-badge&color=blue)](./LICENSE)

<br>

## 🙆🏼‍♂️ Author Information

Created in **2022** by [lotyp / wayofdev](https://github.com/wayofdev)

<br>

## 🧱 Resources

* Full documentation about all fixers are available here - [PHP-CS-Fixer configuration UI](https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0)

* The official [PHP-CS-Fixer documentation](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

<br>

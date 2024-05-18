<div align="center">
    <br>
    <a href="https://wayof.dev" target="_blank">
        <picture>
            <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/wayofdev/.github/master/assets/logo.gh-dark-mode-only.png">
            <img width="400" src="https://raw.githubusercontent.com/wayofdev/.github/master/assets/logo.gh-light-mode-only.png" alt="WayOfDev Logo">
        </picture>
    </a>
    <br>
    <br>
</div>

<p align="center">
<a href="https://github.com/wayofdev/php-cs-fixer-config/actions" target="_blank"><img alt="Build Status" src="https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Fwayofdev%2Fphp-cs-fixer-config%2Fbadge&style=flat-square&label=github%20actions"/></a>
<a href="https://packagist.org/packages/wayofdev/php-cs-fixer-config" target="_blank"><img src="https://img.shields.io/packagist/dt/wayofdev/cs-fixer-config?&style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wayofdev/php-cs-fixer-config" target="_blank"><img src="https://img.shields.io/packagist/v/wayofdev/cs-fixer-config?&style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wayofdev/php-cs-fixer-config" target="_blank"><img alt="Commits since latest release" src="https://img.shields.io/github/commits-since/wayofdev/php-cs-fixer-config/latest?style=flat-square"></a>
<a href="https://packagist.org/packages/wayofdev/php-cs-fixer-config" target="_blank"><img alt="PHP Version Require" src="https://poser.pugx.org/wayofdev/cs-fixer-config/require/php?style=flat-square"></a>
<a href="https://app.codecov.io/gh/wayofdev/php-cs-fixer-config" target="_blank"><img alt="Codecov" src="https://img.shields.io/codecov/c/github/wayofdev/php-cs-fixer-config?style=flat-square&logo=codecov"></a>
<a href="https://dashboard.stryker-mutator.io/reports/github.com/wayofdev/php-cs-fixer-config/master" target="_blank"><img alt="Mutation testing badge" src="https://img.shields.io/endpoint?style=flat-square&label=mutation%20score&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fwayofdev%2Fphp-cs-fixer-config%2Fmaster"></a>
<a href=""><img src="https://img.shields.io/badge/phpstan%20level-9%20of%209-brightgreen?style=flat-square" alt="PHP Stan Level 9 of 9"></a>
</p>

<br>

# PHP CS Fixer Config

Wrapper with pre-defined rules around the [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) package — A tool to automatically fix PHP Coding Standards issues.

This repository aims to provide a standardized way to apply coding standards across multiple projects, ensuring consistency and adherence to best practices.

By using predefined rulesets, it simplifies the setup process and allows teams to quickly integrate PHP-CS-Fixer into their development workflow.

<br>

If you **like/use** this package, please consider ⭐️ **starring** it. Thanks!

<br>

## 💿 Installation

### → Using composer

Require as dependency:

```bash
composer req --dev wayofdev/cs-fixer-config
```

<br>

## 🛠 Configuration

### → Setup

- Create PHP file and name it `.php-cs-fixer.dist.php` and place it inside root directory of project. It will be recognized by PHP CS Fixer automatically.

- Example contents of `.php-cs-fixer.dist.php` file:

   ```php
    <?php
    
    declare(strict_types=1);
    
    use WayOfDev\PhpCsFixer\Config\ConfigBuilder;
    use WayOfDev\PhpCsFixer\Config\RuleSets\DefaultSet;
    
    require_once 'vendor/autoload.php';
    
    $config = ConfigBuilder::createFromRuleSet(new DefaultSet())
        ->inDir(__DIR__ . '/src')
        ->inDir(__DIR__ . '/tests')
        ->addFiles([__FILE__])
        ->getConfig()
    ;
    
    $config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/php-cs-fixer.cache');
    
    return $config;
   ```

### → Composer Script

- Add `scripts` section to `composer.json`:
  
  ```diff
  {
      "scripts": {
  +       "cs:diff": "php vendor/bin/php-cs-fixer fix --dry-run -v --diff",
  +       "cs:fix": "php vendor/bin/php-cs-fixer fix -v"
      }
  }
  ```

### → Git

- Place `.build` folder file into `.gitignore`

  ```diff
  +/.build/
   /vendor/
  ```

### → GitHub Actions

To use in GitHub Actions, do...

<br>

## 💻 Usage

Fix coding standards by simply running console command:

### → Directly

```bash
vendor/bin/php-cs-fixer fix -v
```

### → Via Composer Script

To use via composer script commands:

* Fixes code to follow coding standards using php-cs-fixer:

  ```bash
  composer cs:diff
  ```

* Runs php-cs-fixer in dry-run mode and shows diff which will by applied:

  ```bash
  composer cs:fix
  ```

### → Using Makefile

**To use with `Makefile`**

- Fixes code to follow coding standards using php-cs-fixer:

  ```bash
  make lint-php
  ```

- Runs php-cs-fixer in dry-run mode and shows diff which will by applied:

  ```bash
  make lint-diff 
  ```


<br>

## 🔒 Security Policy

This project has a [security policy](.github/SECURITY.md).

<br>

## 🙌 Want to Contribute?

Thank you for considering contributing to the wayofdev community! We are open to all kinds of contributions. If you want to:

- 🤔 [Suggest a feature](https://github.com/wayofdev/php-cs-fixer-config/issues/new?assignees=&labels=type%3A+enhancement&projects=&template=2-feature-request.yml&title=%5BFeature%5D%3A+)
- 🐛 [Report an issue](https://github.com/wayofdev/php-cs-fixer-config/issues/new?assignees=&labels=type%3A+documentation%2Ctype%3A+maintenance&projects=&template=1-bug-report.yml&title=%5BBug%5D%3A+)
- 📖 [Improve documentation](https://github.com/wayofdev/php-cs-fixer-config/issues/new?assignees=&labels=type%3A+documentation%2Ctype%3A+maintenance&projects=&template=4-docs-bug-report.yml&title=%5BDocs%5D%3A+)
- 👨‍💻 Contribute to the code

You are more than welcome. Before contributing, kindly check our [contribution guidelines](.github/CONTRIBUTING.md).

[![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-yellow.svg?style=for-the-badge)](https://conventionalcommits.org)

<br>

## 🫡 Contributors

<p align="left">
    <a href="https://github.com/wayofdev/php-cs-fixer-config/graphs/contributors">
        <img align="left" src="https://img.shields.io/github/contributors-anon/wayofdev/php-cs-fixer-config?style=for-the-badge" alt="Contributors Badge"/>
    </a>
</p>

<br>

## 🌐 Social Links

- **Twitter:** Follow our organization [@wayofdev](https://twitter.com/intent/follow?screen_name=wayofdev) and the author [@wlotyp](https://twitter.com/intent/follow?screen_name=wlotyp).
- **Discord:** Join our community on [Discord](https://discord.gg/CE3TcCC5vr).

<p align="left">
<a href="https://discord.gg/CE3TcCC5vr" target="_blank"><img alt="Codecov" src="https://img.shields.io/discord/1228506758562058391?style=for-the-badge&logo=discord&labelColor=7289d9&logoColor=white&color=39456d"></a>
<a href="https://x.com/intent/follow?screen_name=wayofdev" target="_blank"><img alt="Follow on Twitter (X)" src="https://img.shields.io/badge/-Follow-black?style=for-the-badge&logo=X"></a>
</p>

<br>

## 🧱 Resources

- Full documentation about all fixers are available here - [PHP-CS-Fixer configuration UI](https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0)

- The official [PHP-CS-Fixer documentation](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

<br>

## ⚖️ License

[![Licence](https://img.shields.io/github/license/wayofdev/php-cs-fixer-config?style=for-the-badge&color=blue)](./LICENSE.md)

<br>

# nulldark/devtools

This composer plugin is a development toolkit aimed at simplifying and enhancing the coding process for developers.
This project is crafted with an intent to streamline the efforts involved in developmental
tasks, automate mundane chores, and artfully clear the path for developers to push their boundaries.

## Installation

It's recommended that you use Composer to install

``` bash
composer require --dev nulldark/devtools
```

### PHP_CodeSniffer

Create a `phpcs.xml.dist` file to configure your own coding standard, Below is a sample configuration. It's optional step.

```xml
<?xml version="1.0"?>
<ruleset
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="vendor/squizlabs/php_codesniffer/phpcs.xsd"
>
    <file>src</file>

    <arg name="basepath" value="."/>
    <arg name="extensions" value="php"/>
    <arg name="parallel" value="80"/>
    <arg name="colors"/>
    <arg value="ps"/>

    <rule ref="PSR12"/>
</ruleset>
```

### PHPStan

Create a `phpstan.neon.dist` file, below is a sample configuration. It's optional step.

```neon
parameters:
    level: max
    paths:
        - src/
```

### PHPUnit

Create a `phpunit.xml.dist` file, below is a sample configuration. It's optional step.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.5/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         cacheDirectory="build/cache/phpunit/"
         executionOrder="depends,defects"
         requireCoverageMetadata="true"
         beStrictAboutCoverageMetadata="true"
         beStrictAboutOutputDuringTests="true"
         failOnRisky="true"
         failOnWarning="true">
    <testsuites>
        <testsuite name="default">
            <directory>tests</directory>
        </testsuite>
    </testsuites>

    <source restrictDeprecations="true" restrictNotices="true" restrictWarnings="true">
        <include>
            <directory>src</directory>
        </include>
    </source>
</phpunit>

```

## Usage

After installation, type `composer list`, and 
you'll see a lot of new commands with prefixes `dev:` that this plugin provides.

```bash
composer list
```

### Available commands

After execute a `composer list` command, you'll see a section of commands that looks like this:

```
 dev:
  dev:analyze          Run all QA tools
  dev:analyze:phpstan  Run static analyze with PHPStan
  dev:analyze:psalm    Run static analyze with Psalm
  dev:lint:fix         Fix violations of coding standards.
  dev:lint:style       Check violations of coding standards.
  dev:lint:syntax      Check violations of syntax.
  dev:test:unit        Run unit tests with PHPUnit
```

## Available tools

| Package                                                                                                   | Version       |
|-----------------------------------------------------------------------------------------------------------|---------------|
| [php](https://github.com/php/php-src)                                                                     | ~8.2.4 ~8.3.0 |
| [ext-mbstring](https://github.com/php/php-src)                                                            | *             |
| [composer-plugin-api](https://getcomposer.org/)                                                           | ^2.3          |
| [composer/composer ](https://getcomposer.org/)                                                            | ^2.7@dev      |
| [mockery/mockery](https://github.com/mockery/mockery)                                                     | ^2.0.x-dev    |
| [nulldark/plugin-mockery](https://github.com/nulldark/psalm-plugin-mockery)                               | dev-master    |
| [php-parallel-lint/php-console-highlighter](https://github.com/php-parallel-lint/PHP-Console-Highlighter) | dev-master    |
| [php-parallel-lint/php-parallel-lint](https://github.com/php-parallel-lint/PHP-Parallel-Lint)             | dev-develop   |
| [phpmd/phpmd](https://github.com/phpmd/phpmd)                                                             | dev-master    |
| [phpstan/extension-installer](https://github.com/phpstan/extension-installer)                             | ^1.3          |
| [phpstan/phpstan](https://github.com/phpstan/phpstan)                                                     | 1.11.x-dev    |
| [phpstan/phpstan-deprecation-rules](https://github.com/phpstan/phpstan-deprecation-rules)                 | 1.2.x-dev     |
| [phpstan/phpstan-mockery](https://github.com/phpstan/phpstan-mockery)                                     | 1.1.x-dev     |
| [phpstan/phpstan-phpunit](https://github.com/phpstan/phpstan-phpunit)                                     | 1.4.x-dev     |
| [phpstan/phpstan-strict-rules](https://github.com/phpstan/phpstan-strict-rules)                           | 1.6.x-dev     |
| [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit)                                         | ^10.5.x-dev   |
| [psalm/plugin-phpunit](https://github.com/psalm/psalm-plugin-phpunit)                                     | dev-master    |
| [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer)                                 | ^4.0.x-dev    |
| [vimeo/psalm](https://github.com/vimeo/psalm)                                                             | 6.x-dev       |

## Contributing

The maintainers of this project suggest following the [contribution guide](CONTRIBUTING.md).

## Code of Conduct

The maintainers of this project ask contributors to follow the [code of conduct](CODE_OF_CONDUCT.md).

## PHP Version Support Policy

This project supports PHP versions with [active and security support](https://www.php.net/supported-versions.php).
The maintainers of this project add support for a PHP version following its initial release and drop support for a PHP
version when it has reached its end of security support.

## License

This project uses the [MIT license](LICENSE).

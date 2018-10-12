ShariffBundle
=============
[![Latest Stable Version](https://poser.pugx.org/core23/shariff-bundle/v/stable)](https://packagist.org/packages/core23/shariff-bundle)
[![Latest Unstable Version](https://poser.pugx.org/core23/shariff-bundle/v/unstable)](https://packagist.org/packages/core23/shariff-bundle)
[![License](https://poser.pugx.org/core23/shariff-bundle/license)](https://packagist.org/packages/core23/shariff-bundle)

[![Total Downloads](https://poser.pugx.org/core23/shariff-bundle/downloads)](https://packagist.org/packages/core23/shariff-bundle)
[![Monthly Downloads](https://poser.pugx.org/core23/shariff-bundle/d/monthly)](https://packagist.org/packages/core23/shariff-bundle)
[![Daily Downloads](https://poser.pugx.org/core23/shariff-bundle/d/daily)](https://packagist.org/packages/core23/shariff-bundle)

[![Build Status](https://travis-ci.org/core23/ShariffBundle.svg)](https://travis-ci.org/core23/ShariffBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/core23/ShariffBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/core23/ShariffBundle)
[![Code Climate](https://codeclimate.com/github/core23/ShariffBundle/badges/gpa.svg)](https://codeclimate.com/github/core23/ShariffBundle)
[![Coverage Status](https://coveralls.io/repos/core23/ShariffBundle/badge.svg)](https://coveralls.io/r/core23/ShariffBundle)

This bundle provides a wrapper for using [shariff] inside the symfony sonata-project.

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
composer require core23/shariff-bundle
```

### Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in `bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Core23\ShariffBundle\Core23ShariffBundle::class => ['all' => true],
];
```

### Configure the Bundle

Create a configuration file called `core23_shariff.yaml`:

```yaml
# app/config/routes/core23_shariff.yaml

core23_shariff:
    resource: "@Core23ShariffBundle/Resources/config/routing/backend.yml"
```

Add the block to the `sonata_block` configuration if necessary:

```yaml
# config/packages/sonata_block.yaml

sonata_block:
    blocks:
        core23_shariff.block.share: ~
```

Create a configuration file called `doctrine_cache.yaml`:

```yaml
doctrine_cache:
    providers:
        core23_shariff:
            type: php_file
            namespace: core23_shariff
```

## Usage

```twig
{# template.twig #}

{{ sonata_block_render({ 'type': 'core23_shariff.block.share' }, {
    'url': 'https://example.com/site.html'
}) }}
```

### Configure the Bundle

You can globally configure the services that should count the likes or favorites for a page. 

```yaml
core23_shariff:
    options:
        domains: [ ] # Allow specific domains for shariff
        services: [ 'GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis' ]
    services:
        # Optional configuration when using facebook service
        facebook:
            app_id: "1234567890"
            secret: "GENERATEDSECRET"
```

See [shariff-php] for a list of all available services.

## License

This bundle is under the [MIT license](LICENSE.md).

[shariff]: https://github.com/heiseonline/shariff
[shariff-php]: https://github.com/heiseonline/shariff-backend-php

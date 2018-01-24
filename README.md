What is ShariffBundle?
=============================
[![Latest Stable Version](https://poser.pugx.org/core23/shariff-bundle/v/stable)](https://packagist.org/packages/core23/shariff-bundle)
[![Latest Unstable Version](https://poser.pugx.org/core23/shariff-bundle/v/unstable)](https://packagist.org/packages/core23/shariff-bundle)
[![License](https://poser.pugx.org/core23/shariff-bundle/license)](https://packagist.org/packages/core23/shariff-bundle)

[![Build Status](https://travis-ci.org/core23/ShariffBundle.svg)](https://travis-ci.org/core23/ShariffBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/core23/ShariffBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/core23/ShariffBundle)
[![Coverage Status](https://coveralls.io/repos/core23/ShariffBundle/badge.svg)](https://coveralls.io/r/core23/ShariffBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c55567df-e9da-41ec-8509-4030e5363b17/mini.png)](https://insight.sensiolabs.com/projects/c55567df-e9da-41ec-8509-4030e5363b17)

[![Donate to this project using Flattr](https://img.shields.io/badge/flattr-donate-yellow.svg)](https://flattr.com/profile/core23)
[![Donate to this project using PayPal](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://paypal.me/gripp)

This bundle provides a wrapper for using [shariff] inside the symfony sonata-project.

### Installation

```
php composer.phar require core23/shariff-bundle
```

### Enabling the bundle

```php
    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...

            new Core23\ShariffBundle\Core23ShariffBundle(),

            // ...
        );
    }
```

```yaml
# app/config/routing.yml

core23_shariff:
    resource: "@Core23ShariffBundle/Resources/config/routing/backend.yml"
```

### Usage

```twig
{# template.twig #}

{{ sonata_block_render({ 'type': 'core23_shariff.block.share' }, {
    'url': 'https://example.com/site.html'
}) }}
```

### Configuration

You can globally configure the services that should count the likes or favorites for a page. 

```yaml
doctrine_cache:
    providers:
        core23_shariff:
            type: php_file
            namespace: core23_shariff


core23_shariff:
    options:
        domains: [ ] # Allow specific domains for shariff
        services: [ 'GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis' ]
    services:
        # Optional configuration when using facebook service
        facebook:
            app_id: 1234567890
            secret: GENERATEDSECRET
```

Add the block to the `sonata_block` configuration if necessary:

```yaml
sonata_block:
    blocks:
        ...
        core23_shariff.block.share: ~
```

See [shariff-php] for a list of all available services.

This bundle is available under the [MIT license](LICENSE.md).

[shariff]: https://github.com/heiseonline/shariff
[shariff-php]: https://github.com/heiseonline/shariff-backend-php

What is ShariffBundle?
=============================
[![Latest Stable Version](http://img.shields.io/packagist/v/core23/shariff-bundle.svg)](https://packagist.org/packages/core23/shariff-bundle)
[![Build Status](http://img.shields.io/travis/core23/ShariffBundle.svg)](http://travis-ci.org/core23/ShariffBundle)
[![Latest Stable Version](https://poser.pugx.org/core23/shariff-bundle/v/stable.png)](https://packagist.org/packages/core23/shariff-bundle)
[![Dependency Status](https://www.versioneye.com/php/core23:shariff-bundle/badge.svg)](https://www.versioneye.com/php/core23:shariff-bundle)
[![License](http://img.shields.io/packagist/l/core23/shariff-bundle.svg)](https://packagist.org/packages/core23/shariff-bundle)
[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=core23&url=https%3A%2F%2Fgithub.com%2Fcore23%2FShariffBundle&title=ShariffBundle&tags=github&category=software)

This bundle provides a wrapper for using [shariff] inside the symfony sonata-project.

### Installation

```
php composer.phar require core23/shariff-bundle
```

### Enabling the bundle

```php
<?php
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

{{ sonata_block_render({ 'type': 'core23.shariff.block.share' }, {
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
        domain: null
        services: [ 'GooglePlus', 'Twitter', 'Facebook' ]
```

See [shariff-php] for a list of all available services.

This bundle is available under the [MIT license](LICENSE.md).

[shariff]: https://github.com/heiseonline/shariff
[shariff-php]: https://github.com/heiseonline/shariff-backend-php

What is ShariffBundle?
=============================
[![Latest Stable Version](http://img.shields.io/packagist/v/core23/shariff-bundle.svg)](https://packagist.org/packages/core23/shariff-bundle)
[![Build Status](http://img.shields.io/travis/core23/ShariffBundle.svg)](http://travis-ci.org/core23/ShariffBundle)
[![Latest Stable Version](https://poser.pugx.org/core23/shariff-bundle/v/stable.png)](https://packagist.org/packages/core23/shariff-bundle)
[![License](http://img.shields.io/packagist/l/core23/shariff-bundle.svg)](https://packagist.org/packages/core23/shariff-bundle)

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
core23_shariff:
	options:
		cache: 
			ttl: 60
			cacheDir: %kernel.cache_dir%/social
		domain: null
		services: [ 'GooglePlus', 'Twitter', 'Facebook' ]
```

See [shariff-php] for a list of all available services.

This bundle is available under the [MIT license](LICENSE.md).

[shariff]: https://github.com/heiseonline/shariff
[shariff-php]: https://github.com/heiseonline/shariff-backend-php

What is ShariffBundle?
=============================
[![Build Status](https://secure.travis-ci.org/core23/ShariffBundle.png?branch=master)](http://travis-ci.org/core23/ShariffBundle)

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
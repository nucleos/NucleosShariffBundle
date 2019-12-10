ShariffBundle
=============
[![Latest Stable Version](https://poser.pugx.org/core23/shariff-bundle/v/stable)](https://packagist.org/packages/core23/shariff-bundle)
[![Latest Unstable Version](https://poser.pugx.org/core23/shariff-bundle/v/unstable)](https://packagist.org/packages/core23/shariff-bundle)
[![License](https://poser.pugx.org/core23/shariff-bundle/license)](https://packagist.org/packages/core23/shariff-bundle)

[![Total Downloads](https://poser.pugx.org/core23/shariff-bundle/downloads)](https://packagist.org/packages/core23/shariff-bundle)
[![Monthly Downloads](https://poser.pugx.org/core23/shariff-bundle/d/monthly)](https://packagist.org/packages/core23/shariff-bundle)
[![Daily Downloads](https://poser.pugx.org/core23/shariff-bundle/d/daily)](https://packagist.org/packages/core23/shariff-bundle)

[![Continuous Integration](https://github.com/core23/ShariffBundle/workflows/Continuous%20Integration/badge.svg)](https://github.com/core23/ShariffBundle/actions)
[![Code Coverage](https://codecov.io/gh/core23/ShariffBundle/branch/master/graph/badge.svg)](https://codecov.io/gh/core23/ShariffBundle)

This bundle provides a wrapper for using [shariff] inside the symfony sonata-project.

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
composer require core23/shariff-bundle
```

### Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Core23\ShariffBundle\Core23ShariffBundle::class => ['all' => true],
];
```

Define cache, http client and request factory:

```
# config/routes/core23_shariff.yaml

framework:
    cache:
        pools:
            cache.shariff:
                adapter: cache.adapter.filesystem

core23_shariff:
    cache: 'cache.shariff'
    http_client: 'some.http.client'         # e.g httplug.client
    request_factory: 'some.request.factory' # e.g. nyholm.psr7.psr17_factory
```

### Assets

It is recommended to use [webpack](https://webpack.js.org/) / [webpack-encore](https://github.com/symfony/webpack-encore)
to include the `shariff.js` and `shariff.css` file in your page.

You can use [npm](https://www.npmjs.com/) or [yarn](https://yarnpkg.com/) to load the library:

```
npm install shariff
```

```
yarn add shariff
```

### Configure the Bundle

Create a configuration file called `core23_shariff.yaml`:

```yaml
# config/routes/core23_shariff.yaml

core23_shariff:
    resource: "@Core23ShariffBundle/Resources/config/routing/backend.yml"
```

Create a configuration file called `framework_cache.yaml`:

```yaml
framework:
    cache:
        pools:
            cache.shariff:
                adapter: cache.adapter.filesystem

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
    cache: 'cache.shariff'
    http_client: 'some.http.client'
    request_factory: 'some.request.factory'

    options:
        domains: [ ] # Allow specific domains for shariff
        services: [ 'addthis', 'buffer', 'facebook', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing' ]

    services:
        facebook:
            app_id:  "1234567890"
            secret:  "GENERATEDSECRET"
            version: "5.0"
```

This is a fork of [shariff-php] with a more modern and dynamic solution.

## License

This bundle is under the [MIT license](LICENSE.md).

[shariff]: https://github.com/heiseonline/shariff
[shariff-php]: https://github.com/heiseonline/shariff-backend-php

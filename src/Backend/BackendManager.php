<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Backend;

use GuzzleHttp\Client;
use Heise\Shariff\Backend\BackendManager as BaseBackendManager;
use Heise\Shariff\Backend\ServiceFactory;
use Heise\Shariff\CacheInterface;

final class BackendManager extends BaseBackendManager
{
    /**
     * @var ServiceFactory
     */
    private $serviceFactory;

    /**
     * BackendManager constructor.
     *
     * @param CacheInterface $cache
     * @param array          $options
     */
    public function __construct(CacheInterface $cache, array $options)
    {
        $client               = new Client();
        $this->serviceFactory = new ServiceFactory($client);

        $baseCacheKey = md5(json_encode($options));
        $services     = $this->serviceFactory->getServicesByName($options['services'], $options);
        $domains      = $options['domains'];

        parent::__construct($baseCacheKey, $cache, $client, $domains, $services);
    }
}

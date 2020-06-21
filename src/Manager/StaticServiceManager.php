<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Manager;

use Nucleos\ShariffBundle\Service\Service;

final class StaticServiceManager implements ServiceManager
{
    /**
     * @var array<string, Service>
     */
    private $services;

    /**
     * @var string[]
     */
    private $active;

    /**
     * @param Service[] $services
     * @param string[]  $active
     */
    public function __construct(array $services = [], array $active = [])
    {
        $this->services = [];

        foreach ($services as $service) {
            \assert($service instanceof Service);

            $this->services[$service->getCode()] = $service;
        }

        $this->active = $active;
    }

    public function get(string $code): ?Service
    {
        if (!isset($this->services[$code])) {
            return null;
        }

        return $this->services[$code];
    }

    public function getAll(): array
    {
        return array_values($this->services);
    }

    public function getActive(): array
    {
        if (0 === \count($this->active)) {
            return $this->getAll();
        }

        return array_filter(array_map(function (string $code): ?Service {
            return $this->get($code);
        }, $this->active));
    }
}

<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Cache;

use Doctrine\Common\Cache\Cache;
use Heise\Shariff\CacheInterface;

final class DoctrineCache implements CacheInterface
{
    /**
     * @var Cache
     */
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Set cache entry.
     *
     * @param string $key
     * @param string $content
     */
    public function setItem($key, $content): void
    {
        $this->cache->save($key, $content);
    }

    /**
     * Get cache entry.
     *
     * @param string $key
     */
    public function getItem($key): string
    {
        return $this->cache->fetch($key);
    }

    /**
     * Check if cache entry exists.
     *
     * @param string $key
     */
    public function hasItem($key): bool
    {
        return $this->cache->contains($key);
    }
}

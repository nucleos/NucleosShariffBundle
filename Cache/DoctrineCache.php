<?php

/*
 * This file is part of the ni-ju-san CMS.
 *
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
    protected $cache;

    /**
     * DoctrineCache constructor.
     *
     * @param Cache $cache
     */
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
    public function setItem($key, $content)
    {
        $this->cache->save($key, $content);
    }

    /**
     * Get cache entry.
     *
     * @param string $key
     *
     * @return string
     */
    public function getItem($key)
    {
        return $this->cache->fetch($key);
    }

    /**
     * Check if cache entry exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasItem($key)
    {
        return $this->cache->contains($key);
    }
}

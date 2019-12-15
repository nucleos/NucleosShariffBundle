<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Manager;

use Core23\ShariffBundle\Service\Service;

interface ServiceManager
{
    public function get(string $code): ?Service;

    /**
     * @return Service[]
     */
    public function getAll(): array;

    /**
     * @return Service[]
     */
    public function getActive(): array;
}

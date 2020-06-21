<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Backend;

interface Backend
{
    /**
     * @return array<string, int>
     */
    public function get(string $url): array;
}

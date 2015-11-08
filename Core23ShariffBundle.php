<?php

/*
 * This file is part of the ni-ju-san CMS.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Core23ShariffBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $options = $this->container->getParameter('core23_shariff.options');

        $fs = new Filesystem();
        $fs->mkdir($options['cache']['cacheDir']);
    }
}

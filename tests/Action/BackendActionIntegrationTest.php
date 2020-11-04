<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Tests\Action;

use Nucleos\ShariffBundle\Manager\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BackendActionIntegrationTest extends WebTestCase
{
    public function testShare(): void
    {
        $client = static::createClient();
        $client->request('GET', '/share');

        static::assertSame(200, $client->getResponse()->getStatusCode());

        $container      = static::$kernel->getContainer();
        $serviceManager = $container->get('test_service_manager');

        \assert($serviceManager instanceof ServiceManager);

        static::assertCount(8, $serviceManager->getAll());
    }
}

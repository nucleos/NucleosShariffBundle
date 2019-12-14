<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Service;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Vk implements Service
{
    public function getCode(): string
    {
        return 'vk';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        return $factory->createRequest(
            'GET',
            'https://vk.com/share.php?act=count&index=1&url='.urlencode($url)
        );
    }

    public function count(ResponseInterface $response): int
    {
        $content = $response->getBody()->getContents();
        $content = mb_substr($content, 18, mb_strlen($content) - 20);

        return (int) $content ?? 0;
    }
}

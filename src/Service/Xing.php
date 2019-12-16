<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Service;

use Core23\ShariffBundle\Service\Exception\FetchException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Xing implements Service
{
    public function getCode(): string
    {
        return 'xing';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        return $factory->createRequest(
            'POST',
            'https://www.xing-share.com/spi/shares/statistics?url='.urlencode($url)
        );
    }

    public function count(ResponseInterface $response): int
    {
        $json = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!\array_key_exists('share_counter', $json)) {
            throw new FetchException('The "share_counter" attributes could not be found', $response->getBody()->getContents());
        }

        return (int) $json['share_counter'];
    }
}

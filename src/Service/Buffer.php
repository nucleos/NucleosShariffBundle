<?php

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

final class Buffer implements Service
{
    public function getCode(): string
    {
        return 'buffer';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        return $factory->createRequest(
            'GET',
            'https://api.bufferapp.com/1/links/shares.json?url='.urlencode($url)
        );
    }

    public function count(ResponseInterface $response): int
    {
        $json = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!\array_key_exists('shares', $json)) {
            throw new FetchException('The "shares" attributes could not be found', $response->getBody()->getContents());
        }

        return (int) $json['shares'];
    }
}

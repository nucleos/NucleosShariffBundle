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

final class Pinterest implements Service
{
    public function getCode(): string
    {
        return 'pinterest';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        return $factory->createRequest(
            'GET',
            'https://api.pinterest.com/v1/urls/count.json?callback=x&url='.urlencode($url)
        );
    }

    public function count(ResponseInterface $response): int
    {
        $content = $response->getBody()->getContents();
        $content = mb_substr($content, 2, mb_strlen($content) - 3);

        $json = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        if (!\array_key_exists('count', $json)) {
            throw new FetchException('The "count" attributes could not be found', $response->getBody()->getContents());
        }

        return (int) $json['count'];
    }
}

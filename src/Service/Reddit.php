<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Service;

use Nucleos\ShariffBundle\Service\Exception\FetchException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Reddit implements Service
{
    public function getCode(): string
    {
        return 'reddit';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        return $factory->createRequest('GET', 'https://www.reddit.com/api/info.json?url='.urlencode($url));
    }

    public function count(ResponseInterface $response): int
    {
        $json = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!isset($json['data']['children'])) {
            throw new FetchException('The "data.children" attributes could not be found', $response->getBody()->getContents());
        }

        $count = 0;
        if (isset($json['data']['children'])) {
            foreach ((array) $json['data']['children'] as $child) {
                if (isset($child['data']['score'])) {
                    $count += $child['data']['score'];
                }
            }
        }

        return $count;
    }
}

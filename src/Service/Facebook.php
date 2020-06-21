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

final class Facebook implements Service
{
    /**
     * @var string
     */
    private $appid;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string|null
     */
    private $version;

    public function __construct(string $appid, string $secret, ?string $version = null)
    {
        $this->appid   = $appid;
        $this->secret  = $secret;
        $this->version = $version;
    }

    public function getCode(): string
    {
        return 'facebook';
    }

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface
    {
        $accessToken = urlencode($this->appid).'|'.urlencode($this->secret);

        $query       = sprintf(
            'https://graph.facebook.com/%s?id=%s&fields=engagement&access_token=%s',
            $this->getVersionPrefix(),
            urlencode($url),
            $accessToken
        );

        return $factory->createRequest('GET', $query);
    }

    public function count(ResponseInterface $response): int
    {
        $json = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!\array_key_exists('engagement', $json)) {
            throw new FetchException('The "engagement" attributes could not be found', $response->getBody()->getContents());
        }

        if (isset(
            $json['engagement']['reaction_count'],
            $json['engagement']['comment_count'],
            $json['engagement']['share_count']
        )) {
            return $json['engagement']['reaction_count']
                + $json['engagement']['comment_count']
                + $json['engagement']['share_count'];
        }

        return 0;
    }

    private function getVersionPrefix(): string
    {
        if (null === $this->version) {
            return '';
        }

        return 'v'.ltrim($this->version, 'v').'/';
    }
}

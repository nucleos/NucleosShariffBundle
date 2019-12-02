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

interface Service
{
    public function getCode(): string;

    public function createRequest(RequestFactoryInterface $factory, string $url): RequestInterface;

    /**
     * @throws FetchException
     */
    public function count(ResponseInterface $response): int;
}

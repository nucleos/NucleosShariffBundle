<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Backend;

use Core23\ShariffBundle\Manager\ServiceManager;
use Core23\ShariffBundle\Service\Exception\FetchException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

final class PsrBackend implements Backend, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var string[]
     */
    private $domains;

    /**
     * @param string[] $domains
     */
    public function __construct(
        ServiceManager $serviceManager,
        RequestFactoryInterface $requestFactory,
        ClientInterface $client,
        CacheItemPoolInterface $cache,
        array $domains = []
    ) {
        $this->serviceManager = $serviceManager;
        $this->requestFactory = $requestFactory;
        $this->client         = $client;
        $this->cache          = $cache;
        $this->domains        = $domains;
        $this->logger         = new NullLogger();
    }

    public function get(string $url): array
    {
        if (!$this->isValidDomain($url)) {
            return [];
        }

        $cacheKey = $this->cacheKey($url);

        if ($this->cache->hasItem($cacheKey)) {
            return json_decode($this->cache->getItem($cacheKey)->get(), true);
        }

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            return [];
        }

        $counts = $this->fetchServiceCounters($url);

        $this->saveCacheEntry($cacheKey, $counts);

        return $counts;
    }

    private function isValidDomain(string $url): bool
    {
        if (0 === \count($this->domains)) {
            $parsed = parse_url($url);

            if (false === $parsed) {
                return false;
            }

            return \in_array($parsed['host'], $this->domains, true);
        }

        return true;
    }

    private function cacheKey(string $url): string
    {
        return md5($url);
    }

    /**
     * @return array<string, int>
     */
    private function fetchServiceCounters(string $url): array
    {
        $counts = [];

        foreach ($this->serviceManager->getActive() as $service) {
            $request = $service->createRequest($this->requestFactory, $url);

            try {
                $response = $this->client->sendRequest($request);

                $counts[$service->getCode()] = $service->count($response);
            } catch (FetchException $e) {
                $this->logger->warning($e->getMessage(), [
                    'exception'    => $e,
                    'responseBody' => $e->getResponseBody(),
                ]);
            } catch (ClientExceptionInterface $e) {
                $this->logger->warning($e->getMessage(), [
                    'exception' => $e,
                ]);
            }
        }

        return $counts;
    }

    /**
     * @param array<string, int> $counts
     *
     * @throws InvalidArgumentException
     */
    private function saveCacheEntry(string $cacheKey, array $counts): void
    {
        $item = $this->cache->getItem($cacheKey);
        $item->set(json_encode($counts));

        $this->cache->save($item);
    }
}

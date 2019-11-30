<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Action;

use Core23\ShariffBundle\Backend\Backend;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class BackendAction
{
    /**
     * @var Backend
     */
    private $backend;

    public function __construct(Backend $backend)
    {
        $this->backend = $backend;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $url    = $request->get('url');
        $result = $this->backend->get($url);

        return new JsonResponse($result);
    }
}

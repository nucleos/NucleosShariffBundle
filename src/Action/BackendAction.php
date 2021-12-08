<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Action;

use Nucleos\ShariffBundle\Backend\Backend;
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
        $url = $request->query->get('url', '');

        if ('' === $url) {
            return new JsonResponse();
        }

        $result = $this->backend->get($url);

        return new JsonResponse($result);
    }
}

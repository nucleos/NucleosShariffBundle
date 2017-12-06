<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Controller;

use Heise\Shariff\Backend\BackendManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class BackendController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function shariffAction(Request $request): JsonResponse
    {
        $url    = $request->get('url');
        $result = $this->getBackendManager()->get($url);

        return new JsonResponse($result);
    }

    /**
     * @return BackendManager
     */
    private function getBackendManager(): BackendManager
    {
        return $this->get('core23.shariff.backend.manager');
    }
}

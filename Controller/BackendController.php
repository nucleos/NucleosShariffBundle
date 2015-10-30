<?php

/*
 * This file is part of the ni-ju-san CMS.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Controller;

use Heise\Shariff\Backend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BackendController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function shariffAction(Request $request)
    {
        $options = $this->getParameter('core23_shariff.options');

        $shariff = new Backend($options);
        $url     = $request->get('url');

        return new JsonResponse($shariff->get($url));
    }
}

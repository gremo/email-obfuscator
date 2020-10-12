<?php

/*
 * This file is part of the zurb-ink-bundle package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\EmailObfuscator\Laravel;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;

class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        // Apply logic differently based on the nature of $response.
        if ($response instanceof Renderable) {
            $response = obfuscateEmail($response->render());
        } elseif ($response instanceof Response) {
            $content = obfuscateEmail($response->getContent());
            $response->setContent($content);
        }

        return $response;
    }
}

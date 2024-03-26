<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware as BaseMiddleware;

class HandleInertiaRequests extends BaseMiddleware
{
    /**
     * The name of the root template to be used on the first page visit.
     *
     * @var string
     */
    protected string $rootTemplate = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function determineAssetVersion(Request $request): ?string
    {
        return parent::determineAssetVersion($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function shareData(Request $request): array
    {
        return array_merge(parent::shareData($request), [
            'auth' => [
                'user' => $request->user(),
            ],
        ]);
    }
}

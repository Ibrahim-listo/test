<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware as BaseMiddleware;

// HandleInertiaRequests class extends BaseMiddleware and is used to manage Inertia requests
class HandleInertiaRequests extends BaseMiddleware
{
    // The name of the root template to be used on the first page visit
    protected string $rootTemplate = 'app';

    // determineAssetVersion method returns the current asset version
    public function determineAssetVersion(Request $request): ?string
    {
        // Call the parent determineAssetVersion method and return its result
        return parent::determineAssetVersion($request);
    }

    // shareData method defines the props that are shared by default
    public function shareData(Request $request): array
    {
        // Merge the parent shared data with the custom data
        return array_merge(parent::shareData($request), [
            'auth' => [
                // Share the authenticated user with the Inertia response
                'user' => $request->user(),
            ],
        ]);
    }
}


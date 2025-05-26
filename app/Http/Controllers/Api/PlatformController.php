<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Platform\TogglePlatformRequest;
use App\Services\PlatformService;
use Illuminate\Http\Request;

class PlatformController extends AppBaseController
{
    protected $platformService;

    public function __construct(PlatformService $platformService)
    {
        $this->platformService = $platformService;
    }

    public function index()
    {
        return $this->platformService->listAll();
    }

    public function toggle(TogglePlatformRequest $request)
    {
        return $this->platformService->togglePlatform($request->validated(), $request->user());
    }

    public function userPlatforms(Request $request)
    {
        return $this->platformService->listUserPlatforms($request->user());
    }
}

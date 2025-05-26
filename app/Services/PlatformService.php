<?php

namespace App\Services;

use App\Models\Platform;

class PlatformService
{
  public function listAll()
  {
    return Platform::all();
  }

  public function listUserPlatforms($user)
  {
    return $user->platforms()->get();
  }

  public function togglePlatform(array $data, $user)
  {
    if ($data['active']) {
      $user->platforms()->syncWithoutDetaching([$data['platform_id']]);
    } else {
      $user->platforms()->detach($data['platform_id']);
    }

    return response()->json(['message' => 'Platform toggled successfully.']);
  }
}

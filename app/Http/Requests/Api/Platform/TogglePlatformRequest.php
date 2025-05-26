<?php

namespace App\Http\Requests\Api\Platform;

use Illuminate\Foundation\Http\FormRequest;

class TogglePlatformRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'platform_id' => 'required|exists:platforms,id',
      'active' => 'required|boolean',
    ];
  }
}

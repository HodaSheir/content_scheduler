<?php

namespace App\Http\Requests\Api\Platform;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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

  protected function failedValidation(Validator $validator)
  {
    $response = [
      'status' => false,
      'message' => $validator->errors()->first(),
    ];
    throw new HttpResponseException(response()->json($response, 422));
  }
}

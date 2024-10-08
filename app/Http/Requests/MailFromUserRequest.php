<?php

namespace App\Http\Requests;

use App\Models\BasicSettings\Basic;
use Illuminate\Foundation\Http\FormRequest;

class MailFromUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $googleRecaptchaStatus = Basic::query()->pluck('google_recaptcha_status')->first();

    return [
      'name' => 'required',
      'email' => 'required|email:rfc,dns',
      'subject' => 'required',
      'message' => 'required',
      'g-recaptcha-response' => $googleRecaptchaStatus == 1 ? 'required|captcha' : ''
    ];
  }

  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  public function messages()
  {
    $googleRecaptchaStatus = Basic::query()->pluck('google_recaptcha_status')->first();

    $messageArray = [];

    if ($googleRecaptchaStatus == 1) {
      $messageArray['g-recaptcha-response.required'] = 'Please verify that you are not a robot.';
      $messageArray['g-recaptcha-response.captcha'] = 'Captcha error! try again later or contact site admin.';
    }

    return $messageArray;
  }
}

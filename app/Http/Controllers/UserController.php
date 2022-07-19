<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
  public function updatePersonalInfo(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric|exists:users',
      'new_profile_image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg|max:10240',
      'first_name' => 'sometimes|nullable|alpha',
      'last_name' => 'sometimes|nullable|alpha',
      'gender' => 'sometimes|nullable|alpha|in:male,female',
      'nationality' => 'sometimes|nullable|string',
      'current_address' => 'sometimes|nullable|string',
      'mobile_phone' => 'sometimes|nullable|string|max:15|min:8|unique:users,mobile_phone,' . auth()->id(),
      'current_job_title' => 'sometimes|nullable|string',
      'years_of_work_experience' => 'sometimes|nullable|numeric|integer|between:0,10',
      'countries_of_work_experience' => 'sometimes|nullable|array|min:0',
      'countries_of_work_experience.*' => 'string|distinct|min:3',
      // 'hands_on_technology' => 'sometimes|nullable|array|min:0',
      // 'hands_on_technology.*' => 'string|distinct|min:3',
      'utm_medium' => 'sometimes|nullable|string',
      'name_of_professional' => 'sometimes|nullable|string',
      'languages' => 'sometimes|nullable|array|min:0',
      'languages.*.name' => 'string|distinct|min:2',
      'languages.*.fluency' => 'alpha|in:elementary,professional,native',
    ]);

    $user = User::whereId(auth()->id())->first();
    $userData = $request->except(['id, new_profile_image']);
    $user->update($userData);


    //updating images
    if ($request->hasFile('new_profile_image') && isset($request->profile_image) && !empty($request->profile_image)) {
      $image = Image::make($request->file('new_profile_image'))->encode('jpg', 1);
      if (Auth()->user()->avatar != null) {
        if (File::exists("images/users/" . Auth()->user()->avatar)) {
          File::delete("images/users/" . Auth()->user()->avatar);
        }
      }
      $img_name = sprintf("usr_%s.jpg", strtolower(Str::random(10)));
      if (!File::isDirectory(public_path("images"))) {
        File::makeDirectory(public_path("images"));
      }
      if (!File::isDirectory(public_path("images/users"))) {
        File::makeDirectory(public_path("images/users"));
      }
      $image->save(public_path("images/users/") . $img_name, 70, 'jpg');
      $user->personalInformation()->update([
        'profile_image' => $img_name
      ]);
    }
    $response['status'] = 'success';
    $response['message'] = 'User personal information updated';
    return response($response, 200);
  }

  public function updateInterests(Request $request)
  {
    $request->validate([
      'topic_of_interests' => 'sometimes|nullable|array',
      'topic_of_interests.*' => 'string|distinct|min:2',
      'areas_of_contribution' => 'sometimes|nullable|array',
      'areas_of_contribution.*' => 'string|distinct|min:2',
    ]);

    $user = User::whereId(auth()->id())->first();
    $updatable_values = $request->only(['topic_of_interests', 'areas_of_contribution']);
    $user->update($updatable_values);

    $response['status'] = 'success';
    $response['message'] = 'User interests and contributions updated';
    return response($response, 200);
  }

  public function updateShortBio(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric|exists:users',
      'short_bio' => 'sometimes|nullable|string|min:100',
    ]);

    $user = User::whereId(auth()->id())->first();
    $updatable_values = $request->only(['short_bio']);
    $user->update($updatable_values);

    $response['status'] = 'success';
    $response['message'] = 'User short bio updated';
    return response($response, 200);
  }

  public function updateJobSearchPreference(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric|exists:users',
      'current_job_status' => 'required|alpha_dash|in:not_available,part_time,full_time',
      'available_for_job_from' => 'sometimes|nullable|required_if:current_job_status,not_available|date|after:today',
      'available_for_fulltime_job_from' => 'sometimes|nullable|date|after:today',
      'preferred_job_location_type' => 'sometimes|nullable|required_if:current_job_status,part_time,full_time|alpha_dash|in:remote,onsite',
      'preferred_job_hours_per_week' => 'sometimes|nullable|required_if:current_job_status,part_time,full_time|integer|between:1,40',
      'preferred_job_countries' => 'sometimes|nullable|array|min:0',
      'preferred_job_countries.*' => 'string|distinct|min:3',
    ]);

    $user = User::whereId(auth()->id())->first();
    $userData = $request->only([
      'current_job_status',
      'available_for_job_from',
      'available_for_fulltime_job_from',
      'preferred_job_location_type',
      'preferred_job_hours_per_week',
      'preferred_job_countries',
    ]);
    $user->update($userData);

    $response['status'] = 'success';
    $response['message'] = 'User work status updated';
    return response($response, 200);
  }

  public function getProfileInformation(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response(['user' => $user]);
  }
}

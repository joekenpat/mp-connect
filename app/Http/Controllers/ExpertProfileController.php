<?php

namespace App\Http\Controllers;

use App\Models\ExpertProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertProfileController extends Controller
{
  public function getExpertProfile(Int $expert_profile_id)
  {
    $profile = ExpertProfile::where(['user_id' => auth()->id(), 'id' => $expert_profile_id])->first();
    $response['status'] = 'success';
    $response['message'] = 'User expert profile retrieved';
    $response['profile'] = $profile;
    return response($response, 200);
  }

  public function updateExpertProfile(Request $request)
  {
    $request->validate([
      'id' => 'sometimes|nullable|numeric|integer|exists:expert_profiles,id,user_id,' . auth()->id(),
      'name' => 'required|string|max:255',
      'description' => 'sometimes|string|min:100|max:1024',
    ]);

    $user = User::whereId(auth()->id())->first();
    if (isset($request->id)) {
      ExpertProfile::where([
        'user_id' => $user->id,
        'id' => $request->id
      ])->update($request->only(['name', 'description']));
      $expertProfile = ExpertProfile::where([
        'user_id' => $user->id,
        'id' => $request->id
      ])->first();
    } else {
      $expertProfile = ExpertProfile::create(
        array_merge($request->only(['name', 'description']), ['user_id' => $user->id])
      );
    }
    $response['status'] = 'success';
    $response['message'] = 'User expert profile updated';
    $response['profile'] = $expertProfile;
    return response($response, 200);
  }
}

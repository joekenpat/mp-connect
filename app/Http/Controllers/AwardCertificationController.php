<?php

namespace App\Http\Controllers;

use App\Models\AwardCertification;
use App\Models\ExpertProfile;
use App\Models\User;
use Illuminate\Http\Request;

class AwardCertificationController extends Controller
{
  public function getCertifications(Request $request)
  {
    $award_certifications = AwardCertification::where(['user_id' => auth()->id()])->get();
    return response([
      'certifications' => $award_certifications,
    ]);
  }

  public function getExpertCertification(Int $expert_profile_id)
  {
    $expertProfile = ExpertProfile::where([
      'user_id' => auth()->id(),
      'id' => $expert_profile_id,
    ])->first();

    $response['status'] = 'success';
    $response['certifications'] = $expertProfile->award_certifications;
    return response($response, 200);
  }

  public function updateCertifications(Request $request)
  {
    $request->validate([
      'certifications' => 'sometimes|nullable|array',
      'certifications.*.id' => 'sometimes|nullable|numeric|exists:award_certifications,id',
      'certifications.*.title' => 'required|nullable|string',
      'certifications.*.description' => 'sometimes|nullable|string'
    ]);

    $user = User::whereId(auth()->id())->first();
    $user_id = $user->id;

    if (isset($request->certifications) && count($request->certifications)) {
      foreach ($request->certifications as $certification) {
        if (isset($certification['id'])) {
          AwardCertification::where(['user_id' => $user_id, 'id' => $certification['id']])->update($certification);
        } else {
          $certification['user_id'] = $user_id;
          AwardCertification::create($certification);
        }
      };
    }

    $response['status'] = 'success';
    $response['message'] = 'User awards and certifications updated';
    return response($response, 200);
  }

  public function deleteCertification(Int $certification_id)
  {
    $certification = AwardCertification::where(['user_id' => auth()->id(), 'id' => $certification_id])->first();
    if ($certification) {
      $certification->delete();
      $response['status'] = 'success';
      $response['message'] = 'User Award / Certification deleted';
      return response($response, 200);
    } else {
      $response['status'] = 'error';
      $response['message'] = 'User Award / Certification not found';
      return response($response, 404);
    }
  }

  public function updateExpertCertifications(Request $request)
  {
    $request->validate([
      'expert_profile_id' => 'required|numeric|exists:expert_profiles,id,user_id,' . auth()->id(),
      'certification_ids' => 'sometimes|nullable|array',
      'certifications.*' => 'numeric|exists:award_certifications,id,user_id,' . auth()->id(),
    ]);

    $expertProfile = ExpertProfile::where([
      'user_id' => auth()->id(),
      'id' => $request->expert_profile_id
    ])->first();
    $expertProfile->award_certifications()->sync($request->certifications);
    $response['status'] = 'success';
    $response['message'] = 'Expert awards and certifications updated';
    return response($response, 200);
  }
}

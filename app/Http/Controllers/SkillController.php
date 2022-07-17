<?php

namespace App\Http\Controllers;

use App\Models\ExpertProfile;
use App\Models\ExpertSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
  public function getExpertSkill(Int $expert_profile_id)
  {
    $expertProfile = ExpertProfile::where(['user_id' => auth()->id(), 'id' => $expert_profile_id])->first();
    $response['status'] = 'success';
    $response['skills'] = $expertProfile->skills;
    return response($response, 200);
  }

  public function getSkills(Request $request)
  {
    $skills = Skill::where(['user_id' => auth()->id()])->get();
    return response([
      'skills' => $skills,
    ]);
  }

  public function updateSkills(Request $request)
  {
    $request->validate([
      'skills' => 'sometimes|nullable|array',
      'skills.*.id' => 'sometimes|nullable|numeric|exists:skills,id',
      'skills.*.name' => 'sometimes|nullable|string',
      'skills.*.type' => 'required|alpha_dash',
    ]);

    $user = User::whereId(auth()->id())->first();
    $user_id = $user->id;
    $functional_skills = [];
    $industry_skills = [];

    if (isset($request->skills) && count($request->skills)) {
      foreach ($request->skills as $skill) {
        if ($skill['type'] == 'functional_skill') {
          $functional_skills[] = $skill['name'];
        } else if ($skill['type'] == 'industry_experience') {
          $industry_skills[] = $skill['name'];
        }
        if (isset($skill['id'])) {
          Skill::where(['user_id' => $user_id, 'id' => $skill['id']])->update($skill);
        } else {
          $skill['user_id'] = $user_id;
          Skill::create($skill);
        }
      };
      Skill::where(['user_id' => $user_id, 'type' => 'functional_skill'])->whereNotIn('name', $functional_skills)->delete();
      Skill::where(['user_id' => $user_id, 'type' => 'industry_experience'])->whereNotIn('name', $industry_skills)->delete();
    }


    $response['status'] = 'success';
    $response['message'] = 'User skill and experience  updated';
    return response($response, 200);
  }

  function updateExpertSkills(Request $request)
  {
    $request->validate([
      'expert_profile_id' => 'required|numeric|exists:expert_profiles,id,user_id,' . auth()->id(),
      'skills' => 'sometimes|nullable|array',
      'skills.*.expert_profile_id' => 'required|numeric|exists:expert_profiles,id,user_id,' . auth()->id(),
      'skills.*.id' => 'sometimes|nullable|numeric|exists:expert_skills,id,expert_profile_id,' . $request->expert_profile_id,
      'skills.*.name' => 'sometimes|nullable|string',
      'skills.*.type' => 'required|alpha_dash',
    ]);

    $expert_profile = ExpertProfile::where(['user_id' => auth()->id(), 'id' => $request->expert_profile_id])->first();

    $functional_skills = [];
    $industry_skills = [];

    if (isset($request->skills) && count($request->skills)) {
      foreach ($request->skills as $skill) {
        if ($skill['type'] == 'functional_skill') {
          $functional_skills[] = $skill['name'];
        } else if ($skill['type'] == 'industry_experience') {
          $industry_skills[] = $skill['name'];
        }
        if (isset($skill['id'])) {
          ExpertSkill::where(['expert_profile_id' => $expert_profile->id, 'id' => $skill['id']])->update($skill);
        } else {
          ExpertSkill::create($skill);
        }
      };
      ExpertSkill::where(['expert_profile_id' => $expert_profile->id, 'type' => 'functional_skill'])->whereNotIn('name', $functional_skills)->delete();
      ExpertSkill::where(['expert_profile_id' => $expert_profile->id, 'type' => 'industry_experience'])->whereNotIn('name', $industry_skills)->delete();
    }

    $response['status'] = 'success';
    $response['message'] = 'Expert skill and experience  updated';
    return response($response, 200);
  }
}

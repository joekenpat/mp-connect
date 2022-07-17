<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{

  public function getWorkExperiences(Request $request)
  {
    $work_experiences = WorkExperience::where(['user_id' => auth()->id()])->get();
    return response(['work_experiences' => $work_experiences]);
  }

  public function updateWorkExperience(Request $request)
  {
    $request->validate([
      'work_experiences' => 'sometimes|nullable|array|min:1',
      'work_experiences.*.id' => 'sometimes|nullable|numeric|exists:work_experiences,id',
      'work_experiences.*.job_title' => 'sometimes|nullable|string',
      'work_experiences.*.employer_name' => 'sometimes|nullable|string',
      'work_experiences.*.industry' => 'sometimes|nullable|string',
      'work_experiences.*.start_month' => 'required|numeric|integer|min:1|max:12',
      'work_experiences.*.start_year' => 'required|numeric|integer|min:1920',
      'work_experiences.*.end_month' => 'sometimes|nullable|numeric|integer|min:1|max:12',
      'work_experiences.*.end_year' => 'sometimes|nullable|numeric|integer|min:1920',
      'work_experiences.*.is_current_role' => 'sometimes|nullable|in:yes,no,true,false,1,0',
      'work_experiences.*.hands_on_technology' => 'sometimes|nullable|array|min:0',
      'work_experiences.*.hands_on_technology.*' => 'string|min:3',
      'work_experiences.*.description' => 'sometimes|nullable|string'
    ]);

    $user = User::whereId(auth()->id())->first();
    $user_id = $user->id;

    if (isset($request->work_experiences) && count($request->work_experiences)) {
      foreach ($request->work_experiences as $experience) {
        if (isset($experience['id'])) {
          $experience['is_current_role'] =  filter_var($experience['is_current_role'], FILTER_VALIDATE_BOOLEAN);
          WorkExperience::where(['user_id' => $user_id, 'id' => $experience['id']])->update($experience);
        } else {
          $experience['user_id'] = $user_id;
          WorkExperience::create($experience);
        }
      };
    }

    $response['status'] = 'success';
    $response['message'] = 'User work experience updated';
    return response($response, 200);
  }

  public function deleteWorkExperience(Int $work_experience_id)
  {
    $work_experience = WorkExperience::where(['user_id' => auth()->id(), 'id' => $work_experience_id])->first();
    if ($work_experience) {
      $work_experience->delete();
      $response['status'] = 'success';
      $response['message'] = 'User work experience deleted';
      return response($response, 200);
    } else {
      $response['status'] = 'error';
      $response['message'] = 'User work experience not found';
      return response($response, 404);
    }
  }
}

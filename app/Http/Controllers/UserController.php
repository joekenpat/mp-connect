<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User\AwardCertification;
use App\Models\User\PersonalInformation;
use App\Models\User\ProjectReference;
use App\Models\User\Skill;
use App\Models\User\WorkExperience;
use App\Models\User\WorkHistory;
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
      'mobile_phone' => 'sometimes|nullable|string|max:15|min:8|unique:users,mobile_phone,'. auth()->id(),
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
        Log::debug(print_r($experience, true));
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

  public function updateProjectReferences(Request $request)
  {
    $request->validate([
      'project_references' => 'sometimes|nullable|array',
      'project_references.*.id' => 'sometimes|nullable|numeric|exists:project_references,id',
      'project_references.*.name_of_client' => 'sometimes|nullable|string',
      // 'project_references.*.new_document_file' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,pdf,doc,docx|max:10240',
      'project_references.*.industry' => 'sometimes|nullable|string',
      'project_references.*.functional_skills' => 'sometimes|nullable|array|min:0',
      'project_references.*.functional_skills.*' => 'string|min:3',
      'project_references.*.description' => 'sometimes|nullable|string'
    ]);

    $user = User::whereId(auth()->id())->first();
    $user_id = $user->id;

    if (isset($request->project_references) && count($request->project_references)) {
      foreach ($request->project_references as $reference) {
        Log::debug(print_r($reference, true));
        if (isset($reference['id'])) {
          ProjectReference::where(['user_id' => $user_id, 'id' => $reference['id']])->update($reference);
        } else {
          $reference['user_id'] = $user_id;
          ProjectReference::create($reference);
        }
      };
    }

    $response['status'] = 'success';
    $response['message'] = 'User project reference updated';
    return response($response, 200);
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
        Log::debug(print_r($certification, true));
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


  public function getProfileInformation(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response(['user' => $user]);
  }

  public function getWorkExperiences(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response(['work_experiences' => $user->work_experiences]);
  }

  public function getProjectReferences(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response(['project_references' => $user->project_references]);
  }

  public function getSkills(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response([
      'skills' => $user->skills,
    ]);
  }

  public function getCertifications(Request $request)
  {
    $user = User::whereId(auth()->id())->first();
    return response([
      'certifications' => $user->award_certifications,
    ]);
  }
}

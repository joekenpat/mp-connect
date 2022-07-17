<?php

namespace App\Http\Controllers;

use App\Models\ExpertProfile;
use App\Models\ProjectReference;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectReferenceController extends Controller
{
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

  public function deleteProjectReference(Int $project_reference_id)
  {
    $project_reference = ProjectReference::where(['user_id' => auth()->id(), 'id' => $project_reference_id])->first();
    if ($project_reference) {
      $project_reference->delete();
      $response['status'] = 'success';
      $response['message'] = 'Project reference deleted';
      return response($response, 200);
    } else {
      $response['status'] = 'error';
      $response['message'] = 'Project reference not found';
      return response($response, 404);
    }
  }

  public function getProjectReferences(Request $request)
  {
    $project_references = ProjectReference::where(['user_id' => auth()->id()])->get();
    return response(['project_references' => $project_references]);
  }

  public function getExpertProjectReferences(Int $expert_profile_id)
  {
    $expertProfile = ExpertProfile::where([
      'user_id' => auth()->id(),
      'id' => $expert_profile_id
    ])->first();

    $response['status'] = 'success';
    $response['project_references'] = $expertProfile->project_references;
    return response($response, 200);
  }

  public function updateExpertProjectReferences(Request $request)
  {
    $request->validate([
      'expert_profile_id' => 'required|numeric|exists:expert_profiles,id',
      'project_reference_ids' => 'sometimes|nullable|array',
      'project_reference_ids.*' => 'numeric|exists:project_references,id,expert_profile_id,' . $request->expert_profile_id,
    ]);

    $expertProfile = ExpertProfile::where([
      'user_id' => auth()->id(),
      'id' => $request->expert_id
    ])->first();
    $expertProfile->project_references()->sync($request->project_reference_ids);
    $response['status'] = 'success';
    $response['message'] = 'Expert project references updated';
    return response($response, 200);
  }
}

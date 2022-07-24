<?php

namespace App\Http\Controllers;

use App\Models\ExpertProfile;
use App\Models\ProjectReference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectReferenceController extends Controller
{
  public function updateProjectReferences(Request $request)
  {
    $request->validate([
      'project_references' => 'sometimes|nullable|array',
      'project_references.*.id' => 'sometimes|nullable|numeric|exists:project_references,id',
      'project_references.*.name_of_client' => 'sometimes|nullable|string',
      'project_references.*.new_document_file' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,pdf,doc,docx|max:10240',
      'project_references.*.industry' => 'sometimes|nullable|string',
      'project_references.*.functional_skills' => 'sometimes|nullable|array|min:0',
      'project_references.*.functional_skills.*' => 'string|min:3',
      'project_references.*.description' => 'sometimes|nullable|string'
    ]);

    $user = User::whereId(auth()->id())->first();
    $user_id = $user->id;


    if (isset($request->project_references) && count($request->project_references)) {
      foreach ($request->project_references as $reference) {
        $payload = Arr::except($reference, ['new_document_file','document_file']);
        if (isset($reference['id'])) {
          $new_reference = ProjectReference::where(['user_id' => $user_id, 'id' => $payload['id']])->first();
          $new_reference->update($payload);
        } else {
          $payload['user_id'] = $user_id;
          $new_reference = ProjectReference::create($payload);
        }
        $old_path = $new_reference->getRawOriginal('document_file');
        if ($reference['new_document_file'] && isset($reference['new_document_file'])) {
          $new_document_file = $reference['new_document_file'];
          $new_document_file_name =  $new_document_file->hashName();
          // return [
          //   'path1' => $old_path,
          //   'exist' => Storage::exists($old_path),
          // ];
          if(Storage::exists($old_path)) {
            Storage::delete($old_path);
          }
          $new_document_path = Storage::putFileAs('images/project_references', $new_document_file, $new_document_file_name);
          if($new_document_path) {
            $new_reference->document_file = $new_document_path;
            $new_reference->update();
          }
        }
      }
    };

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
      'expert_profile_id' => 'required|numeric|exists:expert_profiles,id,user_id,' . auth()->id(),
      'project_reference_ids' => 'sometimes|nullable|array',
      'project_reference_ids.*' => 'numeric|exists:project_references,id,user_id,' . auth()->id(),
    ]);

    $expertProfile = ExpertProfile::where([
      'user_id' => auth()->id(),
      'id' => $request->expert_profile_id
    ])->first();
    $expertProfile->project_references()->sync($request->project_reference_ids);
    $response['status'] = 'success';
    $response['message'] = 'Expert project references updated';
    return response($response, 200);
  }
}

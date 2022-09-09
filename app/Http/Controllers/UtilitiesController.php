<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Models\FunctionalSkill;

class UtilitiesController extends Controller
{
    public function country()
    {
        $query = Country::all();
        $countries = [];
        foreach($query as $country) {
            array_push($countries, $country->name);
        }
        return response(['countries' => $countries]);
    }

    public function industry()
    {
        $query = Industry::all();
        $industries = [];
        foreach($query as $industry) {
            array_push($industries, $industry->title);
        }
        return response(['industries' => $industries]);
    }

    public function functional_skills()
    {
        $query = FunctionalSkill::all();
        $functional_skills = [];
        foreach($query as $skill) {
            array_push($functional_skills, $skill->title);
        }
        return response(['functional_skills' => $functional_skills]);
    }
}

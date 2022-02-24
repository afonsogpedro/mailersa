<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};

class DropCscController extends Controller
{
    public function fetchState(Request $request)
    {
        $states = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($states);
    }

    public function fetchCity(Request $request)
    {
        $cities = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($cities);
    }
}

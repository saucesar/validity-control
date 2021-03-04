<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        $params = [
            'expdates' => auth()->user()->makeRoadMap(),
        ];

        return view('roadMap.index', $params);
    }
}

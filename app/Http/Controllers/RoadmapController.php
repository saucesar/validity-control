<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class RoadmapController extends Controller
{
    public function index()
    {
        $params = [
            'expdates' => auth()->user()->makeRoadMap(),
        ];

        return view('roadMap.index', $params);
    }

    public function toPdf()
    {
        $params = [
            'expdates' => auth()->user()->makeRoadMap(30, 0),
        ];

        $pdf = PDF::loadView('roadMap.pdf', $params);
        //$pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Roteiro.pdf');
    }
}

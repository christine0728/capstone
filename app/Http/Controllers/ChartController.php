<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData()
    {
        // Replace this with your actual data retrieval logic
        $data = [
            'labels' => ['Label 1', 'Label 2', 'Label 3'],
            'data' => [10, 20, 15],
        ];

        return response()->json($data); // Return data as JSON
    }
}

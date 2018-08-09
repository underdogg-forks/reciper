<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Visitor;
use Eseath\SxGeo\SxGeo;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::latest()->simplePaginate(40);
        $sxgeo = new SxGeo(storage_path('/geo/SxGeoCity.dat'));
        $all_recipes = Recipe::count();
        $all_visitors = Visitor::distinct('ip')->count();

        return view('admin.statistics.index', compact(
            'sxgeo', 'visitors', 'all_recipes', 'all_visitors'
        ));
    }
}

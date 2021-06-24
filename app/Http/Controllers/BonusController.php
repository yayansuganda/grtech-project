<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class BonusController extends Controller
{
    public function index() {
        return view('daily.view');
    }


    public function datatableDaily(Request $request)
    {
        $test = Http::get('https://zenquotes.io/api/quotes');
        $model = json_decode($test);

        return DataTables::of($model)
            ->addColumn('convert_h',function($model){
                    return "$model->h";
            })
            ->addIndexColumn()
            ->rawColumns(['convert_h'])
            ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CompaniController extends Controller
{
    public function index()
    {
        return view('companies.view');
    }


    public function create()
    {
        $model = new Companies();
        return view('companies.form', compact('model'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email'=>'required|email',
            'website' => 'required|url'
        ]);

        $path_logo = $request->file('logo');
        $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'website' => $request->website
                ];

        if ($path_logo) {
            $name_file_logo = Carbon::now()->timestamp.'_'.$path_logo->getClientOriginalName();
            Storage::putFileAs('public/',$path_logo, $name_file_logo);
            $data['logo'] = $name_file_logo;
        }

        $model =  Companies::updateOrCreate(['id' => $request->id], $data);
        return $model;
    }


    public function show($id)
    {
        $model = Companies::where('id','=',$id)->firstOrFail();
        return view('companies.detail',compact('model'));
    }


    public function edit($id)
    {
        $model = Companies::where('id', $id)->firstOrFail();
        return view('companies.form', compact('model'));
    }


    public function destroy($id)
    {
        $deleted = Companies::findOrFail($id);
        Storage::disk('local')->delete('public/' . $deleted->logo);
        $deleted->delete();
    }


    public function datatableCompani(Request $request)
    {
        $model =  Companies::select('*')->get();
        return DataTables::of($model)
            ->addColumn('logo_company',function($model){
                if (!empty($model->logo)) {
                    return '<img src="'.Storage::url('public/'.$model->logo).'" alt="Product Image" class="img-size-50">';
                } else {
                    return '';
                }
            })
            ->addColumn('website_company',function($model){
                if (!empty($model->website)) {
                    return '<a href="'.$model->website.'" class ="btn btn-block btn-outline-success btn-sm" target="_blank">'.$model->website.'</a>';
                } else {
                    return '';
                }
            })
            ->addColumn('action', function ($model) {
                return view('layouts.button._button', [
                    'model' => $model->name,
                    'title_edit' => "Data Compani",
                    'url_edit' => route('compani.edit', $model->id),
                    'url_destroy' => route('compani.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action','logo_company','website_company'])
            ->make(true);
    }
}

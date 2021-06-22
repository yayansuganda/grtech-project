<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Companies;
use App\Models\Employees;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployessController extends Controller
{
    public function index()
    {
        return view('employees.view');
    }


    public function create()
    {
        $model = new Employees();
        $company = Companies::pluck('name','id');
        return view('employees.form', compact('model','company'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'email'=>'required|email',

        ]);

        $model =  Employees::updateOrCreate(['id' => $request->id], $request->all());
        if (empty($request->id)) {
            $this->sendEmail($model->id);
        }
        return $model;
    }


    public function sendEmail($id) {
        try {
            $email_company = Employees::where('id','=',$id)->firstOrFail();
            Mail::to($email_company->getCompanies->email)->send(new SendEmail($email_company));
            return "Email Has Been Sent";
        } catch (Exception $e) {
            return "Email failed to send";
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $model = Employees::where('id', $id)->firstOrFail();
        $company = Companies::pluck('name','id');
        return view('employees.form', compact('model','company'));
    }


    public function destroy($id)
    {
        Employees::destroy($id);
    }


    public function datatableEmployees(Request $request)
    {
        $model =  Employees::select('employees.*')->join('companies','companies.id','=','employees.company_id')->get();

        return DataTables::of($model)
            ->addColumn('company_detail',function($model){
                return '<a href="'.route('companies.show',$model->company_id).'" title="Detail Companies" class ="btn-show">'.$model->getCompanies->name.'</a>';
            })
            ->addColumn('action', function ($model) {
                return view('layouts.button._button', [
                    'model' => $model->full_name,
                    'title_edit' => "Data Employees",
                    'url_edit' => route('employees.edit', $model->id),
                    'url_destroy' => route('employees.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action','full_name','company_detail','name_company'])
            ->make(true);
    }
}

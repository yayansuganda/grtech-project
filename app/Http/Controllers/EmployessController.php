<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Companies;
use App\Models\Employees;
use Carbon\Carbon;
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
        $company_search = Companies::pluck('name','id');
        return view('employees.view',compact('company_search'));
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
        $first_name = empty($request->first_name) ? '' : $request->first_name;
        $last_name = empty($request->last_name) ? '' : $request->last_name;
        $email = empty($request->email) ? '' : $request->email;
        $company = empty($request->company) ? '' : $request->company;
        $date_range = empty($request->date_range) ? '' : $request->date_range;
        $str = explode(" - ",$date_range);
        $date1 = Carbon::parse($str[0])->format('Y-m-d');
        $date2 = Carbon::parse($str[1])->format('Y-m-d');

        // dd($first_name, $last_name, $email, $company, $date_range);
        $model =  Employees::select('employees.*')->join('companies','companies.id','=','employees.company_id');

        return DataTables::of($model)
            ->filter(function($query) use ($first_name, $last_name, $email, $company, $date1, $date2){
                if(!empty($first_name)) {
                    $query->where('employees.first_name','like',"%$first_name%");
                }

                if(!empty($last_name)) {
                    $query->where('employees.last_name','like',"%$last_name%");
                }

                if(!empty($email)) {
                    $query->where('employees.email','like',"%$email%");
                }

                if(!empty($company)) {
                    $query->where('employees.company_id','like',"%$company%");
                }

                if($date1 != $date2) {
                    $query->whereBetween('employees.created_at', array($date1, $date2));
                }



            })
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
            ->make();
    }
}

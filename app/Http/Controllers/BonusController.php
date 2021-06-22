<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BonusController extends Controller
{
    public function index() {
        $test = Http::get('https://zenquotes.io/api/quotes');

        $result = json_decode($test);
        return view('daily.view',compact('result'));
    }

    // public function dateDa() {
    //     $test = Http::get('https://zenquotes.io/api/quotes');

    //     $result = json_decode($test);
    //     return view('daily.view',compact('result'));
    // }
}

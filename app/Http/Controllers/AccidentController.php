<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    public function getdata(){
        $data = Data::all();
        return view('Admin.accidents',compact('data'));
    }
}

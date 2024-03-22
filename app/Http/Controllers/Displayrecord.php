<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class Displayrecord extends Controller
{
    function display(){
        $find = Payment::all();
        return view('display',['show'=>$find]);
    }
}

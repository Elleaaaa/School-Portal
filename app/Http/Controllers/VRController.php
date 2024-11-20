<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VRController extends Controller
{
    public function index()
    {
        return view('vr.vrsample');
    }
}

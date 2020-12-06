<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Schedules extends Controller
{
    public function index()
    {
        return view('adm.schedules.index');
    }
}

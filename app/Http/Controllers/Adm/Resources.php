<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Resources extends Controller
{
    public function index(Request $request)
    {
        return view('adm.resources.index');
    }

    public function create(Request $request)
    {
        return view('adm.resources.create');
    }

    public function edit(Request $request)
    {
        return view('adm.resources.edit');
    }
}

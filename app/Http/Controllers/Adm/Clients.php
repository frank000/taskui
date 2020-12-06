<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Clients extends Controller
{
    public function index(Request $request)
    {
        return view('adm.clients.index');

    }
    //
}

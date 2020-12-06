<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Api\Agenda;
use App\Http\Controllers\Controller;
use App\Http\Service\AgendaService;
use Illuminate\Http\Request;

class Index extends Controller
{

    /**
     * Used from qrcode
     * @param Request $request
     */
    public function listTasksId(Request $request)
    {
        if (isset($request->id))
        {
            $sgService = new AgendaService(new \App\Models\Agenda());
            $dates = $sgService->getAgendaByIdAtividade($request->id);
        }
        return view('guest.list-tasks-id', compact('dates'));

    }
}

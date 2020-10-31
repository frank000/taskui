<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Service\AgendaService;
use App\Http\Service\HelperService;
use App\Http\Service\TokenService;
use PDF;
use Illuminate\Http\Request;

class AtividadeApi extends Controller
{
    public function pdfQrcode(Request $request, $idAtividade)
    {
        try {
            $agService = new AgendaService(new \App\Models\Agenda());
            $base64Code = $agService->getQrCode(url('/guest/list-tasks-id/' . $idAtividade));
            $logo = HelperService::imagenToBase64('img/logo.png');

            $company = "Clinica teste";

            $data = array( 'qrcode'=>$base64Code, 'company' => $company, 'logo' => $logo);

            $pdf = PDF::setOptions([ 'isRemoteEnabled' => true])->loadView('adm.pdf.qrcode', compact('data'));
            $file = $pdf->output();
            return base64_encode($file);
        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }

}

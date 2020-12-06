<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Api\AtividadeApi;
use App\Http\Controllers\Controller;
use App\Http\Service\HelperService;
use App\Http\Service\TokenService;
use App\Models\Atividade;
use App\Models\Constant;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;

class Atividades extends Controller
{
    public function index(Request $request)
    {
        return view('adm.atividades.index');
    }
    public function create(Request $request)
    {
        return view('adm.atividades.create');
    }

    public function generatePdfQrCode(Request $request)
    {
        if(isset($request->id))
        {
            $api = new AtividadeApi();

            $base = $api->pdfQrcode($request, $request->id);
            $result = base64_decode($base);
            $pdf = new Dompdf();
            return view('adm.atividades.pdfView', compact('result'));
        }
    }

    public function show(Request $request)
    {
        $id = (TokenService::tokenizer($request->atividade)->id);
        $obj = Atividade::find($id);

        $arrs = $obj->semanaPeriodos->map(function ($item){
            return array_merge($item->toArray(),$item->resource->toArray());
        });

        $resourcesArr = [];
        foreach ($arrs as $key => $row)
        {
            $result=[];
            $result['dias'] = " - " . Constant::COMPLETE_DAYS_INDEX[$row['num_dia']] . " de " . $row['hor_inicio_man'] . " às " . $row['hor_fim_man'] .
                " - " . $row['hor_inicio_tar'] . " às " . $row['hor_fim_tar'];
            $result['resource'] = $row['str_name'];
            $resourcesArr[$key] = $result;
        }

        $atividade = $obj->toArray();
        return view('adm.atividades.show')->with('atividade', $atividade)
            ->with('resourcesArr', $resourcesArr)
            ->with('ids', $request->atividade);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Applicant;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $applicant = null;

        if ($request->has(['tipo', 'valor'])) {
            $tipo = $request->input('tipo');
            $valor = $request->input('valor');

            $applicant = match ($tipo) {
                'cedula' => Applicant::with(['license', 'licenseAttachments'])->where('id_number', $valor)->first(),
                'pasaporte' => Applicant::with(['license', 'licenseAttachments'])->where('passport_number', $valor)->first(),
                'licencia' => Applicant::with(['license', 'licenseAttachments'])->whereHas('license', fn($q) => $q->where('transaction_number', $valor))->first(),
                default => null,
            };
        }

        return view('search.index', compact('applicant'));
    }
}

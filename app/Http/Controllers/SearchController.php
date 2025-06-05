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

        // Búsqueda condicional
        $applicant = match ($tipo) {
        'cedula' => Applicant::with(['license', 'attachments'])->where('id_number', $valor)->first(),
        'pasaporte' => Applicant::with(['license', 'attachments'])->where('passport_number', $valor)->first(),
        'licencia' => Applicant::whereHas('license', fn($q) => $q->where('transaction_number', $valor))->with(['license', 'attachments'])->first(),default => null,
};

    }

    return view('search.index', compact('applicant'));
}
}

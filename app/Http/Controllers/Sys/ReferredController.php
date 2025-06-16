<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referred;

class ReferredController extends Controller
{
   public function index()
    {
        $referreds = Referred::with('referredBy')->paginate(10);
        return view('sys.referreds.index', compact('referreds'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $referreds = Referred::all(); // para el select de "Referido por"
        return view('sys.referreds.create', compact('referreds'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'referred_by_id' => 'nullable|exists:referreds,id',
            'country' => 'required|string|max:255',
        ]);

        Referred::create($validated);

        return redirect()->route('sys.referreds.index')->with('success', 'Referido creado correctamente');
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function show(Referred $referred)
    {
        $referred->load('referredBy', 'referrals'); // carga relaciones para mostrar en el detalle
        return view('sys.referreds.show', compact('referred'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function edit(Referred $referred)
    {
        // Obtenemos los posibles referidos para el campo "Referido por"
        $referredOptions = Referred::where('id', '!=', $referred->id)->pluck('first_name', 'id');

        return view('sys.referreds.edit', compact('referred', 'referredOptions'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, Referred $referred)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'referred_by_id' => 'nullable|exists:referred,id|not_in:' . $referred->id,
            'country' => 'required|string|max:100',
        ]);

        $referred->update($request->all());

        return redirect()->route('sys.referreds.index')
            ->with('success', 'Referido actualizado correctamente.');
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function destroy(Referred $referred)
    {
        // Verificar si tiene referidos asociados
        if ($referred->referrals()->count() > 0) {
            return redirect()->route('sys.referreds.index')
                ->with('error', 'No se puede eliminar el referido porque tiene otros referidos asociados.');
        }

        // Si no tiene referidos asociados, eliminar
        $referred->delete();

        return redirect()->route('sys.referreds.index')
            ->with('success', 'Referido eliminado correctamente.');
    }
}

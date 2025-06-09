<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

use App\Models\Applicant;
use App\Models\License;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with('license')->paginate(10); // Paginación de 10 por página

        return view('sys.applicants.index', compact('applicants'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        // Lista de países desde config/countries.php
        $countries = config('countries');

        // Tipos de sangre estándar
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        // Categorías de licencia disponibles
        $licenseCategories = ['A', 'B', 'C', 'D', 'E'];

        // Duraciones posibles
        $durations = [
            'digital' => ['3 months', '6 months', '1 year', '2 years', '5 years'],
            'physical' => ['1 year', '2 years', '5 years'],
        ];

        return view('sys.applicants.create', compact(
            'countries',
            'bloodTypes',
            'licenseCategories',
            'durations'
        ));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|string|unique:applicants,id_number',
            'birth_date' => 'required|date',
            'email' => 'nullable|email',
            'country_of_origin' => 'required|string',
            'address_1' => 'required|string',
            'address_2' => 'nullable|string',
            'phone_1' => 'required|string',
            'phone_2' => 'nullable|string',
            'passport_number' => 'nullable|string',
            'height_cm' => 'required|integer',
            'gender' => 'required|in:M,F',
            'eye_color' => 'required|string',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'has_local_license' => 'required|boolean',
            'license_type' => 'required|in:FISICA,DIGITAL',
            'duration' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:A,B,C,D,E',
            'transaction_number' => 'required|string|unique:licenses,transaction_number',
            'issued_at' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'license_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'license_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'extra_1' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'extra_2' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'extra_3' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $digitalDurations = ['3m', '6m', '1y', '2y', '5y'];
        $fisicaDurations = ['1y', '2y', '5y'];

        if ($request->license_type === 'DIGITAL' && !in_array($request->duration, $digitalDurations)) {
            return back()->withErrors(['duration' => 'Duración inválida para licencia DIGITAL'])->withInput();
        }

        if ($request->license_type === 'FISICA' && !in_array($request->duration, $fisicaDurations)) {
            return back()->withErrors(['duration' => 'Duración inválida para licencia FISICA'])->withInput();
        }

        DB::beginTransaction();

        try {
            $applicant = Applicant::create($request->only([
                'first_name', 'last_name', 'id_number', 'birth_date', 'email',
                'country_of_origin', 'address_1', 'address_2', 'phone_1', 'phone_2',
                'passport_number', 'height_cm', 'eye_color', 'blood_type', 'has_local_license',
                'gender'
            ]));

            $issuedAt = $request->issued_at ? Carbon::parse($request->issued_at) : now();

            $expiresAt = match ($request->duration) {
                '3m' => $issuedAt->copy()->addMonths(3),
                '6m' => $issuedAt->copy()->addMonths(6),
                '1y' => $issuedAt->copy()->addYear(),
                '2y' => $issuedAt->copy()->addYears(2),
                '5y' => $issuedAt->copy()->addYears(5),
                default => null,
            };

            $license = License::create([
                'applicant_id' => $applicant->id,
                'license_type' => $request->license_type,
                'duration' => $request->duration,
                'categories' => $request->categories,
                'transaction_number' => $request->transaction_number,
                'issued_at' => $issuedAt,
                'expires_at' => $expiresAt,
                'status' => 'inactiva',
            ]);

            $saveAttachment = function ($file, $type, $attachable) {
                $path = $file->store('attachments', 'public');
                return $attachable->attachments()->create([
                    'type' => $type,
                    'file_path' => $path,
                ]);
            };

            if ($request->hasFile('photo')) {
                $saveAttachment($request->file('photo'), 'photo', $applicant);
            }

            if ($request->hasFile('local_license_front')) {
                $saveAttachment($request->file('local_license_front'), 'local_license_front', $applicant);
            }

            if ($request->hasFile('local_license_back')) {
                $saveAttachment($request->file('local_license_back'), 'local_license_back', $applicant);
            }

            if ($request->hasFile('license_front')) {
                $saveAttachment($request->file('license_front'), 'license_front', $license);
            }

            if ($request->hasFile('license_back')) {
                $saveAttachment($request->file('license_back'), 'license_back', $license);
            }

            foreach (['extra_1', 'extra_2', 'extra_3'] as $extraType) {
                if ($request->hasFile($extraType)) {
                    $saveAttachment($request->file($extraType), $extraType, $license);
                }
            }

            DB::commit();

            return redirect()->route('sys.applicants.index')
                ->with('success', 'Applicant and license created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al guardar datos: ' . $e->getMessage()])
                ->withInput();
        }
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function show($id)
    {
        $applicant = Applicant::with(['license.attachments', 'attachments'])->findOrFail($id);

        return view('sys.applicants.show', compact('applicant'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function edit(Applicant $applicant)
    {
        $countries = config('countries');
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $licenseCategories = ['A', 'B', 'C', 'D', 'E'];
        $durations = [
            'digital' => ['3m', '6m', '1y', '2y', '5y'],
            'physical' => ['1y', '2y', '5y'],
        ];

        // Carga la licencia y sus attachments relacionados
        $applicant->load('license.attachments');

        return view('sys.applicants.edit', compact(
            'applicant',
            'countries',
            'bloodTypes',
            'licenseCategories',
            'durations'
        ));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);
        $license = $applicant->license;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255|unique:applicants,id_number,' . $applicant->id,
            'birth_date' => 'required|date',
            'email' => 'nullable|email|max:255',
            'country_of_origin' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'phone_1' => 'required|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'height_cm' => 'required|integer|min:0|max:300',
            'eye_color' => 'required|string|max:255',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'required|in:M,F',
            'has_local_license' => 'required|boolean',
            'transaction_number' => [
                'required',
                'string',
                Rule::unique('licenses', 'transaction_number')->ignore($license->id),
            ],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'local_license_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'local_license_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'license_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'license_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'extra_1' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'extra_2' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'extra_3' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {
            // Actualizar datos personales del solicitante
            $applicant->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'id_number' => $request->id_number,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'country_of_origin' => $request->country_of_origin,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'phone_1' => $request->phone_1,
                'phone_2' => $request->phone_2,
                'passport_number' => $request->passport_number,
                'height_cm' => $request->height_cm,
                'eye_color' => $request->eye_color,
                'blood_type' => $request->blood_type,
                'has_local_license' => $request->has_local_license,
                'gender' => $request->gender,
            ]);

            // Actualizar número de transacción de la licencia
            $license->update([
                'transaction_number' => $request->transaction_number,
            ]);

            // Función para guardar archivos
            $saveAttachment = function ($file, $type, $attachable) {
                $path = $file->store('attachments', 'public');
                return $attachable->attachments()->create([
                    'type' => $type,
                    'file_path' => $path,
                ]);
            };

            // Adjuntar archivos si vienen nuevos
            if ($request->hasFile('photo')) {
                $saveAttachment($request->file('photo'), 'photo', $applicant);
            }

            if ($request->hasFile('local_license_front')) {
                $saveAttachment($request->file('local_license_front'), 'local_license_front', $applicant);
            }

            if ($request->hasFile('local_license_back')) {
                $saveAttachment($request->file('local_license_back'), 'local_license_back', $applicant);
            }

            if ($request->hasFile('license_front')) {
                $saveAttachment($request->file('license_front'), 'license_front', $license);
            }

            if ($request->hasFile('license_back')) {
                $saveAttachment($request->file('license_back'), 'license_back', $license);
            }

            foreach (['extra_1', 'extra_2', 'extra_3'] as $extraType) {
                if ($request->hasFile($extraType)) {
                    $saveAttachment($request->file($extraType), $extraType, $license);
                }
            }

            DB::commit();

            return redirect()->route('sys.applicants.index')
                ->with('success', 'Solicitante actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()])
                ->withInput();
        }
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();

        return redirect()->route('sys.applicants.index')->with('success', 'Solicitante eliminado correctamente.');
    }
}

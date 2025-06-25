<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\JumatanTime;
use App\Models\Ustadz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JumatTimeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Waktu Ju\'at - Khatib, Bilal & Muadzin',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => "Waktu Jum'at",
                    'link' => route('back.partner-link.index')
                ]
            ],
            'list_jumat' => JumatanTime::latest()->get(),
            'list_ustadz' => Ustadz::all()

        ];

        // return response()->json($data);
        return view('back.jumat-time.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ustadz_id' => 'required|exists:ustadz,id',
            'bilal' => 'nullable|string|max:255',
            'muadzin' => 'nullable|string|max:255',
            'date' => 'required|date',
        ], [
            'ustadz_id.required' => 'Ustadz wajib dipilih',
            'ustadz_id.exists' => 'Ustadz yang dipilih tidak valid',
            'bilal.string' => 'Bilal harus berupa teks',
            'bilal.max' => 'Bilal maksimal 255 karakter',
            'muadzin.string' => 'Muadzin harus berupa teks',
            'muadzin.max' => 'Muadzin maksimal 255 karakter',
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Format tanggal tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new JumatanTime();
        $data->ustadz_id = $request->ustadz_id;
        $data->bilal = $request->bilal;
        $data->muadzin = $request->muadzin;
        $data->date = $request->date;
        $data->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.jumat-time.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ustadz_id' => 'required|exists:ustadz,id',
            'bilal' => 'nullable|string|max:255',
            'muadzin' => 'nullable|string|max:255',
            'date' => 'required|date',
        ], [
            'ustadz_id.required' => 'Ustadz wajib dipilih',
            'ustadz_id.exists' => 'Ustadz yang dipilih tidak valid',
            'bilal.string' => 'Bilal harus berupa teks',
            'bilal.max' => 'Bilal maksimal 255 karakter',
            'muadzin.string' => 'Muadzin harus berupa teks',
            'muadzin.max' => 'Muadzin maksimal 255 karakter',
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Format tanggal tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = JumatanTime::find($id);
        $data->ustadz_id = $request->ustadz_id;
        $data->bilal = $request->bilal;
        $data->muadzin = $request->muadzin;
        $data->date = $request->date;
        $data->save();

        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('back.jumat-time.index');
    }

    public function destroy($id)
    {
        $data = JumatanTime::find($id);
        if (!$data) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }

        $data->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.jumat-time.index');
    }
}

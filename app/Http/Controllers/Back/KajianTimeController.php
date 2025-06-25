<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KajianTime;
use App\Models\Ustadz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KajianTimeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Waktu Kajian',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => "Waktu Kajian",
                    'link' => route('back.partner-link.index')
                ]
            ],
            'list_kajian' => KajianTime::latest()->get(),
            'list_ustadz' => Ustadz::all()

        ];

        // return response()->json($data);
        return view('back.kajian-time.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ustadz_id' => 'required|exists:ustadz,id',
            'datetime' => 'required|date',
            'theme' => 'nullable|string|max:255',
        ], [
            'ustadz_id.required' => 'Ustadz wajib dipilih',
            'ustadz_id.exists' => 'Ustadz yang dipilih tidak valid',
            'date.required' => 'Tanggal wajib diisi',
            'datetime.date' => 'Format tanggal dan waktu tidak valid',
            'theme.string' => 'Tema harus berupa teks',
            'theme.max' => 'Tema maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = new KajianTime();
        $data->ustadz_id = $request->ustadz_id;
        $data->datetime = $request->datetime;
        $data->theme = $request->theme;
        $data->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.kajian-time.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ustadz_id' => 'required|exists:ustadz,id',
            'datetime' => 'required|date',
            'theme' => 'nullable|string|max:255',
        ], [
            'ustadz_id.required' => 'Ustadz wajib dipilih',
            'ustadz_id.exists' => 'Ustadz yang dipilih tidak valid',
            'date.required' => 'Tanggal wajib diisi',
            'datetime.date' => 'Format tanggal dan waktu tidak valid',
            'theme.string' => 'Tema harus berupa teks',
            'theme.max' => 'Tema maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = KajianTime::find($id);
        if (!$data) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }

        $data->ustadz_id = $request->ustadz_id;
        $data->datetime = $request->datetime;
        $data->theme = $request->theme;
        $data->save();

        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('back.kajian-time.index');
    }

    public function destroy($id)
    {
        $data = KajianTime::find($id);
        if (!$data) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }

        $data->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.kajian-time.index');
    }
}

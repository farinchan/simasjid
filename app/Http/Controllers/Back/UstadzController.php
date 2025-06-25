<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Ustadz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UstadzController extends Controller
{
     public function index()
    {
        $data = [
            'title' => 'Partner Link',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => 'Ustadz',
                    'link' => route('back.partner-link.index')
                ]
            ],
            'list_ustadz' => Ustadz::all(),
        ];

        // return response()->json($data);
        return view('back.ustadz.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'address' => 'nullable',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email',
        ], [
            'name.required' => 'Nama ustadz wajib diisi',
            'name.string' => 'Nama ustadz harus berupa teks',
            'name.max' => 'Nama ustadz maksimal 255 karakter',
            'photo.image' => 'File yang diunggah harus berupa gambar',
            'photo.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif, svg',
            'photo.max' => 'Ukuran gambar maksimal 10 MB',
            'address.string' => 'Alamat harus berupa teks',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'email.email' => 'Format email tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Ustadz::create([
            'name' => $request->name,
            'photo' => $request->hasFile('photo') ? $request->file('photo')->storeAs('ustadz', Str::random(16). '.' . $request->file('photo')->extension(), 'public') : null,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.ustadz.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'address' => 'nullable',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email',
        ], [
            'name.required' => 'Nama ustadz wajib diisi',
            'name.string' => 'Nama ustadz harus berupa teks',
            'name.max' => 'Nama ustadz maksimal 255 karakter',
            'photo.image' => 'File yang diunggah harus berupa gambar',
            'photo.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif, svg',
            'photo.max' => 'Ukuran gambar maksimal 10 MB',
            'address.string' => 'Alamat harus berupa teks',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'email.email' => 'Format email tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Ustadz::find($id);
        $data->name = $request->name;
        if ($request->hasFile('photo')) {
            Storage::delete($data->photo);
            $data->photo = $request->file('photo')->storeAs('ustadz', Str::slug($request->name) . '.' . $request->file('photo')->extension(), 'public');
        }
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('back.ustadz.index');
    }

    public function destroy($id)
    {
        $data = Ustadz::find($id);
        if ($data->photo) {
            Storage::delete($data->photo);
        }
        $data->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.ustadz.index');
    }
}

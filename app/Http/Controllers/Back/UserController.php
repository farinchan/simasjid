<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Pengguna',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => 'Pengguna',
                    'link' => route('back.user.index')
                ]
            ],
            'users' => User::all()
        ];

        return view('back.pages.user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => 'Pengguna',
                    'link' => route('back.user.index')
                ],
                [
                    'name' => 'Tambah Pengguna',
                    'link' => route('back.user.create')
                ]
            ]
        ];

        return view('back.pages.user.create', $data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'github' => 'nullable|url',
            'password' => 'required',
        ], [
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berformat jpg, jpeg, png',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'linkedin.url' => 'URL LinkedIn tidak valid',
            'instagram.url' => 'URL Instagram tidak valid',
            'github.url' => 'URL GitHub tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->all());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->linkedin = $request->linkedin;
        $user->instagram = $request->instagram;
        $user->github = $request->github;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::slug($request->name) . "-" . time() . "." . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('uploads/user/photo', $photoName, 'public');
            $user->photo = $photoPath;
        }
        $user->save();

        if ($request->role_admin) {
            $user->assignRole('super-admin');
        }


        Alert::success('Berhasil', 'Data pengguna berhasil ditambahkan');
        return redirect()->route('back.user.index')->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'menu' => 'Pengguna',
            'sub_menu' => '',
            'user' => User::find($id)
        ];

        return view('back.pages.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'github' => 'nullable|url',
            'password' => 'nullable',
        ], [
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berformat jpg, jpeg, png',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'linkedin.url' => 'URL LinkedIn tidak valid',
            'instagram.url' => 'URL Instagram tidak valid',
            'github.url' => 'URL GitHub tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->all());
        }

        $user = User::find($id);
        $user->name = $request->name;

        $user->email = $request->email;
        $user->linkedin = $request->linkedin;
        $user->instagram = $request->instagram;
        $user->github = $request->github;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::slug($request->name) . "-" . time() . "." . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('uploads/user/photo', $photoName, 'public');
            $user->photo = $photoPath;
        }
        $user->save();


        if ($request->role_admin) {
            $user->assignRole('super-admin');
        } else {
            $user->removeRole('super-admin');
        }


        Alert::success('Berhasil', 'Data pengguna berhasil diubah');
        return redirect()->route('back.user.index')->with('success', 'Data pengguna berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user?->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();

        return redirect()->route('back.user.index')->with('success', 'Data pengguna berhasil dihapus');
    }
}

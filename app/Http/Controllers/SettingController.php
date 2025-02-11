<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {	
        return view('pages.settings.index');
    }

    public function update(Request $request)
    {
        // Validate the incoming request.
        $request->validate(
            [
                'app_name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'app_logo' => [
                    'nullable',
                    'image',
                    'mimes:png',
                    'max:2048', // 2MB max size
                ],
            ],
            [
                'app_name.required' => 'Nama aplikasi wajib diisi!',
                'app_name.string' => 'Nama aplikasi harus berupa string!',
                'app_name.max' => 'Nama aplikasi maksimal 255 karakter!',
                'app_logo.image' => 'Logo aplikasi harus berupa gambar!',
                'app_logo.mimes' => 'Logo aplikasi harus berupa berkas berformat PNG!',
                'app_logo.max' => 'Logo aplikasi tidak boleh lebih dari 2MB!',
            ],
        );

        // Update the .env file.
        $data = [
            'APP_NAME' => $request->app_name,
        ];
        
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $envContent = preg_replace("/^{$key}=.*/m", "{$key}=\"{$value}\"", $envContent);
        }

        File::put($envPath, $envContent);

        // Update the app logo.
        if ($request->hasFile('app_logo')) {
            $oldLogo = public_path('images/logo.png');
            if (File::exists($oldLogo)) {
                File::delete($oldLogo);
            }
            
            $logo = $request->file('app_logo');
            $logo->move(public_path('images'), 'logo.png');
        }

        return redirect()->back()->with('success', 'Pengaturan aplikasi berhasil diubah!');
    }
}

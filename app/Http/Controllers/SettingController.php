<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();

        return view('setting/form', compact(['setting']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $filename_square = '';
        if ($request->file('path_logo_square')) {
            //$name_square = $request->file('path_logo_square')->getClientOriginalName();
            $extension_square = $request->file('path_logo_square')->getClientOriginalExtension();
            $filename_square = $request->nama_rumahsakit . "_square." . $extension_square;
            $request->file('path_logo_square')->storeAs('logo', $filename_square);
        }
        $filename_login = '';
        if ($request->file('path_logo_login')) {
            //$name_login = $request->file('path_logo_login')->getClientOriginalName();
            $extension_login = $request->file('path_logo_login')->getClientOriginalExtension();
            $filename_login = $request->nama_rumahsakit . "_login." . $extension_login;
            $request->file('path_logo_login')->storeAs('logo', $filename_login);
        }

        $setting = Setting::findOrFail($id);

        $setting->nama_rumahsakit = $request['nama_rumahsakit'];
        $setting->kode_rumahsakit = $request['kode_rumahsakit'];
        $setting->alias_rumahsakit = $request['alias_rumahsakit'];
        $setting->alamat = $request['alamat'];
        $setting->telepon = $request['telepon'];
        $setting->path_logo_square = $filename_square;
        $setting->path_logo_login = $filename_login;

        $setting->save();

        return redirect('setting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebSettingController extends Controller
{
    public function edit()
    {
        $setting = WebSetting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:2048',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'header_background' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'header_text' => 'required|string|max:255',
            'about_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'footer_address' => 'required|string',
            'footer_phone' => 'required|string',
            'footer_email' => 'required|email',
            'footer_facebook' => 'nullable|url',
            'footer_instagram' => 'nullable|url',
            'footer_youtube' => 'nullable|url',
        ]);

        $setting = WebSetting::first() ?? new WebSetting();

        // Handle file uploads
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::delete('public/' . $setting->favicon);
            }
            $setting->favicon = $request->file('favicon')->store('settings', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::delete('public/' . $setting->logo);
            }
            $setting->logo = $request->file('logo')->store('settings', 'public');
        }

        // Update other fields
        $setting->fill($request->except(['favicon', 'logo']));
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui');
    }
} 
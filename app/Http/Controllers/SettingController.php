<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{

    /**
     * Display Settings Page
     */
    public function index()
    {
        // Gate::authorize('manage-sitting');

        $setting = Setting::first();


        if (!$setting) {

            $setting = Setting::create([

                'site_name' => 'Student Management System',

                'timezone' => 'Asia/Karachi',

                'currency' => 'PKR',

                'maintenance_mode' => false,

            ]);
        }


        return view('settings.index', compact('setting'));
    }



    /**
     * Update Settings
     */
    public function update(Request $request)
    {
        Gate::authorize('manage-sitting');

        $setting = Setting::first();



        $request->validate([


            'site_name' => 'required|max:255',


            'site_email' => 'nullable|email',


            'site_phone' => 'nullable|max:20',


            'site_address' => 'nullable|max:500',


            'timezone' => 'required|max:100',


            'currency' => 'required|max:20',


            'logo' => 'nullable|image',


            'favicon' => 'nullable|image|mimes:png,ico|max:1024',


        ]);





        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('logo')) {


            if ($setting->logo && File::exists(public_path($setting->logo))) {

                File::delete(public_path($setting->logo));
            }



            $logoName = time() . '_logo.'
                . $request->logo->extension();



            $request->logo->move(

                public_path('uploads/settings'),

                $logoName

            );



            $setting->logo =
                'uploads/settings/' . $logoName;
        }





        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('favicon')) {


            if ($setting->favicon && File::exists(public_path($setting->favicon))) {

                File::delete(public_path($setting->favicon));
            }



            $faviconName = time() . '_favicon.'
                . $request->favicon->extension();



            $request->favicon->move(

                public_path('uploads/settings'),

                $faviconName

            );



            $setting->favicon =
                'uploads/settings/' . $faviconName;
        }





        /*
        |--------------------------------------------------------------------------
        | Save Data
        |--------------------------------------------------------------------------
        */


        $setting->site_name = $request->site_name;


        $setting->site_email = $request->site_email;


        $setting->site_phone = $request->site_phone;


        $setting->site_address = $request->site_address;


        $setting->timezone = $request->timezone;


        $setting->currency = $request->currency;


        $setting->maintenance_mode =
            $request->has('maintenance_mode');



        $setting->save();



        return back()->with(
            'success',
            'Settings Updated Successfully.'
        );
    }
}

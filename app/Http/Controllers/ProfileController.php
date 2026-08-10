<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        return view('profile.index', compact('user'));
    }



    public function update(Request $request)
    {

        $user = auth()->user();


        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'nullable',
            'address' => 'nullable',

        ]);



        $user->name = $request->name;

        $user->email = $request->email;

        $user->phone = $request->phone;

        $user->address = $request->address;



        // Password Update

        if ($request->filled('password')) {

            $request->validate([

                'password' => 'min:6|confirmed'

            ]);


            $user->password = Hash::make(
                $request->password
            );
        }



        // Profile Image Upload

        if ($request->hasFile('image')) {

            $request->validate([

                'image' => 'image|mimes:jpg,jpeg,png|max:2048'

            ]);



            $imageName = time() . '.' . $request->image->extension();



            $request->image->move(

                public_path('uploads/profile'),

                $imageName

            );


            $user->image = $imageName;
        }



        $user->save();



        return back()->with(
            'success',
            'Profile Updated Successfully'
        );
    }
}
